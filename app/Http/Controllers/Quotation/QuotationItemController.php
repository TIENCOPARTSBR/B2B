<?php

namespace App\Http\Controllers\Quotation;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ProductSisrev;
use App\Models\QuotationItem;

class QuotationItemController extends Controller
{
    /* Está função retorna o html com o produto, se esse produto estiver com a condição de entrega para ambos os paises de fornecimento, vai voltar dois html. */
    public function show(ProductSisrev $product_sisrev, Request $request)
    {
        /* Pegar todos os produtos e seus relacionamentos conforme o part_number */
        $product = $product_sisrev->with('product_photo')->where('part_number', $request['part_number'])->get();

        $html = array();

        /* Transformar o objeto em array de produto */
        foreach($product as $product) {

            /* Se não houver imagem no banco de dados definir a variavel com o logo da encoparts */
            if(!empty($product['product_photo'][0]['filename'])) {
                $product['image'] = Storage::url('images/'.$product['product_photo'][0]['filename']);
            }
            else{
                $product['image'] = "https://b2b.encoparts.com/app-assets/images/logo/encoparts_c.png";
            }

            // Mudar a descrição conforme o idioma usado no sistema.
            if(app()->getLocale() == 'pt')  $product['descricao'] = $product['descricao_br'];
            if(app()->getLocale() == 'en')  $product['descricao'] = $product['descricao_en'];
            if(app()->getLocale() == 'es')  $product['descricao'] = $product['descricao_es'];

            // Definir o html conforme o local de fornecimento
            if(isset($product['local_fornecimento_br'])){
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
                                <li> <h2>'.$product['part_number'].' - '.$product['descricao'].' </h2> </li>
                                <li><strong>'.__("messages.Price Encoparts BR").':</strong>    '.$product['custo_liquido_br'].'</li>
                                <li><strong>'.__("messages.Encoparts USA Price").':</strong>   '.$product['custo_liquido_eua'].'</li>
                                <li><strong>'.__("messages.Weight").':</strong>                '.$product['peso'].' kg</li>
                                <li><strong>NCM:</strong>                                      '.$product['ncm'].'</li>
                                <li><strong>HS Code:</strong>                                  '.$product['hscode'].'</li>
                                <li>
                                    <img src="https://encoparts.com/wp-content/plugins/sitepress-multilingual-cms/res/flags/pt-br.png"> &nbsp
                                    <strong>'.__("messages.Supply location").':</strong>       '.$product['local_fornecimento_br'].'
                                </li>
                                <li><strong>'.__('messages.Quantity in stock').':</strong>     '.$product['saldo_br'].'</li>
                                <li><strong>'.__('messages.Lead time').':</strong>             '.$product['lead_time_br'].'</li>
                            </ul>
                        </div>
                    
                        <div class="row justify-end mt-2">
                            <input type="number" class="input-number" name="quantity" placeholder="0" min="1">
                            <input type="submit" class="input-submit" value="'.__('messages.Add to quotation').'">
                        </div>
                    </form>';
            }

            if(isset($product['local_fornecimento_usa'])){
                $html[] = 
                    '<form class="card-product">
                        <div type="button" data-modal="close"></div>

                        <input type="hidden" name="product_sisrev_id" value="'.$product['part_number'].'">
                        <input type="hidden" name="country" value="USA">
                        <input type="hidden" name="status" value="A">
                        <input type="hidden" name="product_exists" value="X">
                        <input type="hidden" name="quotation_id" value="'.$request['quotation_id'].'">
                        
                        <div class="col-12">
                            <ul>
                                <li> <h2>'.$product['part_number'].' - '.$product['descricao'].' </h2> </li>
                                <li><strong>'.__("messages.Price Encoparts BR").':</strong>    '.$product['custo_liquido_br'].'</li>
                                <li><strong>'.__("messages.Encoparts USA Price").':</strong>   '.$product['custo_liquido_eua'].'</li>
                                <li><strong>'.__("messages.Weight").':</strong>                '.$product['peso'].' kg</li>
                                <li><strong>NCM:</strong>                                      '.$product['ncm'].'</li>
                                <li><strong>HS Code:</strong>                                  '.$product['hscode'].'</li>
                                <li>
                                    <img src="https://encoparts.com/wp-content/uploads/flags/us.png"> &nbsp
                                    <strong>'.__("messages.Supply location").':</strong>       '.$product['local_fornecimento_usa'].'
                                </li>
                                <li><strong>'.__('messages.Quantity in stock').':</strong>     '.$product['saldo_eua'].'</li>
                                <li><strong>'.__('messages.Lead time').':</strong>             '.$product['lead_time_eua'].'</li>
                            </ul>
                        </div>
                    
                        <div class="row justify-end mt-2">
                            <input type="number" class="input-number" name="quantity" placeholder="0" min="1">
                            <input type="submit" class="input-submit" value="'.__('messages.Add to quotation').'">
                        </div>
                    </form>';
            }

            if(!isset($product['local_fornecimento_br']) || !isset($product['local_fornecimento_usa'])){
                $html[] = 
                    '<form class="card-product">
                        <div type="button" data-modal="close"></div>

                        <input type="hidden" name="product_sisrev_id" value="'.$product['part_number'].'">
                        <input type="hidden" name="country" value="USA">
                        <input type="hidden" name="status" value="A">
                        <input type="hidden" name="product_exists" value="X">
                        <input type="hidden" name="quotation_id" value="'.$request['quotation_id'].'">
                        
                        <div class="col-12">
                            <ul>
                                <li> <h2>'.$product['part_number'].' - '.$product['descricao'].' </h2> </li>
                                <li><strong>'.__("messages.Price Encoparts BR").':</strong>    '.$product['custo_liquido_br'].'</li>
                                <li><strong>'.__("messages.Encoparts USA Price").':</strong>   '.$product['custo_liquido_eua'].'</li>
                                <li><strong>'.__("messages.Weight").':</strong>                '.$product['peso'].' kg</li>
                                <li><strong>NCM:</strong>                                      '.$product['ncm'].'</li>
                                <li><strong>HS Code:</strong>                                  '.$product['hscode'].'</li>
                                <li><strong>'.__("messages.Supply location").': ----</strong></li>
                                <li><strong>'.__('messages.Quantity in stock').':</strong>     '.$product['saldo_eua'].'</li>
                                <li><strong>'.__('messages.Lead time').':</strong>             '.$product['lead_time_eua'].'</li>
                            </ul>
                        </div>
                    
                        <div class="row justify-end mt-2">
                            <input type="number" class="input-number" name="quantity" placeholder="0" min="1">
                            <input type="submit" class="input-submit" value="'.__('messages.Add to quotation').'">
                        </div>
                    </form>';
            }
        }

        return response()->json(json_encode($html),200);
    }

    /* Adiconar item na cotação */
    public function store(QuotationItem $quotation_item, Request $request)
    {
        $item = [
            'quotation_id' => trim($request['quotation_id']),
            'product_sisrev_id' => trim($request['product_sisrev_id']),
            'country' => trim($request['country']),
            'quantity' => trim($request['quantity']),
            'status' => trim($request['status']),
            'product_exists' => trim($request['product_exists']),
        ];

        $quotation_item::create($item);

        return response()->json(json_encode('Successfully'),200);
    }
}