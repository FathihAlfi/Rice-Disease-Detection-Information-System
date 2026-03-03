<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengendalian extends Model
{
    protected $table = 'pengendalian';

    protected $primaryKey = 'pengendalian_id'; // ⬅ tambahkan baris ini

    protected $keyType = 'int'; 

    protected $fillable = ['opt_id', 'deskripsi'];

     public $timestamps = false; // ⬅ Nonaktifkan timestamps

    public function opt()
    {
        return $this->belongsTo(opt::class, 'opt_id', 'opt_id');
    }

}

