<div>
    <button type="button"
        class="btn {{ $id ? 'btn-warning btn-sm' : 'btn-primary btn-sm' }}"
        data-toggle="modal"
        data-target="#formMetodePembayaran{{ $id ?? '' }}">

        @if($id)
            <i class="fas fa-edit text-light"></i>
        @else
            <i class="fas fa-plus"></i> Metode Pembayaran
        @endif
    </button>

    <div class="modal fade" id="formMetodePembayaran{{ $id ?? '' }}">
        <div class="modal-dialog">
            <form action="{{ route('data-master.metode-pembayaran.store') }}" method="POST">
                @csrf

                <input type="hidden" name="id" value="{{ $id }}">

                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">
                            {{ $id ? 'Form Edit Metode Pembayaran' : 'Form Tambah Metode Pembayaran' }}
                        </h4>
                        <button type="button" class="close" data-dismiss="modal">
                            <span>&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">

                        {{-- Nama Metode --}}
                        <div class="form-group my-1">
                            <label>Nama Metode</label>
                            <input type="text"
                                name="nama_metode"
                                class="form-control"
                                value="{{ old('nama_metode', $namaMetode) }}"
                                required>
                        </div>

                        {{-- Jenis --}}
                        <div class="form-group my-1">
                            <label>Jenis Pembayaran</label>
                            <select name="jenis" class="form-control" required>
                                <option value="">-- Pilih Jenis --</option>
                                <option value="tunai" {{ ($id && $jenis == 'tunai') ? 'selected' : '' }}>
                                    Tunai
                                </option>
                                <option value="non_tunai" {{ ($id && $jenis == 'non_tunai') ? 'selected' : '' }}>
                                    Non Tunai
                                </option>
                            </select>
                        </div>

                        {{-- Status Menggunakan Custom Switch --}}
                        <div class="form-group mt-3 mb-1">
                            {{-- Label Utama --}}
                            <label class="d-block mb-1">Status Metode Pembayaran</label>
                            
                            <div class="custom-control custom-switch">
                                {{-- Hidden input ini berfungsi agar jika switch tidak dicentang, 
                                    server tetap menerima nilai '0' (karena checkbox yang tidak dicentang tidak terkirim di request) --}}
                                <input type="hidden" name="status" value="0">
                                
                                <input type="checkbox" 
                                    class="custom-control-input" 
                                    id="status_{{ $id ?? 'new' }}" 
                                    name="status" 
                                    value="1"
                                    {{ old("status", $status) ? "checked" : "" }}>
                                
                                <label class="custom-control-label font-weight-bold" for="status_{{ $id ?? 'new' }}">
                                    Metode Aktif
                                </label>
                            </div>
                            
                            <small class="text-muted mt-1 d-block">
                                <i class="fas fa-info-circle mr-1"></i>
                                Jika aktif, metode ini akan muncul sebagai opsi pembayaran di kasir.
                            </small>
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
