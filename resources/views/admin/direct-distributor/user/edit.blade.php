@extends('layouts.admin')

@section('content')
    <section class="page">
        <ul class="breadcrumb">
            <li><a href="/admin">{{ __('messages.Home') }}</a> &nbsp/</li>
            <li> &nbsp &nbsp<a href="{{route('admin.direct.distributor.user.index', $user->direct_distributor_id)}}">{{ __('messages.Users') }}</a></li>
        </ul>

        <h1 class="title">{{ __('messages.User') }}</h1>

        <form class="card tab-content" method="POST" action="{{ route('admin.direct.distributor.user.updated') }}">
            @csrf
            @method('POST')
            <input type="hidden" name="id" value="{{ $user->id }}">
            <input type="hidden" name="direct_distributor_id" value="{{ $user->direct_distributor_id }}">

            <div class="group">
                <label for="name" class="form-label">{{ __('messages.Name') }}</label>
                <input type="text" name="name" required value="{{ $user->name }}" class="form-control">
            </div>

            <div class="group">
                <label for="mail" class="form-label">E-mail</label>
                <input type="text" name="mail" required value="{{ $user->mail }}" class="form-control">
            </div>

            <div class="group">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" placeholder="{{ __('messages.New password') }}" class="form-control">
            </div>

            <div class="group">
                <label for="password" class="form-label">Confirmed password</label>
                <input type="password" name="password" placeholder="{{ __('messages.New password') }}" class="form-control">
            </div>

            <div class="group">
                <label for="is_active" class="form-label">Status</label>
                
                <div class="form-select">
                    <select name="is_active">
                        <option value="1" {{ $user->is_active == '1' ? 'Selected' : '' }}>{{ __('messages.Active') }}</option>
                        <option value="0" {{ $user->is_active == '0' ? 'Selected' : '' }}>{{ __('messages.Inactive') }}</option>
                    </select>
                </div>
            </div>

            <div class="group">
                <label for="type" class="form-label" >{{__('messages.User Type')}}:</label>
    
                <div class="form-select">
                    <select name="type" >
                        <option value="U" {{ $user->is_active == 'U' ? 'Selected' : '' }}>{{ __('messages.User') }}</option>
                        <option value="A" {{ $user->is_active == 'A' ? 'Selected' : '' }}>{{ __('messages.Administrator') }}</option>
                    </select>
                </div>
            </div>

            <div class="row">
                <input class="button-yellow-1" type="submit" value="Atualizar">
            </div>
        </form>
    </section>
@endsection