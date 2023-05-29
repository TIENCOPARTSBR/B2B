@extends('layouts.admin')

@section('content')
    <section class="page">
        <h1 class="title">{{__('messages.Settings')}}</h1>

        <form action="{{route('admin.config.updated')}}" method="POST" class="card-form">
            @csrf
            @method('POST')
            <label for="key_value" class="form-label">{{__('messages.Quotations receipt e-mail')}}</label>
            <input type="text" class="form-control mb-2" placeholder="b2b@encoparts.com" name="key_value" value="{{ Helper::getSystemConfigurationKeyName('receipt_quotation_email')[0]['value']; }}">
            <input type="submit" value="Enviar" class="button-yellow-1 button-small">
        </form>
    </section>
@endsection