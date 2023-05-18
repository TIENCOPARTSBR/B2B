<?php

namespace App\Http\Controllers\Quotation;

use App\Http\Controllers\Controller;
use App\Http\Helper;
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

        return view('direct-distributor.quotation.item')
            ->with('id', $id);
    }

    public function get_product(Request $request, $id)
    {
        
    }

    public function datatable(Quotation $quotation, $id)
    {   
        // get item quotations
        $quotation_item = $quotation->with('QuotationItem', 'QuotationItem.ProductSisrev', 'QuotationItem.ProductSisrev.product_photo')->findOrFail($id);

        $product = [];

        foreach($quotation_item['QuotationItem'] as $key => $item)
        {
            $country = strtoupper(trim($item['country']));
            
            if (!empty($item['ProductSisrev'][0])){
                if (str_contains($country, 'EUA'))
                {
                    $custo_liquido_name = 'custo_liquido_eua';
                    $saldo = 'saldo_br';
                    $local = 'local_fornecimento_eua';
                    $lead_time = 'lead_time_eua';
                }

                if (str_contains($country, 'BR'))
                {
                    $custo_liquido_name = 'custo_liquido_br';
                    $saldo = 'saldo_br';
                    $local = 'local_fornecimento_br';
                    $lead_time = 'lead_time_br';
                }
                
                // custo liquido
                if (!empty($custo_liquido_name))
                {
                    $option_general_value = Helper::getDirectDistributorLogged()->option_general_value;
                    $general_value = Helper::getDirectDistributorLogged()->general_value;
                    $custo_liquido_original = $item['ProductSisrev'][0][$custo_liquido_name];

                    if($option_general_value === 'PERCENTAGE')
                        $custo_liquido = $custo_liquido_original + ( $custo_liquido_original / 100 * $general_value) ;

                    if($option_general_value === 'UNIT_PRICE')
                        $custo_liquido = ( $custo_liquido_original + $general_value );

                    $total = ($custo_liquido * $item['quantity']);
                }

                $product[$key]['country']         = $custo_liquido_original;
                $product[$key]['part_number']         = $item['ProductSisrev'][0]['part_number'];
                $product[$key]['description']         = $item['ProductSisrev'][0]['descricao_br'];
                $product[$key]['custo_liquido_original']       = (!empty($custo_liquido_original)) ? '$ '.number_format((float) $custo_liquido_original, 2, '.', ',') : '';
                $product[$key]['custo_liquido']       = (!empty($custo_liquido)) ? '$ '.number_format((float) $custo_liquido, 2, '.', ',') : '';
                $product[$key]['quantity']            = $item['quantity'];
                $product[$key]['total']               = (!empty($total)) ? '$ '.number_format((float) $total, 2, '.', ',') : '-----';
                $product[$key]['weight']              = (!empty($item['ProductSisrev'][0]['peso'])) ? $item['ProductSisrev'][0]['peso'] : '-----';
                $product[$key]['ncm']                 = (!empty($item['ProductSisrev'][0]['ncm'])) ? $item['ProductSisrev'][0]['ncm'] : '-----';
                $product[$key]['hscode']              = (!empty($item['ProductSisrev'][0]['hscode'])) ? $item['ProductSisrev'][0]['hscode'] : '-----';
                $product[$key]['local_fornecimento']  = (!empty($item['ProductSisrev'][0]['local_fornecimento'])) ? $item['ProductSisrev'][0][$local] : '-----';
                $product[$key]['saldo']              = (!empty($item['ProductSisrev'][0]['saldo'])) ? $item['ProductSisrev'][0][$saldo] : '-----';
                $product[$key]['lead_time']              = (!empty($item['ProductSisrev'][0]['lead_time'])) ? $item['ProductSisrev'][0][$lead_time] : '-----';
                $product[$key]['photo']              = (!empty($item['ProductSisrev'][0]['product_photo'][0]['filename'] )) ? '/storage/images/'.$item['ProductSisrev'][0]['product_photo'][0]['filename'] : 'https://b2b.encoparts.com/app-assets/images/logo/encoparts_c.png';
            }  
            else{
                $product[$key]['part_number']         = $item['product_sisrev_id'];
                $product[$key]['description']         = '-----';
                $product[$key]['custo_liquido_original']       = '-----';
                $product[$key]['custo_liquido']       = '-----';
                $product[$key]['quantity']            = '-----';
                $product[$key]['total']               = '-----';
                $product[$key]['weight']              = '-----';
                $product[$key]['ncm']                 = '-----';
                $product[$key]['hscode']              = '-----';
                $product[$key]['status_color']        = '-----';
                $product[$key]['local_fornecimento']  = '-----';
                $product[$key]['saldo']               = '-----';
                $product[$key]['lead_time']           = '-----';
                $product[$key]['photo']               = 'https://b2b.encoparts.com/app-assets/images/logo/encoparts_c.png';
            } 
        } 

        // return data
        return datatables()->of($product)->toJson();
    }
}