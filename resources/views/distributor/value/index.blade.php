@extends('layouts.DirectDistributor')

@section('content')
    @if($type AND $general)
        <section class="page">
            <!-- Title -->
            <h1 class="title">{{__('messages.Update products')}}</h1>

            <!-- Card -->            
            <div class="card">
                <div class="tab-nav">
                    <button class="tab-link active" data-tab="#nav-unitary" type="button">
                        {{__('messages.Unitary')}}
                    </button>

                    <button class="tab-link" data-tab="#nav-geral" type="button">
                        {{__('messages.General update')}}
                    </button>
                </div>

                <div class="tab-content">
                    <!-- unit -->
                    <div class="tab-pane show" id="nav-unitary">
                        <!-- header -->
                        <div class="tab-header">
                            <!-- search -->
                            <form action="{{ url('/produto/valor') }}/" class="form-search" >
                                @csrf @method('POST')
                                <input type="text" name="part_number" placeholder="{{ __('messages.Type the code') }}" class="form-control" >
            
                                <button type="submit"></button>
                            </form>
                            
                            <!-- add row -->
                            <button type="button" class="button-yellow-1 button-small" data-form="add" >
                                {{__('messages.Add')}}
                            </button>
                        </div>

                        <!-- table -->
                        <div class="table">
                            <!-- thead -->
                            <div class="thead">
                                <div class="th">{{__('messages.Part number')}}</div>
                                <div class="th">{{__('messages.Value')}}</div>
                                <div class="th">{{__('messages.Option')}}</div>
                                <div class="th"></div>
                            </div>

                            <!-- add -->
                            <form method="POST" action="{{url('/produto/valor/unitario/adicionar')}}" class="tbody d-none @error('product_value') d-table-row @enderror" data-form="new">
                                @csrf
                                @method('POST')
                                <div class="td">
                                    <input type="text" name="part_number" placeholder="{{__('messages.Part number')}}" class="form-input" >
                                </div>

                                <div class="td">
                                    <input type="text" name="product_value" placeholder="{{__('messages.Type the value')}}" class="form-input" >
                                </div>

                                <div class="td">
                                    <div class="form-select">
                                        <select name="value_type" >
                                            <option value="PERCENTAGE">{{ __('messages.Percentage') }}</option>
                                            <option value="UNIT_PRICE">{{ __('messages.Unit price') }}</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="td">
                                    <div class="table-button">
                                        <button type="submit" data-trigger="save"></button>
                                        <button type="button" data-trigger="close" ></button>
                                    </div>
                                </div>
                            </form>

                            <!-- list -->
                            @foreach ($type as $key => $item)
                                <form method="POST" action="{{url('/produto/valor/unitario/atualizar')}}" class="tbody" id="form-{{$key}}">
                                    @csrf @method('POST')
                                    <!-- required input -->
                                    <input type="hidden" name="id" value="{{$item->id}}">

                                    <div class="td">
                                        <input type="text" name="part_number" value="{{trim($item->part_number)}}" class="form-input" readonly >
                                    </div>

                                    <div class="td">
                                        <input type="text" name="product_value" value="{{trim($item->product_value)}}" class="form-input on-change" disabled >
                                    </div>

                                    <div class="td">
                                        <div class="form-select on-change disabled">
                                            <select name="value_type" disabled >
                                                <option value="PERCENTAGE" {{ $item->value_type == 'PERCENTAGE' ? 'selected' : '' }}>
                                                    {{ __('messages.Percentage') }}
                                                </option>

                                                <option value="UNIT_PRICE" {{ $item->value_type == 'UNIT_PRICE' ? 'selected' : '' }}>
                                                    {{ __('messages.Unit price') }}
                                                </option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="td">
                                        <div class="table-button">
                                            <button type="button" data-trigger="edit" data-form="#form-{{$key}}" ></button>
                                            <button type="submit" data-trigger="save" class="d-none" ></button>
                                            <button type="button" data-trigger="delete" onclick="triggerModal('/produto/valor/unitario/excluir', {{$item->id}})" ></button>
                                        </div>
                                    </div>
                                </form>
                            @endforeach
                        </div>
                        {{ $type->links() }}
                    </div>

                    <!-- geral -->
                    <div class="tab-pane" id="nav-geral">
                        <form method="POST" action="{{ url('/produto/valor/geral') }}" class="tab-header" >
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
    @endif
@endsection