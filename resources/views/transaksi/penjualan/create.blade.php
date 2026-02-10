@extends('layouts.app')

@section('content_title', 'Transaksi Penjualan')

@section('content')
<div class="d-flex justify-content-start align-items-center mb-3">
    <a href="{{ route('transaksi.penjualan.index') }}" class="btn btn-light btn-sm">
        <i class="fas fa-arrow-left"></i> Kembali
    </a>
</div>

<form action="{{ route('transaksi.penjualan.store') }}" method="POST" id="form-penjualan">
    @csrf

    <div class="row">
        {{-- KIRI: DAFTAR PRODUK --}}
        <div class="col-lg-6 col-md-12 mb-4">
            <div class="card shadow-sm h-100">
                <div class="card-header">
                    <h5 class="mb-0">Daftar Produk</h5>
                </div>
                <div class="card-body p-2">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Produk</th>
                                    <th>Harga</th>
                                    <th width="80">Qty</th>
                                    <th>Subtotal</th>
                                    <th width="60">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="produk-list">
                                <tr>
                                    <td>
                                        <select name="produk_id[]" class="form-control form-control-sm">
                                            <option value="">-- Pilih Produk --</option>
                                            @foreach($produk as $p)
                                                <option value="{{ $p->id }}" data-harga="{{ $p->harga_jual }}">
                                                    {{ $p->nama_produk }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control form-control-sm harga" readonly>
                                    </td>
                                    <td>
                                        <input type="number" name="qty[]" class="form-control form-control-sm qty" value="1" min="1">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control form-control-sm subtotal" readonly>
                                    </td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-sm btn-danger hapus-produk">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    {{-- Tambahkan id="tambahProduk" disini --}}
                    <button type="button" id="tambahProduk" class="btn btn-primary btn-sm mt-2">
                        <i class="fas fa-plus"></i> Tambah Produk
                    </button>
                </div>
            </div>
        </div>

        {{-- KANAN: PEMBAYARAN --}}
        <div class="col-lg-6 col-md-12 mb-4">
            <div class="card shadow-sm h-100">
                <div class="card-header">
                    <h5 class="mb-0">Pembayaran</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">Pelanggan</label>
                        <select name="pelanggan_id" class="form-control select2">
                            <option value="">-- Pilih pelanggan --</option>
                            @foreach($pelanggan as $pl)
                                <option value="{{ $pl->id }}">{{ $pl->nama_pelanggan }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Metode Pembayaran</label>
                        <select name="metode_pembayaran_id" class="form-control" required>
                            @foreach($metode as $m)
                                <option value="{{ $m->id }}">{{ $m->nama_metode }}</option>
                            @endforeach
                        </select>
                    </div>

                    <hr>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Total</label>
                        <input type="text" class="form-control form-control-lg fw-bold text-end" id="total" readonly>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Bayar</label>
                        <input type="number" name="bayar" id="bayar" class="form-control form-control-lg" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Catatan</label>
                        <textarea name="catatan" class="form-control" rows="3"></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">
                        <i class="fas fa-save"></i> Simpan Transaksi
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>

@push('script')
<script>
$(document).ready(function () {

    // INIT SELECT2
    $('.select2').select2({
        theme: 'bootstrap',
        placeholder: '-- Pilih pelanggan --',
        allowClear: true,
        width: '100%'
    });

    // Hitung subtotal
    function hitungBaris(row) {
        const select = row.querySelector('select[name="produk_id[]"]');
        const hargaInput = row.querySelector('.harga');
        const qtyInput = row.querySelector('.qty');
        const subtotalInput = row.querySelector('.subtotal');

        if (!select.value) {
            hargaInput.value = '';
            subtotalInput.value = '';
            hitungTotal();
            return;
        }

        const harga = parseInt(select.options[select.selectedIndex].dataset.harga) || 0;
        const qty = parseInt(qtyInput.value) || 0;

        hargaInput.value = harga;
        subtotalInput.value = harga * qty;

        hitungTotal();
    }

    // Hitung total
    function hitungTotal() {
        let total = 0;
        $('.subtotal').each(function () {
            total += parseInt($(this).val()) || 0;
        });
        $('#total').val(total);
    }

    // CHANGE PRODUK / QTY
    $(document).on('change', 'select[name="produk_id[]"], .qty', function () {
        hitungBaris($(this).closest('tr')[0]);
    });

    // TAMBAH PRODUK
    $('#tambahProduk').click(function () {
        const row = $('#produk-list tr:first').clone();
        row.find('input').val('');
        row.find('.qty').val(1);
        row.find('select').prop('selectedIndex',0);
        $('#produk-list').append(row);
    });

    // HAPUS PRODUK
    $(document).on('click', '.hapus-produk', function () {
        if ($('#produk-list tr').length === 1) {
            alert('Minimal harus ada 1 produk');
            return;
        }
        $(this).closest('tr').remove();
        hitungTotal();
    });

    // VALIDASI BAYAR
    $('#form-penjualan').submit(function (e) {
        const total = parseInt($('#total').val()) || 0;
        const bayar = parseInt($('#bayar').val()) || 0;

        if (bayar < total) {
            e.preventDefault();
            alert('Pembayaran tidak boleh kurang dari total!');
            $('#bayar').focus();
        }
    });

});
</script>
@endpush
@endsection
