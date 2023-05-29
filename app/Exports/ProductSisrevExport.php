<?php

namespace App\Exports;

use App\Models\ProductSisrev;
use Maatwebsite\Excel\Concerns\FromCollection;

class ProductSisrevExport implements FromCollection
{
    public function collection()
    {
        return ProductSisrev::all();
    }
}
