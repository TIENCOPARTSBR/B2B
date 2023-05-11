<?php

namespace App\Imports;

use App\Models\ProductValueDistributor;
use Maatwebsite\Excel\Concerns\ToModel;

class ProductValueDistributorImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return $row;
    }
}
