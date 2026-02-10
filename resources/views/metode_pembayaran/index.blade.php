@extends("layouts.app")

@section("content_title","Data Metode Pembayaran")

@section("content")
<div class="card">
    <div class="card-header">
        <h4 class="card-title">Data Metode Pembayaran</h4>

        <div class="d-flex justify-content-end mb-2">
            <x-metode-pembayaran.form-metode-pembayaran/>
        </div>
    </div>

    <div class="card-body">
        <x-alert :error="$errors->any()"/>

        <div class="table-responsive">
            <table class="table table-sm" id="example1">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Metode</th>
                        <th>Jenis</th>
                        <th>Status</th>
                        <th>Opsi</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($metode as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $item->nama_metode }}</td>

                            <td>
                                @if($item->jenis === 'tunai')
                                    <span class="badge bg-primary">Tunai</span>
                                @else
                                    <span class="badge bg-info">Non Tunai</span>
                                @endif
                            </td>

                            <td>
                                @if($item->status)
                                    <span class="badge bg-success">Aktif</span>
                                @else
                                    <span class="badge bg-danger">Nonaktif</span>
                                @endif
                            </td>

                            <td>
                                <div class="d-flex align-items-center">
                                    <x-metode-pembayaran.form-metode-pembayaran
                                        :id="$item->id"
                                        :nama-metode="$item->nama_metode"
                                        :jenis="$item->jenis"
                                        :status="$item->status"
                                    />
                                    <a href="{{ route('data-master.metode-pembayaran.destroy', $item->id) }}"
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
