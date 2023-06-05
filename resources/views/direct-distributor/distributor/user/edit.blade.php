@extends('layouts.direct-distributor')

@section('content')
    <section class="page">
        <!-- breadcrumb -->
        <ul class="breadcrumb">
            <li><a href="/">{{ __('messages.Home') }}</a> &nbsp/</li>
            <li><a href="{{ url('/usuarios') }}">&nbsp {{ __('messages.Users') }}</a></li>
            <li class="active">&nbsp&nbsp / &nbsp{{ __('messages.New') }}</li>
        </ul>

        <!-- Title -->
        <h1 class="title">{{__('messages.Users')}}</h1>

        <!-- Card -->        
        <div class="card tab-content">
            <form class="row justify-between" method="POST" action="{{ route('direct.distributor.distributor.user.updated') }}">
                @csrf @method('POST')
                <div class="col-lg-6 mb-1">
                    <input type="hidden" name="id" value="{{$user->id}}">
                    <label for="name" class="form-label" >{{ __('messages.Name') }}</label>
                    <input type="text" name="name" class="form-control @error('name') form-invalid @enderror" value="{{ !empty(old('name')) ? old('name') : $user['name'] }}">
                </div>
    
                <div class="col-lg-6 mb-1">
                    <label for="mail" class="form-label" >Email</label>
                    <input type="text" name="mail" class="form-control @error('mail') form-invalid @enderror" value="{{ !empty(old('mail')) ? old('mail') : $user['mail'] }}">
                </div>
    
                <div class="col-lg-6 mb-1">
                    <label for="is_active" class="form-label" >Status</label>
    
                    <div class="form-select">
                        <select name="is_active">
                            <option value="1" {{ $user['is_active'] === '1' ? 'selected' : '' }} >{{ __('messages.Active') }}</option>
                            <option value="0" {{ $user['is_active'] === '0' ? 'selected' : '' }}>{{ __('messages.Inactive') }}</option>
                        </select>
                    </div>
                </div>
    
                <div class="col-lg-6 mb-1">
                    <label for="type" class="form-label" >{{__('messages.User Type')}}:</label>
    
                    <div class="form-select">
                        <select name="type">
                            <option value="A" {{ $user['type'] === 'A' ? 'selected' : '' }} >{{ __('messages.Administrator') }}</option>
                            <option value="U" {{ $user['type'] === 'U' ? 'selected' : '' }} >{{ __('messages.User') }}</option>
                        </select>
                    </div>
                </div>
    
                <div class="col-lg-6 mb-1">
                    <label for="password" class="form-label" >Password</label>
                    <input type="password" name="password" placeholder="{{ __('messages.Password') }}" class="form-control @error('password') form-invalid @enderror" value="{{ !empty(old('password')) ? old('password') : '' }}">
                </div>
    
                <div class="col-lg-6 mb-1">
                    <label for="password" class="form-label" >Confirmed password</label>
                    <input type="password" name="password_confirmation" placeholder="{{ __('messages.Password') }}" class="form-control @error('password') form-invalid @enderror" value="{{ !empty(old('password_confirmation')) ? old('password_confirmation') : '' }}">
                </div>
    
                <input type="submit" class="button-yellow-1 button-small" value="{{ __('messages.Save') }}">
            </form>
        </div>    
    </section>
@endsection