@extends('layouts.direct-distributor')

@section('content')
    <section class="page">
        <!-- breadcrumb -->
        <ul class="breadcrumb">
            <li><a href="/">{{ __('messages.Home') }}</a> &nbsp/</li>
            <li>&nbsp <a href="{{route('direct.distributor.quotation.index')}}">{{ __('messages.Quotes') }}</a></li>
            <li class="active">&nbsp / &nbsp{{$quotation->customer_name}}</li>
        </ul>

        <h1 class="title">{{ __('messages.Quotes') }}</h1>

        <div class="steps">
            <div class="box">
                <div class="box-number active">1</div>
                <p class="box-text active">{{__('messages.Register quote')}}</p>
            </div>
        </div>

        <form method="POST" action="{{route('direct.distributor.quotation.updated')}}" class="card-quotation">
            @csrf
            @method('POST')
            <div class="group mb-1">
                <input type="hidden" name="id" value="{{$quotation->id}}">
                <input type="hidden" name="status" value="{{$quotation->status}}" {{ $quotation->status === 'S' ? 'readonly' : '' }}>
                <label for="name" class="form-label">{{__('messages.Urgent quote')}}:</label>
                <div class="check-box">
                    <input type="checkbox" name="urgent" {{ $quotation->urgent == 1 ? 'checked' : '' }} {{ $quotation->status === 'S' ? 'disabled' : '' }}>
                </div>
            </div>

            <div class="group mb-1">
                <label for="name" class="form-label">{{__('messages.Customer name')}}:</label>
                <input type="text" name="customer_name" class="form-input" value="{{$quotation->customer_name}}" {{ $quotation->status === 'S' ? 'readonly' : '' }}>
            </div>

            <div class="group mb-1">
                <label for="name" class="form-label">{{__('messages.Quote requester')}}:</label>
                <input type="text" name="requester_quotation" class="form-input" value="{{$quotation->requester_quotation}}" {{ $quotation->status === 'S' ? 'readonly' : '' }} >
            </div>

            <div class="group mb-1">
                <label for="name" class="form-label">{{__('messages.Quote type')}}:</label>
                <div class="form-select">
                    <select name="quotation_type"  {{ $quotation->status === 'S' ? 'disabled' : '' }}>
                        <option value="S" {{ $quotation->quotation_type === "S" ? 'selected' : '' }}>SPOT</option>
                        <option value="C" {{ $quotation->quotation_type === "C" ? 'selected' : '' }}>Contrato</option>
                    </select>
                </div>
            </div>
            
            <div class="group mb-1">
                <label for="name" class="form-label">{{__('messages.Response date')}}:</label>
                <input type="date" name="reply_date" class="form-input" value="{{$quotation->reply_date}}"{{ $quotation->status === 'S' ? 'readonly' : '' }}>
            </div>

            <div class="group" mb-1">
                <label for="name" class="form-label">{{__('messages.General remarks')}}:</label>
                <textarea type="text" name="general_observation" {{ $quotation->status === 'S' ? 'readonly' : '' }} class="form-input" style="height: 100px" value="{{ $quotation->general_observation }}">{{ $quotation->general_observation }}</textarea>
            </div>

            <div class="col-12">
                <input type="submit" value="{{__('messages.Next')}}" class="button-yellow-1 button-small">
            </div>
        </form>   
    </section>
@endsection