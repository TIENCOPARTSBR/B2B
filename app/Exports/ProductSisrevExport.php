<?php

namespace App\Exports;

use App\Models\ProductSisrev;
use Maatwebsite\Excel\Concerns\FromCollection;

class ProductSisrevExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return ProductSisrev::all();
    }
}
