<?php

namespace App\Exports;

use App\Models\DiagnosaRekomendasi;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class DiagnosaExport implements FromQuery, WithHeadings, WithMapping, ShouldAutoSize
{
    /**
    * Mengambil data yang akan diekspor dari database.
    */
    public function query()
    {
        // Mengambil data diagnosa dengan semua relasi yang dibutuhkan
        return DiagnosaRekomendasi::query()->with([
            'permohonan.user', 
            'permohonan.jenis', 
            'permohonan.varietas', 
            'metode'
        ]);
    }

    /**
    * Mendefinisikan header untuk setiap kolom di file Excel.
    */
    public function headings(): array
    {
        return [
            'ID Diagnosa',
            'No. Surat Permohonan',
            'Tanggal Diagnosa',
            'Pemohon',
            'Jenis Tanaman',
            'Varietas',
            'Hasil Diagnosa',
            'Metode',
            'Deskripsi OPT',
            'Rekomendasi Pengendalian',
        ];
    }

    /**
    * Memetakan setiap baris data ke format yang diinginkan.
    *
    * @param \App\Models\DiagnosaRekomendasi $diagnosa
    */
    public function map($diagnosa): array
    {
        return [
            $diagnosa->diagnosa_id,
            $diagnosa->permohonan->no_surat ?? 'N/A',
            $diagnosa->tgl_diagnosa,
            $diagnosa->permohonan->user->nama ?? 'N/A',
            $diagnosa->permohonan->jenis->nama_jenis ?? 'N/A',
            $diagnosa->permohonan->varietas->nama_varietas ?? 'N/A',
            $diagnosa->hasil_diagnosa,
            $diagnosa->metode->nama_metode ?? 'N/A',
            $diagnosa->deskripsi_opt,
            $diagnosa->rekomendasi_pengendalian,
        ];
    }
}
