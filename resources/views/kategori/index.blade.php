@extends("layouts.app")
@section("content_title","Data Kategori")
@section("content")
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Data Kategori</h4>
            <div class="d-flex justify-content-end">
                <x-kategori.form-kategori/>
            </div>
        </div>
        <div class="card-body">
            <x-alert :error="$errors->any()"/>
            <div class="table-responsive">
                <table class="table table-sm" id="example1">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Kategori</th>
                            <th>Deskripsi</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kategori as $index => $item)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $item->nama_kategori }}</td>
                                <td>{{ $item->deskripsi }}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <x-kategori.form-kategori :id="$item->id"/>
                                        <a href="{{ route("data-master.kategori.destroy", $item->id) }}" data-confirm-delete="true" class="text-light btn btn-sm btn-danger mx-1">
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