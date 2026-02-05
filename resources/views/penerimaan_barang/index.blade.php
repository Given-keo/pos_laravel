@extends("layouts.app")

@section("content_title", "Penerimaan Barang")

@section("content")
<div class="container-fluid">
    <div class="card shadow-sm">
        <div class="card-header">
            <h4 class="card-title mb-0">Form Penerimaan Barang</h4>
        </div>
        <div class="card-body">
            <div class="row align-items-end">
                <div class="col-md-5 mb-3">
                    <label for="select2" class="form-label font-weight-bold">Cari Produk</label>
                    <select name="select2" id="select2" class="form-control" style="width: 100%;">
                    </select>
                </div>

                <div class="col-md-2 mb-3">
                    <label for="current_stok" class="form-label">Stok</label>
                    <input type="text" id="current_stok" class="form-control bg-light" readonly placeholder="0">
                </div>

                <div class="col-md-3 mb-3">
                    <label for="qty" class="form-label font-weight-bold">Qty Masuk</label>
                    <div class="input-group">
                        <input type="number" name="qty" id="qty" class="form-control" placeholder="0" min="1">
                        <div class="input-group-append">
                            <span class="input-group-text">Pcs</span>
                        </div>
                    </div>
                </div>

                <div class="col-md-2 mb-3">
                    <button class="btn btn-dark" id="btn-tambah">
                        Tambahkan
                    </button>
                </div>
            </div>
            
            <hr>

        </div>
    </div>

    
    <div class="card shadow-sm">
        <div class="card-body">

            <div class="">
                <h5>Daftar Barang Masuk</h5>
                <div class="table-responsive" id="">
                    <table class="table table-hover" id="example1">
                        <thead class="">
                            <tr>
                                <th>No</th>
                                <th>Nama Produk</th>
                                <th>Stok Awal</th>
                                <th>Qty Masuk</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="tabel-keranjang">
                            <tr>
                                <td colspan="5" class="text-center text-muted">Belum ada barang yang ditambahkan</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                
                <div class="text-right mt-3">
                    <button class="btn btn-md btn-dark" id="btn-simpan">
                        Simpan
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push("script")
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        var selectedProduk = {}; 
        var keranjang = [];      

        $(document).ready(function () {

            $.ajaxSetup({
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
            });

            $('#select2').select2({
                theme: "bootstrap",
                placeholder: "Ketik nama produk...",
                allowClear: true,
                minimumInputLength: 1, 
                ajax: {
                    url: "{{ route('get-data.produk') }}", 
                    dataType: "json",
                    delay: 250,
                    data: function (params) { return { search: params.term }; },
                    processResults: function (data) {
                        if (typeof selectedProduk !== 'undefined') {
                            data.forEach(item => { selectedProduk[item.id] = item; });
                        }
                        return {
                            results: data.map((item) => { 
                                return { id: item.id, text: item.nama_produk }
                            })
                        };
                    },
                    cache: true
                } 
            });


            $('#select2').on("select2:select", function(e) {
                let id = $(this).val();
                $('#current_stok').val("Loading...");

                $.ajax({
                    type: "GET",
                    url: "{{ route('get-data.cek-stok') }}",
                    data: { id: id },
                    success: function(response) {
                        $('#current_stok').val(response); 
                        $('#qty').focus(); 
                    },
                    error: function() { $('#current_stok').val(0); }
                });
            });

            $('#btn-tambah').on('click', function() {
                let produkId = $('#select2').val();
                let qty = parseInt($('#qty').val());
                let stokAwal = $('#current_stok').val();

                if (!produkId) {
                    Swal.fire("Gagal", "Silakan pilih produk terlebih dahulu!", "warning");
                    return;
                }
                if (!qty || qty <= 0) {
                    Swal.fire("Gagal", "Jumlah (Qty) harus lebih dari 0!", "warning");
                    return;
                }

                let existingItem = keranjang.find(item => item.produk_id == produkId);
                if (existingItem) {
                    Swal.fire("Info", "Produk ini sudah ada di daftar, hapus dulu jika ingin ubah.", "info");
                    return;
                }

                let namaProduk = selectedProduk[produkId] ? selectedProduk[produkId].nama_produk : $('#select2 option:selected').text();

                keranjang.push({
                    produk_id: produkId,
                    nama_produk: namaProduk,
                    stok_awal: stokAwal,
                    qty: qty
                });

                renderTable(); 
                resetForm();   
            });

            $('#btn-simpan').on('click', function() {
                if (keranjang.length === 0) {
                    Swal.fire("Gagal", "Daftar barang masih kosong!", "warning");
                    return;
                }

                Swal.fire({
                    title: 'Konfirmasi',
                    text: "Apakah Anda yakin ingin memproses penerimaan barang ini?",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, Simpan!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Loading state
                        let btn = $(this);
                        btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Menyimpan...');

                        $.ajax({
                            url: "{{ route('penerimaan.store') }}",
                            type: "POST",
                            data: { items: keranjang },
                            success: function(response) {
                                Swal.fire("Berhasil!", "Stok telah ditambahkan.", "success")
                                .then(() => {
                                    window.location.reload(); 
                                });
                            },
                            error: function(xhr) {
                                btn.prop('disabled', false).html('<i class="fas fa-save"></i> Proses Simpan');
                                console.log(xhr.responseText);
                                Swal.fire("Error!", "Terjadi kesalahan sistem!", "error");
                            }
                        });
                    }
                });
            });
        });

        function renderTable() {
            let html = '';
            if (keranjang.length === 0) {
                html = '<tr><td colspan="5" class="text-center text-muted">Belum ada barang yang ditambahkan</td></tr>';
            } else {
                keranjang.forEach((item, index) => {
                    html += `
                        <tr>
                            <td>${index + 1}</td>
                            <td>${item.nama_produk}</td>
                            <td>${item.stok_awal}</td>
                            <td>${item.qty}</td>
                            <td>
                                <button class="btn btn-sm btn-danger" onclick="hapusItem(${index})">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    `;
                });
            }
            $('#tabel-keranjang').html(html);
        }

        function hapusItem(index) {
            keranjang.splice(index, 1);
            renderTable();
        }

        function resetForm() {
            $('#select2').val(null).trigger('change');
            $('#current_stok').val('');
            $('#qty').val('');
            $('#select2').select2('open'); 
        }
    </script>
@endpush