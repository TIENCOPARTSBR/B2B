<?php

namespace App\Http\Controllers\Quotation;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Helper;
use App\Models\ProductValue;
use App\Models\Quotation;
use App\Models\QuotationItem;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
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
        // Todos os items da cotação
        $quotation = QuotationItem::with('ProductSisrev', 'ProductSisrev.product_photo')
        ->where('quotation_id', $this->id)->get();

        $product = [];
        $key = 0;
        foreach($quotation as $index){
            // Eua
            if (strtoupper(trim($index['country'])) == 'USA' || strtoupper(trim($index['country'])) == 'EUA')
            {
                $custo_liquido_name = 'custo_liquido_eua';
                $saldo = 'saldo_eua';
                $local = 'local_fornecimento_usa';
                $lead_time = 'lead_time_eua';
            }

            // Brasil
            if (strtoupper(trim($index['country'])) == 'BR')
            {
                $custo_liquido_name = 'custo_liquido_br';
                $saldo = 'saldo_br';
                $local = 'local_fornecimento_br';
                $lead_time = 'lead_time_br';
            }

            // defualt
            if (empty(trim($index['country'])))
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
                $custo_liquido_original = $index['ProductSisrev'][0][$custo_liquido_name];

                // consultar preço adicional
                $product_value = ProductValue
                    ::where('part_number', $index['ProductSisrev'][0]['part_number'])
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

                    $total = ($custo_liquido * $index['quantity']);
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

                $total = ($custo_liquido * $index['quantity']);
            }

            $product[$key]['part_number']                  = $index['ProductSisrev'][0]['part_number'];
            $product[$key]['description']                  = (!empty($index['description'])) ? $index['description'] : '-----';
            $product[$key]['custo_liquido_original']       = (!empty($custo_liquido_original)) ? '$ '.number_format((float) $custo_liquido_original, 2, '.', ',') : '-----';
            $product[$key]['custo_liquido']                = (!empty($custo_liquido)) ? '$ '.number_format((float) $custo_liquido, 2, '.', ',') : '-----';
            $product[$key]['quantity']                     = $index['quantity'];
            $product[$key]['total']                        = (!empty($total)) ? '$ '.number_format((float) $total, 2, '.', ',') : '-----';
            $product[$key]['weight']                       = (!empty($index['ProductSisrev'][0]['peso'])) ? $index['ProductSisrev'][0]['peso'] : '-----';
            $product[$key]['ncm']                          = (!empty($index['ProductSisrev'][0]['ncm'])) ? $index['ProductSisrev'][0]['ncm'] : '-----';
            $product[$key]['hscode']                       = (!empty($index['ProductSisrev'][0]['hscode'])) ? $index['ProductSisrev'][0]['hscode'] : '-----';
            $product[$key]['local_fornecimento']           = (!empty($index['ProductSisrev'][0][$local])) ? $index['ProductSisrev'][0][$local] : '-----';
            $product[$key]['saldo']                        = (!empty($index['ProductSisrev'][0][$saldo])) ? $index['ProductSisrev'][0][$saldo] : '-----';
            $product[$key]['lead_time']                    = (!empty($index['ProductSisrev'][0][$lead_time])) ? $index['ProductSisrev'][0][$lead_time] : '-----';

            $key = $key + $key++;
        }

        return view('component.quotation.excel-quotation', [
            'product' => $product,
            'quotation' => Quotation::findOrFail($this->id),
        ]);
    }
}
