@extends("layouts.app")
@section("content_title","Data Admin")
@section("content")
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Data Users</h4>
            <div class="d-flex justify-content-end mb-2">
                <x-users.form-users/>
            </div>
        </div>
        <div class="card-body">
            <x-alert :error="$errors->any()"/>
            <div class="table-responsive">
                <table class="table table-sm" id="example1">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $index => $user)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->name }}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <x-users.form-users :id="$user->id"/>
                                        <a href="{{ route("users.destroy", $user->id) }}" data-confirm-delete="true" class="text-light btn btn-sm btn-danger mx-1">
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