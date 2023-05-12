@extends('layouts.DirectDistributor')
@section('content')
    <section class="users">
        <h1>{{ __('messages.Users') }}</h1>
        <ul class="breadcrumb">
            <li><a href="{{ url('/') }}">{{ __('messages.Home') }}</a> &nbsp/</li>
            <li><a href="{{ url('/distribuidor') }}">&nbsp {{ __('messages.Users') }}</a></li>
            <li class="active">&nbsp/ {{ __('messages.New') }}</li>
        </ul>

        @if ($user)
            <form class="card-form" method="POST" action="{{ url('/distribuidor/usuarios/editar') }}">
                @csrf
                @method('POST')
                <input type="hidden" name="id" value="{{ $user->id }}">
                <input type="hidden" name="id_distributor" value="{{ $user->id_distributor }}">

                <div class="group">
                    <label for="name" class="form-label">{{ __('messages.Name') }}</label>
                    <input type="text" class="form-control" name="name" required value="{{$user->name}}">
                </div>
    
                <div class="group">
                    <label for="mail" class="form-label">E-mail</label>
                    <input type="text" class="form-control" name="mail" required value="{{$user->mail}}">
                </div>
    
                <div class="group">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" name="password" placeholder="{{ __('messages.Password') }}">
                </div>

                <div class="group">
                    <label for="password" class="form-label">Confirmed password</label>
                    <input type="password" class="form-control" name="password" placeholder="{{ __('messages.Password') }}">
                </div>
                
                <div class="form-radius">
                    <h2>Status</h2>
                    <label>
                        <input type="radio" name="is_active" value="1" {{ $user['is_active'] == 1 ? 'checked' : '' }}>
                        <span>{{ __('messages.Active') }}</span>
                    </label>
                    <label>
                        <input type="radio" name="is_active" value="0" {{ $user['is_active'] == 0 ? 'checked' : '' }}>
                        <span>{{ __('messages.Inactive') }}</span>
                    </label>
                </div>
    
                <div class="row">
                    <input type="submit" class="button-yellow-1" value="{{ __('messages.Save') }}">
                </div>
            </form>
        @endif
    </section>
@endsection