@extends('layouts.direct-distributor')

@section('content')
    <section class="page">
        <h1 class="title">{{ __('messages.Welcome').', '.Helper::getDirectDistributorLogged()->name; }}!<br></h1>
    </section>
@endsection