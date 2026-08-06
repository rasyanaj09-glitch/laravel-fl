<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class produk extends Model
{
    // Tambahkan baris ini agar kolom database diizinkan untuk diperbarui dari luar
    protected $fillable = ['nama', 'harga', 'stok', 'desk', 'gambar'];
}
