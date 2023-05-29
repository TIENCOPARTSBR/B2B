<?php

namespace App\Http\Controllers\DirectDistributor\Distributor;

use App\Http\Controllers\Controller;
use App\Models\Distributor;
use Illuminate\Http\Request;

class DistributorController extends Controller
{
	public function index()
	{
		return view ('direct-distributor.distributor.index')->with('distributor', Distributor::all());
	}

	public function show(Request $request)
	{
		return view ('direct-distributor.distributor.index')
			->with('distributor', Distributor::where('name', 'LIKE', '%'.$request['name'].'%')->get()); 
	}

	public function create()
	{
		return view('direct-distributor.distributor.create');
	}
 
	public function store(Request $request)
	{
		$request->validate([
			'name' => 'required',
			'cif_freight' => 'required',
		],[
			'cif_freight' => __('messages.Field CIF freight is required'),
		]);

		Distributor::create($request->all());

		return to_route('direct.distributor.distributor.index')
			->with('successfully', __('messages.Distributor created successfully'));
	}

	public function edit($id)
	{
		return view('direct-distributor.distributor.edit')
			->with('distributor', Distributor::findOrFail($id));
	}

	public function updated(Request $request)
	{
		$request->validate([
			'name' => 'required',
			'cif_freight' => 'required',
		],[
			'cif_freight' => __('messages.Field CIF freight is required'),
		]);

		Distributor::findOrFail($request->id)
			->update($request->all());

		return to_route('direct.distributor.distributor.index')
			->with('successfully', __('messages.Distributor changed successfully'));
	}

	public function destroy(Request $request)
	{
		Distributor::findOrFail(trim($request->id_delete))
			->delete();

		return to_route('direct.distributor.distributor.index')
			->with('successfully', __('messages.Distributor deleted successfully'));
	}

	public function view(Distributor $distributor, $id)
	{
		$distributor = $distributor->with('UserDistributor', 'ProductValue')->findOrFail($id);

		return view('direct-distributor.distributor.view')
			->with('distributor', $distributor)
			->with('user', $distributor['UserDistributor'])
			->with('type', $distributor['ProductValue']);
	}
}