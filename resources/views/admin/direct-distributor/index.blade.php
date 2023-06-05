@extends('layouts.admin')
@section('content')
    <section class="page">
        <ul class="breadcrumb">
            <li><a href="/admin">{{ __('messages.Home') }}</a> &nbsp/</li>
            <li class="active">&nbsp {{ __('messages.Distributors') }}</li>
        </ul>

        <h1 class="title">{{ __('messages.Distributors') }}</h1>

        <div class="card">
            <div class="tab-content">
                <div class="tab-header">
                    <form class="form-search" action="{{ route('admin.direct.distributor.show') }}" method="POST">
                        @csrf
                        @method('POST')
                        <input type="text" name="name" class="form-control" placeholder="{{ __('messages.Search') }}">

                        <button type="submit"></button>
                    </form>

                    <a href="{{route('admin.direct.distributor.create')}}" class="button-yellow-1 button-add">{{ __('messages.Add company') }}</a>
                </div>

                <div class="card-body">
                    <div class="table">
                        <div class="thead">
                            <div class="th">{{__('messages.Distributors')}} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
                            <div class="th">{{__('messages.Action')}} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
                        </div>
                        @if($distributor)
                            @foreach ($distributor as $distributor)
                                <div class="tbody">
                                    <div class="td">
                                        <input type="text" value="{{trim($distributor->name)}}" class="form-input" readonly >
                                    </div>

                                    <div class="td">
                                        <div class="table-button">
                                            <a href="{{route('admin.direct.distributor.user.index', $distributor->id)}}" data-button="user" >
                                                <span class="tooltip">{{__('messages.User')}}</span>
                                            </a>

                                            <a href="{{route('admin.direct.distributor.edit', $distributor->id)}}" data-button="edit" >
                                                <span class="tooltip">{{__('messages.Edit')}}</span>
                                            </a>
    
                                            <button type="button" data-trigger="delete" onclick="triggerModal('{{route('admin.direct.distributor.destroy')}}',' {{$distributor->id}}')" >
                                                <span class="tooltip">{{__('messages.Delete')}}</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </d>
                </div>
            </div>
        </div>
    </section>
@endsection