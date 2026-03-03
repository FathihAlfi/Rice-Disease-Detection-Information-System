<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KabKotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('kab_kota')->insert([
            // --- 12 Kabupaten ---
            ['kabkot_id' => 1, 'nama_kabkot' => 'Kabupaten Agam'],
            ['kabkot_id' => 2, 'nama_kabkot' => 'Kabupaten Dharmasraya'],
            ['kabkot_id' => 3, 'nama_kabkot' => 'Kabupaten Kepulauan Mentawai'],
            ['kabkot_id' => 4, 'nama_kabkot' => 'Kabupaten Lima Puluh Kota'],
            ['kabkot_id' => 5, 'nama_kabkot' => 'Kabupaten Padang Pariaman'],
            ['kabkot_id' => 6, 'nama_kabkot' => 'Kabupaten Pasaman'],
            ['kabkot_id' => 7, 'nama_kabkot' => 'Kabupaten Pasaman Barat'],
            ['kabkot_id' => 8, 'nama_kabkot' => 'Kabupaten Pesisir Selatan'],
            ['kabkot_id' => 9, 'nama_kabkot' => 'Kabupaten Sijunjung'],
            ['kabkot_id' => 10, 'nama_kabkot' => 'Kabupaten Solok'],
            ['kabkot_id' => 11, 'nama_kabkot' => 'Kabupaten Solok Selatan'],
            ['kabkot_id' => 12, 'nama_kabkot' => 'Kabupaten Tanah Datar'],

            // --- 7 Kota ---
            ['kabkot_id' => 13, 'nama_kabkot' => 'Kota Padang'],
            ['kabkot_id' => 14, 'nama_kabkot' => 'Kota Bukittinggi'],
            ['kabkot_id' => 15, 'nama_kabkot' => 'Kota Padang Panjang'],
            ['kabkot_id' => 16, 'nama_kabkot' => 'Kota Pariaman'],
            ['kabkot_id' => 17, 'nama_kabkot' => 'Kota Payakumbuh'],
            ['kabkot_id' => 18, 'nama_kabkot' => 'Kota Sawahlunto'],
            ['kabkot_id' => 19, 'nama_kabkot' => 'Kota Solok'],
        ]);
    }
}
