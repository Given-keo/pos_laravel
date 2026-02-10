<?php

namespace App\View\Components\MetodePembayaran;

use Illuminate\View\Component;

class FormMetodePembayaran extends Component
{
    public $id;
    public $namaMetode;
    public $jenis;
    public $status;

    public function __construct(
        $id = null,
        $namaMetode = null,
        $jenis = null,
        $status = 1
    ) {
        $this->id = $id;
        $this->namaMetode = $namaMetode;
        $this->jenis = $jenis;
        $this->status = $status;
    }

    public function render()
    {
        return view('components.metode-pembayaran.form-metode-pembayaran');
    }
}
