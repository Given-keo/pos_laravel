@extends('layouts.app')

@section('content_title', 'Laporan Stok Produk')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card shadow-sm">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title">Status Stok Saat Ini</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" id="stok-table">
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th>Nama Produk</th>
                                <th>Kategori</th>
                                <th class="text-center">Stok Minimal</th>
                                <th class="text-center">Stok Saat Ini</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($stokProduk as $key => $p)
                            @php
                                $isKritis = $p->stok <= $p->stok_minimal;
                            @endphp
                            <tr class="{{ $isKritis ? 'table-danger' : '' }}">
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $p->nama_produk }}</td>
                                <td>{{ $p->kategori->nama_kategori ?? '-' }}</td>
                                <td class="text-center">{{ $p->stok_minimal }}</td>
                                <td class="text-center">
                                    <strong class="{{ $isKritis ? 'text-danger' : '' }}">
                                        {{ $p->stok }}
                                    </strong>
                                </td>
                                <td>
                                    @if($isKritis)
                                        <span class="badge badge-danger">
                                            <i class="fas fa-exclamation-triangle"></i> Stok Menipis / Habis
                                        </span>
                                    @else
                                        <span class="badge badge-success">Aman</span>
                                    @endif
                                </td>
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
        $('#stok-table').DataTable({
            responsive: true,
            pageLength: 25,
            order: [[4, 'asc']] 
        });
    });
</script>
@endpush