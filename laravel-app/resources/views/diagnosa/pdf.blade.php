<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Laporan Hasil Analisis - {{ $diagnosa->diagnosa_id }}</title>
    <style>
        @page { margin: 25px 35px; }
        body { 
            font-family: 'Times New Roman', Times, serif; 
            font-size: 11pt;
            line-height: 1.3;
        }
        .header-table {
            width: 100%;
            border-bottom: 2.5px solid black;
            padding-bottom: 5px;
            margin-bottom: 10px;
        }
        .header-table td {
            vertical-align: middle;
            text-align: center;
        }
        .header-table .logo { width: 75px; }
        .header-table .iso-logo { width: 85px; }
        .header-table .title { font-size: 13pt; font-weight: bold; }
        .header-table .address { font-size: 8pt; }
        .page-break { page-break-after: always; }
        .content-table { width: 100%; border-collapse: collapse; margin-top: 8px; }
        .content-table td { padding: 1px 2px; vertical-align: top; }
        .content-table .label { width: 30%; }
        .content-table .separator { width: 2%; }
        .section-title { font-weight: bold; margin-top: 10px; margin-bottom: 5px; }
        p { margin: 2px 0; }

        /* CSS untuk Tanda Tangan Berjenjang */
        .signature-table-wrapper {
            margin-top: 25px;
            page-break-inside: avoid;
        }
        .signature-table {
            width: 100%;
            text-align: center;
            border-collapse: collapse;
        }
        .signature-table td {
            width: 25%; /* Membagi menjadi 4 kolom */
            padding: 0 5px;
            vertical-align: top;
            font-size: 10pt;
        }
        .signature-space {
            height: 70px;
            position: relative;
            margin-bottom: 3px;
        }
        .signature-image {
            position: absolute;
            max-height: 65px;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            z-index: 10;
        }
        .stamp-image {
            position: absolute;
            max-height: 75px;
            left: 50%;
            top: 50%;
            transform: translate(-40%, -60%);
            opacity: 0.85;
            z-index: 5;
        }
        .footer {
            position: fixed;
            bottom: -20px;
            left: 0px;
            right: 0px;
            height: 40px;
            font-size: 8pt;
            border-top: 1px solid black;
            padding-top: 5px;
        }
    </style>
</head>
<body>

    {{-- HALAMAN 1: SURAT PENGANTAR --}}
    <header>
        <table class="header-table">
            <tr>
                <td class="logo"><img src="{{ public_path('images/logo.png') }}" alt="Logo" style="width: 70px;"></td>
                <td>
                    <div class="title">BALAI PERLINDUNGAN TANAMAN PANGAN DAN HORTIKULTURA</div>
                    <div class="title">LPHP DAN PAH INDUK BANDA BUAT</div>
                    <div class="subtitle">PROVINSI SUMATERA BARAT</div>
                    <div class="address">Alamat: Jl. Jambak Indah No. 40 Rimbo Data Kelurahan Bandar Buat Kecamatan Lubuk Kilangan, Padang 25237</div>
                    <div class="address">email: lphp.bandabuat@gmail.com, Fanpage: LPHP dan PAH Induk Bandar Buat Padang</div>
                </td>
                <td class="iso-logo"><img src="{{ public_path('images/iso-logo.png') }}" alt="ISO Logo" style="width: 80px;"></td>
            </tr>
        </table>
    </header>
    <main>
        <h3 style="text-align: center; text-decoration: underline; margin-bottom: 20px;">SURAT PENGANTAR</h3>
        <table style="width:100%; margin-bottom: 20px;">
            <tr>
                <td style="width: 15%;"><strong>Nomor</strong></td>
                <td style="width: 2%;">:</td>
                <td style="width: 43%;">{{ $diagnosa->diagnosa_id }}</td>
                <td style="width: 40%; text-align: right;">Padang, {{ \Carbon\Carbon::parse($diagnosa->tgl_diagnosa)->format('d F Y') }}</td>
            </tr>
            <tr>
                <td><strong>Lamp</strong></td>
                <td>:</td>
                <td>1 (satu) exp.</td>
                <td></td>
            </tr>
            <tr>
                <td style="vertical-align: top;"><strong>Hal</strong></td>
                <td style="vertical-align: top;">:</td>
                <td style="vertical-align: top;">Hasil analisis tanaman {{ $diagnosa->permohonan->jenis->nama_jenis ?? '' }}</td>
                <td></td>
            </tr>
        </table>
        <div style="margin-top: 30px;">
            <p>Kepada Yth.<br>
            <strong>Bapak/Ibu {{ $diagnosa->permohonan->user->nama ?? '' }}</strong><br>
            di<br>
            LPHP Bandar Buat Kota Padang</p>
        </div>
        <p>Dengan hormat,</p>
        <p style="text-indent: 40px;">Memenuhi surat permohonan Bapak nomor: <strong>{{ $diagnosa->permohonan_no_surat }}</strong> tanggal <strong>{{ \Carbon\Carbon::parse($diagnosa->permohonan->created_at)->format('d F Y') }}</strong> bersama ini kami sampaikan hasil analisis dan rekomendasi, seperti terlampir.</p>
        <p>Demikian disampaikan, atas perhatiannya diucapkan terimakasih.</p>
        
        <table style="width: 100%; text-align: center; margin-top: 50px;">
            <tr>
                <td style="width: 60%;"></td>
                <td style="width: 40%;">
                    Hormat kami,<br>
                    Kepala LPHP dan PAH Induk<br>
                    Bandar Buat
                    <div class="signature-space">
                        @if($diagnosa->pengesah && $diagnosa->pengesah->stempel)
                            <img src="{{ public_path('storage/' . $diagnosa->pengesah->stempel) }}" class="stamp-image">
                        @endif
                        @if($diagnosa->pengesah && $diagnosa->pengesah->tanda_tangan)
                            <img src="{{ public_path('storage/' . $diagnosa->pengesah->tanda_tangan) }}" class="signature-image">
                        @endif
                    </div>
                    <strong><u>{{ $diagnosa->pengesah->nama ?? 'Denny Eka Putri, SP' }}</u></strong><br>
                    NIP. {{ $diagnosa->pengesah->nip ?? '19670316 198903 2 002' }}
                </td>
            </tr>
        </table>
    </main>

    <div class="page-break"></div>

    {{-- HALAMAN 2: LAPORAN HASIL ANALISIS --}}
    <header>
       <table class="header-table">
            <tr>
                <td class="logo"><img src="{{ public_path('images/logo.png') }}" alt="Logo" style="width: 70px;"></td>
                <td>
                    <div class="title">BALAI PERLINDUNGAN TANAMAN PANGAN DAN HORTIKULTURA</div>
                    <div class="title">LPHP DAN PAH INDUK BANDA BUAT</div>
                    <div class="subtitle">PROVINSI SUMATERA BARAT</div>
                    <div class="address">Alamat: Jl. Jambak Indah No. 40 Rimbo Data Kelurahan Bandar Buat Kecamatan Lubuk Kilangan, Padang 25237</div>
                    <div class="address">email: lphp.bandabuat@gmail.com, Fanpage: LPHP dan PAH Induk Bandar Buat Padang</div>
                </td>
                <td class="iso-logo"><img src="{{ public_path('images/iso-logo.png') }}" alt="ISO Logo" style="width: 80px;"></td>
            </tr>
        </table>
    </header>

    <main>
        <table class="content-table" style="margin-bottom: 20px;">
            <tr>
                <td class="label"><strong>Nomor Surat Permohonan</strong></td>
                <td class="separator">:</td>
                <td>{{ $diagnosa->permohonan_no_surat }}</td>
            </tr>
            <tr>
                <td class="label"><strong>Nomor Sampel Klinik Tanaman</strong></td>
                <td class="separator">:</td>
                <td>{{ $diagnosa->diagnosa_id }}</td>
            </tr>
        </table>

        <div class="section-title">A. Keterangan Umum</div>
        <table class="content-table">
            <tr><td class="label">1. Nama Pembawa</td><td class="separator">:</td><td>{{ $diagnosa->permohonan->user->nama ?? '-' }}</td></tr>
            <tr><td class="label">2. Nama Pemilik</td><td class="separator">:</td><td>{{ $diagnosa->permohonan->user->nama ?? '-' }}</td></tr>
            <tr><td class="label">3. No Telp</td><td class="separator">:</td><td>{{ $diagnosa->permohonan->user->no_telp ?? '-' }}</td></tr>
            <tr><td class="label">4. Alamat</td><td class="separator">:</td><td>{{ $diagnosa->permohonan->user->alamat ?? '-' }}</td></tr>
        </table>

        <div class="section-title">B. Data Bahan Sampel</div>
        <table class="content-table">
            <tr><td class="label">1. Jenis Tanaman</td><td class="separator">:</td><td>{{ $diagnosa->permohonan->jenis->nama_jenis ?? '-' }}</td></tr>
            <tr><td class="label">2. Varietas Tanaman</td><td class="separator">:</td><td>{{ $diagnosa->permohonan->varietas->nama_varietas ?? '-' }}</td></tr>
            <tr><td class="label">3. Umur Tanaman</td><td class="separator">:</td><td>{{ $diagnosa->permohonan->umur ?? '-' }} HST</td></tr>
            <tr><td class="label">4. Bagian Tanaman terserang</td><td class="separator">:</td><td>{{ $diagnosa->permohonan->bagian_terserang ?? '-' }}</td></tr>
            <tr><td class="label">5. Tanggal ditemukan</td><td class="separator">:</td><td>{{ \Carbon\Carbon::parse($diagnosa->permohonan->tgl_ditemukan)->format('d F Y') }}</td></tr>
            <tr><td class="label">6. Tanggal diagnosa</td><td class="separator">:</td><td>{{ \Carbon\Carbon::parse($diagnosa->tgl_diagnosa)->format('d F Y') }}</td></tr>
            <tr><td class="label">7. Budidaya tanaman</td><td class="separator">:</td><td>{{ $diagnosa->permohonan->budidaya ?? '-' }}</td></tr>
            <tr><td class="label">8. Jumlah sampel</td><td class="separator">:</td><td>{{ $diagnosa->permohonan->jumlah_sampel ?? '-' }}</td></tr>
        </table>
        
        <div class="section-title">C. Hasil Diagnosa</div>
        <p>{{ $diagnosa->hasil_diagnosa }}</p>

        <div class="section-title">D. Metode Diagnosa</div>
        <p>{{ $diagnosa->metode->nama_metode ?? '-' }}</p>
        
        <div class="section-title">E. Gejala Serangan</div>
        <p>{{ $diagnosa->permohonan->gejala ?? '-' }}</p>

        <div class="section-title">F. Deskripsi Penyebab</div>
        <p>{{ $diagnosa->deskripsi_opt }}</p>

        <div class="section-title">G. Rekomendasi Pengendalian</div>
        <p>{!! nl2br(e($diagnosa->rekomendasi_pengendalian)) !!}</p>

        @if($diagnosa->dokumentasi)
        <div class="section-title">H. Dokumentasi Hasil Identifikasi</div>
        <img src="{{ public_path('storage/' . $diagnosa->dokumentasi) }}" alt="Dokumentasi" style="max-width: 300px; margin-top: 10px;">
        @endif

        <div class="signature-table-wrapper">
            <table class="signature-table">
                <tr>
                    <td>Dianalisis Oleh,</td>
                    <td>Diperiksa Oleh,</td>
                    <td>Disetujui Oleh,</td>
                </tr>
                <tr>
                    <td>
                        <div class="signature-space">
                            @if($diagnosa->analis && $diagnosa->analis->tanda_tangan)
                                <img src="{{ public_path('storage/' . $diagnosa->analis->tanda_tangan) }}" class="signature-image">
                            @endif
                        </div>
                        <strong><u>{{ $diagnosa->analis->nama ?? '________________' }}</u></strong><br>
                        <span style="font-size: 9pt;">{{ $diagnosa->analis->role->nama_role ?? 'Analis' }}</span>
                    </td>
                    <td>
                        <div class="signature-space">
                            @if($diagnosa->pemeriksa)
                                @if($diagnosa->pemeriksa->stempel)
                                    <img src="{{ public_path('storage/' . $diagnosa->pemeriksa->stempel) }}" class="stamp-image">
                                @endif
                                @if($diagnosa->pemeriksa->tanda_tangan)
                                    <img src="{{ public_path('storage/' . $diagnosa->pemeriksa->tanda_tangan) }}" class="signature-image">
                                @endif
                            @endif
                        </div>
                        <strong><u>{{ $diagnosa->pemeriksa->nama ?? '________________' }}</u></strong><br>
                        <span style="font-size: 9pt;">Manager Teknis</span>
                    </td>
                    <td>
                        <div class="signature-space">
                            @if($diagnosa->penyetuju)
                                @if($diagnosa->penyetuju->stempel)
                                    <img src="{{ public_path('storage/' . $diagnosa->penyetuju->stempel) }}" class="stamp-image">
                                @endif
                                @if($diagnosa->penyetuju->tanda_tangan)
                                    <img src="{{ public_path('storage/' . $diagnosa->penyetuju->tanda_tangan) }}" class="signature-image">
                                @endif
                            @endif
                        </div>
                        <strong><u>{{ $diagnosa->penyetuju->nama ?? '________________' }}</u></strong><br>
                        <span style="font-size: 9pt;">Manager Mutu</span>
                    </td>
                </tr>
            </table>
        </div>
    </main>
    
    <footer class="footer">
        Dilarang memperbanyak/menggandakan/menyebarluaskan/mempublikasikan isi dokumen ini untuk pihak luar Bandar Buat
    </footer>
</body>
</html>
