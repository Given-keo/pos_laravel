<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Kategori; 
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {

        $products = Product::all();
        $kategori = Kategori::all();

        confirmDelete("Hapus Data", "Apakah anda yakin ingin menghapus produk ini?");

        return view("product.index", compact("products", "kategori"));
    }

    public function store(Request $request)
    {
        $id = $request->id;
        
        $request->validate([
            "nama_product"      => "required|unique:products,nama_produk," . $id,
            "harga_jual"        => "required|numeric|min:0",
            "harga_beli_pokok"  => "required|numeric|min:0",
            "kategori_id"       => "required|exists:kategoris,id", 
            "stok"              => "required|numeric|min:0",
            "stok_minimal"      => "required|numeric|min:0",
            "is_active"         => "nullable", 
        ], 
        [
            "nama_product.required"     => "Nama produk harus diisi",
            "nama_product.unique"       => "Nama produk sudah terdaftar, gunakan nama lain",
            "harga_jual.required"       => "Harga jual harus diisi",
            "harga_jual.numeric"        => "Harga jual harus berupa angka",
            "harga_jual.min"            => "Harga jual tidak boleh kurang dari 0",
            "harga_beli_pokok.required" => "Harga beli pokok harus diisi",
            "harga_beli_pokok.numeric"  => "Harga beli pokok harus berupa angka",
            "harga_beli_pokok.min"      => "Harga beli pokok tidak boleh kurang dari 0",
            "kategori_id.required"      => "Silakan pilih kategori produk",
            "kategori_id.exists"        => "Kategori yang dipilih tidak valid",
            "stok.required"             => "Stok awal harus diisi (isi 0 jika kosong)",
            "stok.numeric"              => "Stok harus berupa angka",
            "stok.min"                  => "Stok tidak boleh minus",
            "stok_minimal.required"     => "Stok minimal harus diisi",
            "stok_minimal.numeric"      => "Stok minimal harus berupa angka",
            "stok_minimal.min"          => "Stok minimal tidak boleh minus",
        ]);

        $dataToSave = [
            "nama_produk"       => $request->nama_product, 
            "slug"              => Str::slug($request->nama_product),
            "kategori_id"       => $request->kategori_id,
            "harga_jual"        => $request->harga_jual,
            "harga_beli_pokok"  => $request->harga_beli_pokok,
            "stok"              => $request->stok,
            "stok_minimal"      => $request->stok_minimal,
            
            "is_active"         => $request->has('is_active') ? 1 : 0,
        ];

        if (!$id) {

            $dataToSave['sku'] = 'PRD-' . strtoupper(Str::random(6));
        }

        Product::updateOrCreate(
            ["id" => $id], 
            $dataToSave    
        );

        toast()->success("Data produk berhasil disimpan");
        return redirect()->route("master-data.product.index");
    }

    public function destroy(String $id)
    {
        $product = Product::findOrFail($id);
        
        $product->delete();
        
        toast()->success("Data produk berhasil dihapus");
        return redirect()->route("master-data.product.index");
    }
}