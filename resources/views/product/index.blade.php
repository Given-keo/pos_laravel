@extends("layouts.app")
@section("content_title","Data Produk")
@section("content")
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Data Produk</h4>
        </div>
        <div class="card-body">
            <x-alert :error="$errors->any()"/>
            <div class="d-flex justify-content-end mb-2">
                <x-product.form-product/>
            </div>
            <div class="table-responsive">
                <table class="table table-sm" id="example1">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>SKU</th>
                            <th>Nama Produk</th>
                            <th>Harga Jual</th>
                            <th>Harga Beli</th>
                            <th>Stok</th>
                            <th>Aktif</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $index => $product)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $product->sku }}</td>
                                <td>{{ $product->nama_produk }}</td>
                                <td>Rp. {{ number_format($product->harga_jual) }}</td>
                                <td>Rp. {{ number_format($product->harga_beli_pokok) }}</td>
                                <td>{{ number_format($product->stok) }}</td>
                                <td>{{ $product->is_active }}</td>
                                <td>
                                    <div class="mt-2 d-flex align-items-center">
                                        <x-product.form-product :id="$product->id"/>
                                        <a href="{{ route("master-data.product.destroy", $product->id) }}" data-confirm-delete="true" class="text-white btn btn-danger mx-1">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div> 
        </div>
    </div>
@endsection()