@extends('layouts.distributor')

@section('content')
    <section class="page">
        <h1 class="title">{{ __('messages.Hi').', '.Helper::getDistributorLogged()->name; }}!<br></h1>
    </section>
@endsection