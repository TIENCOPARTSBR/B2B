@extends('layouts.admin')
@section('content')
    <section class="page">
        <ul class="breadcrumb">
            <li><a href="/admin">{{ __('messages.Home') }}</a> &nbsp/</li>
            <li class="active">&nbsp {{ __('messages.Users') }}</li>
        </ul>

        <h1 class="title">{{ __('messages.Users') }} | {{$distributor['name']}}</h1>

        <div class="card">
            <div class="tab-content">
                <div class="tab-header">
                    <form class="form-search" action="{{route('admin.user.show')}}" method="POST">
                        @csrf
                        @method('POST')
                        <input type="hidden" name="id" value="{{$distributor->id}}">
                        <input type="text" name="name" placeholder="{{ __('messages.Search') }}" class="form-control">

                        <button type="submit"></button>
                    </form>

                    <a href="{{route('admin.direct.distributor.user.create', $distributor['id']) }}" class="button-yellow-1">{{ __('messages.Add user')}}</a>
                </div>

                <div class="card-body">
                    <div class="table">
                        <div class="thead">
                            <div class="th">{{ __('messages.Name') }}</div>
                            <div class="th">{{ __('messages.Email') }}</div>
                            <div class="th">{{ __('messages.Action') }}</div>
                        </div>
                        @if($user)
                        @foreach ($user as $user)
                            <div class="tbody">
                                <div class="td">{{ $user->name }}</div>
                                <div class="td">{{ $user->mail }}</div>
                                <div class="td">
                                    <div class="table-button">
                                        <a href="{{route('admin.direct.distributor.user.edit', $user->id)}}" data-button="edit" >
                                            <span class="tooltip">{{__('messages.Edit')}}</span>
                                        </a>

                                        <button type="button" data-trigger="delete" onclick="triggerModal('{{route('admin.direct.distributor.user.destroy')}}',' {{$user->id}}')" >
                                            <span class="tooltip">{{__('messages.Delete')}}</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection