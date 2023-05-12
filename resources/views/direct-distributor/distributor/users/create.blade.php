@extends('layouts.DirectDistributor')
@section('content')
    <section class="section">
        <h1>{{ __('messages.Users') }} | {{ Helper::getDirectDistributorLogged()->name; }}</h1>

        <ul class="breadcrumb">
            <li><a href="{{ url('/') }}">{{ __('messages.Home') }}</a> &nbsp/</li>
            <li><a href="{{ url('/distribuidor') }}">&nbsp {{ __('messages.Users') }}</a></li>
            <li class="active">&nbsp/ {{ __('messages.New') }}</li>
        </ul>

        <form class="card-form" method="POST" action="{{ url('/distribuidor/usuarios/novo') }}">
            @csrf
            @method('POST')

            <input type="hidden" name="id_distributor" value="{{$idDirectDistributor}}">

            <div class="group">
                <label for="name" class="form-label">{{ __('messages.Name') }}</label>
                <input type="text" class="form-control" name="name" required placeholder="{{ __('messages.Name') }}">
            </div>

            <div class="group">
                <label for="mail" class="form-label">E-mail</label>
                <input type="text" class="form-control validate-mail" name="mail" required placeholder="info@encoparts.com">
            </div>

            <div class="group">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" name="password" required placeholder="{{ __('messages.Password') }}">
            </div>

            <div class="group">
                <label for="password" class="form-label">Confirmed password</label>
                <input type="password" class="form-control" name="password" required placeholder="{{ __('messages.Password') }}">
            </div>
            
            <div class="form-radius">
                <h2>Status</h2>
                <label>
                    <input type="radio" name="is_active" value="1" required>
                    <span for="is_active" class="form-label">{{ __('messages.Active') }}</span>
                </label>
                <label>
                    <input type="radio" name="is_active" value="0">
                    <span for="is_active" class="form-label">{{ __('messages.Inactive') }}</span>
                </label>
            </div>

            <div class="row">
                <input type="submit" class="button-yellow-1" value="{{ __('messages.Save') }}">
            </div>
        </form>
    </section>
@endsection