<?php

namespace App\Http\Controllers\Distributor\Quotation;

use App\Http\Helper;
use App\Models\ProductSisrev;
use App\Models\ProductValue;
use App\Models\Quotation;
use App\Models\QuotationItem;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class QuotationDatatableController extends Controller
{
    public function datatable(Quotation $quotation, ProductSisrev $product_sisrev, $id, Request $request)
    {   
        $draw = $request->get('draw');
        $start = $request->get("start");
        $rowperpage = $request->get("length"); 
        $search_arr = $request->get('search');
        $searchValue = $search_arr['value']; 

        // Todos os items da cotação
        $quotation = QuotationItem::with('ProductSisrev', 'ProductSisrev.product_photo')
            ->where('quotation_id', $id)
            ->where('product_sisrev_id', 'like', '%'.$searchValue.'%')
            ->skip($start)
            ->take($rowperpage)
            ->get();

        // total records
        $totalRecords = QuotationItem::with('ProductSisrev', 'ProductSisrev.product_photo')
            ->select('count(*) as allcount')
            ->where('quotation_id', $id)
            ->count();
        
        // total records for search
        $totalRecordswithFilter = QuotationItem::with('ProductSisrev', 'ProductSisrev.product_photo')
            ->select('count(*) as allcount')
            ->where('quotation_id', $id)
            ->where('product_sisrev_id', 'like', '%'.$searchValue.'%')
            ->count();

        // Array de produtos
        $product = [];

        // Loop dos produtos
        foreach($quotation as $key => $item)
        {
            if ($item['product_exists'] === 'X')
            {
                // Eua
                if($item['country'] == null) $item['country'] = '';

                if (strtoupper(trim($item['country'])) == 'USA' || strtoupper(trim($item['country'])) == 'EUA')
                {
                    $custo_liquido_name = 'custo_liquido_eua';
                    $saldo = 'saldo_eua';
                    $local = 'local_fornecimento_usa';
                    $lead_time = 'lead_time_eua';
                }

                // Brasil
                if (strtoupper(trim($item['country'])) == 'BR')
                {
                    $custo_liquido_name = 'custo_liquido_br';
                    $saldo = 'saldo_br';
                    $local = 'local_fornecimento_br';
                    $lead_time = 'lead_time_br';
                }

                // defualt
                if (empty(trim($item['country'])))
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
                    $option_general_value = Helper::getDistributorLogged()->option_general_value;
                    $general_value = Helper::getDistributorLogged()->general_value;
                    // Custo original
                    $custo_liquido_original = $item['ProductSisrev'][0][$custo_liquido_name];

                    // consultar preço adicional
                    $product_value = ProductValue
                        ::where('part_number', $item['ProductSisrev'][0]['part_number'])
                        ->where('direct_distributor_id', Helper::getDistributorLogged()->distributor_id)
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

                // Mudar a descrição conforme o idioma usado no sistema.
                if(app()->getLocale() == 'pt')  $description = $item['ProductSisrev'][0]['descricao_br'];
                if(app()->getLocale() == 'en')  $description = $item['ProductSisrev'][0]['descricao_en'];
                if(app()->getLocale() == 'es')  $description = $item['ProductSisrev'][0]['descricao_es'];

                if($item['description']) $description = $item['description'];

                $product[$key]['part_number']                  = $item['ProductSisrev'][0]['part_number'];
                $product[$key]['description']                  = ($description) ? $description : '-----';
                $product[$key]['custo_liquido_original']       = (!empty($custo_liquido_original)) ? '$ '.number_format((float) $custo_liquido_original, 2, '.', ',') : '-----';
                $product[$key]['custo_liquido']                = (!empty($custo_liquido)) ? '$ '.number_format((float) $custo_liquido, 2, '.', ',') : '-----';
                $product[$key]['quantity']                     = $item['quantity'];
                $product[$key]['total']                        = (!empty($total)) ? '$ '.number_format((float) $total, 2, '.', ',') : '-----';
                $product[$key]['weight']                       = (!empty($item['ProductSisrev'][0]['peso'])) ? $item['ProductSisrev'][0]['peso'] : '-----';
                $product[$key]['ncm']                          = (!empty($item['ProductSisrev'][0]['ncm'])) ? $item['ProductSisrev'][0]['ncm'] : '-----';
                $product[$key]['hscode']                       = (!empty($item['ProductSisrev'][0]['hscode'])) ? $item['ProductSisrev'][0]['hscode'] : '-----';
                $product[$key]['local_fornecimento']           = (!empty($item['ProductSisrev'][0][$local])) ? $item['ProductSisrev'][0][$local] : '-----';
                $product[$key]['saldo']                        = (!empty($item['ProductSisrev'][0][$saldo])) ? $item['ProductSisrev'][0][$saldo] : '-----';
                $product[$key]['lead_time']                    = (!empty($item['ProductSisrev'][0][$lead_time])) ? $item['ProductSisrev'][0][$lead_time] : '-----';
                $product[$key]['photo']                        = (!empty($item['ProductSisrev'][0]['product_photo'][0]['filename'] )) ? '/storage/images/'.$item['ProductSisrev'][0]['product_photo'][0]['filename'] : 'https://b2b.encoparts.com/app-assets/images/logo/encoparts_c.png';
                $product[$key]['edit'] = '<div class="row-button"><button type="button" data-trigger="delete" onclick="triggerModal(\''.route('direct.distributor.quotation.product.destroy').'\', \''.$item['ProductSisrev'][0]['id'].'\')"><span class="tooltip"></span></button></div>';
            }  
            else
            {
                $product[$key]['id']                       = $item['id'];
                $product[$key]['part_number']              = $item['product_sisrev_id'];
                $product[$key]['description']              = $item['descricao'];
                $product[$key]['custo_liquido_original']   = '-----';
                $product[$key]['custo_liquido']            = '-----';
                $product[$key]['quantity']                 = $item['quantity'];
                $product[$key]['total']                    = '-----';
                $product[$key]['weight']                   = '-----';
                $product[$key]['ncm']                      = '-----';
                $product[$key]['hscode']                   = '-----';
                $product[$key]['status_color']             = '-----';
                $product[$key]['local_fornecimento']       = '-----';
                $product[$key]['saldo']                    = '-----';
                $product[$key]['lead_time']                = '-----';
                $product[$key]['photo']                    = 'https://b2b.encoparts.com/app-assets/images/logo/encoparts_c.png';
                $product[$key]['edit'] = '<div class="row-button"><button type="button" data-trigger="delete" onclick="triggerModal(\''.route('direct.distributor.quotation.product.destroy').'\', \''.$item['id'].'\')"><span class="tooltip"></span></button></div>';
            } 
        } 

        // return
        $response = [
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordswithFilter,
            "aaData" => $product
        ];

        return json_encode($response);
    }
}