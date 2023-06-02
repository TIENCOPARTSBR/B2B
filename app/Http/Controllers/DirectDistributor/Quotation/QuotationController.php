<?php

namespace App\Http\Controllers\DirectDistributor\Quotation;

use App\Http\Controllers\Controller;
use App\Mail\SendQuotation;
use App\Models\Quotation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;

class QuotationController extends Controller
{
    public function index(Quotation $quotation)
    {
        return view('direct-distributor.quotation.index')
            ->with('quotation', $quotation
                                    ->where('direct_distributor_id', Auth::guard('distributor')->user()->direct_distributor_id)
                                    ->paginate(10));
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

        $result = $quotation::create($create);

        return to_route('direct.distributor.quotation.product.index', $result['id']);
    }

    public function show(Quotation $quotation, Request $request)
    {
        return view('direct-distributor.quotation.index')
            ->with('quotation', $quotation::where('customer_name', 'LIKE', '%'.$request->name.'%')->paginate(10));
    }

    public function edit(Quotation $quotation, Request $request)
    {
        return view('direct-distributor.quotation.show')
            ->with('quotation', $quotation::findOrFail($request['id']));
    }

    public function updated(Quotation $quotation, Request $request)
    {
        $request['urgent'] = ($request->urgent == "on")? 1 : 0;

        $quotation::findOrFail($request->id)->update($request->all());

        return to_route('direct.distributor.quotation.product.index', $request->id);
    }

    public function destroy(Quotation $quotation, Request $request)
    {
        $quotation::findOrFail($request->id_delete)->delete();

        return to_route('direct.distributor.quotation.product.index')
            ->with('successfully', __('messages.Quotation deleted'));
    }

    public function export($id) 
    {
        return Excel::download(new ExportForQuotationController($id), 'quotation.xlsx');
    }

    public function send(Quotation $quotation, $id)
    {
        $mail = new SendQuotation($id);
        Mail::to('daniel.ismael@encoparts.com')->send($mail);

        $item = [
            'status' => 'S'
        ];

        $quotation::findOrFail($id)->update($item);

        return to_route('direct.distributor.quotation.index')
            ->with('successfully', __('messages.Quotation sent'));
    }
}