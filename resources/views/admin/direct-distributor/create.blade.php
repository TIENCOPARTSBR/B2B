@extends('layouts.admin')
@section('content')
    <section class="page">
        <ul class="breadcrumb">
            <li><a href="{{route('admin.index')}}">{{ __('messages.Home') }}</a> &nbsp/</li>
            <li><a href="{{route('admin.direct.distributor.index')}}">&nbsp {{ __('messages.Distributors') }}</a></li>
            <li class="active">&nbsp/ {{ __('messages.New') }}</li>
        </ul>

        <h1 class="title">{{ __('messages.Distributors') }}</h1>

        <form class="tab-form" method="POST" action="{{route('admin.direct.distributor.store')}}">
            @csrf
            @method('POST')
            <div class="group">
                <label class="form-label" for="name">{{ __('messages.Name') }}</label>
                <input class="form-input" type="text" name="name" required placeholder="{{ __('messages.Name') }}">
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
                <input class="form-input" type="text" name="cif_freight" value="0">
            </div>

            <div class="group">
                <label class="form-label" for="allow_quotation">{{ __('messages.Allow quote') }}?</label>

                <div class="form-select">
                    <select name="allow_quotation">
                        <option value="N">{{ __('messages.No') }}</option>
                        <option value="Y">{{ __('messages.Yes') }}</option>
                    </select>
                </div>
            </div>

            <div class="group">
                <label class="form-label" for="allow_product_report">{{ __('messages.Allow product report') }}?</label>
                
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