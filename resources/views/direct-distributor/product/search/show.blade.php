@extends('layouts.direct-distributor')
@section('content')
    <section class="page">
        <h2 class="title">{{ __('messages.Product list') }}</h2>

        <form action="{{ route('direct.distributor.product.show') }}" method="POST" class="form-product">
            @csrf
            @method('POST')
            <input type="text" name="part_number" required min="3" placeholder="{{__('messages.Enter code')}}">

            <button type="submit">
                <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="8" cy="8" r="7" stroke-width="2"/>
                    <path d="M17 17L13 13" stroke-width="2" stroke-linecap="round"/>
                </svg>
            </button>
        </form>

        <div class="listing-product">
            @if($product)
                @foreach ($product as $product)
                    <div class="card-product">
                        <div class="column">
                            <ul>
                                <li>
                                    <h2>
                                        {{ $product->part_number }} -
                                        {{ $product->description }}
                                    </h2>
                                </li>
                                <li><strong>{{__('messages.Encoparts BR price')}}:</strong> {{$product->custo_liquido_br}}</li>
                                <li><strong>{{__('messages.Encoparts USA Price')}}:</strong> {{$product->custo_liquido_eua}}</li>
                                <li><strong>{{__('messages.Weight')}}:</strong> {{$product->peso}} kg</li>
                                <li><strong>NCM:</strong> {{$product->ncm}} | <strong>HS Code:</strong> {{$product->hscode}}</li>
                                <li><strong>{{__('messages.Supply location')}}:</strong></li>
                                <li><strong>&nbsp &nbsp &nbsp &nbsp • BR</strong>  | {{__('messages.Stock quantity')}}: {{$product->saldo_br}} | Lead time: {{$product->lead_time_br}}</li>
                                <li><strong>&nbsp &nbsp &nbsp &nbsp • EUA</strong>  | {{__('messages.Stock quantity')}}: {{$product->saldo_eua}} | Lead time: {{$product->lead_time_eua}}</li>
                            </ul>
                        </div>

                        <div class="column mt-1">
                            @isset ($product->product_photo[0])
                                <a data-fslightbox="image-{{$product->part_number}}" class="button-yellow-1 button-small" href="{{Storage::url('images/'.$product->product_photo[0]->filename)}}">
                                    {{__('messages.View image')}}
                                </a>
                            @endisset
                        </div>
                    </div>
                @endforeach
            @else
                <p class="warning">{{__('messages.Product not found')}}</p>
            @endif
        </div>
    </section>
@endsection