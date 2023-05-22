@extends('layouts.DirectDistributor')

@section('content')
    <section class="page">
        <!-- breadcrumb -->
        <ul class="breadcrumb">
            <li><a href="/">{{ __('messages.Home') }}</a> &nbsp/</li>
            <li>&nbsp <a href="{{route('direct.distributor.quotation.index')}}">{{ __('messages.Quotations') }}</a></li>
            <li class="active">&nbsp / &nbsp{{$quotation->customer_name}}</li>
        </ul>

        <h1 class="title">{{ __('messages.Quotations') }}</h1>

        <div class="steps">
            <div class="box">
                <div class="box-number active">1</div>
                <p class="box-text active">{{__('messages.Register quotation')}}</p>
            </div>
        </div>

        <form method="POST" action="{{route('direct.distributor.quotation.updated')}}" class="card-quotation">
            @csrf
            @method('POST')
            <div class="group mb-1">
                <input type="hidden" name="id" value="{{$quotation->id}}">
                <input type="hidden" name="status" value="{{$quotation->status}}">
                <label for="name" class="form-label">{{__('messages.Urgent quotation')}}:</label>
                <div class="check-box">
                    <input type="checkbox" name="urgent" {{ $quotation->urgent == 1 ? 'checked' : '' }}>
                </div>
            </div>

            <div class="group mb-1">
                <label for="name" class="form-label">{{__('messages.Customer name')}}:</label>
                <input type="text" name="customer_name" class="form-input" value="{{$quotation->customer_name}}">
            </div>

            <div class="group mb-1">
                <label for="name" class="form-label">{{__('messages.Requester for quotation')}}:</label>
                <input type="text" name="requester_quotation" class="form-input" value="{{$quotation->requester_quotation}}">
            </div>

            <div class="group mb-1">
                <label for="name" class="form-label">{{__('messages.Quotation type')}}:</label>
                <div class="form-select">
                    <select name="quotation_type">
                        <option value="S" {{ $quotation->urgent == "S" ? 'checked' : '' }}>SPOT</option>
                        <option value="C" {{ $quotation->urgent == "C" ? 'checked' : '' }}>Contrato</option>
                    </select>
                </div>
            </div>
            
            <div class="group mb-1">
                <label for="name" class="form-label">{{__('messages.Reply date')}}:</label>
                <input type="date" name="reply_date" class="form-input" value="">
            </div>

            <div class="group" mb-1">
                <label for="name" class="form-label">{{__('messages.General observations')}}:</label>
                <textarea type="text" name="general_observation" class="form-input" style="height: 100px">{{$quotation->general_observation}}</textarea>
            </div>

            <div class="col-12">
                <input type="submit" value="{{__('messages.Advance')}}" class="button-yellow-1 button-small">
            </div>
        </form>   
    </section>
@endsection