<?php

namespace App\View\Components\Admin;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Aside extends Component
{
    public $routes;

    public function __construct()
    {
        $this->routes = [
            [
                "label" => "Dashboard",
                "icon" => "fas fa-laptop",
                "route_name" => "dashboard",
                "route_active" => "dashboard",
                "is_dropdown" => false
            ],

            [
                "label" => "Users",
                "icon" => "fas fa-user-shield",
                "route_name" => "users.index",
                "route_active" => "users.*",
                "is_dropdown" => false
            ],

            [
                "label" => "Data Master",
                "icon" => "fas fa-database",
                "route_active" => "data-master.*",
                "is_dropdown" => true,
                "dropdown" => [
                    [
                        "label" => "Kategori",
                        "route_active" => "data-master.kategori.*",
                        "route_name" => "data-master.kategori.index",
                    ],
                    [
                        "label" => "Produk",
                        "route_active" => "data-master.product.*",
                        "route_name" => "data-master.product.index",
                    ],
                    [
                        "label" => "Pelanggan",
                        "route_active" => "data-master.pelanggan.*",
                        "route_name" => "data-master.pelanggan.index",
                    ],
                    [
                        "label" => "Metode Pembayaran",
                        "route_active" => "data-master.metode-pembayaran.*",
                        "route_name" => "data-master.metode-pembayaran.index",
                    ],
                ]
            ],

            [
                "label" => "Transaksi",
                "icon" => "fas fa-cash-register",
                "route_active" => "transaksi.*",
                "is_dropdown" => true,
                "dropdown" => [
                    [
                        "label" => "Penjualan",
                        "route_active" => "transaksi.penjualan.*",
                        "route_name" => "transaksi.penjualan.index",
                    ],
                ]
            ],

            [
                "label" => "Laporan",
                "icon" => "fas fa-chart-line",
                "route_active" => "laporan.*",
                "is_dropdown" => true,
                "dropdown" => [
                    [
                        "label" => "Laporan Penjualan",
                        "route_active" => "laporan.penjualan.*",
                        "route_name" => "laporan.penjualan.index",
                    ],
                    [
                        "label" => "Laporan Terlaris",
                        "route_active" => "laporan.produk-terlaris.*",
                        "route_name" => "laporan.produk-terlaris.index",
                    ],
                    [
                        "label" => "Stok Produk",
                        "route_active" => "laporan.stok.*",
                        "route_name" => "laporan.stok.index",
                    ],
                ]
            ],
        ];
    }

    public function render(): View|Closure|string
    {
        return view('components.admin.aside');
    }
}
