<?php

namespace App\Http\Controllers;

use App\Models\PenjualanDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Product; 

class LaporanProdukController extends Controller
{
    public function terlaris(Request $request)
    {
        $tgl_mulai = $request->tgl_mulai ?? Carbon::now()->startOfMonth()->format('Y-m-d');
        $tgl_selesai = $request->tgl_selesai ?? Carbon::now()->format('Y-m-d');

        $produkTerlaris = PenjualanDetail::select(
                'produk_id', 
                DB::raw('SUM(qty) as total_qty'), 
                DB::raw('SUM(subtotal) as total_pendapatan')
            )
            ->whereHas('penjualan', function($query) use ($tgl_mulai, $tgl_selesai) {
                $query->whereDate('tanggal', '>=', $tgl_mulai)
                      ->whereDate('tanggal', '<=', $tgl_selesai);
            })
            ->groupBy('produk_id')
            ->orderBy('total_qty', 'desc')
            ->with(['produk.kategori']) 
            ->get();

        return view('laporan.produk.terlaris', compact('produkTerlaris', 'tgl_mulai', 'tgl_selesai'));
    }

    public function stok()
    {
        $stokProduk = Product::with('kategori')
            ->orderBy('stok', 'asc') 
            ->get();

        return view('laporan.produk.stok', compact('stokProduk'));
    }
}