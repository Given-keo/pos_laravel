<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;
use Illuminate\Http\Request;
use Carbon\Carbon;

class LaporanPenjualanController extends Controller
{
    public function index(Request $request)
    {
        // Default ke awal bulan sampai hari ini jika tidak ada filter
        $tgl_mulai = $request->tgl_mulai ?? Carbon::now()->startOfMonth()->format('Y-m-d');
        $tgl_selesai = $request->tgl_selesai ?? Carbon::now()->format('Y-m-d');

        $laporan = Penjualan::with(['pelanggan', 'metodePembayaran'])
            ->whereDate('tanggal', '>=', $tgl_mulai)
            ->whereDate('tanggal', '<=', $tgl_selesai)
            ->latest()
            ->get();

        $total_pendapatan = $laporan->sum('total');

        return view('laporan.penjualan.index', compact('laporan', 'tgl_mulai', 'tgl_selesai', 'total_pendapatan'));
    }
}