@extends('layouts.DirectDistributor')

@section('content')
    @if($user)
        <section class="page">
            <!-- breadcrumb -->
            <ul class="breadcrumb">
                <li><a href="/admin">{{ __('messages.Home') }}</a> &nbsp/</li>
                <li class="active">&nbsp {{ __('messages.Users') }}</li>
            </ul>

            <!-- Title -->
            <h1 class="title">{{__('messages.Users')}}</h1>

            <!-- Card -->        
            <div class="card">
                <div class="tab-content">
                    <!-- header -->
                    <div class="tab-header">
                        <!-- search -->
                        <form method="POST" action="{{ url('/usuarios') }}/" class="form-search" >
                            @csrf @method('POST')
                            <input type="text" name="name" placeholder="{{ __('messages.Search') }}" class="form-control" >
        
                            <button type="submit"></button>
                        </form>
                        
                        <!-- add row -->
                        <a href="{{url('/usuarios/novo')}}" class="button-yellow-1 button-small" >
                            {{__('messages.Add')}}
                        </a>
                    </div>

                    <!-- table -->
                    <div class="table">
                        <!-- thead -->
                        <div class="thead">
                            <div class="th">{{__('messages.Users')}}</div>
                            <div class="th">Status</div>
                            <div class="th"></div>
                        </div>

                        <!-- list -->
                        @foreach ($user as $user)
                            <form method="POST" action="{{url('/produto/valor/unitario/atualizar')}}" class="tbody">
                                @csrf @method('POST')

                                <div class="td">
                                    <input type="text" value="{{trim($user->name)}}" class="form-input" readonly >
                                </div>

                                <div class="td">
                                    <input type="text" value="{{trim($user->is_active)}}" class="form-input" readonly >
                                </div>

                                <div class="td">
                                    <div class="table-button">
                                        <a href="{{ url('/usuarios/editar') }}/{{ $user->id }}/" data-button="edit" ></a>
                                        <button type="button" data-trigger="delete" onclick="triggerModal('/usuarios/excluir', {{$user->id}})" ></button>
                                    </div>
                                </div>
                            </form>
                        @endforeach
                    </div>
                </div>
            </div>    
        </section>
    @endif
@endsection