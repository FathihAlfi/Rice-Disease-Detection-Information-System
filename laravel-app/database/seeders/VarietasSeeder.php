<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VarietasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('varietas')->insert([
        ['varietas_id' => 1, 'jenis_id' => 1, 'nama_varietas' => 'Inpari 32'],
        ['varietas_id' => 2, 'jenis_id' => 1, 'nama_varietas' => 'Ciherang'],
        ['varietas_id' => 3, 'jenis_id' => 2, 'nama_varietas' => 'Inpago 8'],
        ['varietas_id' => 4, 'jenis_id' => 2, 'nama_varietas' => 'Inpago 10'],
        ['varietas_id' => 5, 'jenis_id' => 3, 'nama_varietas' => 'Situ Bagendit'],
        ['varietas_id' => 6, 'jenis_id' => 3, 'nama_varietas' => 'Rojolele'],
    ]);
    }
}
