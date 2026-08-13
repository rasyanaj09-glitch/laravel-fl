<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $table = 'produks'; // kalau database nama tabelnya produk, pakai 'produks'

    protected $fillable = [
        'nama',
        'harga',
        'stok',
        'desk',
        'gambar',
    ];
}
