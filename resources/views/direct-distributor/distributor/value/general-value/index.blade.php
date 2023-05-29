@extends('layouts.direct-distributor')

@section('content')
    <section class="page">
        <!-- Title -->
        <h1 class="title">{{__('messages.Update products')}}</h1>

        <!-- Card -->            
        <div class="card">
            <div class="tab-nav">
                <a href="{{route('direct.distributor.distributor.product.value.general.value.index', $id)}}" class="tab-link active" type="button">
                    {{__('messages.General update')}}
                </a>

                <a href="{{route('direct.distributor.distributor.product.value.unitary.index', $id)}}" class="tab-link" type="button">
                    {{__('messages.Unitary')}}
                </a>

                <a href="{{route('direct.distributor.distributor.product.value.import.index', $id)}}" class="tab-link" type="button">
                    {{__('messages.Via spreadsheet')}}
                </a>
            </div>

            <div class="tab-content">
                <!-- geral -->
                <div class="tab-pane show" id="nav-geral">
                    <form method="POST" action="{{route('direct.distributor.distributor.product.value.general.value.store')}}" class="tab-header mb-0">
                        @csrf @method('POST')

                        <input type="hidden" name="id" value="{{$id}}">

                        <div class="col-lg-6 mb-1 mb-lg-0">
                            <div class="form-select">
                                <select name="profit_margin_option" required >
                                    @if ($general->profit_margin_option == '')
                                        <option selected>{{ __('messages.Select') }}</option>
                                    @endif
                                    <option value="PERCENTAGE" {{ $general->profit_margin_option == "PERCENTAGE" ? 'selected' : '' }}>{{ __('messages.Percentage') }}</option>
                                    <option value="UNIT_PRICE" {{ $general->profit_margin_option == "UNIT_PRICE" ? 'selected' : '' }}>{{ __('messages.Unit price') }}</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-6 mb-1 mb-lg-0">
                            <input type="text" class="form-control" name="profit_margin_value" value="{{ $general->profit_margin_value }}">
                        </div>

                        <div class="col-lg-6 mt-lg-1">
                            <input type="submit" value="{{__('messages.Save')}}" class="button-yellow-1 button-small">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection