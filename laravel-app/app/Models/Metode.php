<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Metode extends Model
{
    protected $table = 'metode'; // default sebenarnya 'metodes', tapi pastikan di-set jika ada keraguan
    protected $primaryKey = 'metode_id';
    protected $fillable = ['nama_metode'];

    public function metodes()
    {
        return $this->belongsToMany(Metode::class, 'diagnosa_metode', 'diagnosa_id', 'metode_id');
    }

}
