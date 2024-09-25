<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class Storesseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        DB::table('stores')->insert([
            [
                'id' => 1,
                'kode_toko' => '001',
                'nama_toko' => 'Toko Segar',
                'alamat' => 'jalan raya sukajalan',
                'nomor_telepon' => null,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'id' => 2,
                'kode_toko' => '002',
                'nama_toko' => 'Toko XYZ',
                'alamat' => 'jalan raya jalan terus',
                'nomor_telepon' => null,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'id' => 3,
                'kode_toko' => '003',
                'nama_toko' => 'Toko Herman',
                'alamat' => 'jalan raya heran',
                'nomor_telepon' => null,
                'created_at' => $now,
                'updated_at' => $now
            ],
        ]);
    }   
}
