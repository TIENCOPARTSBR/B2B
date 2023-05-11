@extends('layouts.DirectDistributor')
@section('content')
    <section class="products">
        <h2 class="titleClient mb-1">{{ __('messages.Product list') }}</h2>

        <form class="mb-2" action="{{ url('/produto') }}" method="POST">
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

        @foreach ($product as $product)
            <div class="card listing mb-2">
                <div class="column">
                    <ul>
                        <li>
                            <h2>
                                {{ $product->part_number }} -
                                {{ $product->descricao }}
                            </h2>
                        </li>
                        <li><strong>{{__('messages.Price Encoparts BR')}}:</strong> $ <?= $product->saldo_br ?></li>
                        <li><strong>{{__('messages.Encoparts USA Price')}}:</strong> $ <?= $product->saldo_eua ?></li>
                        <li><strong>{{__('messages.Weight')}}:</strong> <?= $product->peso ?> kg</li>
                        <li><strong>NCM:</strong> <?= $product->ncm ?> | <strong>HS Code:</strong> <?= $product->hscode ?></li>
                        <li><strong>{{__('messages.Supply location')}}:</strong></li>
                    </ul>
                </div>

                <div class="column">
                    <div class="image">
                        <img src="https://b2b.encoparts.com//app-assets/images/logo/encoparts_c.png" alt="">
                    </div>
                </div>
            </div>
        @endforeach
    </section>
@endsection