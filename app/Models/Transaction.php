<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 
        'kode_tiket', 
        'nama_pemesan', 
        'tgl_kunjungan', 
        'jumlah_orang', 
        'kategori', 
        'total_harga', 
        'status'
    ];
}