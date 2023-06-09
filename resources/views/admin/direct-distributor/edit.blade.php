@extends('layouts.admin')
@section('content')
    <section class="page">

        <ul class="breadcrumb">
            <li><a href="{{route('admin.index')}}">{{ __('messages.Home') }}</a> &nbsp/</li>
            <li><a href="{{route('admin.direct.distributor.index')}}">&nbsp {{ __('messages.Distributors') }}</a></li>
            <li class="active"> &nbsp / {{ __('messages.New') }}</li>
        </ul>

        <h1 class="title">{{ __('messages.Distributors') }}</h1>

        @if($distributor)
            <form class="card tab-content" method="POST" action="{{route('admin.direct.distributor.updated')}}">
                @csrf   
                @method('POST')

                <input type="hidden" name="id" value="{{ $distributor->id }}">

                <div class="group">
                    <label for="name" class="form-label">{{ __('messages.Name') }}</label>
                    <input class="form-control" type="text" name="name" required value="{{ $distributor->name }}">
                </div>
                
                <div class="group">
                    <label for="is_active" class="form-label" >Status</label>
                    <div class="form-select">
                        <select name="is_active">
                            <option value="A" {{ $distributor->is_active == 'A' ? 'Selected' : ''}}>{{ __('messages.Active') }}</option>
                            <option value="I" {{ $distributor->is_active == 'I' ? 'Selected' : ''}}>{{ __('messages.Inactive') }}</option>
                        </select>
                    </div>
                </div>

                <div class="group">
                    <label for="cifFreight" class="form-label">{{ __('messages.CIF freight') }}&nbsp(%)</label>
                    <input class="form-control" type="text" name="cif_freight" value="{{ $distributor->cifFreight == '' ? '0' : $distributor->cif_freight }}">
                </div>

                <div class="group">
                    <label for="allowQuotation" class="form-label">{{ __('messages.Allow quote') }}?</label>

                    <div class="form-select">
                        <select name="allow_quotation">
                            <option value="N" {{ $distributor->allow_quotation == 'N' ? 'Selected' : '' }}>{{ __('messages.No') }}</option>
                            <option value="Y" {{ $distributor->allow_quotation == 'Y' ? 'Selected' : '' }}>{{ __('messages.Yes') }}</option>
                        </select>
                    </div>
                </div>

                <div class="group">
                    <label for="allow_product_report" class="form-label">{{ __('messages.Allow product report') }}?</label>
                    
                    <div class="form-select">
                        <select name="allow_product_report">
                            <option value="N" {{ $distributor->allow_product_report == 'N' ? 'Selected' : '' }}>{{ __('messages.No') }}</option>
                            <option value="Y" {{ $distributor->allow_product_report == 'Y' ? 'Selected' : '' }}>{{ __('messages.Yes') }}</option>
                        </select>
                    </div>
                </div>
    
                <div class="row">
                    <input class="button-yellow-1" type="submit" value="{{ __('messages.Save') }}">
                </div>
            </form>
        @endif
    </section>
@endsection