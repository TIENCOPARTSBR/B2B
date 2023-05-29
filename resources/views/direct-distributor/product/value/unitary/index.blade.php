@extends('layouts.direct-distributor')

@section('content')
    @if($type)
        <section class="page">
            <!-- Title -->
            <h1 class="title">{{__('messages.Update products')}}</h1>

            <!-- Card -->            
            <div class="card">
                <div class="tab-nav">
                    <a href="{{route('direct.distributor.product.value.general.value.index')}}" class="tab-link" type="button">
                        {{__('messages.General update')}}
                    </a>

                    <a href="{{route('direct.distributor.product.value.unitary.index')}}" class="tab-link active" type="button">
                        {{__('messages.Unitary')}}
                    </a>

                    <a href="{{route('direct.distributor.product.value.import.index')}}" class="tab-link" type="button">
                        {{__('messages.Via spreadsheet')}}
                    </a>
                </div>

                <div class="tab-content">
                    <!-- unit -->
                    <div class="tab-pane show" id="nav-unitary">
                        <!-- header -->
                        <div class="tab-header">
                            <!-- search -->
                            <form method="POST" action="{{ route('direct.distributor.product.value.unitary.show') }}" class="form-search">
                                @csrf @method('POST')
                                <input type="text" name="part_number" placeholder="{{ __('messages.Type the code') }}" class="form-control">
            
                                <button type="submit"></button>
                            </form>
                            
                            <!-- add row -->
                            <button type="button" class="button-yellow-1 button-small" data-form="add">
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
                            <form method="POST" action="{{route('direct.distributor.product.value.unitary.store')}}" class="tbody d-none @error('product_value') d-table-row @enderror @error('part_number') d-table-row @enderror" data-form="new">
                                @csrf
                                @method('POST')
                                <div class="td">
                                    <input type="text" name="part_number" placeholder="{{__('messages.Part number')}}" class="form-input" value="{{old('part_number')}}">
                                </div>

                                <div class="td">
                                    <input type="text" name="product_value" placeholder="{{__('messages.Type the value')}}" class="form-input" value="{{old('product_value')}}">
                                </div>

                                <div class="td">
                                    <div class="form-select">
                                        <select name="value_type">
                                            <option value="PERCENTAGE" {{ !empty(old('value_type')) ? 'selected' : ''}}>{{ __('messages.Percentage') }}</option>
                                            <option value="UNIT_PRICE" {{ !empty(old('value_type')) ? 'selected' : ''}}>{{ __('messages.Unit price') }}</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="td">
                                    <div class="table-button">
                                        <button type="submit" data-trigger="save"></button>
                                        <button type="button" data-trigger="close"></button>
                                    </div>
                                </div>
                            </form>

                            <!-- list -->
                            @foreach ($type as $key => $item)
                                <form method="POST" action="{{route('direct.distributor.product.value.unitary.updated')}}" class="tbody" id="form-{{$key}}">
                                    @csrf @method('POST')
                                    <!-- required input -->
                                    <input type="hidden" name="id" value="{{$item->id}}">

                                    <div class="td">
                                        <input type="text" name="part_number" value="{{trim($item->part_number)}}" class="form-input" readonly>
                                    </div>

                                    <div class="td">
                                        <input type="text" name="product_value" value="{{trim($item->product_value)}}" class="form-input on-change" disabled>
                                    </div>

                                    <div class="td">
                                        <div class="form-select on-change disabled">
                                            <select name="value_type" disabled>
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
                                            <button type="button" data-trigger="edit" data-form="#form-{{$key}}"></button>
                                            <button type="submit" data-trigger="save" class="d-none"></button></button>
                                            <button type="button" data-trigger="delete" onclick="triggerModal('{{route('direct.distributor.product.value.unitary.destroy')}}', '{{$item->id}}')"></button>
                                        </div>
                                    </div>
                                </form>
                            @endforeach
                        </div>
                        {{ $type->links() }}
                    </div>
                </div>
            </div>
        </section>
    @endif
@endsection