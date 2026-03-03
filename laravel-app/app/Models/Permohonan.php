<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permohonan extends Model
{
    use HasFactory;

    // Menentukan nama tabel secara eksplisit
    protected $table = 'surat_permohonan';

    // Menentukan primary key
    protected $primaryKey = 'no_surat';

    // Memberi tahu Laravel bahwa primary key bukan integer
    public $incrementing = false;

    // Memberi tahu Laravel tipe data dari primary key
    protected $keyType = 'string';

    // Kolom yang dapat diisi secara massal
    protected $fillable = [
        'no_surat',
        'user_id',
        'penerima_id',
        'jenis_id',
        'varietas_id',
        'umur',
        'bagian_terserang',
        'tgl_ditemukan',
        'budidaya',
        'jumlah_sampel',
        'gejala',
        'status',
        'perbaikan',
    ];

    /**
     * Mendefinisikan relasi ke model User.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function penerima()
    {
        return $this->belongsTo(User::class, 'penerima_id', 'user_id');
    }


    /**
     * Mendefinisikan relasi ke model Jenis.
     */
    public function jenis()
    {
        return $this->belongsTo(Jenis::class, 'jenis_id', 'jenis_id');
    }

    /**
     * Mendefinisikan relasi ke model Varietas.
     */
    public function varietas()
    {
        return $this->belongsTo(Varietas::class, 'varietas_id', 'varietas_id');
    }

    public function diagnosa()
    {
        return $this->hasOne(DiagnosaRekomendasi::class, 'permohonan_no_surat', 'no_surat');
    }
}
