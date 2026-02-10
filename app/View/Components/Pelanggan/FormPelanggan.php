<?php

namespace App\View\Components\Pelanggan;

use Illuminate\View\Component;

class FormPelanggan extends Component
{
    public $id;
    public $namaPelanggan;
    public $noHp;
    public $alamat;

    public function __construct(
        $id = null,
        $namaPelanggan = null,
        $noHp = null,
        $alamat = null
    ) {
        $this->id = $id;
        $this->namaPelanggan = $namaPelanggan;
        $this->noHp = $noHp;
        $this->alamat = $alamat;
    }

    public function render()
    {
        return view('components.pelanggan.form-pelanggan');
    }
}
