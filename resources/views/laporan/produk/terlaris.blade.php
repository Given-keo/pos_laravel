@extends('layouts.app')

@section('content_title', 'Laporan Produk Terlaris')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card shadow-sm">
            <div class="card-header">
                <h4 class="card-title">Filter Periode</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('laporan.produk-terlaris.index') }}" method="GET">
                    <div class="row align-items-end">
                        <div class="col-md-4">
                            <div class="form-group mb-0">
                                <label>Mulai Tanggal</label>
                                <input type="date" name="tgl_mulai" class="form-control" value="{{ $tgl_mulai }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mb-0">
                                <label>Sampai Tanggal</label>
                                <input type="date" name="tgl_selesai" class="form-control" value="{{ $tgl_selesai }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-searchr"></i> Tampilkan Laporan
                            </button>
                            <a href="{{ route('laporan.produk-terlaris.index') }}" class="btn btn-secondary">
                                <i class="fas fa-sync"></i> Reset
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-12 mt-3">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Peringkat Penjualan Produk</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" id="terlaris-table">
                        <thead class="table-light">
                            <tr>
                                <th width="50">Peringkat</th>
                                <th>Produk</th>
                                <th>Kategori</th>
                                <th class="text-center">Total Terjual</th>
                                <th class="text-right">Total Pendapatan (Omzet)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($produkTerlaris as $key => $item)
                            <tr>
                                <td class="text-center font-weight-bold">
                                    @if($key == 0)
                                        <span class="badge" style="font-size: 1rem">1</span>
                                    @elseif($key == 1)
                                        <span class="badge" style="font-size: 0.9rem">2</span>
                                    @elseif($key == 2)
                                        <span class="badge" style="font-size: 0.8rem">3</span>
                                    @else
                                        {{ $key + 1 }}
                                    @endif
                                </td>
                                <td>{{ $item->produk->nama_produk ?? 'Produk Dihapus' }}</td>
                                <td>
                                    <span class="badge badge-info">
                                        {{ $item->produk->kategori->nama_kategori ?? 'Tanpa Kategori' }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <strong>{{ number_format($item->total_qty, 0, ',', '.') }}</strong>
                                </td>
                                <td class="text-right font-weight-bold">
                                    Rp {{ number_format($item->total_pendapatan, 0, ',', '.') }}
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center py-4 text-muted">Tidak ada data penjualan pada periode ini.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
<script>
    $(document).ready(function () {
        $('#terlaris-table').DataTable({
            responsive: true,
            autoWidth: false,
            // Mengurutkan berdasarkan kolom ke-4 (Total Terjual) secara descending
            "order": [[ 3, "desc" ]]
        });
    });
</script>
@endpush