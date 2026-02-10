<?php

namespace App\Http\Controllers;

use App\Models\Metode_pembayaran;
use App\Models\Produk;
use App\Models\Pelanggan;
use App\Models\MetodePembayaran;
use App\Models\Penjualan;
use App\Models\PenjualanDetail;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;


class PenjualanController extends Controller
{
    /**
     * Halaman kasir
     */
    public function index()
    {
        $penjualan = Penjualan::with('pelanggan', 'kasir')->latest()->get();

        return view('transaksi.penjualan.index', compact('penjualan'));
    }


    /**
     * Simpan transaksi penjualan
     */
    public function store(Request $request)
    {
        $request->validate([
            'produk_id' => 'required|array',
            'qty' => 'required|array',
            'bayar' => 'required|numeric|min:0',
            'metode_pembayaran_id' => 'required',
        ]);

        DB::transaction(function () use ($request) {

            $total = 0;

            // Hitung total
            foreach ($request->produk_id as $index => $produkId) {
                $produk = Product::findOrFail($produkId);
                $subtotal = $produk->harga_jual * $request->qty[$index];
                $total += $subtotal;
            }

            // Simpan header penjualan
            $penjualan = Penjualan::create([
                'kode_transaksi' => 'TRX-' . now()->format('YmdHis'),
                'tanggal' => now(),
                'pelanggan_id' => $request->pelanggan_id,
                'user_id' => Auth::id(),
                'total' => $total,
                'bayar' => $request->bayar,
                'kembalian' => $request->bayar - $total,
                'metode_pembayaran_id' => $request->metode_pembayaran_id,
                'catatan' => $request->catatan,
            ]);

            // Simpan detail & kurangi stok
            foreach ($request->produk_id as $index => $produkId) {
                $produk = Product::findOrFail($produkId);

                PenjualanDetail::create([
                    'penjualan_id' => $penjualan->id,
                    'produk_id' => $produkId,
                    'harga' => $produk->harga_jual,
                    'qty' => $request->qty[$index],
                    'subtotal' => $produk->harga_jual * $request->qty[$index],
                ]);

                // Kurangi stok
                $produk->decrement('stok', $request->qty[$index]);
            }
        });

        toast()->success('Transaksi berhasil disimpan');
        return redirect()->route('transaksi.penjualan.index');
    }

    public function create()
    {
        return view('transaksi.penjualan.create', [
            'produk' => Product::where('is_active', 1)->get(),
            'pelanggan' => Pelanggan::all(),
            'metode' => Metode_pembayaran::where('status', 1)->get(),
        ]);
    }

    public function show($id)
    {
        $penjualan = Penjualan::with(['details.produk', 'pelanggan', 'kasir', 'metodePembayaran'])
                    ->findOrFail($id);

        return view('transaksi.penjualan.show', compact('penjualan'));
    }


}
