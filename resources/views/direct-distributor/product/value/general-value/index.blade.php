@extends('layouts.direct-distributor')

@section('content')
    <section class="page">
        <!-- Title -->
        <h1 class="title">{{__('messages.Update products')}}</h1>

        <!-- Card -->            
        <div class="card">
            <div class="tab-nav">
                <a href="{{route('direct.distributor.product.value.general.value.index')}}" class="tab-link active" type="button">
                    {{__('messages.General update')}}
                </a>

                <a href="{{route('direct.distributor.product.value.unitary.index')}}" class="tab-link" type="button">
                    {{__('messages.Unitary')}}
                </a>

                <a href="{{route('direct.distributor.product.value.import.index')}}" class="tab-link" type="button">
                    {{__('messages.Via spreadsheet')}}
                </a>
            </div>

            <div class="tab-content">
                <!-- geral -->
                <div class="tab-pane show" id="nav-geral">
                    <form method="POST" action="{{ route('direct.distributor.product.value.general.value.store') }}" class="tab-header mb-0">
                        @csrf @method('POST')
                        <div class="col-lg-6 mb-1 mb-lg-0">
                            <div class="form-select">
                                <select name="option_general_value" required >
                                    @if ($general->option_general_value == '')
                                        <option selected>{{ __('messages.Select') }}</option>
                                    @endif
                                    <option value="PERCENTAGE" {{ $general->option_general_value == "PERCENTAGE" ? 'selected' : '' }}>{{ __('messages.Percentage') }}</option>
                                    <option value="UNIT_PRICE" {{ $general->option_general_value == "UNIT_PRICE" ? 'selected' : '' }}>{{ __('messages.Unit price') }}</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-6 mb-1 mb-lg-0">
                            <input type="text" class="form-control" name="general_value" value="{{ $general->general_value }}">
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