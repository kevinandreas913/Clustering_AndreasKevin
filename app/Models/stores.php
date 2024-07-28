<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class stores extends Model
{
    protected $fillable = ['kode_toko', 'nama_toko', 'alamat', 'nomor_telepon', 'kesepakatan', 'lokasi', 'pelayanan', 'hasil'];

    public function sales()
    {
        return $this->hasMany(Sales::class, 'store_id');
    }

    public function products()
    {
        return $this->belongsToMany(Products::class, 'sales')->withPivot('banyak_terjual', 'harga_unit', 'durasi_penjualan');
    }
}
