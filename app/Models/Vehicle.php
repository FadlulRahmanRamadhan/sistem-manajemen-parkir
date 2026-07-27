<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    protected $fillable = [
        'plat_nomor',
        'nama_pemilik',
        'jenis_kendaraan',
    ];

    public function parkings()
    {
        return $this->hasMany(Parking::class);
    }
}