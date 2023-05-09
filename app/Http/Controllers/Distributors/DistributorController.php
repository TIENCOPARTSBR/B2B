<?php

namespace App\Http\Controllers\Distributors;

use App\Http\Controllers\Controller;
use App\Models\Distributor;
use App\Models\ProductValueDistributor;
use App\Models\UserDistributor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class DistributorController extends Controller
{
	public function index()
	{
		return view ('distributor.distributor.index')->with('distributor', Distributor::all());
	}

	public function show(Request $request)
	{
		return view ('distributor.distributor.index')
			->with('distributor', Distributor::where('name', 'LIKE', '%'.$request['name'].'%')->get()); 
	}

	public function create()
	{
		return view('distributor.distributor.create');
	}
 
	public function store(Request $request)
	{
		Distributor::create($request->all());

		return to_route('distributor.index')
			->with('successfully', __('messages.Distributor created successfully'));
	}

	public function edit($id)
	{
		return view('distributor.distributor.edit')
			->with('distributor', Distributor::findOrFail($id));
	}

	public function updated(Request $request)
	{
		Distributor::updated($request->all());

		return to_route('distributor.index')
			->with('successfully', __('messages.Distributor changed successfully'));
	}

	public function destroy($id){
		Distributor::destroy($id);
		return Redirect::to('/distribuidor')->with('successfully', __('messages.Distributor deleted successfully'));
	}

	public function view($id){
		return view('distributor.distributor.view', ['distributor' => Distributor::findOrFail($id), 'user' => UserDistributor::where('id_distributor', Auth::user()->id)->get(), 'type' => ProductValueDistributor::where('id_distributor', Auth::user()->id)->get()]);
	}
}
