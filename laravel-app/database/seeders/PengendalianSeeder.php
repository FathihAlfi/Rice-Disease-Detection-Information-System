<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PengendalianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('pengendalian')->insert([
        ['opt_id' => 1, 'deskripsi' => 'Semprot insektisida untuk Wereng'],
        ['opt_id' => 2, 'deskripsi' => 'Gunakan varietas tahan Blast'],
        ['opt_id' => 3, 'deskripsi' => 'Pasang jebakan tikus'],
        ['opt_id' => 4, 'deskripsi' => 'Fungisida untuk Blight'],
        ['opt_id' => 5, 'deskripsi' => 'Kendalikan dengan biopestisida'],
    ]);
    }
}
