<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    protected $fillable = [
        'kode_transaksi',
        'tanggal',
        'pelanggan_id',
        'user_id',
        'total',
        'bayar',
        'kembalian',
        'metode_pembayaran_id',
        'catatan',
    ];

    protected $casts = [
        'tanggal' => 'datetime',
    ];

    public function details()
    {
        return $this->hasMany(PenjualanDetail::class);
    }

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class);
    }

    public function kasir()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function metodePembayaran()
    {
        return $this->belongsTo(Metode_pembayaran::class);
    }
}


