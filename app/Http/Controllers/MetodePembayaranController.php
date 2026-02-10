<?php

namespace App\Http\Controllers;

use App\Models\Metode_pembayaran;
use Illuminate\Http\Request;

class MetodePembayaranController extends Controller
{
    public function index()
    {
        $metode = Metode_pembayaran::all();
        confirmDelete(
            'Hapus Data',
            'Apakah anda yakin ingin menghapus metode pembayaran ini?'
        );

        return view('metode_pembayaran.index', compact('metode'));
    }

    public function store(Request $request)
    {
        $id = $request->id;

        $request->validate([
            'nama_metode' => 'required|unique:metode_pembayarans,nama_metode,' . $id,
            'jenis'       => 'required|in:tunai,non_tunai',
            'status'      => 'required|boolean',
        ], [
            'nama_metode.required' => 'Nama metode pembayaran harus diisi',
            'nama_metode.unique'   => 'Nama metode pembayaran sudah terdaftar',
            'jenis.required'       => 'Jenis pembayaran harus dipilih',
            'jenis.in'             => 'Jenis pembayaran tidak valid',
            'status.required'      => 'Status harus dipilih',
        ]);

        Metode_pembayaran::updateOrCreate(
            ['id' => $id],
            [
                'nama_metode' => $request->nama_metode,
                'jenis'       => $request->jenis,
                'status'      => $request->status,
            ]
        );

        toast()->success('Data berhasil disimpan');
        return redirect()->route('data-master.metode-pembayaran.index');
    }

    public function destroy(string $id)
    {
        Metode_pembayaran::findOrFail($id)->delete();

        toast()->success('Data berhasil dihapus');
        return redirect()->route('data-master.metode-pembayaran.index');
    }
}
