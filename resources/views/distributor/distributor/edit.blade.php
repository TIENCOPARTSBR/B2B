@extends('layouts.DirectDistributor')
@section('content')
    <section class="page">
        <ul class="breadcrumb">
            <li><a href="{{ url('/') }}">{{ __('messages.Home') }}</a> &nbsp/</li>
            <li><a href="{{ url('/distribuidor') }}">&nbsp {{ __('messages.Distributor') }}</a></li>
            <li class="active"> &nbsp / {{ __('messages.New') }}</li>
        </ul>

        <h1 class="title">{{ __('messages.Distributor') }}</h1>

        @if($distributor)
            <div class="card tab-content">
                <form class="tab-header mb-0" method="POST" action="{{ route('distributor.updated') }}">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" value="{{ $distributor->id }}">
                    
                    <div class="group col-12">
                        <label for="name" class="form-label" >{{ __('messages.Name') }}</label>
                        <input type="text" name="name" value="{{ $distributor->name }}" class="form-input">
                    </div>
                    
                    <div class="group col-lg-4 mb-1">
                        <label for="is_active">Status</label>
    
                        <div class="form-select">
                            <select name="is_active">
                                <option value="1" {{ $distributor->is_active == 1 ? 'selected' : '' }} >{{ __('messages.Active') }}</option>
                                <option value="0" {{ $distributor->is_active == 0 ? 'selected' : '' }} >{{ __('messages.Inactive') }}</option>
                            </select>
                        </div>
                    </div>
    
                    <div class="group col-lg-4 mb-1">
                        <label for="name" class="form-label" >{{ __('messages.Allow product reporting') }}</label>
                        <div class="form-select">
                            <select name="allow_product_report">
                                <option value="1" {{ $distributor->allow_product_report == 1 ? 'selected' : '' }} >{{ __('messages.Yes') }}</option>
                                <option value="0" {{ $distributor->allow_product_report == 0 ? 'selected' : '' }} >{{ __('messages.No') }}</option>
                            </select>
                        </div>
                    </div>
    
                    <div class="group col-lg-4 mb-1">
                        <label for="name" class="form-label" >{{ __('messages.Allow quotation') }}</label>
                        <div class="form-select">
                            <select name="allow_quotation">
                                <option value="1" {{ $distributor->allow_quotation == 1 ? 'selected' : '' }} >{{ __('messages.Yes') }}</option>
                                <option value="0" {{ $distributor->allow_quotation == 0 ? 'selected' : '' }} >{{ __('messages.No') }}</option>
                            </select>
                        </div>
                    </div>
    
                    <div class="group col-lg-4 mb-1">
                        <label for="name" class="form-label" >{{ __('messages.CIF freight') }}</label>
                        <input type="text" name="cif_freight" value="{{ $distributor->cif_freight }}" class="form-input" >
                    </div>
                    
                    <div class="group col-lg-4 mb-1">
                        <label for="name" class="form-label" >{{ __('messages.General update') }}</label>
                        <div class="form-select">
                            <select name="profit_margin_option" >
                                <option value="PERCENTAGE" {{ $distributor->allow_quotation == 'PERCENTAGE' ? 'selected' : '' }}>{{ __('messages.Percentage') }}</option>
                                <option value="UNIT_PRICE" {{ $distributor->allow_quotation == 'UNIT_PRICE' ? 'selected' : '' }}>{{ __('messages.Unit price') }}</option>
                            </select>
                        </div>
                    </div>
    
                    <div class="group col-lg-4">
                        <label for="name" class="form-label" >{{ __('messages.Value') }}</label>
                        <input type="text" name="profit_margin_value" value="{{ $distributor->profit_margin_value }}" class="form-input" >
                    </div>
                    
                    <input type="submit" class="button-yellow-1 button-small" value="{{ __('messages.Update') }}">
                </form>
            </div>
        @endif
    </section>
@endsection