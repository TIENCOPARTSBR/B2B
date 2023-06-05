@extends('layouts.admin')

@section('content')
    <section class="page">
        <ul class="breadcrumb">
            <li><a href="{{route('admin.index')}}">{{ __('messages.Home') }}</a> &nbsp/</li>
            <li><a href="{{route('admin.user.index')}}">&nbsp {{ __('messages.Users') }}</a></li>
        </ul>

        <h1 class="title">{{ __('messages.Add user') }}</h1>
            
        <form class="card tab-content" method="POST" action="{{ route('admin.user.store') }}">
            @csrf
            @method('POST')
            <div class="group">
                <label for="name" class="form-label" >{{ __('messages.Name') }}</label>
                <input required type="text" name="name" placeholder="{{ __('messages.Name') }}" class="form-control" value="{{old('name')}}">
            </div>

            <div class="group">
                <label for="mail" class="form-label" >E-mail</label>
                <input required type="mail" name="mail" placeholder="E-mail" class="form-control" value="{{old('mail')}}">
            </div>

            <div class="group">
                <label for="password" class="form-label" >Password</label>
                <input required type="password" name="password" placeholder="{{ __('messages.Password') }}" class="form-control" minlength="8">
            </div>

            <div class="group">
                <label for="password" class="form-label">Confirmed password</label>
                <input required type="password" name="password_confirmation" placeholder="{{ __('messages.Password') }}" class="form-control" minlength="8">
            </div>

            <div class="group">
                <label for="is_active" class="form-label">Status</label>
                
                <div class="form-select">
                    <select name="is_active">
                        <option value="1">{{ __('messages.Active') }}</option>
                        <option value="0">{{ __('messages.Inactive') }}</option>
                    </select>
                </div>
            </div>

            <div class="row">
                <input class="button-yellow-1" type="submit" value="Cadastrar">
            </div>
        </form>
    </section>
@endsection