@extends('layouts.DirectDistributor')

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

                    <button class="tab-link" data-tab="#nav-user" type="button">
                        {{__('messages.Users')}}
                    </button>

                    <button class="tab-link" data-tab="#nav-product" type="button">
                        {{__('messages.Update products')}}
                    </button>
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

                    <!-- user -->
                    <div class="tab-pane {{ session('selected') == 'product' ? show : ''  }}" id="nav-user">
                        <!-- header -->
                        <div class="tab-header">
                            <!-- search -->
                            <form action="{{ url('/produto/valor') }}/" class="form-search" >
                                @csrf @method('POST')
                                <input type="text" name="part_number" placeholder="{{ __('messages.Type the code') }}" class="form-control" >

                                <button type="submit"></button>
                            </form>
                            
                            <!-- add row -->
                            <a href="{{ url('/distribuidor/usuarios/novo') }}/{{$distributor->id}}" class="button-yellow-1 button-small" >
                                {{__('messages.Add')}}
                            </a>
                        </div>

                        <!-- table -->
                        <div class="table">
                            <!-- thead -->
                            <div class="thead">
                                <div class="th">{{__('messages.Name')}}</div>
                                <div class="th">{{__('messages.Email')}}</div>
                                <div class="th"></div>
                            </div>
                           
                            <!-- list -->
                            @foreach ($user as $user)
                                <div class="tbody">
                                    <div class="td">
                                        <input type="text" name="name" value="{{trim($user->name)}}" class="form-input" readonly >
                                    </div>
    
                                    <div class="td">
                                        <input type="text" name="mail" value="{{trim($user->mail)}}" class="form-input on-change" disabled >
                                    </div>
    
                                    <div class="td">
                                        <div class="table-button">
                                            <form method="get" action="{{url('/distribuidor/usuarios/editar')}}/{{$user->id}}">
                                                @csrf
                                                <button type="button" data-button="edit"></button>
                                            </form>
                                            <button type="button" data-trigger="delete" onclick="triggerModal('/distribuidor/usuarios/excluir', {{$user->id}})" ></button>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        {{-- $user->links() --}}
                    </div>

                    <!-- unit -->
                    <div class="tab-pane {{ session('selected') == 'product' ? show : ''  }}" id="nav-product">
                        <!-- header -->
                        <div class="tab-header">
                            <!-- search -->
                            <form action="{{ url('/distribuidor/produto/valor') }}/" method="POST" class="form-search" >
                                @csrf @method('POST')
                                <input type="hidden" name="id_distributor" value="{{$distributor->id}}">
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
                            <form method="POST" action="{{url('/distribuidor/produto/valor/unitario/adicionar')}}" class="tbody d-none @error('product_value') d-table-row @enderror" data-form="new">
                                @csrf
                                @method('POST')
                                <input type="hidden" name="id_distributor" value="{{$distributor->id}}">

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
                                <form method="POST" action="{{url('/distribuidor/produto/valor/unitario/atualizar')}}" class="tbody" id="form-{{$key}}">
                                    @csrf @method('POST')
                                    <!-- required input -->
                                    <input type="hidden" name="id" value="{{$item->id}}">
                                    <input type="hidden" name="id_distributor" value="{{$distributor->id}}">

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
                                            <button type="button" data-trigger="delete" onclick="triggerModal('/distribuidor/produto/valor/unitario/excluir', {{$item->id}})" ></button>
                                        </div>
                                    </div>
                                </form>
                            @endforeach
                        </div>
                        {{-- {{ $type->links() }} --}}
                    </div>
                </div>
            </div>
        </section>
    @endif
@endsection