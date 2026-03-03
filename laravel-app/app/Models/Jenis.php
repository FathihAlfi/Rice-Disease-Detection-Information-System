<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jenis extends Model
{
    protected $table = 'jenis';
    protected $primaryKey = 'jenis_id'; // ⬅ tambahkan baris ini
    protected $keyType = 'int';
    protected $fillable = ['nama_jenis'];

}
