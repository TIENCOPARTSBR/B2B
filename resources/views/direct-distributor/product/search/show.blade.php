@extends('layouts.DirectDistributor')
@section('content')
    <section class="page">
        <h2 class="title">{{ __('messages.Product list') }}</h2>

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

        <div class="listing-product">
            @foreach ($product as $product)
                <div class="card-product">
                    <div class="column">
                        <ul>
                            <li>
                                <h2>
                                    {{ $product->part_number }} -
                                    {{ $product->descricao }}
                                </h2>
                            </li>
                            <li><strong>{{__('messages.Price Encoparts BR')}}:</strong> {{$product->custo_liquido_br}}</li>
                            <li><strong>{{__('messages.Encoparts USA Price')}}:</strong> {{$product->custo_liquido_eua}}</li>
                            <li><strong>{{__('messages.Weight')}}:</strong> {{$product->peso}} kg</li>
                            <li><strong>NCM:</strong> {{$product->ncm}} | <strong>HS Code:</strong> {{$product->hscode}}</li>
                            <li><strong>{{__('messages.Supply location')}}:</strong></li>
                            <li><strong>&nbsp &nbsp &nbsp &nbsp • BR</strong>  | Quantidade em estoque: {{$product->saldo_br}} | Lead time: {{$product->lead_time_br}}</li>
                            <li><strong>&nbsp &nbsp &nbsp &nbsp • EUA</strong>  | Quantidade em estoque: {{$product->saldo_eua}} | Lead time: {{$product->lead_time_eua}}</li>
                        </ul>
                    </div>

                    <div class="column">
                        <div class="image">
                            @empty ($product->product_photo)
                                <img src="https://b2b.encoparts.com//app-assets/images/logo/encoparts_c.png" alt="">
                            @endempty
                            @isset ($product->product_photo)
                                <img src="{{Storage::url('images/'.$product->product_photo[0]->filename)}}" alt="">
                            @endisset
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
@endsection