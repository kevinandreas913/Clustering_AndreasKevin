<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class sales extends Model
{
    use HasFactory;

    protected $fillable = ['uuid', 'product_id', 'store_id', 'banyak_terjual', 'harga_unit', 'durasi_penjualan', 'bulan_periode'];

    // public function sales()
    // {
    //     return $this->hasMany(\App\Models\sales::class);
    // }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->uuid)) {
                $model->uuid = Str::uuid();
            }
        });
    }

    // public function products()
    // {
    //     return $this->belongsToMany(\App\Models\products::class, 'sales')->withPivot('banyak_terjual', 'harga_unit', 'durasi_penjualan');
    // }

    public function product()
    {
        return $this->belongsTo(products::class, 'product_id');
    }

    public function store()
    {
        return $this->belongsTo(stores::class, 'store_id');
    }
}
