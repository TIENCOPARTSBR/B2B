@extends('layouts.DirectDistributor')
@section('content')
    <section class="products">
        <h2 class="titleClient">{{ __('messages.Search product') }}</h2>

        <form action="{{ url('/produto') }}" method="POST">
            @csrf
            @method('POST')
            <input type="text" name="partNumber" placeholder="{{__('messages.Type the code')}}">

            <button type="submit">
                <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="8" cy="8" r="7" stroke-width="2"/>
                    <path d="M17 17L13 13" stroke-width="2" stroke-linecap="round"/>
                </svg>
            </button>
        </form>
    </section>
@endsection