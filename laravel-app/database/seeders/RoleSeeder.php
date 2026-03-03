<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    public function run()
    {
        DB::table('roles')->insert([
            [
                'role_id' => 1,
                'nama_role' => 'Admin',
                'tugas_role' => 'Mengelola sistem dan pengguna'
            ],
            [
                'role_id' => 2,
                'nama_role' => 'POPT',
                'tugas_role' => 'Melakukan pengamatan dan input data lapangan'
            ],
            [
                'role_id' => 3,
                'nama_role' => 'Staff Lab (Penerima Sampel)',
                'tugas_role' => 'Melakukan diagnosa dan membuat rekomendasi'
            ],
            [
                'role_id' => 4,
                'nama_role' => 'Staff Lab (Analis)',
                'tugas_role' => 'Melakukan diagnosa dan membuat rekomendasi'
            ],
            [
                'role_id' => 5,
                'nama_role' => 'Manager Teknis',
                'tugas_role' => 'Memeriksa hasil analisa yang dibuat oleh analis'
            ],
            [
                'role_id' => 6,
                'nama_role' => 'Manager Mutu',
                'tugas_role' => 'Menyetujui hasil analisa yang telah diperiksa oleh Manager Teknis'
            ],
            [
                'role_id' => 7,
                'nama_role' => 'Kepala LPHP',
                'tugas_role' => 'Mengevaluasi dan Mensahkan Laporan Diagnosa dan rekomendasi'
            ]
        ]);
    }
}