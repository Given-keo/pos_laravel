<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PenerimaanBarangController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
})->middleware("guest");

Route::post('/login',[LoginController::class,"handleLogin"])->name("login")->middleware("guest");

Route::middleware("auth")->group(function(){
    Route::get('/dashboard',[DashboardController::class,"index"])->name("dashboard");
    Route::post('/logout',[LoginController::class,"logout"])->name("logout");

    // Pastikan ini ada di dalam group middleware 'auth' jika aplikasi butuh login
    Route::post('/penerimaan-barang/store', [ProductController::class, 'storePenerimaan'])->name('penerimaan.store');

    Route::prefix("get-data")->as("get-data.")->group(function() {
        Route::get("/produk", [ProductController::class, "getData"])->name("produk");
        Route::get("/cek-stok-produk", [ProductController::class, "cekStok"])->name("cek-stok");
    });

    // users.index
    // users.store
    // users.destroy
    Route::prefix("users")->as("users.")->controller(UserController::class)->group(function(){
            Route::get("/","index")->name("index");
            Route::post("/","store")->name("store");
            Route::delete("/{id}/destroy","destroy")->name("destroy");
    });

    // master-data.kategori.index
    // master-data/kategori/index
    Route::prefix("master-data")->as("master-data.")->group(function(){
        Route::prefix("kategori")->as("kategori.")->controller(KategoriController::class)->group(function() {
            Route::get("/","index")->name("index");
            Route::post("/","store")->name("store");
            Route::delete("/{id}/destroy","destroy")->name("destroy");
        });

        Route::prefix("product")->as("product.")->controller(ProductController::class)->group(function() {
            Route::get("/","index")->name("index");
            Route::post("/","store")->name("store");
            Route::delete("/{id}/destroy","destroy")->name("destroy");
        });
    });

    // route penerimaan barang
    Route::prefix("penerimaan_barang")->as("penerimaan_barang.")->controller(PenerimaanBarangController::class)->group(function() {
        Route::get("/","index")->name("index");
    });
});
