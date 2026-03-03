<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MetodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('metode')->insert([
        ['metode_id' => 1, 'nama_metode' => 'Pengamatan Makroskopis'],
        ['metode_id' => 2, 'nama_metode' => 'Pengamatan Mikroskopis'],
    ]);
    }
}
