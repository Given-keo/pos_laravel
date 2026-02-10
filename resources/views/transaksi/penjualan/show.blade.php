@extends('layouts.app')

@section('content_title', 'Detail Transaksi: ' . $penjualan->kode_transaksi)

@section('content')
<div class="d-flex justify-content-start mb-3">
    <a href="{{ route('transaksi.penjualan.index') }}" class="btn btn-light btn-sm">
        <i class="fas fa-arrow-left"></i> Kembali
    </a>
</div>

<div class="card shadow-sm">
    <div class="card-header">
        <h5 class="mb-0">Informasi Transaksi</h5>
    </div>
    <div class="card-body">
        <p><strong>Pelanggan:</strong> {{ $penjualan->pelanggan ? $penjualan->pelanggan->nama_pelanggan : 'Umum' }}</p>
        <p><strong>Kasir:</strong> {{ $penjualan->kasir->name ?? '-' }}</p>
        <p><strong>Metode Pembayaran:</strong> {{ $penjualan->metodePembayaran->nama_metode ?? '-' }}</p>
        <p><strong>Tanggal:</strong> {{ $penjualan->tanggal->format('d/m/Y H:i') }}</p>
    </div>
</div>

<div class="card shadow-sm mt-3">
    <div class="card-header">
        <h5 class="mb-0">Daftar Produk</h5>
    </div>
    <div class="card-body table-responsive">
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>No</th>
                    <th>Produk</th>
                    <th>Harga</th>
                    <th>Qty</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($penjualan->details as $key => $detail)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $detail->produk->nama_produk }}</td>
                    <td>{{ number_format($detail->harga, 0, ',', '.') }}</td>
                    <td>{{ $detail->qty }}</td>
                    <td>{{ number_format($detail->subtotal, 0, ',', '.') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="card-footer text-end">
        <p><strong>Total:</strong> {{ number_format($penjualan->total,0,',','.') }}</p>
        <p><strong>Bayar:</strong> {{ number_format($penjualan->bayar,0,',','.') }}</p>
        <p><strong>Kembalian:</strong> {{ number_format($penjualan->kembalian,0,',','.') }}</p>
        <p><strong>Catatan:</strong> {{ $penjualan->catatan ?? '-' }}</p>
    </div>
</div>
@endsection
