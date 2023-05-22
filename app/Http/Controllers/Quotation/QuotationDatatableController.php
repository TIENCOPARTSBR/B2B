<?php

namespace App\Http\Controllers\Quotation;

use App\Http\Helper;
use App\Models\ProductValue;
use App\Models\Quotation;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class QuotationDatatableController extends Controller
{
    public function datatable(Quotation $quotation, $id)
    {   
        // Todos os items da cotação
        $quotation = $quotation->with('QuotationItem', 'QuotationItem.ProductSisrev', 'QuotationItem.ProductSisrev.product_photo')->findOrFail($id);

        // Array de produtos
        $product = [];

        // Loop dos produtos
        foreach($quotation['QuotationItem'] as $key => $item)
        {
            if ($item['ProductSisrev'][0])
            {
                // Eua
                if (str_contains(strtoupper(trim($item['country'])), 'USA'))
                {
                    $custo_liquido_name = 'custo_liquido_eua';
                    $saldo = 'saldo_eua';
                    $local = 'local_fornecimento_usa';
                    $lead_time = 'lead_time_eua';
                }

                // Brasil
                if (str_contains(strtoupper(trim($item['country'])), 'BR'))
                {
                    $custo_liquido_name = 'custo_liquido_br';
                    $saldo = 'saldo_br';
                    $local = 'local_fornecimento_br';
                    $lead_time = 'lead_time_br';
                }
                
                // Custo liquido
                if (!empty($custo_liquido_name))
                {
                    // Valor extra do distribuidor direto.
                    $option_general_value = Helper::getDirectDistributorLogged()->option_general_value;
                    $general_value = Helper::getDirectDistributorLogged()->general_value;
                    // Custo original
                    $custo_liquido_original = $item['ProductSisrev'][0][$custo_liquido_name];

                    // consultar preço adicional
                    $product_value = ProductValue
                        ::where('part_number', $item['ProductSisrev'][0]['part_number'])
                        ->where('direct_distributor_id', Auth::guard('distributor')->user()->id)
                        ->first();

                    // se existir valor adicional no part_number
                    if($product_value)
                    {
                        // Valor extra do produto
                        $value_type = $product_value['value_type'];
                        $product_value = $product_value['product_value'];

                        // Porcentagem
                        if($value_type === 'PERCENTAGE')
                            $custo_liquido = $custo_liquido_original + ($custo_liquido_original / 100 * $product_value);

                        // Preço unitario
                        if($value_type === 'UNIT_PRICE')
                            $custo_liquido = ($custo_liquido_original + $product_value);

                        $total = ($custo_liquido * $item['quantity']);
                    }
                    else if($option_general_value && $general_value)
                    {
                        // Porcentagem
                        if($option_general_value === 'PERCENTAGE')
                            $custo_liquido = $custo_liquido_original + ($custo_liquido_original / 100 * $general_value);

                        // Preço unitario
                        if($option_general_value === 'UNIT_PRICE')
                            $custo_liquido = ($custo_liquido_original + $general_value);
                    }
                    else
                    {
                        $custo_liquido = $custo_liquido_original;
                    }

                    $total = ($custo_liquido * $item['quantity']);
                }

                $product[$key]['id']                           = $item['id'];
                $product[$key]['part_number']                  = $item['ProductSisrev'][0]['part_number'];
                $product[$key]['description']                  = $item['ProductSisrev'][0]['descricao_br'];
                $product[$key]['custo_liquido_original']       = (!empty($custo_liquido_original)) ? '$ '.number_format((float) $custo_liquido_original, 2, '.', ',') : '';
                $product[$key]['custo_liquido']                = (!empty($custo_liquido)) ? '$ '.number_format((float) $custo_liquido, 2, '.', ',') : '';
                $product[$key]['quantity']                     = $item['quantity'];
                $product[$key]['total']                        = (!empty($total)) ? '$ '.number_format((float) $total, 2, '.', ',') : '-----';
                $product[$key]['weight']                       = (!empty($item['ProductSisrev'][0]['peso'])) ? $item['ProductSisrev'][0]['peso'] : '-----';
                $product[$key]['ncm']                          = (!empty($item['ProductSisrev'][0]['ncm'])) ? $item['ProductSisrev'][0]['ncm'] : '-----';
                $product[$key]['hscode']                       = (!empty($item['ProductSisrev'][0]['hscode'])) ? $item['ProductSisrev'][0]['hscode'] : '-----';
                $product[$key]['local_fornecimento']           = (!empty($item['ProductSisrev'][0][$local])) ? $item['ProductSisrev'][0][$local] : '-----';
                $product[$key]['saldo']                        = (!empty($item['ProductSisrev'][0][$saldo])) ? $item['ProductSisrev'][0][$saldo] : '-----';
                $product[$key]['lead_time']                    = (!empty($item['ProductSisrev'][0][$lead_time])) ? $item['ProductSisrev'][0][$lead_time] : '-----';
                $product[$key]['photo']                        = (!empty($item['ProductSisrev'][0]['product_photo'][0]['filename'] )) ? '/storage/images/'.$item['ProductSisrev'][0]['product_photo'][0]['filename'] : 'https://b2b.encoparts.com/app-assets/images/logo/encoparts_c.png';
            }  
            else
            {
                $product[$key]['id']                       = $item['id'];
                $product[$key]['part_number']              = $item['product_sisrev_id'];
                $product[$key]['description']              = '-----';
                $product[$key]['custo_liquido_original']   = '-----';
                $product[$key]['custo_liquido']            = '-----';
                $product[$key]['quantity']                 = '-----';
                $product[$key]['total']                    = '-----';
                $product[$key]['weight']                   = '-----';
                $product[$key]['ncm']                      = '-----';
                $product[$key]['hscode']                   = '-----';
                $product[$key]['status_color']             = '-----';
                $product[$key]['local_fornecimento']       = '-----';
                $product[$key]['saldo']                    = '-----';
                $product[$key]['lead_time']                = '-----';
                $product[$key]['photo']                    = 'https://b2b.encoparts.com/app-assets/images/logo/encoparts_c.png';
            } 
        } 

        // return
        return datatables()::of($product)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                $actionBtn = '
                    <div class="row-button"> 
                        <a href="javascript:void(0)" data-button="edit"> 
                            <span class="tooltip">'.__("messages.Edit").'</span> 
                        </a> 
                        <button type="button" data-trigger="delete" onclick="deleteQuotation(\''.route('direct.distributor.quotation.product.destroy').'\', \''.trim($row["id"]).'\')">
                            <span class="tooltip">'.__("messages.Delete").'</span>
                        </button>
                    </div>';
                return $actionBtn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }
}
