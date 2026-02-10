@extends("layouts.app")

@section("content_title","Data Pelanggan")

@section("content")
<div class="card">
    <div class="card-header">
        <h4 class="card-title">Data Pelanggan</h4>

        <div class="d-flex justify-content-end mb-2">
            <x-pelanggan.form-pelanggan/>
        </div>
    </div>

    <div class="card-body">
        <x-alert :error="$errors->any()"/>

        <div class="table-responsive">
            <table class="table table-sm" id="example1">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Pelanggan</th>
                        <th>No HP</th>
                        <th>Alamat</th>
                        <th>Opsi</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($pelanggan as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $item->nama_pelanggan }}</td>
                            <td>{{ $item->no_hp ?? '-' }}</td>
                            <td>{{ $item->alamat ?? '-' }}</td>

                            <td>
                                <div class="d-flex align-items-center">

                                    <x-pelanggan.form-pelanggan
                                        :id="$item->id"
                                        :nama-pelanggan="$item->nama_pelanggan"
                                        :no-hp="$item->no_hp"
                                        :alamat="$item->alamat"
                                    />


                                    <a href="{{ route('data-master.pelanggan.destroy', $item->id) }}"
                                       data-confirm-delete="true"
                                       class="btn btn-sm btn-danger mx-1 text-light">
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
@endsection
