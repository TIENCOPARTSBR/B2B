@extends('layouts.DirectDistributor')

@section('content')
    <section class="home">
        <h1>{{ Helper::getDirectDistributorLogged()->name; }}<br></h1>
        <p>{{ __('messages.User') }}: {{ Auth::guard('distributor')->user()->mail }}</p>
    </section>
@endsection