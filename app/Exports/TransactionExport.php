<?php

namespace App\Exports;

use App\Models\Htrans;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithTitle;

class TransactionExport implements FromView, WithTitle, ShouldAutoSize
{
    public function title(): string{
        return 'Semua Transaksi';
    }

    public function view(): View
    {
        // $listBuku = Htrans::where('pengguna_id',$this->user->pengguna_id)->get();
        $list = Htrans::get();
        return view('master.Reports.excel',compact('list'));
    }
}
