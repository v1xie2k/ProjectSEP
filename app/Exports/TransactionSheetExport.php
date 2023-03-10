<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class TransactionSheetExport implements WithMultipleSheets
{
    public function sheets(): array
    {
        $sheets = [];

        $sheets[]= new TransactionExport();


        return $sheets;
    }
}
