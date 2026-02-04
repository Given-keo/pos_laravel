<div>
    <button type="button" class="btn {{ $id ? 'btn-warning btn-sm' : 'btn-primary btn-sm' }}" data-toggle="modal" data-target="#formProduct{{ $id ?? '' }}">
        @if($id)
            <i class="fas fa-edit text-light"></i>
        @else
            <i class="fas fa-plus"></i> Tambah Produk
        @endif
    </button>

    <div class="modal fade" id="formProduct{{ $id ?? '' }}">
        <div class="modal-dialog">
            
            <form action="{{ route('master-data.product.store') }}" method="POST">
                @csrf
                <input type="hidden" name="id" value="{{ $id }}">
                
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">{{ $id ? 'Form Edit Produk' : 'Form Tambah Produk' }}</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    
                    <div class="modal-body">
                        <div class="form-group my-1">
                            <label for="nama_product">Nama Produk</label>
                            <input type="text" name="nama_product" id="nama_product" class="form-control" value="{{ $id ? $nama_product : old("nama_product") }}">
                        </div>

                        <div class="form-group my-1">
                            <label for="kategori_product">Kategori Produk</label>
                            <select name="kategori_id" id="kategori_product" class="form-control">
                                <option value="">Pilih kategori</option>
                                @foreach ($kategori as $item)
                                    <option value="{{ $item->id }}" {{ $kategori_id || old('kategori_id') == $item->id ? 'selected' : '' }}>
                                        {{ $item->nama_kategori }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group my-1">
                            <label for="harga_jual">Harga Jual</label>
                            <input type="number" name="harga_jual" id="harga_jual" class="form-control" value="{{ $id ? $harga_jual : old("harga_jual") }}">
                        </div>

                        <div class="form-group my-1">
                            <label for="harga_beli_pokok">Harga Beli Pokok</label>
                            <input type="number" name="harga_beli_pokok" id="harga_beli_pokok" class="form-control" value="{{ $id ? $harga_beli_pokok : old("harga_beli_pokok") }}">
                        </div>
                        
                        <div class="form-group my-1">
                            <label for="stok">Stok Persedian</label>
                            <input type="number" name="stok" id="stok" class="form-control" value="{{ $id ? $stok : old("stok") }}">
                        </div>

                        <div class="form-group my-1">
                            <label for="stok_minimal">Stok Minimal</label>
                            <input type="number" name="stok_minimal" id="stok_minimal" class="form-control" value="{{ $id ? $stok_minimal : old("stok_minimal") }}">
                        </div>

                        <div class="form-group my-2">
                            {{-- Label Utama --}}
                            <label class="d-block mb-1">Status Produk</label>
                            
                            <div class="custom-control custom-switch">
                                <input type="checkbox" 
                                    class="custom-control-input" 
                                    id="is_active_{{ $id ?? 'new' }}" 
                                    name="is_active" 
                                    value="1"
                                    {{ old("is_active", $id ? $is_active : true) ? "checked" : "" }}>
                                
                                <label class="custom-control-label font-weight-bold" for="is_active_{{ $id ?? 'new' }}">
                                    Produk Aktif
                                </label>
                            </div>
                            
                            <small class="text-muted mt-1 d-block">
                                <i class="fas fa-info-circle mr-1"></i>
                                Jika aktif, produk akan muncul di halaman POS.
                            </small>
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