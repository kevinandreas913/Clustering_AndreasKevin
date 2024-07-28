<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class Productsseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        DB::table('products')->insert([
            [
                'id' => 1,
                'kode_barang' => '111',
                'nama' => 'Produk A',
                'deskripsi' => 'produk A sejak 2001 dengan rasa A',
                'harga' => 20000,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'id' => 2,
                'kode_barang' => '101',
                'nama' => 'Produk B',
                'deskripsi' => 'produk B sejak 2001 dengan rasa B',
                'harga' => 25000,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'id' => 3,
                'kode_barang' => '112',
                'nama' => 'Produk C',
                'deskripsi' => 'produk C sejak 2001 dengan rasa C',
                'harga' => 30000,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'id' => 4,
                'kode_barang' => '113',
                'nama' => 'Produk D',
                'deskripsi' => 'produk D sejak 2001 dengan rasa D',
                'harga' => 40000,
                'created_at' => $now,
                'updated_at' => $now
            ],
        ]);
    }
}
