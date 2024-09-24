<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class Loginseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        DB::table('users')->insert([
            [
                'id' => 1145923,
                'name' => 'Admin1',
                'email' => 'Admin1@gmail.com',
                'password' => Hash::make('password'),
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'id' => 1975437,
                'name' => 'Admin2',
                'email' => 'Admin2@gmail.com',
                'password' => Hash::make('password'),
                'created_at' => $now,
                'updated_at' => $now
            ],
        ]);
    }
}
