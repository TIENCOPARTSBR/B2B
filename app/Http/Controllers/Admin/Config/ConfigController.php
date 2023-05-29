<?php

namespace App\Http\Controllers\Admin\Config;

use App\Models\SystemConfiguration;
use Illuminate\Http\Request;

class ConfigController
{
    public function index()
    {
        return view('admin.config.index');
    }

    public function updated(Request $request)
    {
        SystemConfiguration::findOrFail('1')->update($request->all());

        return to_route('admin.config.index')
            ->with('successfully', __('messages.Configuration changed successfully'));
    }
}
