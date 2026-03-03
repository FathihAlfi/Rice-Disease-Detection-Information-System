<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiagnosaRekomendasi extends Model
{
    use HasFactory;

    protected $table = 'diagnosa_rekomendasis';

    // === PERBAIKAN: Menyesuaikan Primary Key dengan migrasi baru ===
    protected $primaryKey = 'diagnosa_id';
    public $incrementing = false;
    protected $keyType = 'string';

    /**
     * Properti fillable disesuaikan agar cocok dengan kolom-kolom baru di migrasi.
     */
    protected $fillable = [
        'diagnosa_id',
        'permohonan_no_surat',
        'analis_id', // <-- Tambahkan ini
        'metode_id',
        'tgl_diagnosa',
        'hasil_diagnosa',
        'deskripsi_opt',
        'rekomendasi_pengendalian',
        'dokumentasi',
        'status',
        'perbaikan',
        'pemeriksa_id',
        'penyetuju_id',
        'pengesah_id',
        'diperiksa_at',
        'disetujui_at',
        'disahkan_at',
    ];

    /**
     * Relasi "belongsTo" ke model Permohonan.
     * Ini adalah relasi kunci untuk mengambil semua data dari surat permohonan.
     */
    public function permohonan()
    {
        return $this->belongsTo(Permohonan::class, 'permohonan_no_surat', 'no_surat');
    }
    
    /**
     * Relasi ke metode diagnosa yang digunakan.
     */
    public function metode()
    {
        return $this->belongsTo(Metode::class, 'metode_id', 'metode_id');
    }

    public function analis()
    {
        return $this->belongsTo(User::class, 'analis_id', 'user_id');
    }

     public function pemeriksa()
    {
        return $this->belongsTo(User::class, 'pemeriksa_id', 'user_id');
    }

    /**
     * Relasi ke user yang menjadi Penyetuju (Manager Mutu).
     */
    public function penyetuju()
    {
        return $this->belongsTo(User::class, 'penyetuju_id', 'user_id');
    }

    /**
     * Relasi ke user yang menjadi Pengesah (Kepala LPHP).
     */
    public function pengesah()
    {
        return $this->belongsTo(User::class, 'pengesah_id', 'user_id');
    }
}
