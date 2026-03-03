<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KecamatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         DB::table('kecamatan')->insert([
            // Kabupaten Agam (ID: 1) - 16 Kecamatan
            ['kecamatan_id' => 1, 'kabkot_id' => 1, 'nama_kecamatan' => 'Ampek Nagari'],
            ['kecamatan_id' => 2, 'kabkot_id' => 1, 'nama_kecamatan' => 'Banuhampu'],
            ['kecamatan_id' => 3, 'kabkot_id' => 1, 'nama_kecamatan' => 'Baso'],
            ['kecamatan_id' => 4, 'kabkot_id' => 1, 'nama_kecamatan' => 'Candung'],
            ['kecamatan_id' => 5, 'kabkot_id' => 1, 'nama_kecamatan' => 'IV Angkat'],
            ['kecamatan_id' => 6, 'kabkot_id' => 1, 'nama_kecamatan' => 'IV Koto'],
            ['kecamatan_id' => 7, 'kabkot_id' => 1, 'nama_kecamatan' => 'Kamang Magek'],
            ['kecamatan_id' => 8, 'kabkot_id' => 1, 'nama_kecamatan' => 'Lubuk Basung'],
            ['kecamatan_id' => 9, 'kabkot_id' => 1, 'nama_kecamatan' => 'Malalak'],
            ['kecamatan_id' => 10, 'kabkot_id' => 1, 'nama_kecamatan' => 'Matur'],
            ['kecamatan_id' => 11, 'kabkot_id' => 1, 'nama_kecamatan' => 'Palembayan'],
            ['kecamatan_id' => 12, 'kabkot_id' => 1, 'nama_kecamatan' => 'Palupuh'],
            ['kecamatan_id' => 13, 'kabkot_id' => 1, 'nama_kecamatan' => 'Sungai Pua'],
            ['kecamatan_id' => 14, 'kabkot_id' => 1, 'nama_kecamatan' => 'Tanjung Mutiara'],
            ['kecamatan_id' => 15, 'kabkot_id' => 1, 'nama_kecamatan' => 'Tanjung Raya'],
            ['kecamatan_id' => 16, 'kabkot_id' => 1, 'nama_kecamatan' => 'Tilatang Kamang'],

            // Kabupaten Dharmasraya (ID: 2) - 11 Kecamatan
            ['kecamatan_id' => 17, 'kabkot_id' => 2, 'nama_kecamatan' => 'Asam Jujuhan'],
            ['kecamatan_id' => 18, 'kabkot_id' => 2, 'nama_kecamatan' => 'IX Koto'],
            ['kecamatan_id' => 19, 'kabkot_id' => 2, 'nama_kecamatan' => 'Koto Baru'],
            ['kecamatan_id' => 20, 'kabkot_id' => 2, 'nama_kecamatan' => 'Koto Besar'],
            ['kecamatan_id' => 21, 'kabkot_id' => 2, 'nama_kecamatan' => 'Koto Salak'],
            ['kecamatan_id' => 22, 'kabkot_id' => 2, 'nama_kecamatan' => 'Padang Laweh'],
            ['kecamatan_id' => 23, 'kabkot_id' => 2, 'nama_kecamatan' => 'Pulau Punjung'],
            ['kecamatan_id' => 24, 'kabkot_id' => 2, 'nama_kecamatan' => 'Sitiung'],
            ['kecamatan_id' => 25, 'kabkot_id' => 2, 'nama_kecamatan' => 'Sungai Rumbai'],
            ['kecamatan_id' => 26, 'kabkot_id' => 2, 'nama_kecamatan' => 'Timpeh'],
            ['kecamatan_id' => 27, 'kabkot_id' => 2, 'nama_kecamatan' => 'Tiumang'],

            // Kabupaten Kepulauan Mentawai (ID: 3) - 10 Kecamatan
            ['kecamatan_id' => 28, 'kabkot_id' => 3, 'nama_kecamatan' => 'Pagai Selatan'],
            ['kecamatan_id' => 29, 'kabkot_id' => 3, 'nama_kecamatan' => 'Pagai Utara'],
            ['kecamatan_id' => 30, 'kabkot_id' => 3, 'nama_kecamatan' => 'Siberut Barat'],
            ['kecamatan_id' => 31, 'kabkot_id' => 3, 'nama_kecamatan' => 'Siberut Barat Daya'],
            ['kecamatan_id' => 32, 'kabkot_id' => 3, 'nama_kecamatan' => 'Siberut Selatan'],
            ['kecamatan_id' => 33, 'kabkot_id' => 3, 'nama_kecamatan' => 'Siberut Tengah'],
            ['kecamatan_id' => 34, 'kabkot_id' => 3, 'nama_kecamatan' => 'Siberut Utara'],
            ['kecamatan_id' => 35, 'kabkot_id' => 3, 'nama_kecamatan' => 'Sikakap'],
            ['kecamatan_id' => 36, 'kabkot_id' => 3, 'nama_kecamatan' => 'Sipora Selatan'],
            ['kecamatan_id' => 37, 'kabkot_id' => 3, 'nama_kecamatan' => 'Sipora Utara'],

            // Kabupaten Lima Puluh Kota (ID: 4) - 13 Kecamatan
            ['kecamatan_id' => 38, 'kabkot_id' => 4, 'nama_kecamatan' => 'Akabiluru'],
            ['kecamatan_id' => 39, 'kabkot_id' => 4, 'nama_kecamatan' => 'Bukik Barisan'],
            ['kecamatan_id' => 40, 'kabkot_id' => 4, 'nama_kecamatan' => 'Guguak'],
            ['kecamatan_id' => 41, 'kabkot_id' => 4, 'nama_kecamatan' => 'Gunuang Omeh'],
            ['kecamatan_id' => 42, 'kabkot_id' => 4, 'nama_kecamatan' => 'Harau'],
            ['kecamatan_id' => 43, 'kabkot_id' => 4, 'nama_kecamatan' => 'Kapur IX'],
            ['kecamatan_id' => 44, 'kabkot_id' => 4, 'nama_kecamatan' => 'Lareh Sago Halaban'],
            ['kecamatan_id' => 45, 'kabkot_id' => 4, 'nama_kecamatan' => 'Luak'],
            ['kecamatan_id' => 46, 'kabkot_id' => 4, 'nama_kecamatan' => 'Mungka'],
            ['kecamatan_id' => 47, 'kabkot_id' => 4, 'nama_kecamatan' => 'Pangkalan Koto Baru'],
            ['kecamatan_id' => 48, 'kabkot_id' => 4, 'nama_kecamatan' => 'Payakumbuh'],
            ['kecamatan_id' => 49, 'kabkot_id' => 4, 'nama_kecamatan' => 'Situjuah Limo Nagari'],
            ['kecamatan_id' => 50, 'kabkot_id' => 4, 'nama_kecamatan' => 'Suliki'],

            // Kabupaten Padang Pariaman (ID: 5) - 17 Kecamatan
            ['kecamatan_id' => 51, 'kabkot_id' => 5, 'nama_kecamatan' => '2 x 11 Enam Lingkung'],
            ['kecamatan_id' => 52, 'kabkot_id' => 5, 'nama_kecamatan' => '2 x 11 Kayu Tanam'],
            ['kecamatan_id' => 53, 'kabkot_id' => 5, 'nama_kecamatan' => 'Batang Anai'],
            ['kecamatan_id' => 54, 'kabkot_id' => 5, 'nama_kecamatan' => 'Batang Gasan'],
            ['kecamatan_id' => 55, 'kabkot_id' => 5, 'nama_kecamatan' => 'Enam Lingkung'],
            ['kecamatan_id' => 56, 'kabkot_id' => 5, 'nama_kecamatan' => 'IV Koto Aur Malintang'],
            ['kecamatan_id' => 57, 'kabkot_id' => 5, 'nama_kecamatan' => 'Lubuk Alung'],
            ['kecamatan_id' => 58, 'kabkot_id' => 5, 'nama_kecamatan' => 'Nan Sabaris'],
            ['kecamatan_id' => 59, 'kabkot_id' => 5, 'nama_kecamatan' => 'Padang Sago'],
            ['kecamatan_id' => 60, 'kabkot_id' => 5, 'nama_kecamatan' => 'Patamuan'],
            ['kecamatan_id' => 61, 'kabkot_id' => 5, 'nama_kecamatan' => 'Sintuk Toboh Gadang'],
            ['kecamatan_id' => 62, 'kabkot_id' => 5, 'nama_kecamatan' => 'Sungai Geringging'],
            ['kecamatan_id' => 63, 'kabkot_id' => 5, 'nama_kecamatan' => 'Sungai Limau'],
            ['kecamatan_id' => 64, 'kabkot_id' => 5, 'nama_kecamatan' => 'Ulakan Tapakis'],
            ['kecamatan_id' => 65, 'kabkot_id' => 5, 'nama_kecamatan' => 'V Koto Kampung Dalam'],
            ['kecamatan_id' => 66, 'kabkot_id' => 5, 'nama_kecamatan' => 'V Koto Timur'],
            ['kecamatan_id' => 67, 'kabkot_id' => 5, 'nama_kecamatan' => 'VII Koto Sungai Sarik'],

            // Kabupaten Pasaman (ID: 6) - 12 Kecamatan
            ['kecamatan_id' => 68, 'kabkot_id' => 6, 'nama_kecamatan' => 'Bonjol'],
            ['kecamatan_id' => 69, 'kabkot_id' => 6, 'nama_kecamatan' => 'Duo Koto'],
            ['kecamatan_id' => 70, 'kabkot_id' => 6, 'nama_kecamatan' => 'Lubuk Sikaping'],
            ['kecamatan_id' => 71, 'kabkot_id' => 6, 'nama_kecamatan' => 'Mapat Tunggul'],
            ['kecamatan_id' => 72, 'kabkot_id' => 6, 'nama_kecamatan' => 'Mapat Tunggul Selatan'],
            ['kecamatan_id' => 73, 'kabkot_id' => 6, 'nama_kecamatan' => 'Panti'],
            ['kecamatan_id' => 74, 'kabkot_id' => 6, 'nama_kecamatan' => 'Padang Gelugur'],
            ['kecamatan_id' => 75, 'kabkot_id' => 6, 'nama_kecamatan' => 'Rao'],
            ['kecamatan_id' => 76, 'kabkot_id' => 6, 'nama_kecamatan' => 'Rao Selatan'],
            ['kecamatan_id' => 77, 'kabkot_id' => 6, 'nama_kecamatan' => 'Rao Utara'],
            ['kecamatan_id' => 78, 'kabkot_id' => 6, 'nama_kecamatan' => 'Simpang Alahan Mati'],
            ['kecamatan_id' => 79, 'kabkot_id' => 6, 'nama_kecamatan' => 'Tigo Nagari'],

            // Kabupaten Pasaman Barat (ID: 7) - 11 Kecamatan
            ['kecamatan_id' => 80, 'kabkot_id' => 7, 'nama_kecamatan' => 'Gunung Tuleh'],
            ['kecamatan_id' => 81, 'kabkot_id' => 7, 'nama_kecamatan' => 'Kinali'],
            ['kecamatan_id' => 82, 'kabkot_id' => 7, 'nama_kecamatan' => 'Koto Balingka'],
            ['kecamatan_id' => 83, 'kabkot_id' => 7, 'nama_kecamatan' => 'Lembah Melintang'],
            ['kecamatan_id' => 84, 'kabkot_id' => 7, 'nama_kecamatan' => 'Luhak Nan Duo'],
            ['kecamatan_id' => 85, 'kabkot_id' => 7, 'nama_kecamatan' => 'Pasaman'],
            ['kecamatan_id' => 86, 'kabkot_id' => 7, 'nama_kecamatan' => 'Ranah Batahan'],
            ['kecamatan_id' => 87, 'kabkot_id' => 7, 'nama_kecamatan' => 'Sasak Ranah Pesisir'],
            ['kecamatan_id' => 88, 'kabkot_id' => 7, 'nama_kecamatan' => 'Sungai Aur'],
            ['kecamatan_id' => 89, 'kabkot_id' => 7, 'nama_kecamatan' => 'Sungai Beremas'],
            ['kecamatan_id' => 90, 'kabkot_id' => 7, 'nama_kecamatan' => 'Talamau'],

            // Kabupaten Pesisir Selatan (ID: 8) - 15 Kecamatan
            ['kecamatan_id' => 91, 'kabkot_id' => 8, 'nama_kecamatan' => 'Airpura'],
            ['kecamatan_id' => 92, 'kabkot_id' => 8, 'nama_kecamatan' => 'Batang Kapas'],
            ['kecamatan_id' => 93, 'kabkot_id' => 8, 'nama_kecamatan' => 'Bayang'],
            ['kecamatan_id' => 94, 'kabkot_id' => 8, 'nama_kecamatan' => 'Basa Ampek Balai Tapan'],
            ['kecamatan_id' => 95, 'kabkot_id' => 8, 'nama_kecamatan' => 'IV Jurai'],
            ['kecamatan_id' => 96, 'kabkot_id' => 8, 'nama_kecamatan' => 'IV Nagari Bayang Utara'],
            ['kecamatan_id' => 97, 'kabkot_id' => 8, 'nama_kecamatan' => 'Koto XI Tarusan'],
            ['kecamatan_id' => 98, 'kabkot_id' => 8, 'nama_kecamatan' => 'Lengayang'],
            ['kecamatan_id' => 99, 'kabkot_id' => 8, 'nama_kecamatan' => 'Linggo Sari Baganti'],
            ['kecamatan_id' => 100, 'kabkot_id' => 8, 'nama_kecamatan' => 'Lunang'],
            ['kecamatan_id' => 101, 'kabkot_id' => 8, 'nama_kecamatan' => 'Pancung Soal'],
            ['kecamatan_id' => 102, 'kabkot_id' => 8, 'nama_kecamatan' => 'Ranah Ampek Hulu Tapan'],
            ['kecamatan_id' => 103, 'kabkot_id' => 8, 'nama_kecamatan' => 'Ranah Pesisir'],
            ['kecamatan_id' => 104, 'kabkot_id' => 8, 'nama_kecamatan' => 'Silaut'],
            ['kecamatan_id' => 105, 'kabkot_id' => 8, 'nama_kecamatan' => 'Sutera'],

            // Kabupaten Sijunjung (ID: 9) - 8 Kecamatan
            ['kecamatan_id' => 106, 'kabkot_id' => 9, 'nama_kecamatan' => 'IV Nagari'],
            ['kecamatan_id' => 107, 'kabkot_id' => 9, 'nama_kecamatan' => 'Kamang Baru'],
            ['kecamatan_id' => 108, 'kabkot_id' => 9, 'nama_kecamatan' => 'Koto VII'],
            ['kecamatan_id' => 109, 'kabkot_id' => 9, 'nama_kecamatan' => 'Kupitan'],
            ['kecamatan_id' => 110, 'kabkot_id' => 9, 'nama_kecamatan' => 'Lubuk Tarok'],
            ['kecamatan_id' => 111, 'kabkot_id' => 9, 'nama_kecamatan' => 'Sijunjung'],
            ['kecamatan_id' => 112, 'kabkot_id' => 9, 'nama_kecamatan' => 'Sumpur Kudus'],
            ['kecamatan_id' => 113, 'kabkot_id' => 9, 'nama_kecamatan' => 'Tanjung Gadang'],

            // Kabupaten Solok (ID: 10) - 14 Kecamatan
            ['kecamatan_id' => 114, 'kabkot_id' => 10, 'nama_kecamatan' => 'IX Koto Sungai Lasi'],
            ['kecamatan_id' => 115, 'kabkot_id' => 10, 'nama_kecamatan' => 'X Koto Diatas'],
            ['kecamatan_id' => 116, 'kabkot_id' => 10, 'nama_kecamatan' => 'X Koto Singkarak'],
            ['kecamatan_id' => 117, 'kabkot_id' => 10, 'nama_kecamatan' => 'Bukit Sundi'],
            ['kecamatan_id' => 118, 'kabkot_id' => 10, 'nama_kecamatan' => 'Danau Kembar'],
            ['kecamatan_id' => 119, 'kabkot_id' => 10, 'nama_kecamatan' => 'Gunung Talang'],
            ['kecamatan_id' => 120, 'kabkot_id' => 10, 'nama_kecamatan' => 'Hiliran Gumanti'],
            ['kecamatan_id' => 121, 'kabkot_id' => 10, 'nama_kecamatan' => 'Junjung Sirih'],
            ['kecamatan_id' => 122, 'kabkot_id' => 10, 'nama_kecamatan' => 'Kubung'],
            ['kecamatan_id' => 123, 'kabkot_id' => 10, 'nama_kecamatan' => 'Lembah Gumanti'],
            ['kecamatan_id' => 124, 'kabkot_id' => 10, 'nama_kecamatan' => 'Lembang Jaya'],
            ['kecamatan_id' => 125, 'kabkot_id' => 10, 'nama_kecamatan' => 'Pantai Cermin'],
            ['kecamatan_id' => 126, 'kabkot_id' => 10, 'nama_kecamatan' => 'Payung Sekaki'],
            ['kecamatan_id' => 127, 'kabkot_id' => 10, 'nama_kecamatan' => 'Tigo Lurah'],

            // Kabupaten Solok Selatan (ID: 11) - 7 Kecamatan
            ['kecamatan_id' => 128, 'kabkot_id' => 11, 'nama_kecamatan' => 'Koto Parik Gadang Diateh'],
            ['kecamatan_id' => 129, 'kabkot_id' => 11, 'nama_kecamatan' => 'Pauh Duo'],
            ['kecamatan_id' => 130, 'kabkot_id' => 11, 'nama_kecamatan' => 'Sangir'],
            ['kecamatan_id' => 131, 'kabkot_id' => 11, 'nama_kecamatan' => 'Sangir Balai Janggo'],
            ['kecamatan_id' => 132, 'kabkot_id' => 11, 'nama_kecamatan' => 'Sangir Batang Hari'],
            ['kecamatan_id' => 133, 'kabkot_id' => 11, 'nama_kecamatan' => 'Sangir Jujuan'],
            ['kecamatan_id' => 134, 'kabkot_id' => 11, 'nama_kecamatan' => 'Sungai Pagu'],

            // Kabupaten Tanah Datar (ID: 12) - 14 Kecamatan
            ['kecamatan_id' => 135, 'kabkot_id' => 12, 'nama_kecamatan' => 'Batipuh'],
            ['kecamatan_id' => 136, 'kabkot_id' => 12, 'nama_kecamatan' => 'Batipuh Selatan'],
            ['kecamatan_id' => 137, 'kabkot_id' => 12, 'nama_kecamatan' => 'V Kaum'],
            ['kecamatan_id' => 138, 'kabkot_id' => 12, 'nama_kecamatan' => 'X Koto'],
            ['kecamatan_id' => 139, 'kabkot_id' => 12, 'nama_kecamatan' => 'Lintau Buo'],
            ['kecamatan_id' => 140, 'kabkot_id' => 12, 'nama_kecamatan' => 'Lintau Buo Utara'],
            ['kecamatan_id' => 141, 'kabkot_id' => 12, 'nama_kecamatan' => 'Padang Ganting'],
            ['kecamatan_id' => 142, 'kabkot_id' => 12, 'nama_kecamatan' => 'Pariangan'],
            ['kecamatan_id' => 143, 'kabkot_id' => 12, 'nama_kecamatan' => 'Rambatan'],
            ['kecamatan_id' => 144, 'kabkot_id' => 12, 'nama_kecamatan' => 'Salimpaung'],
            ['kecamatan_id' => 145, 'kabkot_id' => 12, 'nama_kecamatan' => 'Sungai Tarab'],
            ['kecamatan_id' => 146, 'kabkot_id' => 12, 'nama_kecamatan' => 'Sungayang'],
            ['kecamatan_id' => 147, 'kabkot_id' => 12, 'nama_kecamatan' => 'Tanjung Baru'],
            ['kecamatan_id' => 148, 'kabkot_id' => 12, 'nama_kecamatan' => 'Tanjung Emas'],

            // Kota Padang (ID: 13) - 11 Kecamatan
            ['kecamatan_id' => 149, 'kabkot_id' => 13, 'nama_kecamatan' => 'Bungus Teluk Kabung'],
            ['kecamatan_id' => 150, 'kabkot_id' => 13, 'nama_kecamatan' => 'Koto Tangah'],
            ['kecamatan_id' => 151, 'kabkot_id' => 13, 'nama_kecamatan' => 'Kuranji'],
            ['kecamatan_id' => 152, 'kabkot_id' => 13, 'nama_kecamatan' => 'Lubuk Begalung'],
            ['kecamatan_id' => 153, 'kabkot_id' => 13, 'nama_kecamatan' => 'Lubuk Kilangan'],
            ['kecamatan_id' => 154, 'kabkot_id' => 13, 'nama_kecamatan' => 'Nanggalo'],
            ['kecamatan_id' => 155, 'kabkot_id' => 13, 'nama_kecamatan' => 'Padang Barat'],
            ['kecamatan_id' => 156, 'kabkot_id' => 13, 'nama_kecamatan' => 'Padang Selatan'],
            ['kecamatan_id' => 157, 'kabkot_id' => 13, 'nama_kecamatan' => 'Padang Timur'],
            ['kecamatan_id' => 158, 'kabkot_id' => 13, 'nama_kecamatan' => 'Padang Utara'],
            ['kecamatan_id' => 159, 'kabkot_id' => 13, 'nama_kecamatan' => 'Pauh'],

            // Kota Bukittinggi (ID: 14) - 3 Kecamatan
            ['kecamatan_id' => 160, 'kabkot_id' => 14, 'nama_kecamatan' => 'Aur Birugo Tigo Baleh'],
            ['kecamatan_id' => 161, 'kabkot_id' => 14, 'nama_kecamatan' => 'Guguk Panjang'],
            ['kecamatan_id' => 162, 'kabkot_id' => 14, 'nama_kecamatan' => 'Mandiangin Koto Selayan'],
            
            // Kota Padang Panjang (ID: 15) - 2 Kecamatan
            ['kecamatan_id' => 163, 'kabkot_id' => 15, 'nama_kecamatan' => 'Padang Panjang Barat'],
            ['kecamatan_id' => 164, 'kabkot_id' => 15, 'nama_kecamatan' => 'Padang Panjang Timur'],

            // Kota Pariaman (ID: 16) - 4 Kecamatan
            ['kecamatan_id' => 165, 'kabkot_id' => 16, 'nama_kecamatan' => 'Pariaman Selatan'],
            ['kecamatan_id' => 166, 'kabkot_id' => 16, 'nama_kecamatan' => 'Pariaman Tengah'],
            ['kecamatan_id' => 167, 'kabkot_id' => 16, 'nama_kecamatan' => 'Pariaman Timur'],
            ['kecamatan_id' => 168, 'kabkot_id' => 16, 'nama_kecamatan' => 'Pariaman Utara'],

            // Kota Payakumbuh (ID: 17) - 5 Kecamatan
            ['kecamatan_id' => 169, 'kabkot_id' => 17, 'nama_kecamatan' => 'Lamposi Tigo Nagori'],
            ['kecamatan_id' => 170, 'kabkot_id' => 17, 'nama_kecamatan' => 'Payakumbuh Barat'],
            ['kecamatan_id' => 171, 'kabkot_id' => 17, 'nama_kecamatan' => 'Payakumbuh Selatan'],
            ['kecamatan_id' => 172, 'kabkot_id' => 17, 'nama_kecamatan' => 'Payakumbuh Timur'],
            ['kecamatan_id' => 173, 'kabkot_id' => 17, 'nama_kecamatan' => 'Payakumbuh Utara'],

            // Kota Sawahlunto (ID: 18) - 4 Kecamatan
            ['kecamatan_id' => 174, 'kabkot_id' => 18, 'nama_kecamatan' => 'Barangin'],
            ['kecamatan_id' => 175, 'kabkot_id' => 18, 'nama_kecamatan' => 'Lembah Segar'],
            ['kecamatan_id' => 176, 'kabkot_id' => 18, 'nama_kecamatan' => 'Silungkang'],
            ['kecamatan_id' => 177, 'kabkot_id' => 18, 'nama_kecamatan' => 'Talawi'],

            // Kota Solok (ID: 19) - 2 Kecamatan
            ['kecamatan_id' => 178, 'kabkot_id' => 19, 'nama_kecamatan' => 'Lubuk Sikarah'],
            ['kecamatan_id' => 179, 'kabkot_id' => 19, 'nama_kecamatan' => 'Tanjung Harapan'],
        ]);
    }
}
