@extends('layouts.app')

@section('content_title', 'Laporan Penjualan')

@section('content')
<div class="row">
    {{-- Card Filter --}}
    <div class="col-md-12">
        <div class="card shadow-sm">
            <div class="card-header">
                <h4 class="card-title">Filter Tanggal</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('laporan.penjualan.index') }}" method="GET">
                    <div class="row align-items-end">
                        <div class="col-md-4">
                            <label>Dari Tanggal</label>
                            <input type="date" name="tgl_mulai" class="form-control" value="{{ $tgl_mulai }}">
                        </div>
                        <div class="col-md-4">
                            <label>Sampai Tanggal</label>
                            <input type="date" name="tgl_selesai" class="form-control" value="{{ $tgl_selesai }}">
                        </div>
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-search"></i> Filter
                            </button>
                            <a href="{{ route('laporan.penjualan.index') }}" class="btn btn-secondary">
                                <i class="fas fa-sync"></i> Reset
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Ringkasan Pendapatan --}}
    <div class="col-md-12 mt-3">
        <div class="card shadow-sm">
            <div class="card-body py-3">
                <h6 class="mb-1">Total Pendapatan pada Periode Ini:</h6>
                <h3 class="mb-0">Rp {{ number_format($total_pendapatan, 0, ',', '.') }}</h3>
            </div>
        </div>
    </div>

    {{-- Tabel Data --}}
    <div class="col-md-12 mt-3">
        <div class="card shadow-sm">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" id="laporan-table">
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Kode Transaksi</th>
                                <th>Pelanggan</th>
                                <th>Metode</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($laporan as $key => $row)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $row->tanggal->format('d/m/Y H:i') }}</td>
                                <td>{{ $row->kode_transaksi }}</td>
                                <td>{{ $row->pelanggan?->nama_pelanggan ?? 'Umum' }}</td>
                                <td>{{ $row->metodePembayaran?->nama_metode }}</td>
                                <td class="text-right">Rp {{ number_format($row->total, 0, ',', '.') }}</td>
                            </tr>
                            @endforeach
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
        $('#laporan-table').DataTable({
            responsive: true,
            dom: 'Bfrtip',
            buttons: ['excel', 'pdf', 'print']
        });
    });
</script>
@endpush