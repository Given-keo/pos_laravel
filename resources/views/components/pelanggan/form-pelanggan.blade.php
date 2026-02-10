<div>
    <button type="button"
        class="btn {{ $id ? 'btn-warning btn-sm' : 'btn-primary btn-sm' }}"
        data-toggle="modal"
        data-target="#formPelanggan{{ $id ?? '' }}">

        @if($id)
            <i class="fas fa-edit text-light"></i>
        @else
            <i class="fas fa-plus"></i> Tambah Pelanggan
        @endif
    </button>

    <div class="modal fade" id="formPelanggan{{ $id ?? '' }}">
        <div class="modal-dialog">

            <form action="{{ route('data-master.pelanggan.store') }}" method="POST">
                @csrf
                <input type="hidden" name="id" value="{{ $id }}">

                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">
                            {{ $id ? 'Form Edit Pelanggan' : 'Form Tambah Pelanggan' }}
                        </h4>
                        <button type="button" class="close" data-dismiss="modal">
                            <span>&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">

                        {{-- Nama Pelanggan --}}
                        <div class="form-group">
                            <label for="nama_pelanggan">Nama Pelanggan</label>
                            <input type="text"
                                   name="nama_pelanggan"
                                   id="nama_pelanggan"
                                   class="form-control"
                                   value="{{ $namaPelanggan ?? '' }}">
                        </div>

                        {{-- No HP --}}
                        <div class="form-group">
                            <label for="no_hp">No HP</label>
                            <input type="number"
                                   name="no_hp"
                                   id="no_hp"
                                   class="form-control"
                                   value="{{ $noHp ?? '' }}"
                                   placeholder="08xxxxxxxxxx">
                        </div>

                        {{-- Alamat --}}
                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <textarea name="alamat"
                                      id="alamat"
                                      rows="3"
                                      class="form-control">{{ $alamat ?? '' }}</textarea>
                        </div>

                    </div>

                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">
                            Batal
                        </button>
                        <button type="submit" class="btn btn-primary">
                            Simpan
                        </button>
                    </div>
                </div>

            </form>

        </div>
    </div>
</div>
