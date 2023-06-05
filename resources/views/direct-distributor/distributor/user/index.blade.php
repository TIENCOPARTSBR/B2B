@extends('layouts.direct-distributor')

@section('content')
    @if($distributor)
        <section class="page">
            <!-- Title -->
            <h1 class="title">{{ __('messages.Distributor') }} | {{ $distributor->name }}</h1>

            <!-- Card -->            
            <div class="card">
                <div class="tab-nav">
                    <a href="{{route('direct.distributor.distributor.view', $distributor->id)}}" class="tab-link" data-tab="#nav-profile" type="button">
                        {{__('messages.Profile')}}
                    </a>

                    <button class="tab-link active" data-tab="#nav-user" type="button">
                        {{__('messages.Users')}}
                    </button>
                </div>

                <div class="tab-content">
                    <!-- user -->
                    <div class="tab-pane show" id="nav-user">
                        <!-- header -->
                        <div class="tab-header">
                            <!-- search -->
                            <form action="{{ url('/produto/valor') }}/" class="form-search" >
                                @csrf @method('POST')
                                <input type="text" name="part_number" placeholder="{{ __('messages.Enter code') }}" class="form-control" >

                                <button type="submit"></button>
                            </form>
                            
                            <!-- add row -->
                            <a href="{{route('direct.distributor.distributor.user.create', $distributor->id)}}" class="button-yellow-1 button-add" >
                                {{__('messages.Add')}}
                            </a>
                        </div>

                        <!-- table -->
                        <div class="table table-small">
                            <!-- thead -->
                            <div class="thead">
                                <div class="th">{{__('messages.Name')}} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
                                <div class="th">{{__('messages.Email')}} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
                                <div class="th"></div>
                            </div>
                           
                            <!-- list -->
                            @foreach ($user as $user)
                                <div class="tbody">
                                    <div class="td">
                                        <input type="text" name="name" value="{{trim($user->name)}}" class="form-input" readonly >
                                    </div>
    
                                    <div class="td">
                                        <input type="text" name="mail" value="{{trim($user->mail)}}" class="form-input on-change" disabled >
                                    </div>
    
                                    <div class="td">
                                        <div class="table-button">
                                            <a href="{{route('direct.distributor.distributor.user.edit', $user->id)}}" type="button" data-button="edit"></a>
                                            <button type="button" data-trigger="delete" onclick="triggerModal('{{route('direct.distributor.distributor.user.destroy')}}', {{$user->id}})" ></button>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif
@endsection