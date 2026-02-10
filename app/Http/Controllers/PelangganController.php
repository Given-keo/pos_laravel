<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    public function index()
    {
        $pelanggan = Pelanggan::all();
        confirmDelete("Hapus Data", "Apakah anda yakin ingin menghapus data ini?");
        return view('pelanggan.index', compact('pelanggan'));
    }

    public function store(Request $request)
    {
        $id = $request->id;

        $request->validate([
            'nama_pelanggan' => 'required|max:100',
            'no_hp' => 'nullable|max:20',
            'alamat' => 'nullable|max:255',
        ], [
            'nama_pelanggan.required' => 'Nama pelanggan wajib diisi',
            'nama_pelanggan.max' => 'Nama pelanggan maksimal 100 karakter',
            'no_hp.max' => 'No HP maksimal 20 karakter',
            'alamat.max' => 'Alamat maksimal 255 karakter',
        ]);

        Pelanggan::updateOrCreate(
            ['id' => $id],
            [
                'nama_pelanggan' => $request->nama_pelanggan,
                'no_hp' => $request->no_hp,
                'alamat' => $request->alamat,
            ]
        );

        toast()->success('Data pelanggan berhasil disimpan');
        return redirect()->route('data-master.pelanggan.index');
    }

    public function destroy(string $id)
    {
        $pelanggan = Pelanggan::findOrFail($id);
        $pelanggan->delete();

        toast()->success('Data pelanggan berhasil dihapus');
        return redirect()->route('data-master.pelanggan.index');
    }
}
