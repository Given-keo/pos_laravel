<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    protected $fillable = [
        'sku',
        'nama_produk',    
        'kategori_id',
        'harga_jual',
        'harga_beli_pokok',
        'stok',
        'stok_minimal',
        'is_active',
    ];

}