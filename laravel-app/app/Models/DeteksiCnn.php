<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeteksiCnn extends Model
{
    use HasFactory;

    protected $table = 'deteksi_cnn';

    protected $primaryKey = 'deteksi_id';

    protected $fillable = [
        'user_id',
        'label',
        'pengendalian',
        'gambar'
    ];
}
