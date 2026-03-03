<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jorong extends Model
{
    use HasFactory;

    /**
     * Nama tabel yang terhubung dengan model ini.
     *
     * @var string
     */
    protected $table = 'jorong';

    /**
     * Primary key untuk model ini.
     *
     * @var string
     */
    protected $primaryKey = 'jorong_id';

    /**
     * Menunjukkan jika ID tidak auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = true; // Diasumsikan jorong_id adalah integer auto-increment

    /**
     * Menunjukkan jika model tidak memiliki timestamp (created_at, updated_at).
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * PERBAIKAN UTAMA:
     * Kolom-kolom yang boleh diisi secara massal (mass assignable).
     *
     * @var array
     */
    protected $fillable = [
        'nagari_id',
        'nama_jorong',
    ];

    /**
     * Mendefinisikan relasi ke model Nagari.
     */
    public function nagari()
    {
        return $this->belongsTo(Nagari::class, 'nagari_id', 'nagari_id');
    }
}
