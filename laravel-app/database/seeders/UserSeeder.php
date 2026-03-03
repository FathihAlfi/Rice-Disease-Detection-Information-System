<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            [
                'role_id' => 1, 
                'nama' => 'Admin',
                'nip' => 1987654321,
                'no_telp' => '081234567890',
                'wilayah' => 'Padang Pariaman',
                'alamat' => 'Jl. Contoh No.1',
                'email' => 'admin@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('admin123'),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'role_id' => 2, 
                'nama' => 'POPT1',
                'nip' => 1987654322,
                'no_telp' => '081234567891',
                'wilayah' => 'Agam',
                'alamat' => 'Jl. Mawar No.2',
                'email' => 'popt@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('popt123'),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'role_id' => 3, 
                'nama' => 'Sample Recipient',
                'nip' => 1987654323,
                'no_telp' => '081234567892',
                'wilayah' => 'Bukittinggi',
                'alamat' => 'Jl. Anggrek No.3',
                'email' => 'Sample@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('sample123'),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'role_id' => 4, 
                'nama' => 'Analis',
                'nip' => 1987654324,
                'no_telp' => '081234567893',
                'wilayah' => 'Solok',
                'alamat' => 'Jl. Melati No.4',
                'email' => 'Analis@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('analis123'),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'role_id' => 5,
                'nama' => 'Manager Teknis',
                'nip' => 198765432432,
                'no_telp' => '0812345678932',
                'wilayah' => 'Padang',
                'alamat' => 'Jl. Melati No.40',
                'email' => 'mt@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('mt123'),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'role_id' => 6, 
                'nama' => 'Manager Mutu',
                'nip' => 198765432412,
                'no_telp' => '0812345678931',
                'wilayah' => 'Padang',
                'alamat' => 'Jl. Melati No.41',
                'email' => 'mm@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('mm123'),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'role_id' => 7, 
                'nama' => 'Kepala LPHP',
                'nip' => 198765432413,
                'no_telp' => '0812345678931',
                'wilayah' => 'Padang',
                'alamat' => 'Jl. Melati No.41',
                'email' => 'kepala@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('kepala123'),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}