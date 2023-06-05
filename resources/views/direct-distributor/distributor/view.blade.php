@extends('layouts.direct-distributor')

@section('content')
    @if($distributor)
        <section class="page">
            <!-- Title -->
            <h1 class="title">{{ __('messages.Distributor') }} | {{ $distributor->name }}</h1>

            <!-- Card -->            
            <div class="card">
                <div class="tab-nav">
                    <button class="tab-link active" data-tab="#nav-profile" type="button">
                        {{__('messages.Profile')}}
                    </button>

                    <a href="{{route('direct.distributor.distributor.user.index', $distributor->id)}}" class="tab-link" data-tab="#nav-user" type="button">
                        {{__('messages.Users')}}
                    </a>
                </div>

                <div class="tab-content">
                    <!-- configuration -->
                    <div class="tab-pane show {{ session('selected') == 'product' ? show : '' }}" id="nav-profile">
                        <form action="{{ url('/') }}}" method="POST" class="tab-header mb-0">
                            @csrf @method('POST')
                            <div class="col-12 mb-1">
                                <label for="name" class="form-label">{{__('messages.Name')}}</label>
                                <input type="text" name="name" class="form-input" value="{{ $distributor->name }}">
                            </div>

                            <div class="col-lg-6 mb-1">
                                <label class="form-label">Status</label>

                                <div class="form-select">
                                    <select name="is_active">
                                        <option value="1" {{ $distributor->is_active === 1 ? 'selected' : '' }} >{{ __('messages.Active') }}</option>
                                        <option value="0" {{ $distributor->is_active === 0 ? 'selected' : '' }} >{{ __('messages.Inactive') }}</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-6 mb-1">
                                <label class="form-label" >{{ __('messages.Allow product reporting') }}</label>

                                <div class="form-select">
                                    <select name="allow_product_report">
                                        <option value="1" {{ $distributor->allow_product_report === 1 ? 'selected' : '' }} >{{ __('messages.Yes') }}</option>
                                        <option value="0" {{ $distributor->allow_product_report === 0 ? 'selected' : '' }} >{{ __('messages.No') }}</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="col-lg-6 mb-1">
                                <label class="form-label" >{{ __('messages.Allow quotation') }}</label>

                                <div class="form-select">
                                    <select name="allow_quotation">
                                        <option value="1" {{ $distributor->allow_quotation === 1 ? 'selected' : '' }} >{{ __('messages.Yes') }}</option>
                                        <option value="0" {{ $distributor->allow_quotation === 0 ? 'selected' : '' }} >{{ __('messages.No') }}</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-6 mb-1">
                                <label for="cif_freight" class="form-label" >{{ __('messages.CIF freight') }}</label>

                                <input type="text" name="cif_freight" value="{{ $distributor->cif_freight }}" class="form-input" >
                            </div>

                            <div class="col-lg-6 mb-1">
                                <label class="form-label" >{{ __('messages.General update') }}</label>

                                <div class="form-select">
                                    <select name="profit_margin_option">
                                        <option value="PERCENTAGE" {{ $distributor->profit_margin_option === 'PERCENTAGE' ? 'selected' : '' }} >{{ __('messages.Percentage') }}</option>
                                        <option value="UNIT_PRICE" {{ $distributor->profit_margin_option === 'UNIT_PRICE' ? 'selected' : '' }} >{{ __('messages.Unit price') }}</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-6 mb-1">
                                <label for="profit_margin_value" class="form-label" >{{ __('messages.Value') }}</label>

                                <input type="text" name="profit_margin_value" value="{{ $distributor->profit_margin_value }}" class="form-input">
                            </div>

                            <div class="col-lg-6">
                                <input type="submit" class="button-yellow-1 button-small mb-0" value="{{__('messages.Edit')}}">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    @endif
@endsection