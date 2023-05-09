<?php

namespace App\Models;

use App\Http\Helper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class ProductValueDistributor extends Model
{
    use HasFactory;

    protected $table = 'product_value_distributor';

    protected $fillable = [
        'part_number',
        'product_value',
        'value_type',
        'is_active',
        'id_distributor'
    ];

    // index
    public static function index()
    {
        $product = ProductValueDistributor
            ::where('id_distributor',  Auth::user()->id_distributor)
            ->paginate(10);

        return $product;
    }

    // show
    public static function show($r)
    {
        $product = ProductValueDistributor
            ::where('id_distributor', $r['id_distributor'])
            ->where('part_number', $r['part_number'])
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
            'id_distributor' => $r['id_distributor'],
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
