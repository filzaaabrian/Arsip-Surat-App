<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Surat extends Model
{
    protected $table= 'surats';
    // protected $guarded = ['id'];
    protected $fillable =[
        'nomor_surat',
        'judul_surat',
        'kategori_surat',
        'file_surat',
    ];

    use HasFactory;
}
