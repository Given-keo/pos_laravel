<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LaporanPenjualanController;
use App\Http\Controllers\LaporanProdukController;
use App\Http\Controllers\MetodePembayaranController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\PreOrderController;
// use App\Http\Controllers\PenerimaanBarangController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
// use App\Models\Metode_pembayaran;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
})->middleware("guest");

Route::post('/login',[LoginController::class,"handleLogin"])->name("login")->middleware("guest");

Route::middleware("auth")->group(function(){
    Route::get('/dashboard',[DashboardController::class,"index"])->name("dashboard");
    Route::post('/logout',[LoginController::class,"logout"])->name("logout");

    // users.index
    // users.store
    // users.destroy
    Route::prefix("users")->as("users.")->controller(UserController::class)->group(function(){
            Route::get("/","index")->name("index");
            Route::post("/","store")->name("store");
            Route::delete("/{id}/destroy","destroy")->name("destroy");
    });

    // data-master.kategori.index
    // data-master/kategori/index
    Route::prefix("data-master")->as("data-master.")->group(function(){
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

        Route::prefix("metode-pembayaran")->as("metode-pembayaran.")->controller(MetodePembayaranController::class)->group(function() {
                Route::get("/","index")->name("index");
                Route::post("/","store")->name("store");
                Route::delete("/{id}/destroy","destroy")->name("destroy");
        });

        Route::prefix("pelanggan")->as("pelanggan.")->controller(PelangganController::class)->group(function() {
                Route::get("/","index")->name("index");
                Route::post("/","store")->name("store");
                Route::delete("/{id}/destroy","destroy")->name("destroy");
        });
    });

    // transaksi
    Route::prefix('transaksi/penjualan')->name('transaksi.penjualan.')->group(function () {
        Route::get('/', [PenjualanController::class, 'index'])->name('index');
        Route::get('/create', [PenjualanController::class, 'create'])->name('create');
        Route::post('/', [PenjualanController::class, 'store'])->name('store');
        Route::get('/{id}', [PenjualanController::class, 'show'])->name('show'); 
    }); 

    // laporan
    Route::prefix('laporan')->name('laporan.')->group(function () {
        
        Route::prefix('penjualan')->as('penjualan.')
            ->controller(LaporanPenjualanController::class)->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/print', 'print')->name('print');
        });

        Route::prefix('produk-terlaris')->as('produk-terlaris.')
            ->controller(LaporanProdukController::class)->group(function () {
                Route::get('/', 'terlaris')->name('index');
        });

        Route::prefix('stok')->as('stok.')
            ->controller(LaporanProdukController::class)->group(function () {
                Route::get('/', 'stok')->name('index');
        });
        
    });

});
