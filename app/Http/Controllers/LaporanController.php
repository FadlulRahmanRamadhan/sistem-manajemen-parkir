<?php

namespace App\Http\Controllers;

use App\Models\Parking;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $query = Parking::with('vehicle')->where('status', 'Keluar');

        if ($request->filled('tanggal_awal')) {
            $query->whereDate('waktu_keluar', '>=', $request->tanggal_awal);
        }

        if ($request->filled('tanggal_akhir')) {
            $query->whereDate('waktu_keluar', '<=', $request->tanggal_akhir);
        }

        $laporan = $query->orderBy('waktu_keluar', 'desc')->get();
        $totalPendapatan = $laporan->sum('tarif');

        return view('laporan.index', compact('laporan', 'totalPendapatan'));
    }

    public function pdf(Request $request)
    {
        // Ambil data dengan filter yang sama seperti di index
        $query = Parking::with('vehicle')->where('status', 'Keluar');

        if ($request->filled('tanggal_awal')) {
            $query->whereDate('waktu_keluar', '>=', $request->tanggal_awal);
        }

        if ($request->filled('tanggal_akhir')) {
            $query->whereDate('waktu_keluar', '<=', $request->tanggal_akhir);
        }

        $laporan = $query->orderBy('waktu_keluar', 'desc')->get();
        $totalPendapatan = $laporan->sum('tarif');

        // Load view PDF
        $pdf = Pdf::loadView('laporan.pdf', compact('laporan', 'totalPendapatan'));
        $pdf->setPaper('A4', 'landscape');

        // Download file PDF
        return $pdf->download('laporan-parkir-' . date('d-m-Y') . '.pdf');
    }
}