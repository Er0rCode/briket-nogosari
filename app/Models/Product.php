<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // WAJIB ADA: Izinkan nama-nama kolom ini untuk diisi data
    protected $fillable = [
        'nama_produk',
        'harga',
        'deskripsi',
        'foto_produk',
    ];
}