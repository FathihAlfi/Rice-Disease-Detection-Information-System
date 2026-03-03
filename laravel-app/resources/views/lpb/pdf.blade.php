<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>LPB - {{ $lpb->no_surat }}</title>
    <style>
        body {
            font-family: 'Times New Roman', serif;
            font-size: 12px;
            line-height: 1.4;
        }
        .center { text-align: center; }
        .section { margin-top: 15px; }
        .bold { font-weight: bold; }
        table { width: 100%; border-collapse: collapse; }
        td { vertical-align: top; }
        .dotline { border-bottom: 1px dotted #000; display: inline-block; min-width: 100px; }
        .indent { margin-left: 25px; }
        .underline { text-decoration: underline; }

        /* CSS untuk area tanda tangan baru */
        .signature-wrapper {
            width: 40%; 
            float: right; 
            text-align: center; 
            margin-top: 20px;
            page-break-inside: avoid;
        }
        .signature-space {
            height: 80px; /* Memberi ruang untuk tanda tangan & stempel */
            position: relative;
            margin-bottom: 5px;
        }
        .signature-image {
            position: absolute;
            max-height: 75px;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            z-index: 10;
        }
        .stamp-image {
            position: absolute;
            max-height: 85px;
            left: 50%;
            top: 50%;
            transform: translate(-40%, -60%);
            opacity: 0.85;
            z-index: 5;
        }
    </style>
</head>
<body>

    <div class="center">
        <h3>BPTPH SUMBAR</h3>
        <h2>LAPORAN PERINGATAN BAHAYA</h2>
        <h4>NO. {{ $lpb->no_surat }}</h4>
    </div>

    <div class="section">
        <p><strong>Disampaikan Kepada Yth :</strong></p>
        <table>
            <tr>
                <td width="50%">
                    1. Bpk. Ka. BPTPH Sumbar<br>
                    2. Bpk. Ka. Diperta Kab/Kota ..... <span class="dotline">{{ $lpb->userlokasi->kabkot->nama_kabkot ?? '-' }}</span><br>
                    3. Bpk. Ka. L P H P ..... <span class="dotline">Bandar Buat</span><br>
                    4. Sdr. Koordinator POPT ..... <span class="dotline">{{ $lpb->userlokasi->kecamatan->nama_kecamatan ?? '-' }}</span>
                </td>
                <td width="50%">
                    5. Sdr. KCD/UPT Kec ..... <span class="dotline">{{ $lpb->userlokasi->kecamatan->nama_kecamatan ?? '-' }}</span><br>
                    6. Sdr. Ka. BPP ..... <span class="dotline">{{ $lpb->userlokasi->kecamatan->nama_kecamatan ?? '-' }}</span><br>
                    7. Sdr. Lurah/Wali Nagari ..... <span class="dotline">{{ $lpb->userlokasi->nagari->nama_nagari ?? '-' }}</span><br>
                    8. Sdr. PPL Kenagarian ..... <span class="dotline">{{ $lpb->userlokasi->nagari->nama_nagari ?? '-' }}</span>
                </td>
            </tr>
        </table>
    </div>

    <div class="section">
        <table>
            <tr>
                <td width="50%">
                    <p><strong>Lokasi</strong></p>
                    - Jorong : <span class="dotline">{{ $lpb->userlokasi->jorong->nama_jorong ?? '-' }}</span><br>
                    - Nagari/Desa/Kel : <span class="dotline">{{ $lpb->userlokasi->nagari->nama_nagari ?? '-' }}</span><br>
                    - Kecamatan : <span class="dotline">{{ $lpb->userlokasi->kecamatan->nama_kecamatan ?? '-' }}</span><br>
                    - Kab/Kota : <span class="dotline">{{ $lpb->userlokasi->kabkot->nama_kabkot ?? '-' }}</span><br>
                    - Tgl. Pengamatan : <span class="dotline">{{ \Carbon\Carbon::parse($lpb->tgl_pengamatan)->format('d/m/Y') }}</span><br>
                    - Laporan ke : <span class="dotline">{{ $lpb->laporan_ke }}</span>
                </td>
                <td width="50%">
                    <p><strong>1. Jenis Tanaman</strong> : <span class="dotline">Padi</span></p>
                    <p><strong>2. Varietas</strong> : <span class="dotline">{{ $lpb->varietas->nama_varietas ?? '-' }}</span></p>
                    <p><strong>3. Umur</strong> (hst/bln/thn) : <span class="dotline">{{ $lpb->umur ?? '-' }} HST</span></p>
                    <p><strong>4. OPT</strong> : <span class="dotline">{{ $lpb->opt->nama_opt ?? '-' }}</span></p>
                    <p><strong>5. Intensitas Serangan</strong> : <span class="dotline">{{ $lpb->intensitas_serangan ?? '-' }}%</span></p>
                    <p><strong>6. Padat Populasi</strong> : <span class="dotline">{{ $lpb->padat_populasi_ha ?? '-' }}</span> ekor/rpn/phn/m²</p>
                    <p><strong>7. Luas Serangan</strong> : <span class="dotline">{{ $lpb->luas_serangan_ha ?? '-' }}</span> Ha</p>
                    <p><strong>8. Luas Terancam</strong> : <span class="dotline">{{ $lpb->luas_terancam_ha ?? '-' }}</span> Ha</p>
                    <p><strong>9. Populasi MA</strong></p>
                    - Laba-laba : <span class="dotline">{{ $lpb->populasi_MA ?? '-' }}</span> ekor/rpn/phn<br>
                    - Kumbang predator : <span class="dotline">{{ $lpb->populasi_MA ?? '-' }}</span> ekor/rpn/phn
                </td>
            </tr>
        </table>
    </div>

    <div class="section">
        <p><strong>Upaya yang telah dilakukan :</strong></p>
        <p class="indent">{{ $lpb->upaya ?? '-' }}</p>
    </div>

    <div class="section">
        <p><strong>Rekomendasi Pengendalian :</strong></p>
        <ol class="indent">
            @if($lpb->pengendalian)
                @foreach(explode("\n", $lpb->pengendalian->deskripsi) as $item)
                    <li>{{ trim($item) }}</li>
                @endforeach
            @endif
            @if($lpb->custom_pengendalian)
                @foreach(explode("\n", $lpb->custom_pengendalian) as $item)
                    <li>{{ trim($item) }}</li>
                @endforeach
            @endif
        </ol>
    </div>

    {{-- PERBAIKAN: Mengganti seluruh blok tanda tangan --}}
    <div class="signature-wrapper">
        {{ $lpb->userlokasi->kecamatan->nama_kecamatan ?? 'Kecamatan Tidak Ditemukan' }}, {{ \Carbon\Carbon::parse($lpb->created_at)->translatedFormat('j F Y') }}<br>
        <strong>{{ strtoupper($lpb->user->role->nama_role ?? 'POPT') }}</strong><br>
        {{ $lpb->userlokasi->kecamatan->nama_kecamatan ?? 'Kecamatan Tidak Ditemukan' }}
        <div class="signature-space">
            @if($lpb->user && $lpb->user->stempel)
                <img src="{{ public_path('storage/' . $lpb->user->stempel) }}" class="stamp-image">
            @endif
            @if($lpb->user && $lpb->user->tanda_tangan)
                <img src="{{ public_path('storage/' . $lpb->user->tanda_tangan) }}" class="signature-image">
            @endif
        </div>
        <u class="bold">{{ $lpb->user->nama ?? 'Nama Tidak Ditemukan' }}</u><br>
        NIP. {{ $lpb->user->nip ?? '-' }}
    </div>

</body>
</html>
