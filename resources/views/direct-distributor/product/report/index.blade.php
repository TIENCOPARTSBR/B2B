@extends('layouts.DirectDistributor')
@section('content')
    <section class="page">
        <h1 class="title">{{ __('messages.Product report') }}</h1>

        <a href="{{route('direct.distributor.product.report.export')}}" class="button-yellow-1 button-small">Download</a>
    </section>
@endsection