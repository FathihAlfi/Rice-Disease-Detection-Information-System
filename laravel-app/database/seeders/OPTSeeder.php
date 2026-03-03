<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OPTSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('opt')->insert([
            ['opt_id' => 1, 'nama_opt' => 'Blast', 'kategori_opt' => 'Penyakit'],
            ['opt_id' => 2, 'nama_opt' => 'Blight', 'kategori_opt' => 'Penyakit'],
            ['opt_id' => 3, 'nama_opt' => 'BrownSpot', 'kategori_opt' => 'Penyakit'],
            ['opt_id' => 4, 'nama_opt' => 'Tungro', 'kategori_opt' => 'Penyakit'],
            ['opt_id' => 5, 'nama_opt' => 'Tikus', 'kategori_opt' => 'Hama'],
            ['opt_id' => 6, 'nama_opt' => 'Wereng Batang Coklat', 'kategori_opt' => 'Hama'],
            ['opt_id' => 7, 'nama_opt' => 'Penggerek Batang', 'kategori_opt' => 'Hama'],
            ['opt_id' => 8, 'nama_opt' => 'Kepinding Tanah', 'kategori_opt' => 'Hama'],
        ]);
    }
}
