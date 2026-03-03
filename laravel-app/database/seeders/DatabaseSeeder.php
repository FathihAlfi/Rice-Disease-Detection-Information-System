<?php

namespace Database\Seeders;

use App\Models\KabKota;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(KabKotSeeder::class);
        $this->call(KecamatanSeeder::class);
        $this->call(NagariSeeder::class);
        $this->call(JorongSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(JenisSeeder::class);
        $this->call(VarietasSeeder::class);
        $this->call(OPTSeeder::class);
        $this->call(PengendalianSeeder::class);
        $this->call(MetodeSeeder::class);
        $this->call(UserLokasiSeeder::class);
       
    }
}
