@extends('layouts.DirectDistributor')

@section('content')
    <section class="page">
        <h1 class="title">{{ __('messages.Quotations') }}</h1>

        <div class="steps">
            <div class="box">
                <div class="box-number">1</div>
                <p class="box-text">{{__('messages.Register quotation')}}</p>
            </div>

            <div class="box">
                <div class="box-number active">2</div>
                <p class="box-text active">{{__('messages.Add products to quotation')}}</p>
            </div>
        </div>

        <div class="tab-pane show">
            <div class="tab-header">
                <button type="button" class="button-yellow-1 button-small" data-form="add" >
                    {{__('messages.Add')}}
                </button>
            </div>

            <table id="tableQuotation" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>Part number</th>
                        <th>{{__('messages.Description')}}</th>
                        <th>{{__('messages.Encoparts price')}}</th>
                        <th>{{__('messages.Quantity')}}</th>
                        <th>Total</th>
                        <th>{{__('messages.Weight')}}</th>
                        <th>NCM</th>
                        <th>Hs code</th>
                        <th>{{__('messages.Product already sold')}}</th>
                        <th>{{__('messages.Supply location')}}</th>
                        <th>{{__('messages.Quantity in stock')}}</th>
                        <th>{{__('messages.Lead time')}}</th>
                        <th>{{__('messages.Photo')}}</th>
                    </tr>
                </thead>
                <tbody align="left">
                {{-- @foreach ($productSisrev as $key => $item)
                    @isset ($item[0])
                        <tr>
                            <th>{{$item[0]['part_number']}}</th>
                            <th>{{$item[0]['saldo_br']}}</th>
                            <th>{{$item[0]['peso']}}</th>
                        </tr>
                    @endisset
                @endforeach --}}
                </tbody>
            </table>
          
        </div>        
    </section>
@endsection

@section('endBody')
    <script>
        $(document).ready(function () {
            $('#tableQuotation').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{route('direct.distributor.quotation.datatable', $id)}}",
                columns: [
                    {data: 'id'},
                    {data: 'product_sisrev[].description'},
                    {data: 'product_sisrev[].saldo_br'},         
                    {data: 'quantity'},         
                    {data: 'product_sisrev[].custo_liquido'},         
                    {data: 'product_sisrev[].peso'},         
                    {data: 'product_sisrev[].local_fornecimento'},         
                    {data: 'product_sisrev[].minimum_quantity_order'},         
                    {data: 'product_sisrev[].lead_time'},         
                    {data: 'product_sisrev[].ncm'},         
                    {data: 'product_sisrev[].hscode'},         
                ]
            });
        });
    </script>
@endsection