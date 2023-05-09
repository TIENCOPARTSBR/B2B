<?php

namespace App\Models;

use App\Http\Helper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductValueDirectDistributor extends Model
{
    use HasFactory;

    protected $table = 'product_value_distributor';

    protected $fillable = [
        'part_number',
        'product_value',
        'value_type',
        'is_active',
        'id_direct_distributor',
        'id_distributor'
    ];

    // index
    public static function index()
    {
        $product = ProductValueDistributor
            ::where('id_direct_distributor',  Helper::getDirectDistributorLogged()->id)
            ->paginate(10);

        return $product;
    }

    // show
    public static function show($r)
    {
        $product = ProductValueDistributor
            ::where('id_direct_distributor',  Helper::getDirectDistributorLogged()->id)
            ->where('part_number', $r)
            ->paginate(10);
        
        return $product;
    }

    // store
    public static function store($r)
    {
        $product = [
            'part_number' => $r['part_number'],
            'product_value' => $r['product_value'],
            'value_type' => $r['value_type'],
            'id_direct_distributor' => Helper::getDirectDistributorLogged()->id,
            'id_distributor' => NULL
        ];

        ProductValueDistributor::create($product);
    }

    // updated
    public static function updated($r)
    {
        $product = ProductValueDistributor::findOrFail($r['id']);
        $product->part_number = $r['part_number'];
        $product->product_value = $r['product_value'];
        $product->update();
    }

    // destroy
    public static function destroy($id){
        ProductValueDistributor::findOrFail($id)->delete();
    }
}
