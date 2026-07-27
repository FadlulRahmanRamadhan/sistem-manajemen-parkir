<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\ParkingController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
Route::middleware('auth')->group(function () {

    Route::resource('vehicles', VehicleController::class);

    // PDF
    Route::get('/parkings/pdf', [ParkingController::class, 'cetakPdf'])
        ->name('parkings.pdf');

    // Riwayat
    Route::get('/parkings/riwayat', [ParkingController::class, 'riwayat'])
        ->name('parkings.riwayat');

        // Laporan Parkir
Route::get('/laporan', [App\Http\Controllers\LaporanController::class, 'index'])->name('laporan.index');
Route::get('/laporan/pdf', [App\Http\Controllers\LaporanController::class, 'pdf'])->name('laporan.pdf');

    // Data parkir
    Route::resource('parkings', ParkingController::class);

    // Kendaraan keluar
    Route::put('/parkings/{parking}/keluar', [ParkingController::class, 'keluar'])
        ->name('parkings.keluar');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

        Route::get('/parkings/{parking}/struk', [ParkingController::class, 'cetakStruk'])
    ->name('parkings.struk');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');

        Route::post('/profile/foto', [ProfileController::class, 'uploadFoto'])
    ->name('profile.foto');
});

require __DIR__.'/auth.php';