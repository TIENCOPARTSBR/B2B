@extends('layouts.admin')

@section('content')
    <section class="users">
        <h1 class="titleClient">{{ __('messages.Add user') }}</h1>
            
        <form class="card-form" method="POST" action="{{ url('/admin/usuarios/novo') }}">
            @csrf
            @method('POST')
            <div class="group">
                <label for="name" class="form-label" >{{ __('messages.Name') }}</label>
                <input type="text" name="name" placeholder="{{ __('messages.Name') }}" class="form-control" required >
            </div>

            <div class="group">
                <label for="mail" class="form-label" >E-mail</label>
                <input type="text" name="mail" placeholder="E-mail" class="form-control" required >
            </div>

            <div class="group">
                <label for="password" class="form-label" >Password</label>
                <input type="password" name="password" placeholder="{{ __('messages.Password') }}" class="form-control" required >
            </div>

            <div class="group">
                <label for="password" class="form-label">Confirmed password</label>
                <input type="password" name="password" placeholder="{{ __('messages.Password') }}" class="form-control">
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