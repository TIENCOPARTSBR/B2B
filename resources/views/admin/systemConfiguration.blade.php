@extends('layouts.admin')

@section('content')
    <section class="adm">
        <h1 class="titleClient">{{__('messages.Settings')}}</h1>

        <form action="/admin/config" method="POST" class="card-form">
            @csrf
            @method('POST')
            <label for="receipt_quotation_email" class="form-label">{{__('messages.Quotations receipt e-mail')}}</label>
            <input type="text" class="form-control mb-2" placeholder="b2b@encoparts.com" name="receipt_quotation_email" value="{{ Helper::getSystemConfigurationKeyName('receipt_quotation_email')[0]['value']; }}">
            <input type="submit" value="Enviar" class="button-yellow-1 button-small">
        </form>
    </section>
@endsection