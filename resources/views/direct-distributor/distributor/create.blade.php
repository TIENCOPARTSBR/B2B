@extends('layouts.direct-distributor')
@section('content')
    <section class="page">
        <ul class="breadcrumb">
            <li><a href="{{ url('/') }}">{{ __('messages.Home') }}</a> &nbsp/</li>
            <li><a href="{{ url('/distribuidor') }}">&nbsp {{ __('messages.Distributor') }}</a></li>
            <li class="active">&nbsp / &nbsp {{ __('messages.New') }}</li>
        </ul>

        <h1 class="title">{{ __('messages.Distributor') }}</h1>

        <div class="card tab-content">
            <form   class="tab-header mb-0" 
                    method="POST" 
                    action="{{route('distributor.store')}}">
                
                    @csrf @method('POST')

                <div class="group col-12">
                    <label  for="name" 
                            class="form-label" >{{ __('messages.Name') }}</label>

                    <input  type="text" 
                            name="name" 
                            placeholder="{{ __('messages.Name') }}" 
                            class="form-input" 
                            value="{{old('name')}}">
                </div>
                
                <div class="group col-lg-4">
                    <label for="is_active">Status</label>

                    <div class="form-select">
                        <select name="is_active">
                            <option value="1">{{ __('messages.Active') }}</option>
                            <option value="0">{{ __('messages.Inactive') }}</option>
                        </select>
                    </div>
                </div>

                <div class="group col-lg-4">
                    <label  for="name" 
                            class="form-label" >{{ __('messages.Allow product reporting') }}</label>

                    <div class="form-select">
                        <select name="allow_product_report">
                            <option value="1">{{ __('messages.Yes') }}</option>
                            <option value="0">{{ __('messages.No') }}</option>
                        </select>
                    </div>
                </div>

                <div class="group col-lg-4">
                    <label  for="name" 
                            class="form-label" >{{ __('messages.Allow quotation') }}</label>

                    <div class="form-select">
                        <select name="allow_quotation">
                            <option value="1">{{ __('messages.Yes') }}</option>
                            <option value="0">{{ __('messages.No') }}</option>
                        </select>
                    </div>
                </div>

                <div class="group col-lg-4">
                    <label  for="name" 
                            class="form-label" >{{ __('messages.CIF freight') }}</label>

                    <input  type="text" 
                            name="cif_freight" 
                            placeholder="{{ __('messages.CIF freight') }}" 
                            class="form-input" 
                            value="{{ !empty(old('cif_freight')) ? old('cif_freight') : '0'}}">
                </div>
                
                <div class="group col-lg-4">
                    <label  for="name" 
                            class="form-label" >{{ __('messages.General update') }}</label>

                    <div class="form-select">
                        <select name="profit_margin_option" >
                            <option value="PERCENTAGE">{{ __('messages.Percentage') }}</option>
                            <option value="UNIT_PRICE">{{ __('messages.Unit price') }}</option>
                        </select>
                    </div>
                </div>

                <div class="group col-lg-4">
                    <label  for="name" 
                            class="form-label" >{{ __('messages.Value') }}</label>

                    <input  type="text" 
                            name="profit_margin_value" 
                            placeholder="{{ __('messages.Value') }}" 
                            class="form-input" 
                            value="{{ !empty(old('profit_margin_value')) ? old('profit_margin_value') : '0'}}">
                </div>
                
                <input  type="submit" 
                        class="button-yellow-1 button-small mt-1" 
                        value="{{ __('messages.Save') }}">
            </form>
        </div>
    </section>
@endsection