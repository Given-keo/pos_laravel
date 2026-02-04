<div>
    <button type="button" class="btn {{ $id ? 'btn-warning btn-sm' : 'btn-primary btn-sm' }}" data-toggle="modal" data-target="#formUsers{{ $id ?? '' }}">
        @if($id)
            <i class="fas fa-edit text-light"></i>
        @else
            <i class="fas fa-plus"></i> Tambah Users
        @endif
    </button>

    <div class="modal fade" id="formUsers{{ $id ?? '' }}">
        <div class="modal-dialog">
            <form action="{{ route('users.store') }}" method="POST">
                @csrf
                <input type="hidden" name="id" value="{{ $id }}">
                
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">{{ $id ? 'Form Edit Users' : 'Form Tambah Users' }}</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    
                    <div class="modal-body">
                        <div class="form-group my-1">
                            <label for="name">Name</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ $id ? $name : old("name") }}">
                        </div>
                        <div class="form-group my-1">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" class="form-control" value="{{ $id ? $email : old("email") }}">
                        </div>
                        <div class="form-group my-1">
                            <label for="password">Password</label>
                            <input type="password" name="password" id="password" class="form-control" value="{{ $id ? $password : old("password") }}">
                        </div>
                    </div>
                    
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div> 
                </form> 
            </div>
        </div>
    </div>