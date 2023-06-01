<?php

namespace App\Http\Controllers\Quotation;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ProductSisrev;
use App\Models\Quotation;
use App\Models\QuotationItem;
use Illuminate\Support\Facades\Storage;

class QuotationItemController extends Controller
{
    public function index($id)
    {   
        return view('direct-distributor.quotation.item')
            ->with('status', Quotation::select('status')->findOrFail($id))
            ->with('id', $id);
    }

    public function show(ProductSisrev $product_sisrev, Request $request)
    {
        /* Pegar todos os produtos e seus relacionamentos conforme o part_number */
        $product = $product_sisrev
            ->with('product_photo')
            ->where('part_number', $request['part_number'])
            ->first();

        $html = array();

        /* Transformar o objeto em array de produto */
        if($product) {
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
        } else {
            $html[] = 
                '<form class="card-product">
                    <div type="button" data-modal="close"></div>

                    <input type="hidden" name="product_sisrev_id" value="'.$request['part_number'].'">
                    <input type="hidden" name="country" value="">
                    <input type="hidden" name="status" value="A">
                    <input type="hidden" name="product_exists" value="">
                    <input type="hidden" name="quotation_id" value="'.$request['quotation_id'].'">
                    
                    <div class="col-12">
                        <ul>
                            <li> <h2>'.$request['part_number'].' - N/A</h2> </li>
                            <li><strong>'.__("messages.Price Encoparts BR").':</strong> N/A</li>
                            <li><strong>'.__("messages.Encoparts USA Price").':</strong> N/A</li>
                            <li><strong>'.__("messages.Weight").':</strong> N/A</li>
                            <li><strong>NCM:</strong> N/A</li>
                            <li><strong>HS Code:</strong> N/A</li>
                            <li><strong>'.__("messages.Supply location").':</strong> N/A</li>
                            <li><strong>'.__('messages.Quantity in stock').':</strong> N/A</li>
                            <li><strong>'.__('messages.Lead time').':</strong> N/A</li>
                        </ul>
                    </div>
                
                    <div class="row justify-end mt-2">
                        <input type="text" name="description" placeholder="'.__('messages.Description').'" style="width: 100%; margin: 0 0 1rem;">
                        <input type="number" class="input-number" name="quantity" placeholder="0" min="1">
                        <input type="submit" class="input-submit" value="'.__('messages.Add to quotation').'">
                    </div>
                </form>';
        }

        return response()->json(json_encode($html),200);
    }

    public function store(QuotationItem $quotation_item, Request $request)
    {
        $item = $quotation_item
                ->where('quotation_id', $request['quotation_id'])
                ->where('product_sisrev_id', $request['product_sisrev_id'])
                ->first();

        if($item) {
            $quotation['quantity'] = ($request['quantity'] + $item['quantity']);
            $quotation_item::findOrFail($item->id)->update($quotation);
        } 
        else {
            $item = [   
                'quotation_id' => trim($request['quotation_id']),
                'product_sisrev_id' => trim($request['product_sisrev_id']),
                'country' => trim($request['country']),
                'quantity' => trim($request['quantity']),
                'status' => trim($request['status']),
                'product_exists' => trim($request['product_exists']),
                'description' => trim($request['description']),
            ];
    
            $quotation_item::create($item);
        }

        return response()->json(json_encode('Successfully'),200);
    }
    
    public function destroy(QuotationItem $quotationItem, Request $request)
    {
        $quotationItem::findOrFail($request['id'])->delete();
        return response()->json(json_encode(__('messages.Product successfully deleted')),200);
    }
}