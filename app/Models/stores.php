<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class stores extends Model
{
    protected $fillable = ['kode_toko', 'nama_toko', 'alamat', 'nomor_telepon'];

    public function sales()
    {
        return $this->hasMany(sales::class, 'store_id');
    }

    public function products()
    {
        return $this->belongsToMany(products::class, 'sales')->withPivot('banyak_terjual', 'harga_unit', 'durasi_penjualan');
    }
}
