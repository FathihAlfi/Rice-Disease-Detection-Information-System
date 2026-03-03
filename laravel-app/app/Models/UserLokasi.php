<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserLokasi extends Model
{
    use HasFactory;

    protected $table = 'user_lokasis';
    protected $primaryKey = 'userlokasi_id';
    
    // Tabel ini tidak memiliki kolom created_at dan updated_at sesuai skema
    public $timestamps = false; 

    protected $fillable = [
        'user_id', 
        'kabkot_id', 
        'kecamatan_id', 
        'nagari_id', 
        'jorong_id'
    ];

    /**
     * Mendefinisikan relasi "belongsTo" ke model User.
     */
    public function user()
    {
        // Relasi ke tabel 'users' dengan foreign key 'user_id'
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    /**
     * Mendefinisikan relasi "belongsTo" ke model KabKota.
     */
    public function kabkot()
    {
        // Relasi ke tabel 'kab_kota' dengan foreign key 'kabkot_id'
        return $this->belongsTo(KabKota::class, 'kabkot_id', 'kabkot_id');
    }

    /**
     * Mendefinisikan relasi "belongsTo" ke model Kecamatan.
     */
    public function kecamatan()
    {
        // Relasi ke tabel 'kecamatan' dengan foreign key 'kecamatan_id'
        return $this->belongsTo(Kecamatan::class, 'kecamatan_id', 'kecamatan_id');
    }

    /**
     * Mendefinisikan relasi "belongsTo" ke model Nagari.
     */
    public function nagari()
    {
        // Relasi ke tabel 'nagari' dengan foreign key 'nagari_id'
        return $this->belongsTo(Nagari::class, 'nagari_id', 'nagari_id');
    }

    /**
     * Mendefinisikan relasi "belongsTo" ke model Jorong.
     */
    public function jorong()
    {
        // Relasi ke tabel 'jorong' dengan foreign key 'jorong_id'
        return $this->belongsTo(Jorong::class, 'jorong_id', 'jorong_id');
    }
}
