@extends('layouts.DirectDistributor')

@section('content')
    <section class="page">
        <!-- Title -->
        <h1 class="title">{{ __('messages.Distributor') }} | {{ Auth::guard('distributor')->user()->name; }}</h1>

        <!-- Card -->            
        <div class="card">
            <div class="tab-nav">
                <a href="" class="tab-link"> {{__('messages.Profile')}} </a>
                <a href="" class="tab-link active"> {{__('messages.Users')}} </a>
                <a href="" class="tab-link"> {{__('messages.Update products')}} </a>
            </div>

            <div class="tab-content">
                <!-- user -->
                <div class="tab-pane show" id="nav-user">
                    <!-- header -->
                    <div class="tab-header">
                        <!-- search -->
                        <form action="{{route('direct.distributor.distributor.user.create')}}" class="form-search" >
                            @csrf
                            @method('POST')
                            <input type="text" name="part_number" placeholder="{{ __('messages.Type the code') }}" class="form-control" >

                            <button type="submit"></button>
                        </form>
                        
                        <!-- add row -->
                        <a href="{{url('/distribuidor/usuarios/novo')}}" class="button-yellow-1 button-small" >
                            {{__('messages.Add')}}
                        </a>
                    </div>

                    <!-- table -->
                    <div class="table">
                        <!-- thead -->
                        <div class="thead">
                            <div class="th">{{__('messages.Name')}}</div>
                            <div class="th">{{__('messages.Email')}}</div>
                            <div class="th"></div>
                        </div>
                        
                        <!-- list -->
                        @foreach ($user_distributor as $user_distributor)
                            <div class="tbody">
                                <div class="td">
                                    <input type="text" name="name" value="{{trim($user_distributor->name)}}" class="form-input" readonly >
                                </div>

                                <div class="td">
                                    <input type="text" name="mail" value="{{trim($user_distributor->mail)}}" class="form-input on-change" disabled >
                                </div>

                                <div class="td">
                                    <div class="table-button">
                                        <form method="get" action="{{url('/distribuidor/usuarios/editar')}}/{{$user_distributor->id}}">
                                            @csrf
                                            <button type="button" data-button="edit"></button>
                                        </form>
                                        <button type="button" data-trigger="delete" onclick="triggerModal('/distribuidor/usuarios/excluir', {{$user_distributor->id}})" ></button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    {{-- $user->links() --}}
                </div>
            </div>
        </div>
    </section>
@endsection