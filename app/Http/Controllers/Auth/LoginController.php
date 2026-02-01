<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Psy\CodeCleaner\FunctionReturnInWriteContextPass;

class LoginController extends Controller
{
    public Function index()
    {
        return view("auth.login");
    }

    public Function handleLogin(Request $request)
    {
        $credentials = $request->validate([
            "email" => "required|email",
            "password" => "required",
        ], [
            "email.required" => "Email harus terisi",
            "email.email" => "Email tidak valid",
            "password.required" => "Password harus terisi",
        ]);

        if(Auth::attempt($credentials)) {
            $request->session()->regenerate(); 
            return redirect()->intended("/dashboard"); 
        }

        return back()->withErrors([
            "Email" => "Kredential yang anda massukkan tidak sesuai dengan data kami"
        ])->onlyInput("email");
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect("/");
    }
}
