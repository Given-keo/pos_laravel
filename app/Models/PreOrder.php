<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PreOrder extends Model
{
    protected $fillable = [
        'kode_preorder',
        'pelanggan_id',
        'user_id',
        'metode_pembayaran_id',
        'total',
        'bayar',
        'kembalian',
        'tanggal_kirim',
        'status',
        'catatan',
    ];

    protected $casts = [
        'tanggal_kirim' => 'date',
    ];

    // Relasi ke detail pre-order
    public function details()
    {
        return $this->hasMany(PreOrderDetail::class);
    }

    // Relasi ke pelanggan
    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class);
    }

    // Relasi ke kasir/user
    public function kasir()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relasi ke metode pembayaran
    public function metodePembayaran()
    {
        return $this->belongsTo(Metode_pembayaran::class, 'metode_pembayaran_id');
    }
}
