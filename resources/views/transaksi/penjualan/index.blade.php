@extends('layouts.app')

@section('content_title', 'Data Transaksi Penjualan')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title ">Data Produk</h4>
                <div class="d-flex justify-content-end">
                    <a href="{{ route('transaksi.penjualan.create') }}" class="btn btn-primary btn-sm ">
                        + Tambah Transaksi
                    </a>
                </div>
            </div>

            <div class="card-body">
                <table class="table table-bordered" id="transaksi-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode</th>
                            <th>Pelanggan</th>
                            <th>Total</th>
                            <th>Bayar</th>
                            <th>Kembalian</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($penjualan as $key => $p)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $p->kode_transaksi }}</td>
                            <td>{{ $p->pelanggan ? $p->pelanggan->nama_pelanggan : 'Umum' }}</td>
                            <td>{{ number_format($p->total, 0, ',', '.') }}</td>
                            <td>{{ number_format($p->bayar, 0, ',', '.') }}</td>
                            <td>{{ number_format($p->kembalian, 0, ',', '.') }}</td>
                            <td>{{ $p->tanggal->format('d/m/Y H:i') }}</td>
                            <td>
                                <a href="{{ route('transaksi.penjualan.show', $p->id) }}" class="btn btn-info btn-sm">
                                    <i class="fas fa-eye"></i> Detail
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@push('script')
<script>
    $(document).ready(function () {
        $('#transaksi-table').DataTable({
            responsive: true,
            autoWidth: false
        });
    });
</script>
@endpush

@endsection
