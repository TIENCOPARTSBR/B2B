<?php

namespace App\Http\Controllers\Quotation;

use App\Http\Controllers\Controller;
use App\Models\ProductSisrev;
use App\Models\Quotation;
use App\Models\QuotationItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuotationController extends Controller
{
    public function index(Quotation $quotation)
    {
        return view('direct-distributor.quotation.index')
            ->with('quotation', $quotation::paginate(10));
    }
    
    public function create()
    {
        return view('direct-distributor.quotation.create');
    }
    
    public function store(Quotation $quotation, Request $request)
    {
        $create = [
            'direct_distributor_id' => Auth::guard('distributor')->user()->direct_distributor_id,
            'distributor_id' => NULL,
            'urgent' => ($request->urgent == "on")? 1 : 0,
            'name' => $request->name,
            'status' => $request->status,
            'customer_name' => $request->customer_name,
            'requester_quotation' => $request->requester_quotation,
            'quotation_type' => $request->quotation_type,
            'reply_date' => $request->reply_date,
            'general_observation' => $request->general_observation
        ];

        $quotation = $quotation::create($create);

        return to_route('direct.distributor.quotation.item')
            ->with('id', $quotation['id']);
    }

    public function show(Quotation $quotation, Request $request)
    {
        return view('direct-distributor.quotation.show')
            ->with('quotation', $quotation::findOrFail($request['id']));
    }
     
    public function updated(Quotation $quotation, Request $request)
    {
        $request['urgent'] = ($request->urgent == "on")? 1 : 0;

        $quotation::findOrFail($request->id)->update($request->all());

        return to_route('direct.distributor.quotation.item', $request->id);
    }

    public function item(QuotationItem $quotationItem, $id)
    {   
		$quotationItem = $quotationItem::where('quotation_id', $id)->get();
        
        foreach($quotationItem as $key => $quotationItem){
            $productSisrev[$key] = ProductSisrev::where('part_number', $quotationItem['product_sisrev_id'])->get();
        }
        /* 
        return view('direct-distributor.quotation.item')
            ->with('productSisrev', $productSisrev)
            ->with('id', $id); */
        return view('direct-distributor.quotation.item')
            ->with('id', $id);
    }

    public function datatable(Quotation $quotation, $id)
    {   
        // get item quotations
        $quotation_item = $quotation->with('QuotationItem', 'QuotationItem.ProductSisrev')->findOrFail($id);

        // return data
        return datatables()->of($quotation_item['QuotationItem'])->toJson();
    }
}