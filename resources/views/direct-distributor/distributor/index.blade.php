@extends('layouts.direct-distributor')

@section('content')
    @if($distributor)
        <section class="page">
            <!-- breadcrumb -->
            <ul class="breadcrumb">
                <li><a href="/">{{ __('messages.Home') }}</a> &nbsp/</li>
                <li class="active">&nbsp {{ __('messages.Distributors') }}</li>
            </ul>

            <!-- Title -->
            <h1 class="title">{{ Helper::getDirectDistributorLogged()->name }} | {{__('messages.Distributors')}}</h1>

            <!-- Card -->        
            <div class="card">
                <div class="tab-content">                    
                    <!-- header -->
                    <div class="tab-header">
                        <!-- search -->
                        <form method="POST" action="{{ url('/distribuidor') }}/" class="form-search" >
                            @csrf @method('POST')
                            <input type="text" name="name" placeholder="{{ __('messages.Search') }}" class="form-control" >
        
                            <button type="submit"></button>
                        </form>
                        
                        <!-- add row -->
                        <a href="{{ route('direct.distributor.distributor.create') }}" class="button-yellow-1" >
                            {{ __('messages.Add Distributor') }}
                        </a>
                    </div>

                    <!-- table -->
                    <div class="table">
                        <!-- thead -->
                        <div class="thead">
                            <div class="th">{{__('messages.Name')}}</div>
                            <div class="th">Status</div>
                            <div class="th"></div>
                        </div>

                        <!-- list -->
                        @foreach ($distributor as $distributor)
                            <div class="tbody">
                                <div class="td">
                                    <input type="text" value="{{trim($distributor->name)}}" class="form-input" readonly >
                                </div>

                                <div class="td">
                                    <input type="text" value="{{$distributor->is_active == 1 ? __('messages.Active') : __('messages.Inactive') }}" class="form-input" readonly >
                                </div>

                                <div class="td">
                                    <div class="table-button">
                                        <a href="{{ route('direct.distributor.distributor.product.value.general.value.index', $distributor->id) }}" data-button="product" >
                                            <span class="tooltip">{{__('messages.Update products')}}</span>
                                        </a>

                                        <a href="{{ route('direct.distributor.distributor.view', $distributor->id) }}" data-button="view" >
                                            <span class="tooltip">{{__('messages.View')}}</span>
                                        </a>

                                        <a href="{{ route('direct.distributor.distributor.edit', $distributor->id) }}" data-button="edit" >
                                            <span class="tooltip">{{__('messages.Edit')}}</span>
                                        </a>

                                        <button type="button" data-trigger="delete" onclick="triggerModal('{{route('direct.distributor.distributor.destroy')}}',' {{$distributor->id}}')" >
                                            <span class="tooltip">{{__('messages.Delete')}}</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>    
        </section>
    @endif
@endsection