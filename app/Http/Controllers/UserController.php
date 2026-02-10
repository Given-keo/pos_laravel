<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        confirmDelete("Hapus user","Apakah anda yakin menghapus user ini ? ");
        return view("users.index",compact("users"));
    }

    public function store(Request $request)
    {
        $id = $request->id;
        $request->validate([
            "name" => "required",
            "email" => "required|max:100|min:5|email",
            "password" => "required|max:8|min:8",
        ],
        [
            "name.required" => "Nama harus diisi",
            "email.email" => "Email tidak valid",
            "email.required" => "Email harus diisi",
            "password.required" => "Password harus diisi",
            "password.min" => "Password minimal 8 karakter",
        ]);

        User::updateOrCreate(
            ["id" => $id],
            [
                "name" => $request->name,
                "email" => $request->email,
                "password" => Hash::make($request->password),
            ]
        );

        toast()->success("Data berhasil disimpan");
        return redirect()->route("users.index");
    }

    public function destroy(String $id)
    {
        $kategori = User::findOrFail($id);
        $kategori->delete();
        toast()->success("Data berhasil dihapus");
        return redirect()->route("users.index");
    }
}