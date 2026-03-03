<?php

namespace App\Exports;

use App\Models\Lpb;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class LpbExport implements FromQuery, WithHeadings, WithMapping, ShouldAutoSize
{
    /**
    * Mengambil data yang akan diekspor dari database.
    */
    public function query()
    {
        // Kita ambil semua data LPB dengan relasi yang dibutuhkan
        // agar tidak terjadi N+1 problem.
        return Lpb::query()->with([
            'user', 
            'opt', 
            'varietas',
            'userlokasi.jorong', 
            'userlokasi.nagari', 
            'userlokasi.kecamatan', 
            'userlokasi.kabkot',
            'deteksi', 
        ]);
    }

    /**
    * Mendefinisikan header untuk setiap kolom di file Excel.
    */
    public function headings(): array
    {
        return [
            'No Surat',
            'Tanggal Dibuat',
            'Pelapor',
            'OPT',
            'Varietas',
            'Umur Tanaman (HST)',
            'Intensitas Serangan (%)',
            'Padat Populasi/Ha',
            'Luas Serangan (Ha)',
            'Luas Terancam (Ha)',
            'Populasi MA',
            'Lokasi (Jorong)',
            'Lokasi (Nagari)',
            'Lokasi (Kecamatan)',
            'Lokasi (Kab/Kota)',
            'ID Deteksi',
        ];
    }

    /**
    * Memetakan setiap baris data ke format yang diinginkan.
    *
    * @param \App\Models\Lpb $lpb
    */
    public function map($lpb): array
    {
        return [
            $lpb->no_surat,
            $lpb->created_at->format('d-m-Y'),
            $lpb->user->nama ?? 'N/A',
            $lpb->opt->nama_opt ?? 'N/A',
            $lpb->varietas->nama_varietas ?? 'N/A',
            $lpb->umur,
            $lpb->intensitas_serangan,
            $lpb->padat_populasi_ha,
            $lpb->luas_serangan_ha,
            $lpb->luas_terancam_ha,
            $lpb->populasi_MA,
            $lpb->userlokasi->jorong->nama_jorong ?? 'N/A',
            $lpb->userlokasi->nagari->nama_nagari ?? 'N/A',
            $lpb->userlokasi->kecamatan->nama_kecamatan ?? 'N/A',
            $lpb->userlokasi->kabkot->nama_kabkot ?? 'N/A',
            $lpb->deteksi_id,
        ];
    }
}
