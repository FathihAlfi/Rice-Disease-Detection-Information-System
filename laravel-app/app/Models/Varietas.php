<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Varietas extends Model
{
    protected $table = 'varietas';
    protected $primaryKey = 'varietas_id'; // ⬅ tambahkan baris ini
    protected $keyType = 'int';
    protected $fillable = ['jenis_id', 'nama_varietas'];   
    
    public function jenis()
    {
        return $this->belongsTo(Jenis::class, 'jenis_id', 'jenis_id');
    }
}
