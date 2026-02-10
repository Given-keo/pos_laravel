@extends("layouts.app")
@section("content_title","Dashboard")

@section("content")
<div class="row mb-4">
    <div class="col-md-12">
        <div class="card shadow-sm border-left-primary">
            <div class="card-body">
                <h5>Selamat Datang, <strong class="text-capitalize">{{ auth()->user()->name }}</strong>!</h5>
                <p class="mb-0 text-muted">Berikut adalah ringkasan performa toko kue Anda secara keseluruhan.</p>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-3">
        <div class="card bg-primary text-white shadow-sm">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <div class="small text-white-50">Total Omzet</div>
                        <div class="h4 mb-0">Rp {{ number_format($total_penjualan_all_time, 0, ',', '.') }}</div>
                    </div>
                    <i class="fas fa-money-bill-wave fa-2x text-white-50"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card bg-success text-white shadow-sm">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <div class="small text-white-50">Total Transaksi</div>
                        <div class="h4 mb-0">{{ number_format($jumlah_transaksi_all_time, 0, ',', '.') }}</div>
                    </div>
                    <i class="fas fa-shopping-basket fa-2x text-white-50"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card {{ $produk_kritis > 0 ? 'bg-danger' : 'bg-info' }} text-white shadow-sm">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <div class="small text-white-50">Produk Menipis</div>
                        <div class="h4 mb-0">{{ $produk_kritis }}</div>
                    </div>
                    <i class="fas fa-exclamation-triangle fa-2x text-white-50"></i>
                </div>
            </div>
            @if($produk_kritis > 0)
            <a href="{{ route('laporan.stok.index') }}" class="card-footer text-white small text-center" style="background: rgba(0,0,0,0.1); border:none; display:block;">
                Cek Stok Sekarang <i class="fas fa-arrow-right"></i>
            </a>
            @endif
        </div>
    </div>

    <div class="col-md-3">
        <div class="card bg-warning text-dark shadow-sm">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <div class="small text-black-50">Total Pelanggan</div>
                        <div class="h4 mb-0 font-weight-bold">{{ $total_pelanggan }}</div>
                    </div>
                    <i class="fas fa-users fa-2x text-black-50"></i>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection