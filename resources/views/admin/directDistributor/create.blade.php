@extends('layouts.admin')
@section('content')
    <section class="groupCompany">
        <h1 class="titleClient">{{ __('messages.Distributors') }}</h1>

        <ul class="breadcrumb">
            <li><a href="{{ url('/admin') }}">{{ __('messages.Home') }}</a> &nbsp/</li>
            <li><a href="{{ url('/admin/distribuidor') }}">&nbsp {{ __('messages.Distributors') }}</a></li>
            <li class="active">&nbsp/ {{ __('messages.New') }}</li>
        </ul>

        <form class="card-form" method="POST" action="{{ url('/admin/distribuidor/novo') }}">
            @csrf
            @method('POST')

            <div class="group">
                <label class="form-label" for="name">{{ __('messages.Name') }}</label>
                <input class="form-control" type="text" name="name" required placeholder="{{ __('messages.Name') }}">
            </div>
            
            <div class="group">
                <label class="form-label" for="is_active">Status</label>

                <div class="form-select">
                    <select name="is_active">
                        <option value="A">{{ __('messages.Active') }}</option>
                        <option value="I">{{ __('messages.Inactive') }}</option>
                    </select>
                </div>
            </div>

            <div class="group">
                <label class="form-label" for="cif_freight">{{ __('messages.CIF freight') }}&nbsp(%)</label>
                <input class="form-control" type="text" name="cif_freight" value="0">
            </div>

            <div class="group">
                <label class="form-label" for="allow_quotation">{{ __('messages.Allow quotation') }}?</label>

                <div class="form-select">
                    <select name="allow_quotation">
                        <option value="N">{{ __('messages.No') }}</option>
                        <option value="Y">{{ __('messages.Yes') }}</option>
                    </select>
                </div>
            </div>

            <div class="group">
                <label class="form-label" for="allow_partner">{{ __('messages.Allow partner') }}?</label>
                
                <div class="form-select">
                    <select name="allow_partner">
                        <option value="N">{{ __('messages.No') }}</option>
                        <option value="Y">{{ __('messages.Yes') }}</option>
                    </select>
                </div>
            </div>

            <div class="group">
                <label class="form-label" for="allow_product_report">{{ __('messages.Allow product reporting') }}?</label>
                
                <div class="form-select">
                    <select name="allow_product_report">
                        <option value="N">{{ __('messages.No') }}</option>
                        <option value="Y">{{ __('messages.Yes') }}</option>
                    </select>
                </div>
            </div>

            <div class="row">
                <input class="button-yellow-1" type="submit" value="{{ __('messages.Save') }}">
            </div>
        </form>
    </section>
@endsection