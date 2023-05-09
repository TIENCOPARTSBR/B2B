<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class DirectDistributor extends Model
{
    use HasFactory;

    protected $table = 'direct_distributor';

    protected $fillable = [
        'name',
        'is_active',   
        'cif_freight',
        'general_value',
        'option_general_value',
        'allow_quotation',
        'allow_partner',
        'allow_product_report'
    ];

    public static function store($r)
    {
        $distributor = [
            'name' => $r['name'],
            'is_active' => $r['is_active'],
            'cif_freight' => $r['cif_freight'],
            'general_value' => '',
            'option_general_value' => '',
            'allow_quotation' => $r['allow_quotation'],
            'allow_product_report' => $r['allow_product_report']
        ];

        DirectDistributor::create($distributor);
    }

    public static function show($name)
    {
        return DirectDistributor::where('name', 'like', '%'.$name.'%')->get();
    }

    public static function updated($r)
    {
        $distributors = DirectDistributor::findOrFail($r['id']);
        $distributors->name = $r['name'];
        $distributors->is_active = $r['is_active'];
        $distributors->cif_freight = $r['cif_freight'];
        $distributors->allow_quotation = $r['allow_quotation'];
        $distributors->allow_product_report = $r['allow_product_report'];
        $distributors->update();
    }

    public static function destroy($id)
    {
        DirectDistributor::findOrFail($id)->delete();
    }

    // get general update
    public static function getGeneralValue(){
        $general = DirectDistributor
            ::select('general_value', 'option_general_value')
            ->where('id', Auth::user()->id_direct_distributor)
            ->get();
        return $general[0];
    }

    // set general value
    public static function setGeneralValue($r)
    {
        $distributor = DirectDistributor::findOrFail(Auth::user()->id_direct_distributor);
        $distributor->option_general_value = $r['option_general_value'];
        $distributor->general_value = $r['general_value'];
        $distributor->update();
    }
}
