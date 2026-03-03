<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JenisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('jenis')->insert([
        ['jenis_id' => 1, 'nama_jenis' => 'Padi Sawah'],
        ['jenis_id' => 2, 'nama_jenis' => 'Padi Gogo'],
        ['jenis_id' => 3, 'nama_jenis' => 'Padi Organik'],
    ]);
    }
}
