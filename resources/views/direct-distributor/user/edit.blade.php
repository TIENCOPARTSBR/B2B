@extends('layouts.DirectDistributor')
@section('content')
    <section class="page">
        <ul class="breadcrumb">
            <li><a href="{{ url('') }}">{{ __('messages.Home') }}</a> &nbsp/</li>
            <li><a href="{{ url('/usuarios') }}">&nbsp {{ __('messages.Users') }}</a></li>
            <li class="active"> &nbsp / &nbsp{{ __('messages.New') }}</li>
        </ul>

        <h1 class="title">{{ __('messages.Users') }}</h1>

        @if ($user)
            <div class="card tab-content">
                <form class="row justify-between" method="POST" action="{{ route('direct.distributor.user.updated') }}">
                    @csrf
                    @method('POST')
                    <input type="hidden" name="id" value="{{ $user->id }}">

                    <div class="group">
                        <label for="name" class="form-label" >{{ __('messages.Name') }}</label>
                        <input type="text" name="name" value="{{ !empty(old('name')) ? old('name') : $user->name }}" class="form-input" required >
                    </div>
        
                    <div class="group">
                        <label for="mail" class="form-label" >E-mail</label>
                        <input type="text" name="mail" value="{{ !empty(old('mail')) ? old('mail') : $user->mail }}" class="form-input" required>
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
                        <input type="password" name="password" placeholder="{{ __('messages.New password') }}" class="form-input" {{ !empty(old('password')) ? old('password') : '' }}>
                    </div>

                    <div class="group">
                        <label for="password" class="form-label" >Confirmed password</label>
                        <input type="password" name="password_confirmation" placeholder="{{ __('messages.New password') }}" class="form-input" {{ !empty(old('password_confirmation')) ? old('password_confirmation') : '' }}>
                    </div>

                    <input type="submit" class="button-yellow-1 button-small" value="{{ __('messages.Update') }}">
                </form>
            </div>
        @endif
    </section>
@endsection