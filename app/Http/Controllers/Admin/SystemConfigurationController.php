<?php

namespace App\Http\Controllers\Admin;

use App\Models\SystemConfiguration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class SystemConfigurationController
{
    // index
    public function index()
    {
        return view('admin.systemConfiguration');
    }

    // store
    public function store(Request $r)
    {
        SystemConfiguration::store($r->only('receipt_quotation_email'));
        return Redirect::to('/admin/config')->with('successfully', __('messages.Configuration changed successfully'));
    }

    // updated
    public function updated(Request $r)
    {
        SystemConfiguration::updated($r->receipt_quotation_email);
        return Redirect::to('/admin/config')->with('successfully', __('messages.Configuration changed successfully'));
    }
}
