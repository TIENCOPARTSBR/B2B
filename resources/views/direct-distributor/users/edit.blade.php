@extends('layouts.DirectDistributor')
@section('content')
    <section class="users">
        <h1>{{ __('messages.Users') }}</h1>
        <ul class="breadcrumb">
            <li><a href="{{ url('') }}">{{ __('messages.Home') }}</a> &nbsp/</li>
            <li><a href="{{ url('/usuarios') }}">&nbsp {{ __('messages.Users') }}</a></li>
            <li class="active"> &nbsp / {{ __('messages.New') }}</li>
        </ul>

        @if ($user)
            <form class="card-form" method="POST" action="{{ url('/usuarios/editar') }}">
                @csrf
                @method('POST')
                <input type="hidden" name="id" value="{{ $user->id }}">

                <div class="group">
                    <label for="name" class="form-label" >{{ __('messages.Name') }}</label>
                    <input type="text" name="name" value="{{ $user->name }}" class="form-control" required >
                </div>
    
                <div class="group">
                    <label for="mail" class="form-label" >E-mail</label>
                    <input type="text" name="mail" value="{{ $user->mail }}" class="form-control" required>
                </div>
    
                <div class="group">
                    <label for="type" class="form-label" >{{__('messages.User Type')}}</label>
    
                    <div class="form-select">
                        <select name="type" required >
                            <option value="A" {{ $user->type === 'A' ? 'selected' : '' }} >{{ __('messages.Administrator') }}</option>
                            <option value="U" {{ $user->type === 'U' ? 'selected' : '' }} >{{ __('messages.User') }}</option>
                        </select>
                    </div>
                </div>
                
                <div class="group">
                    <label for="is_active" class="form-label" >Status</label>
    
                    <div class="form-select">
                        <select name="is_active" required >
                            <option value="1" {{ $user->is_active === '1' ? 'selected' : '' }} >{{ __('messages.Active') }}</option>
                            <option value="0" {{ $user->is_active === '0' ? 'selected' : '' }}>{{ __('messages.Inactive') }}</option>
                        </select>
                    </div>
                </div>
                
                <div class="group">
                    <label for="password" class="form-label" >Password</label>
                    <input type="password" name="password" placeholder="{{ __('messages.New password') }}" class="form-control" >
                </div>

                <div class="group">
                    <label for="password" class="form-label" >Confirmed password</label>
                    <input type="password" name="password" placeholder="{{ __('messages.New password') }}" class="form-control" >
                </div>

                <input type="submit" class="button-yellow-1" value="{{ __('messages.Update') }}">
            </form>
        @endif
    </section>
@endsection