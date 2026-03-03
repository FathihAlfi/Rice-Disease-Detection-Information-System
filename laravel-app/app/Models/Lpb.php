<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Lpb extends Model
{
    use HasFactory;
    protected $table = 'lpb'; 
    protected $primaryKey = 'no_surat';
    protected $keyType = 'string';
    public $incrementing = false;
    protected $fillable = [
        'no_surat','user_id', 'deteksi_id', 'userlokasi_id', 'varietas_id', 'opt_id', 'pengendalian_id',
        'laporan_ke', 'tgl_pengamatan', 'umur',
        'intensitas_serangan','padat_populasi_ha', 'luas_serangan_ha', 'luas_terancam_ha', 'populasi_MA',
        'upaya', 'custom_pengendalian', 'status'
    ];
    public function getRouteKeyName()
    {
        return 'no_surat';
    }
    
    public function user() { return $this->belongsTo(User::class, 'user_id', 'user_id'); }
    public function deteksi() { return $this->belongsTo(DeteksiCnn::class, 'deteksi_id'); }
    public function userlokasi() { return $this->belongsTo(UserLokasi::class, 'userlokasi_id'); }
    public function varietas() { return $this->belongsTo(Varietas::class, 'varietas_id'); }
    public function opt() { return $this->belongsTo(Opt::class, 'opt_id'); }
    public function pengendalian() { return $this->belongsTo(Pengendalian::class, 'pengendalian_id'); }
}