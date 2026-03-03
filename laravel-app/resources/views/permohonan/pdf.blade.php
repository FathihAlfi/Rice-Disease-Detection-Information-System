<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Surat Permohonan Klinik Tanaman - {{ $permohonan->no_surat }}</title>
    <style>
        body { font-family: 'Times New Roman', Times, serif; font-size: 11pt; margin: 20px; line-height: 1.3; }
        .main-container { border: 1px solid black; width: 100%; padding: 10px; box-sizing: border-box; }
        .header-table { width: 100%; border-bottom: 2.5px solid black; padding-bottom: 5px; margin-bottom: 5px; }
        .header-table td { vertical-align: middle; text-align: center; }
        .header-table .logo { width: 80px; }
        .header-table .title { font-size: 13pt; font-weight: bold; }
        .info-table { width: 100%; border-collapse: collapse; border: 1px solid black; margin-top: 5px; }
        .info-table th, .info-table td { border: 1px solid black; padding: 3px; font-size: 8pt; text-align: left; }
        .content-table { width: 100%; border-collapse: collapse; margin-top: 8px; }
        .content-table td { padding: 1px 2px; vertical-align: top; }
        .section-title { font-weight: bold; margin-top: 10px; margin-bottom: 2px; }
        .statement-list { list-style-type: lower-alpha; padding-left: 20px; margin: 0; }
        .signature-table { width: 100%; margin-top: 25px; page-break-inside: avoid; }
        .signature-table td { width: 50%; text-align: center; vertical-align: top; padding: 0 15px; }
        .signature-space { height: 70px; position: relative; margin-bottom: 3px; }
        p { margin: 2px 0; }

        .signature-image {
            position: absolute;
            max-height: 65px;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            z-index: 5;
        }
        .stamp-image {
            position: absolute;
            max-height: 75px;
            left: 50%;
            top: 50%;
            transform: translate(-40%, -60%);
            opacity: 0.85;
            z-index: 10;
        }
        
        /* PERBAIKAN: CSS untuk merapikan titik dua */
        .data-label {
            width: 35%;
        }
        .data-separator {
            width: 2%;
        }
    </style>
</head>
<body>
<div class="main-container">
    <table class="header-table">
        <tr>
            <td class="logo">
                <img src="{{ public_path('images/logo.png') }}" alt="Logo" style="width: 65px;">
            </td>
            <td>
                <div class="title">BALAI PERLINDUNGAN TANAMAN PANGAN DAN HORTIKULTURA</div>
                <div class="title">LPHP DAN PAH INDUK BANDA BUAT</div>
            </td>
        </tr>
        <tr>
            <td colspan="2" style="padding-top: 5px;">
                <table class="info-table">
                    <tr>
                        <td rowspan="2" style="text-align:center; font-weight:bold; vertical-align:middle; width:50%;">INFORMASI TERDOKUMENTASI</td>
                        <th>KODE DOK : F-LBB-SOP-TEK.02.01</th>
                    </tr>
                     <tr>
                        <th>NO REVISI : 1 &nbsp;&nbsp;&nbsp; TANGGAL TERBIT : 14 OKTOBER 2019 &nbsp;&nbsp;&nbsp; HALAMAN 1/2</th>
                    </tr>
                    <tr>
                         <td colspan="2" style="text-align:center; font-weight:bold;">FORMULIR – SURAT PERMOHONAN KLINIK TANAMAN</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    <table style="width: 100%; margin-top: 15px;">
        <tr>
            <td style="width: 60%;">
                <strong>Nomor SP :</strong> {{ $permohonan->no_surat }}
            </td>
            <td style="width: 40%;">
                <strong>Tanggal :</strong> {{ $permohonan->created_at->format('d F Y') }}
            </td>
        </tr>
        <tr>
            <td colspan="2" style="padding-top: 10px;">
                <strong>Kepada Yth,</strong><br>
                <strong>Kepala LPHP dan PAH Induk Banda Buat / Manajer Eksekutif</strong><br>
                Jln. Jambak Indah No.40<br>
                Banda Buat, Padang
            </td>
        </tr>
    </table>

    <p style="margin-top: 15px; margin-bottom: 5px;">Bersama ini saya menyampaikan <strong>Permohonan Pelayanan Klinik Tanaman</strong> dengan identitas Sebagai Berikut:</p>

    <div class="section-title">A. Keterangan Umum</div>
    <table class="content-table">
        <tr>
            <td class="data-label">1. Nama Pembawa</td>
            <td class="data-separator">:</td>
            <td>{{ $permohonan->user->nama ?? '-' }}</td>
        </tr>
        <tr>
            <td class="data-label">2. Nama Pemilik</td>
            <td class="data-separator">:</td>
            <td>{{ $permohonan->user->nama ?? '-' }}</td>
        </tr>
        <tr>
            <td class="data-label">3. No Telp</td>
            <td class="data-separator">:</td>
            <td>{{ $permohonan->user->no_telp ?? '-' }}</td>
        </tr>
        <tr>
            <td class="data-label">4. Alamat</td>
            <td class="data-separator">:</td>
            <td>{{ $permohonan->user->alamat ?? '-' }}</td>
        </tr>
    </table>

    <div class="section-title">B. Data Bahan Sampel</div>
    <table class="content-table">
        <tr><td class="data-label">1. Jenis Tanaman</td><td class="data-separator">:</td><td>{{ $permohonan->jenis->nama_jenis ?? '-' }}</td></tr>
        <tr><td class="data-label">2. Varietas Tanaman</td><td class="data-separator">:</td><td>{{ $permohonan->varietas->nama_varietas ?? '-' }}</td></tr>
        <tr><td class="data-label">3. Umur Tanaman</td><td class="data-separator">:</td><td>{{ $permohonan->umur }} HST</td></tr>
        <tr><td class="data-label">4. Bagian Tanaman terserang</td><td class="data-separator">:</td><td>{{ $permohonan->bagian_terserang }}</td></tr>
        <tr><td class="data-label">5. Tanggal ditemukan tanaman</td><td class="data-separator">:</td><td>{{ \Carbon\Carbon::parse($permohonan->tgl_ditemukan)->format('d F Y') }}</td></tr>
        <tr><td class="data-label">6. Budidaya tanaman</td><td class="data-separator">:</td><td>{{ $permohonan->budidaya }}</td></tr>
        <tr><td class="data-label">7. Jumlah sampel</td><td class="data-separator">:</td><td>{{ $permohonan->jumlah_sampel }}</td></tr>
    </table>

    <div class="section-title">C. Deskripsi Gejala</div>
    <div style="padding-left: 15px;">
        <p style="margin: 0;">{{ $permohonan->gejala }}</p>
    </div>

    <div class="section-title">D. Pernyataan Pemilik/Kuasanya</div>
    <div style="padding-left: 15px;">
        <ul class="statement-list">
            <li>Keterangan yang saya berikan tersebut diatas adalah benar.</li>
            <li>Saya Bersedia menanggung segala akibat yang timbul terhadap sampel tumbuhan tersebut.</li>
        </ul>
    </div>

    {{-- Area Tanda Tangan dengan Dua Kolom --}}
    <table class="signature-table">
        <tr>
            {{-- Kolom Pemilik/POPT --}}
            <td>
                Pemilik / Kuasanya,
                <div class="signature-space">
                    @if($permohonan->user && $permohonan->user->tanda_tangan)
                        <img src="{{ public_path('storage/' . $permohonan->user->tanda_tangan) }}" class="signature-image">
                    @endif
                </div>
                <strong><u>{{ $permohonan->user->nama ?? '____________________' }}</u></strong>
            </td>
            {{-- Kolom Penerima Sampel --}}
            <td>
                Penerima Sampel,
                <div class="signature-space">
                    @if($permohonan->penerima)
                        @if($permohonan->penerima->stempel)
                            <img src="{{ public_path('storage/' . $permohonan->penerima->stempel) }}" class="stamp-image">
                        @endif
                        @if($permohonan->penerima->tanda_tangan)
                            <img src="{{ public_path('storage/' . $permohonan->penerima->tanda_tangan) }}" class="signature-image">
                        @endif
                    @endif
                </div>
                <strong><u>{{ $permohonan->penerima->nama ?? '____________________' }}</u></strong><br>
                NIP. {{ $permohonan->penerima->nip ?? '____________________' }}
            </td>
        </tr>
    </table>
</div>
</body>
</html>
