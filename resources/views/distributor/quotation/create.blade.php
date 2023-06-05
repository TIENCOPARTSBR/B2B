@extends('layouts.distributor')

@section('content')
    <section class="page">
        <h1 class="title">{{ __('messages.Quotes') }}</h1>

        <div class="steps">
            <div class="box">
                <div class="box-number active">1</div>
                <p class="box-text active">{{__('messages.Register quote')}}</p>
            </div>

            <div class="box">
                <div class="box-number">2</div>
                <p class="box-text">{{__('messages.Add products to quote')}}</p>
            </div>
        </div>

        <form method="POST" action="{{route('distributor.quotation.store')}}" class="card-quotation">
            @csrf
            @method('POST')
            <div class="group mb-1">
                <input type="hidden" name="status" value="A">
                <label for="name" class="form-label">{{__('messages.Urgent quote')}}:</label>
                <div class="check-box">
                    <input type="checkbox" name="urgent">
                </div>
            </div>

            <div class="group mb-1">
                <label for="name" class="form-label">{{__('messages.Customer name')}}:</label>
                <input type="text" name="customer_name" class="form-input">
            </div>

            <div class="group mb-1">
                <label for="name" class="form-label">{{__('messages.Quote requester')}}:</label>
                <input type="text" name="requester_quotation" class="form-input">
            </div>

            <div class="group mb-1">
                <label for="name" class="form-label">{{__('messages.Quote type')}}:</label>
                <div class="form-select">
                    <select name="quotation_type">
                        <option value="S">SPOT</option>
                        <option value="C">Contrato</option>
                    </select>
                </div>
            </div>
            
            <div class="group mb-1">
                <label for="name" class="form-label">{{__('messages.Response date')}}:</label>
                <input type="date" name="reply_date" class="form-input">
            </div>

            <div class="group" mb-1">
                <label for="name" class="form-label">{{__('messages.General remarks')}}:</label>
                <textarea type="text" name="general_obsevation" class="form-input" style="height: 100px"></textarea>
            </div>

            <div class="col-12">
                <input type="submit" value="{{__('messages.Next')}}" class="button-yellow-1 button-small">
            </div>
        </form>
    </section>
@endsection