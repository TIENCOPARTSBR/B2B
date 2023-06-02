@extends('layouts.direct-distributor')

@section('content')
    <section class="home">
        <h1>{{ Helper::getDirectDistributorLogged()->name; }}<br></h1>
    </section>
@endsection