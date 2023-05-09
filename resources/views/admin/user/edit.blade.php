@extends('layouts.admin')

@section('content')
    <section class="users">
        <h1 class="titleClient">{{ __('messages.User') }}</h1>

        <form class="card-form" method="POST" action="{{ url('/admin/usuarios/editar') }}">
            @csrf
            @method('POST')
            <input type="hidden" name="id" value="{{ $user->id }}">

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

            <div class="row">
                <input class="button-yellow-1" type="submit" value="Atualizar">
            </div>
        </form>
    </section>
@endsection