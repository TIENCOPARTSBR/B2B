<?php

namespace App\Http\Controllers\Quotation;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Quotation;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Facades\Excel;

class ExportForQuotationController implements FromView
{
    public $id;

    public function __construct($id)
    {
        $this->id = $id;
    }

    public function view(): View
    {
        return view('component.quotation.excel-quotation', [
            'quotation' => Quotation::with('QuotationItem', 'QuotationItem.ProductSisrev')->findOrFail($this->id),
        ]);
    }
}
