<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Psy\CodeCleaner\FunctionReturnInWriteContextPass;
use RealRashid\SweetAlert\Facades\Alert;


class LoginController extends Controller
{
    public Function index()
    {
        return view("auth.login");
    }

    public function handleLogin(Request $request)
    {
        $credentials = $request->validate([
            "email" => "required|email",
            "password" => "required",
        ], [
            "email.required" => "Email harus terisi",
            "email.email" => "Email tidak valid",
            "password.required" => "Password harus terisi",
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            Alert::success(
                'Login Berhasil',
                'Selamat datang, ' . Auth::user()->name
            );

            return redirect()->intended('/dashboard');
        }

        Alert::error(
            'Login Gagal',
            'Email atau password tidak sesuai dengan data kami'
        );

        return back()->onlyInput('email');
    }


    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect("/");
    }
}
