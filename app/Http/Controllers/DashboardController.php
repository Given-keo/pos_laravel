<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Mengambil total pendapatan dari seluruh transaksi yang pernah ada
        $data['total_penjualan_all_time'] = \App\Models\Penjualan::sum('total');
        
        // Mengambil total seluruh transaksi
        $data['jumlah_transaksi_all_time'] = \App\Models\Penjualan::count();
        
        // Mengambil jumlah produk yang stoknya di bawah stok_minimal
        $data['produk_kritis'] = \App\Models\Product::whereRaw('stok <= stok_minimal')->count();
        
        // Mengambil total seluruh pelanggan yang terdaftar
        $data['total_pelanggan'] = \App\Models\Pelanggan::count();

        return view('dashboard.index', $data);
    }

    
}
