<?php

namespace App\Http\Controllers;

use App\Models\Parking;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class ParkingController extends Controller
{
    public function index(Request $request)
{
    $keyword = $request->keyword;
    $status = $request->status;

    $parkings = Parking::with('vehicle')
        ->when($keyword, function ($query) use ($keyword) {
            $query->whereHas('vehicle', function ($q) use ($keyword) {
                $q->where('plat_nomor', 'like', '%' . $keyword . '%');
            });
        })
        ->when($status, function ($query) use ($status) {
            $query->where('status', $status);
        })
        ->get();

    return view('parkings.index', compact('parkings'));
}
    public function create()
    {
        $vehicles = Vehicle::all();

        return view('parkings.create', compact('vehicles'));
    }

   public function store(Request $request)
{
    $request->validate([
        'vehicle_id' => 'required',
    ]);

    $parking = Parking::create([
        'vehicle_id' => $request->vehicle_id,
        'waktu_masuk' => now(),
        'status' => 'Masuk',
    ]);

  return redirect()
    ->route('parkings.struk', $parking->id)
    ->with('success', 'Data parkir berhasil ditambahkan');
}

    public function cetakStruk(Parking $parking)
{
    $pdf = Pdf::loadView('parkings.struk', compact('parking'));

    return $pdf->stream('struk-parkir.pdf');
}

    public function keluar(Parking $parking)
    {
        $waktuKeluar = now();

        $durasi = ceil(
            strtotime($waktuKeluar) -
            strtotime($parking->waktu_masuk)
        );

        $durasiJam = max(1, ceil($durasi / 3600));

        if ($parking->vehicle->jenis_kendaraan == 'Motor') {

            $tarifPerJam = 2000;
            $maksimal = 20000;

        } else {

            $tarifPerJam = 5000;
            $maksimal = 50000;

        }

        $totalTarif = $durasiJam * $tarifPerJam;

        if ($totalTarif > $maksimal) {
            $totalTarif = $maksimal;
        }

        $parking->update([
            'waktu_keluar' => $waktuKeluar,
            'durasi' => $durasiJam,
            'tarif' => $totalTarif,
            'status' => 'Keluar',
        ]);

        return redirect()->route('parkings.index')
            ->with('success', 'Kendaraan keluar berhasil diproses');
    }

  public function riwayat(Request $request)
{
    $tanggalAwal = $request->tanggal_awal;
    $tanggalAkhir = $request->tanggal_akhir;

    $riwayat = Parking::with('vehicle')
        ->where('status', 'Keluar')

        ->when($tanggalAwal, function ($query) use ($tanggalAwal) {
            $query->whereDate('waktu_keluar', '>=', $tanggalAwal);
        })

        ->when($tanggalAkhir, function ($query) use ($tanggalAkhir) {
            $query->whereDate('waktu_keluar', '<=', $tanggalAkhir);
        })

        ->latest()
        ->get();

    return view('parkings.riwayat', compact('riwayat'));
}
public function destroy(Parking $parking)
{
    $parking->delete();

    return redirect()->route('parkings.index')
        ->with('success', 'Data parkir berhasil dihapus');
}
public function cetakPdf()
{
    $riwayat = Parking::with('vehicle')
        ->where('status', 'Keluar')
        ->get();

    $pdf = Pdf::loadView('parkings.pdf', compact('riwayat'));

    return $pdf->download('laporan-parkir.pdf');

    
}
}