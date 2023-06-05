@extends('layouts.direct-distributor')

@section('content')
    <div id="spinner">
        <span class="throbber-loader">Loading&#8230;</span>
    </div>

    <section class="page">
        <h1 class="title">{{ __('messages.Quotations') }}</h1>

        <div class="steps">
            <div class="box">
                <div class="box-number active">2</div>
                <p class="box-text active">{{__('messages.Add products to quotation')}}</p>
            </div>
        </div>

        @if (str_contains(strtoupper($status['status']), 'A'))
            <div class="tab-nav mb-1 px-0">
                <button class="tab-link quotation active" data-tab="#nav-search" type="button">
                    {{__('messages.Search product')}}
                </button>

                <button class="tab-link quotation" data-tab="#nav-excel" type="button">
                    Upload Excel
                </button>
            </div>    

            <div class="tab-pane show mt-2" id="nav-search">
                <div class="tab-header mb-0">
                    @component('component.quotation.add-product-quotation', ['id' => $id])
                    @endcomponent
                </div>
            </div>

            <div class="tab-pane" id="nav-excel">
                <form action="{{ route('direct.distributor.quotation.product.import') }}" class="tab-header" id="form_import" enctype="multipart/form-data">
                    @csrf @method('POST')
                    <div class="col-12 mb-1">
                        <div class="file-drop-area">
                            <span class="fake-btn">{{__('messages.Choose files')}}</span>
                            <span class="file-msg">{{__('messages.or drag and drop files here')}}</span>
                            <input class="file-input" type="file" name="excel" id="excel">
                            <input type="hidden" name="quotation_id" value="{{$id}}">
                        </div>
                    </div>

                    <div class="col-12">
                        <input  type="submit" 
                                value="{{__('messages.Import')}}" 
                                class="button-yellow-1 button-small">
                    </div>
                </form>
            </div> 

            <div class="form-quotation">
                <ul class="listing-product">
                </ul>
            </div>
        @endif

        <table id="tableQuotation" class="display nowrap hover row-borde stripe" style="width: 100%">
            <thead width="100%">
                <tr>
                    <th>Part number</th>
                    <th>{{__('messages.Description')}}</th>
                    <th>{{__('messages.Encoparts price')}}</th>
                    <th>{{__('messages.Distributor Price')}}</th>
                    <th>Qtty</th>
                    <th>Total</th>
                    <th>{{__('messages.Weight')}}</th>
                    <th>NCM</th>
                    <th>Hs code</th>
                    <th>{{__('messages.Supply location')}}</th>
                    <th>{{__('messages.Quantity in stock')}}</th>
                    <th>{{__('messages.Lead time')}}</th>
                    <th>{{__('messages.Photo')}}</th>
                    <th>{{__('messages.Edit')}}</th>
                </tr>
            </thead>
            <tbody align="left" width="100%"></tbody>
        </table>
        @if (str_contains(strtoupper($status['status']), 'A'))
            <a href="{{route('direct.distributor.quotation.send', $id)}}" class="button-yellow-1 button-send">Enviar cotação</a>
        @endif
    </section>
@endsection

@section('endBody')
    <script async>
        // datatable
        $("#spinner").hide();

        $('#tableQuotation').DataTable({
            autoWidth: true,
            processing: true,
            serverSide: true,
            deferRender: true,
            ajax: "{{route('direct.distributor.quotation.datatable', $id)}}",
            columns: [
                {name: 'part_number', data: 'part_number'},
                {name: 'description', data: 'description'},
                {name: 'custo_liquido_original', data: 'custo_liquido_original'},
                {name: 'custo_liquido', data: 'custo_liquido'},
                {name: 'quantity', data: 'quantity'},
                {name: 'total', data: 'total'},
                {name: 'weight', data: 'weight'},
                {name: 'ncm', data: 'ncm'},
                {name: 'hscode', data: 'hscode'},
                {name: 'local_fornecimento', data: 'local_fornecimento'},
                {name: 'saldo', data: 'saldo'},
                {name: 'lead_time', data: 'lead_time'},
                {name: 'photo', data: 'photo', 
                    render: function( data, type, full, meta ) {
                        return '<a href="'+ data +'" target="blank" data-fslightbox="gallery"><svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0 8C0 4.22876 0 2.34315 1.17157 1.17157C2.34315 0 4.22876 0 8 0H10C13.7712 0 15.6569 0 16.8284 1.17157C18 2.34315 18 4.22876 18 8V10C18 13.7712 18 15.6569 16.8284 16.8284C15.6569 18 13.7712 18 10 18H8C4.22876 18 2.34315 18 1.17157 16.8284C0 15.6569 0 13.7712 0 10V8Z" fill="#7E869E" fill-opacity="0.25"/><circle cx="14" cy="4" r="1" fill="#222222"/><circle cx="9" cy="9" r="3" fill="#222222"/></svg></a>';
                    }
                },
                {name: 'edit', data: 'edit'},
            ]
        });

        $('#form_import').submit(function(event) 
        {
            // Evita que o formulário faça seu envio padrão
            event.preventDefault();

            // Instância o FormData passando como parâmetro o formulário
            var formulario = document.getElementById('form_import');
            var formData = new FormData(formulario);
            
            // action
            var action = $(this).attr('action');

            $.ajax({  
                url: action,
                type: "POST",
                data: formData,
                dataType: 'json',
                processData: false,  
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                beforeSend: function() {
                    $("#spinner").show();
                },
                success: function (response) {
                    $("#spinner").hide();

                    $('#tableQuotation').DataTable().ajax.reload();

                    $('.listing-product').append(JSON.parse(response));

                    $('.card-product').on('submit', function(event) {
                        event.preventDefault();
                        
                        var formData = new FormData($('.card-product')[0]);

                        $.ajax({
                            url: "{{route('direct.distributor.quotation.product.add')}}",
                            type: "POST",
                            data: formData,
                            dataType: 'json',
                            processData: false,  
                            contentType: false,
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function (response) {
                                $('#tableQuotation').DataTable().ajax.reload();
                            }
                        })
                        $(this).remove();
                    });

                    $("[data-modal=close]").on('click', function(){
                        $(this).parent().remove();
                    });

                    $('#excel').val('');
                },
                error: function (error) {
                    console.log(error.responseText);
                }
            })
        }); 

        $('.button-send').on('click', function() {
            $("#spinner").show();
        });

        $('#form-quotation').on('submit', function(event) {
            event.preventDefault();
            var part_number = $('#part_number').val();

            if(part_number.length >= 3) {
                // Instância o FormData passando como parâmetro o formulário
                var formulario = document.getElementById('form-quotation');
                var formData = new FormData(formulario);

                $.ajax({
                    url: "{{route('direct.distributor.quotation.product')}}",
                    type: "POST",
                    data: formData,
                    dataType: 'json',
                    processData: false,  
                    contentType: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (response) {
                        $('.listing-product').append(JSON.parse(response));

                        $('#part_number').val('');

                        $('.card-product').on('submit', function(event) {
                            event.preventDefault();
                            var formData = new FormData($('.card-product')[0]);
                            $.ajax({
                                url: "{{route('direct.distributor.quotation.product.add')}}",
                                type: "POST",
                                data: formData,
                                dataType: 'json',
                                processData: false,  
                                contentType: false,
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                beforeSend: function() {
                                    $("#spinner").show();
                                },
                                success: function (response) {
                                    $('#tableQuotation').DataTable().ajax.reload();
                                    $("#spinner").hide();
                                }
                            })
                            $(this).remove();
                        });

                        $("[data-modal=close]").on('click', function(){
                            $(this).parent().remove();
                        });
                    }
                });

                $('.warning').html("{{__('messages.Search one part number at a time')}}");
                $('.warning').css('color', 'black');
            } else {
                $('.warning').html("{{__('messages.Enter at least 3 characters')}}");
                $('.warning').css('color', 'red');
            }
        });
    </script>
@endsection