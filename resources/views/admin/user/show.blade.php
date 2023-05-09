@extends('layouts.admin')
@section('content')
    <section class="distributors">
        <h1 class="titleClient">{{ __('messages.Admin users') }}</h1>

        <ul class="breadcrumb">
            <li><a href="/admin">{{ __('messages.Home') }}</a> &nbsp/</li>
            <li class="active">&nbsp {{ __('messages.Admin users') }}</li>
        </ul>

        <div class="card">
            <div class="card-header">
                <form class="search" action="{{ url('/admin/usuarios') }}/" method="POST">
                    @csrf
                    @method('POST')
                    <input type="text" name="name" placeholder="{{ __('messages.Search') }}" class="form-control" >

                    <button type="submit">
                        <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="7" cy="7" r="6" stroke="#222222"/>
                            <path d="M16 16L13 13" stroke="#222222" stroke-linecap="round"/>
                        </svg>
                    </button>
                </form>

                <a href="{{ url('/admin/usuarios/novo') }}" class="buttonYellow">{{ __('messages.Add user') }}</a>
            </div>

            <div class="card-body">
                <table class="table">
                    <thead>
                        <th>{{ __('messages.Name') }}</th>
                        <th>{{ __('messages.Email') }}</th>
                    </thead>
                    <tbody>
                        @if($user)
                            @foreach ($user as $item)
                                <tr>
                                    <td>
                                        {{ $item->name }}
                                        <div class="actions">
                                            <form action="{{ url('/admin/usuarios/editar') }}/{{ $item->id }}/" method="GET">
                                                <button type="submit">{{ __('messages.Edit') }}</button>
                                            </form>
        
                                            <button class="delete" onclick="triggerModal({{$item->id}})">{{ __('messages.Delete') }}</button>
                                        </div>
                                    </td>
                                    <td>{{ $item->mail }}</td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <div class="modal" id="delete">
        <div class="modal-overlay"></div>
        <div class="modal-content">
            <form action="{{ url('/admin/usuarios/excluir') }}/" method="GET">
                @method('GET')
                @csrf 
                <div class="modal-header">
                    <h2>{{ __('messages.Are you sure you want to delete?') }}</h2>
                    <span class="close-modal"></span>
                </div>

                <hr>

                <div class="close buttonClose">
                    {{ __('messages.No') }}
                </div>

                <button type="submit" class="buttonYes">
                    {{ __("messages.Yes, I'm sure.") }}
                </button>
            </form>
        </div>
    </div>
@endsection