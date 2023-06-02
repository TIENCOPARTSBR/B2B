<?php

namespace App\Http\Controllers\DirectDistributor\Quotation;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ProductSisrev;
use App\Models\QuotationItem;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class ImportForQuotationController extends Controller
{
    public function index(QuotationItem $quotation_item, ProductSisrev $product_sisrev, Request $request)
    {
        // importing
        $excel_imported = Excel::toCollection(new ProductSisrev, $request->file('excel'));

        // deleted header excel
        unset($excel_imported[0][0]);

        $html = [];

        // loop de todos os part numbers
        foreach($excel_imported[0] as $excel)
        {
            // se não existir quantidade definir como 1
            if(empty($excel[1])) $excel[1] = 1;

            // verificar existencia do part number na cotacao
            $check = $quotation_item
                ->where('quotation_id', $request['quotation_id'])
                ->where('product_sisrev_id', $excel[0])
                ->first();

            // verificar existencia do part number na cotacao
            if($check) {
                $item = [
                    'quantity' => ($excel[1] + $check['quantity'])
                ];

                $quotation_item::findOrFail($check['id'])
                    ->update($item);

                continue;
            }

            // Pegar todos os produtos e seus relacionamentos conforme o part_number
            $product = $product_sisrev->with('product_photo')->where('part_number', trim($excel[0]))->first();

            // Se existir o part_number na base da dados
            if(isset($product)){
                // Se não houver imagem no banco de dados definir a variavel com o logo da encoparts
                $product['image'] = "https://b2b.encoparts.com/app-assets/images/logo/encoparts_c.png";
                if(!empty($product['product_photo'][0]['filename'])) $product['image'] = Storage::url('images/'.$product['product_photo'][0]['filename']);
        
                // Mudar a descrição conforme o idioma usado no sistema.
                if(app()->getLocale() == 'pt')  $descricao = $product['descricao_br'];
                if(app()->getLocale() == 'en')  $descricao = $product['descricao_en'];
                if(app()->getLocale() == 'es')  $descricao = $product['descricao_es'];
        
                // Se houver entrega para dois locais exibir um card para o cliente escolher. 
                if(strtoupper($product['local_fornecimento_br']) === 'BR'  && strtoupper($product['local_fornecimento_usa']) === 'USA')
                {
                    if(strtoupper($product['local_fornecimento_br']) === 'BR') 
                    {
                        $html[] = 
                        '<form class="card-product">
                            <div type="button" data-modal="close"></div>
    
                            <input type="hidden" name="product_sisrev_id" value="'.$product['part_number'].'">
                            <input type="hidden" name="country" value="BR">
                            <input type="hidden" name="status" value="A">
                            <input type="hidden" name="product_exists" value="X">
                            <input type="hidden" name="quotation_id" value="'.$request['quotation_id'].'">
                            
                            <div class="col-12">
                                <ul>
                                    <li> <h2>'.$product['part_number'].' - '.$descricao.' </h2> </li>
                                    <li><strong>'.__("messages.Price Encoparts BR").':</strong>    '.$product['custo_liquido_br'].'</li>
                                    <li><strong>'.__("messages.Weight").':</strong>                '.$product['peso'].' kg</li>
                                    <li><strong>NCM:</strong>                                      '.$product['ncm'].'</li>
                                    <li><strong>HS Code:</strong>                                  '.$product['hscode'].'</li>
                                    <li>
                                        <img src="https://encoparts.com/wp-content/plugins/sitepress-multilingual-cms/res/flags/pt-br.png">
                                        <strong>'.__("messages.Supply location").':</strong>       '.$product['local_fornecimento_br'].'
                                    </li>
                                    <li><strong>'.__('messages.Quantity in stock').':</strong>     '.$product['saldo_br'].'</li>
                                    <li><strong>'.__('messages.Lead time').':</strong>             '.$product['lead_time_br'].'</li>
                                </ul>
                            </div>
                        
                            <div class="row justify-end mt-2">
                                <input type="number" class="input-number" name="quantity" placeholder="0" min="1" value="'.$excel[1].'">
                                <input type="submit" class="input-submit" value="'.__('messages.Add to quotation').'">
                            </div>
                        </form>';
                    }

                    if(strtoupper($product['local_fornecimento_usa']) === 'USA') 
                        {
                        $html[] = 
                        '<form class="card-product">
                            <div type="button" data-modal="close"></div>
    
                            <input type="hidden" name="product_sisrev_id" value="'.$product['part_number'].'">
                            <input type="hidden" name="country" value="BR">
                            <input type="hidden" name="status" value="A">
                            <input type="hidden" name="product_exists" value="X">
                            <input type="hidden" name="quotation_id" value="'.$request['quotation_id'].'">
                            
                            <div class="col-12">
                                <ul>
                                    <li> <h2>'.$product['part_number'].' - '.$descricao.' </h2> </li>
                                    <li><strong>'.__("messages.Encoparts USA Price").':</strong>   '.$product['custo_liquido_eua'].'</li>
                                    <li><strong>'.__("messages.Weight").':</strong>                '.$product['peso'].' kg</li>
                                    <li><strong>NCM:</strong>                                      '.$product['ncm'].'</li>
                                    <li><strong>HS Code:</strong>                                  '.$product['hscode'].'</li>
                                    <li>
                                        <img src="https://encoparts.com/wp-content/uploads/flags/us.png">
                                        <strong>'.__("messages.Supply location").':</strong>       '.$product['local_fornecimento_usa'].'
                                    </li>
                                    <li><strong>'.__('messages.Quantity in stock').':</strong>     '.$product['saldo_eua'].'</li>
                                    <li><strong>'.__('messages.Lead time').':</strong>             '.$product['lead_time_eua'].'</li>
                                </ul>
                            </div>
                        
                            <div class="row justify-end mt-2">
                                <input type="number" class="input-number" name="quantity" placeholder="0" min="1" value="'.$excel[1].'">
                                <input type="submit" class="input-submit" value="'.__('messages.Add to quotation').'">
                            </div>
                        </form>';
                    }
                } 
                else 
                {
                    if($product['local_fornecimento_br']) $country = 'BR';
                    if($product['local_fornecimento_usa']) $country = 'USA';
                    if(empty($product['local_fornecimento_br']) || $product['local_fornecimento_usa']) $country = '';
                    if(empty($excel['2'])) $excel['2'] = "";

                    $prod = [
                        'quotation_id' => $request['quotation_id'],
                        'product_sisrev_id' => $product['part_number'],
                        'description' => $excel['2'],
                        'country' => $country,
                        'quantity' => $excel['1'],
                        'status' => 'A',
                        'product_exists' => 'X',
                    ];
                    
                    $quotation_item::create($prod);
                }
            }
        }

      return response()->json(json_encode($html),200);
    }
}