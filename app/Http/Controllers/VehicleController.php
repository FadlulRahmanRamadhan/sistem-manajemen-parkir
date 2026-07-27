<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    public function index(Request $request)
{
    $query = Vehicle::query();

    if ($request->filled('keyword')) {
        $keyword = $request->keyword;
        $query->where(function($q) use ($keyword) {
            $q->where('plat_nomor', 'LIKE', "%$keyword%")
              ->orWhere('nama_pemilik', 'LIKE', "%$keyword%");
        });
    }

    if ($request->filled('jenis')) {
        $query->where('jenis_kendaraan', $request->jenis);
    }

    $vehicles = $query->get();

    return view('vehicles.index', compact('vehicles'));
}

    public function create()
    {
        return view('vehicles.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'plat_nomor' => 'required',
            'nama_pemilik' => 'required',
            'jenis_kendaraan' => 'required',
        ]);

        Vehicle::create([
            'plat_nomor' => $request->plat_nomor,
            'nama_pemilik' => $request->nama_pemilik,
            'jenis_kendaraan' => $request->jenis_kendaraan,
        ]);

        return redirect()->route('vehicles.index')
            ->with('success', 'Data kendaraan berhasil ditambahkan');
    }

    public function edit(Vehicle $vehicle)
    {
        return view('vehicles.edit', compact('vehicle'));
    }

    public function update(Request $request, Vehicle $vehicle)
    {
        $request->validate([
            'plat_nomor' => 'required',
            'nama_pemilik' => 'required',
            'jenis_kendaraan' => 'required',
        ]);

        $vehicle->update([
            'plat_nomor' => $request->plat_nomor,
            'nama_pemilik' => $request->nama_pemilik,
            'jenis_kendaraan' => $request->jenis_kendaraan,
        ]);

        return redirect()->route('vehicles.index')
            ->with('success', 'Data kendaraan berhasil diubah');
    }

    public function destroy(Vehicle $vehicle)
    {
        $vehicle->delete();

        return redirect()->route('vehicles.index')
            ->with('success', 'Data kendaraan berhasil dihapus');
    }
}