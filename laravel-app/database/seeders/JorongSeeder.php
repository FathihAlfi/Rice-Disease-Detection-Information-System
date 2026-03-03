<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JorongSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('jorong')->insert([
            // --- 1. KABUPATEN AGAM (kabkot_id: 1) ---

            // Kecamatan Ampek Nagari (kecamatan_id: 1)
            ['jorong_id' => 1, 'nagari_id' => 1, 'nama_jorong' => 'Baringin'],
            ['jorong_id' => 2, 'nagari_id' => 1, 'nama_jorong' => 'Gantiang'],
            ['jorong_id' => 3, 'nagari_id' => 1, 'nama_jorong' => 'Panta'],
            ['jorong_id' => 4, 'nagari_id' => 2, 'nama_jorong' => 'Anak Aia Kasiang'],
            ['jorong_id' => 5, 'nagari_id' => 2, 'nama_jorong' => 'Bawan'],
            ['jorong_id' => 6, 'nagari_id' => 2, 'nama_jorong' => 'Buayan'],
            ['jorong_id' => 7, 'nagari_id' => 2, 'nama_jorong' => 'Lubuak Aluang'],
            ['jorong_id' => 8, 'nagari_id' => 2, 'nama_jorong' => 'Malabua'],
            ['jorong_id' => 9, 'nagari_id' => 2, 'nama_jorong' => 'Sago'],
            ['jorong_id' => 10, 'nagari_id' => 2, 'nama_jorong' => 'Silayang'],
            ['jorong_id' => 11, 'nagari_id' => 2, 'nama_jorong' => 'Tapian Kandih'],
            ['jorong_id' => 12, 'nagari_id' => 3, 'nama_jorong' => 'Sitalang'],
            ['jorong_id' => 13, 'nagari_id' => 4, 'nama_jorong' => 'Sitanang'],

            // Kecamatan Banuhampu (kecamatan_id: 2)
            ['jorong_id' => 14, 'nagari_id' => 5, 'nama_jorong' => 'Batu Ajung'],
            ['jorong_id' => 15, 'nagari_id' => 5, 'nama_jorong' => 'Batu Balirik'],
            ['jorong_id' => 16, 'nagari_id' => 5, 'nama_jorong' => 'Cingkariang'],
            ['jorong_id' => 17, 'nagari_id' => 6, 'nama_jorong' => 'Kubang Putiah'],
            ['jorong_id' => 18, 'nagari_id' => 7, 'nama_jorong' => 'Gantiang'],
            ['jorong_id' => 19, 'nagari_id' => 7, 'nama_jorong' => 'Ladang Laweh'],
            ['jorong_id' => 20, 'nagari_id' => 8, 'nama_jorong' => 'Padang Lua'],
            ['jorong_id' => 21, 'nagari_id' => 9, 'nama_jorong' => 'Pakan Sinayan'],
            ['jorong_id' => 22, 'nagari_id' => 10, 'nama_jorong' => 'Sungai Tanang'],
            ['jorong_id' => 23, 'nagari_id' => 11, 'nama_jorong' => 'Parik Putuih'],
            ['jorong_id' => 24, 'nagari_id' => 11, 'nama_jorong' => 'Taluak'],

            // Kecamatan Baso (kecamatan_id: 3)
            ['jorong_id' => 25, 'nagari_id' => 12, 'nama_jorong' => 'Koto Baru'],
            ['jorong_id' => 26, 'nagari_id' => 13, 'nama_jorong' => 'Koto Gadang'],
            ['jorong_id' => 27, 'nagari_id' => 14, 'nama_jorong' => 'Koto Tinggi'],
            ['jorong_id' => 28, 'nagari_id' => 15, 'nama_jorong' => 'Padang Tarok'],
            ['jorong_id' => 29, 'nagari_id' => 16, 'nama_jorong' => 'Salo'],
            ['jorong_id' => 30, 'nagari_id' => 17, 'nama_jorong' => 'Simarasok'],
            ['jorong_id' => 31, 'nagari_id' => 18, 'nama_jorong' => 'Sungai Cubadak'],
            ['jorong_id' => 32, 'nagari_id' => 19, 'nama_jorong' => 'Tabek Panjang'],

            // Kecamatan Candung (kecamatan_id: 4)
            ['jorong_id' => 33, 'nagari_id' => 20, 'nama_jorong' => 'Batabuah'],
            ['jorong_id' => 34, 'nagari_id' => 21, 'nama_jorong' => 'Canduang'],
            ['jorong_id' => 35, 'nagari_id' => 21, 'nama_jorong' => 'Koto Laweh'],
            ['jorong_id' => 36, 'nagari_id' => 22, 'nama_jorong' => 'Lasi Mudo'],
            ['jorong_id' => 37, 'nagari_id' => 22, 'nama_jorong' => 'Lasi Tuo'],

            // Kecamatan IV Angkat (kecamatan_id: 5)
            ['jorong_id' => 38, 'nagari_id' => 23, 'nama_jorong' => 'Ampang Gadang'],
            ['jorong_id' => 39, 'nagari_id' => 24, 'nama_jorong' => 'Balai Gurah'],
            ['jorong_id' => 40, 'nagari_id' => 25, 'nama_jorong' => 'Batu Taba'],
            ['jorong_id' => 41, 'nagari_id' => 26, 'nama_jorong' => 'Biaro'],
            ['jorong_id' => 42, 'nagari_id' => 27, 'nama_jorong' => 'Lambah'],
            ['jorong_id' => 43, 'nagari_id' => 28, 'nama_jorong' => 'Panampuang'],
            ['jorong_id' => 44, 'nagari_id' => 29, 'nama_jorong' => 'Pasia'],

            // Kecamatan IV Koto (kecamatan_id: 6)
            ['jorong_id' => 45, 'nagari_id' => 30, 'nama_jorong' => 'Balingka'],
            ['jorong_id' => 46, 'nagari_id' => 31, 'nama_jorong' => 'Guguak'],
            ['jorong_id' => 47, 'nagari_id' => 31, 'nama_jorong' => 'Tabek Sarojo'],
            ['jorong_id' => 48, 'nagari_id' => 32, 'nama_jorong' => 'Koto Gadang'],
            ['jorong_id' => 49, 'nagari_id' => 33, 'nama_jorong' => 'Koto Panjang'],
            ['jorong_id' => 50, 'nagari_id' => 34, 'nama_jorong' => 'Koto Tuo'],
            ['jorong_id' => 51, 'nagari_id' => 35, 'nama_jorong' => 'Sianok'],
            ['jorong_id' => 52, 'nagari_id' => 35, 'nama_jorong' => 'Anam Suku'],
            ['jorong_id' => 53, 'nagari_id' => 36, 'nama_jorong' => 'Sungai Landia'],

            // Kecamatan Kamang Magek (kecamatan_id: 7)
            ['jorong_id' => 54, 'nagari_id' => 37, 'nama_jorong' => 'Pintu Koto'],
            ['jorong_id' => 55, 'nagari_id' => 37, 'nama_jorong' => 'Babukik'],
            ['jorong_id' => 56, 'nagari_id' => 37, 'nama_jorong' => 'V Kampuang'],
            ['jorong_id' => 57, 'nagari_id' => 38, 'nama_jorong' => 'Durian'],
            ['jorong_id' => 58, 'nagari_id' => 38, 'nama_jorong' => 'Halalang'],
            ['jorong_id' => 59, 'nagari_id' => 39, 'nama_jorong' => 'Magek'],

            // Kecamatan Lubuk Basung (kecamatan_id: 8)
            ['jorong_id' => 60, 'nagari_id' => 40, 'nama_jorong' => 'Geragahan'],
            ['jorong_id' => 61, 'nagari_id' => 41, 'nama_jorong' => 'Kampung Pinang'],
            ['jorong_id' => 62, 'nagari_id' => 42, 'nama_jorong' => 'Kampung Tangah'],
            ['jorong_id' => 63, 'nagari_id' => 43, 'nama_jorong' => 'Balai Ahad'],
            ['jorong_id' => 64, 'nagari_id' => 43, 'nama_jorong' => 'Pasar Lubuk Basung'],
            ['jorong_id' => 65, 'nagari_id' => 43, 'nama_jorong' => 'Surabayo'],
            ['jorong_id' => 66, 'nagari_id' => 43, 'nama_jorong' => 'Siguhung'],
            ['jorong_id' => 67, 'nagari_id' => 43, 'nama_jorong' => 'Sangkir'],
            ['jorong_id' => 68, 'nagari_id' => 43, 'nama_jorong' => 'Parit Rantang'],
            ['jorong_id' => 69, 'nagari_id' => 44, 'nama_jorong' => 'Balai Satu'],
            ['jorong_id' => 70, 'nagari_id' => 44, 'nama_jorong' => 'Kajai Pisik'],
            ['jorong_id' => 71, 'nagari_id' => 44, 'nama_jorong' => 'Kubu Anau'],
            ['jorong_id' => 72, 'nagari_id' => 44, 'nama_jorong' => 'Padang Mardani'],
            ['jorong_id' => 73, 'nagari_id' => 44, 'nama_jorong' => 'Padang Tongga'],
            ['jorong_id' => 74, 'nagari_id' => 44, 'nama_jorong' => 'Sago'],

            // Kecamatan Malalak (kecamatan_id: 9)
            ['jorong_id' => 75, 'nagari_id' => 45, 'nama_jorong' => 'Malalak Barat'],
            ['jorong_id' => 76, 'nagari_id' => 46, 'nama_jorong' => 'Malalak Selatan'],
            ['jorong_id' => 77, 'nagari_id' => 47, 'nama_jorong' => 'Malalak Timur'],
            ['jorong_id' => 78, 'nagari_id' => 48, 'nama_jorong' => 'Malalak Utara'],

            // Kecamatan Matur (kecamatan_id: 10)
            ['jorong_id' => 79, 'nagari_id' => 49, 'nama_jorong' => 'Lawang'],
            ['jorong_id' => 80, 'nagari_id' => 50, 'nama_jorong' => 'Matua Hilia'],
            ['jorong_id' => 81, 'nagari_id' => 51, 'nama_jorong' => 'Matua Mudiak'],
            ['jorong_id' => 82, 'nagari_id' => 52, 'nama_jorong' => 'Panta'],
            ['jorong_id' => 83, 'nagari_id' => 52, 'nama_jorong' => 'Pauh'],
            ['jorong_id' => 84, 'nagari_id' => 53, 'nama_jorong' => 'Parik Panjang'],
            ['jorong_id' => 85, 'nagari_id' => 54, 'nama_jorong' => 'Tigo Balai'],

            // Kecamatan Palembayan (kecamatan_id: 11)
            ['jorong_id' => 86, 'nagari_id' => 55, 'nama_jorong' => 'Ampek Koto'],
            ['jorong_id' => 87, 'nagari_id' => 56, 'nama_jorong' => 'Baringin'],
            ['jorong_id' => 88, 'nagari_id' => 57, 'nama_jorong' => 'Salareh Aia'],
            ['jorong_id' => 89, 'nagari_id' => 58, 'nama_jorong' => 'Sipinang'],
            ['jorong_id' => 90, 'nagari_id' => 59, 'nama_jorong' => 'Sungai Pua'],
            ['jorong_id' => 91, 'nagari_id' => 60, 'nama_jorong' => 'Tigo Koto Silungkang'],

            // Kecamatan Palupuh (kecamatan_id: 12)
            ['jorong_id' => 92, 'nagari_id' => 61, 'nama_jorong' => 'Koto Rantang'],
            ['jorong_id' => 93, 'nagari_id' => 62, 'nama_jorong' => 'Nan Limo'],
            ['jorong_id' => 94, 'nagari_id' => 63, 'nama_jorong' => 'Nan Tujuah'],
            ['jorong_id' => 95, 'nagari_id' => 64, 'nama_jorong' => 'Pagadih'],
            ['jorong_id' => 96, 'nagari_id' => 65, 'nama_jorong' => 'Pasia Laweh'],

            // Kecamatan Sungai Pua (kecamatan_id: 13)
            ['jorong_id' => 97, 'nagari_id' => 66, 'nama_jorong' => 'Batagak'],
            ['jorong_id' => 98, 'nagari_id' => 67, 'nama_jorong' => 'Batu Palano'],
            ['jorong_id' => 99, 'nagari_id' => 68, 'nama_jorong' => 'Padang Laweh'],
            ['jorong_id' => 100, 'nagari_id' => 69, 'nama_jorong' => 'Sariak'],
            ['jorong_id' => 101, 'nagari_id' => 70, 'nama_jorong' => 'Sungai Pua'],

            // Kecamatan Tanjung Mutiara (kecamatan_id: 14)
            ['jorong_id' => 102, 'nagari_id' => 71, 'nama_jorong' => 'Durian Kapeh'],
            ['jorong_id' => 103, 'nagari_id' => 72, 'nama_jorong' => 'Tiku Selatan'],
            ['jorong_id' => 104, 'nagari_id' => 73, 'nama_jorong' => 'Tiku Utara'],
            ['jorong_id' => 105, 'nagari_id' => 74, 'nama_jorong' => 'Tiku V Jorong'],

            // Kecamatan Tanjung Raya (kecamatan_id: 15)
            ['jorong_id' => 106, 'nagari_id' => 75, 'nama_jorong' => 'Bayur'],
            ['jorong_id' => 107, 'nagari_id' => 76, 'nama_jorong' => 'Duo Koto'],
            ['jorong_id' => 108, 'nagari_id' => 77, 'nama_jorong' => 'Koto Gadang'],
            ['jorong_id' => 109, 'nagari_id' => 78, 'nama_jorong' => 'Koto Kaciak'],
            ['jorong_id' => 110, 'nagari_id' => 79, 'nama_jorong' => 'Koto Malintang'],
            ['jorong_id' => 111, 'nagari_id' => 80, 'nama_jorong' => 'Maninjau'],
            ['jorong_id' => 112, 'nagari_id' => 81, 'nama_jorong' => 'Paninjauan'],
            ['jorong_id' => 113, 'nagari_id' => 82, 'nama_jorong' => 'Sungai Batang'],
            ['jorong_id' => 114, 'nagari_id' => 83, 'nama_jorong' => 'Tanjung Sani'],

            // Kecamatan Tilatang Kamang (kecamatan_id: 16)
            ['jorong_id' => 115, 'nagari_id' => 84, 'nama_jorong' => 'Gadut'],
            ['jorong_id' => 116, 'nagari_id' => 85, 'nama_jorong' => 'Kapau'],
            ['jorong_id' => 117, 'nagari_id' => 86, 'nama_jorong' => 'Koto Tangah'],

            
    ]);
    }
}
