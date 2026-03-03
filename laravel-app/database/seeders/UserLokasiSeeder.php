<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserLokasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('user_lokasis')->insert([
            [
                'user_id' => 2,
                'kabkot_id' => 1,
                'kecamatan_id' => 1,
                'nagari_id' => 1,
                'jorong_id' => 1,
            ],

            [
                'user_id' => 2,
                'kabkot_id' => 1,
                'kecamatan_id' => 1,
                'nagari_id' => 1,
                'jorong_id' => 2,
            ],

              [
                'user_id' => 2,
                'kabkot_id' => 1,
                'kecamatan_id' => 1,
                'nagari_id' => 2,
                'jorong_id' => 3,
            ],

              [
                'user_id' => 2,
                'kabkot_id' => 1,
                'kecamatan_id' => 1,
                'nagari_id' => 2,
                'jorong_id' => 4,
            ],

              [
                'user_id' => 2,
                'kabkot_id' => 1,
                'kecamatan_id' => 1,
                'nagari_id' => 3,
                'jorong_id' => 5,
            ],

              [
                'user_id' => 2,
                'kabkot_id' => 1,
                'kecamatan_id' => 1,
                'nagari_id' => 3,
                'jorong_id' => 6,
            ],

              [
                'user_id' => 2,
                'kabkot_id' => 1,
                'kecamatan_id' => 1,
                'nagari_id' => 4,
                'jorong_id' => 7,
            ],
        ]);
    }
}
