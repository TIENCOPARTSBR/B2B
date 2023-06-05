@extends('layouts.direct-distributor')

@section('content')
    <section class="page">
        <h1 class="title">{{ __('messages.Hi').', '.Helper::getDirectDistributorLogged()->name; }}!<br></h1>
    </section>
@endsection