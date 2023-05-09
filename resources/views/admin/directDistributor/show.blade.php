@extends('layouts.admin')
@section('content')
    <section class="distributors">
        <h1 class="titleClient">{{ __('messages.Distributors') }}</h1>

        <ul class="breadcrumb">
            <li><a href="/admin">{{ __('messages.Home') }}</a> &nbsp/</li>
            <li class="active">&nbsp {{ __('messages.Distributors') }}</li>
        </ul>

        <div class="card">
            <div class="card-header">
                <form class="search" action="{{ url('/admin/distribuidor') }}/" method="POST">
                    @csrf
                    @method('POST')
                    <input type="text" name="name" placeholder="{{ __('messages.Search') }}">

                    <button type="submit">
                        <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="7" cy="7" r="6" stroke="#222222"/>
                            <path d="M16 16L13 13" stroke="#222222" stroke-linecap="round"/>
                        </svg>
                    </button>
                </form>

                <a href="{{ url('/admin/distribuidor/novo') }}" class="buttonYellow">{{ __('messages.Add company') }}</a>
            </div>

            <div class="card-body">
                <table class="table">
                    <thead>
                        <th width="70%" class="title">{{ __('messages.Distributors') }}</th>
                    </thead>
                    <tbody>
                        @if($distributor)
                            @foreach ($distributor as $item)
                                <tr>
                                    <td>
                                        <form action="{{ url('/admin/distribuidor/editar') }}/{{ $item->id }}/" method="GET">
                                            <button type="submit" class="link">{{ $item->name }}</button>
                                        </form>

                                        <div class="actions">
                                            <form action="{{ url('/admin/distribuidor/editar') }}/{{ $item->id }}/" method="GET">
                                                <button type="submit">{{ __('messages.Edit') }}</button>
                                            </form>
        
                                            <button class="delete" onclick="triggerModal({{$item->id}})">{{ __('messages.Delete') }}</button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <p>{{ __('messages.Not Found') }}</p>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </section>
    
    <div class="modal" id="delete">
        <div class="modal-overlay"></div>
        <div class="modal-content">
            <form action="{{ url('/admin/distribuidor/excluir') }}/" method="GET">
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