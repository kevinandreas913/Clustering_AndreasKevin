<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class products extends Model
{
    protected $fillable = ['kode_barang', 'nama', 'deskripsi', 'harga'];

    public function sales()
    {
        return $this->hasMany(sales::class, 'product_id');
    }

    public function stores()
    {
        return $this->belongsToMany(\App\Models\stores::class, 'sales')->withPivot('banyak_terjual', 'harga_unit', 'durasi_penjualan');
    }
    
}
