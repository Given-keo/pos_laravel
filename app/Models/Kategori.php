<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    //
    protected $fillable = [
        "id",
        'nama_kategori', 
        'slug', 
        'deskripsi'
    ];
}
