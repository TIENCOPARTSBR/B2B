@extends('layouts.DirectDistributor')
@section('content')
    <section class="page">
        <h2 class="title">{{ __('messages.Search product') }}</h2>

        <form action="{{ route('direct.distributor.product.show') }}" method="POST" class="form-product">
            @csrf
            @method('POST')
            <input type="text" name="part_number" placeholder="{{__('messages.Type the code')}}">

            <button type="submit">
                <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="8" cy="8" r="7" stroke-width="2"/>
                    <path d="M17 17L13 13" stroke-width="2" stroke-linecap="round"/>
                </svg>
            </button>
        </form>
    </section>
@endsection