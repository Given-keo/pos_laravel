<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PreOrderDetail extends Model
{
    protected $fillable = [
        'pre_order_id',
        'produk_id',
        'harga',
        'qty',
        'subtotal',
    ];

    public function preorder()
    {
        return $this->belongsTo(PreOrder::class);
    }

    public function produk()
    {
        return $this->belongsTo(Product::class);
    }
}
