@extends('layouts.DirectDistributor')

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
                        <input class="file-input" type="file" name="excel">
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

        <table id="tableQuotation" class="display nowrap hover row-borde stripe" style="width: 100%">
            <thead width="100%">
                <tr>
                    <th>No</th>
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
                </tr>
            </thead>
            <tbody align="left" width="100%"></tbody>
        </table>
    </section>
@endsection

@section('endBody')
    <script async>
        // datatable
        $('#tableQuotation').DataTable({
            autoWidth: true,
            processing: true,
            serverSide: true,
            order: [[1, 'desc']],
            ajax: "{{route('direct.distributor.quotation.datatable', $id)}}",
            columns: [
                {name: 'DT_RowIndex', data: 'DT_RowIndex', name: 'DT_RowIndex'},
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
            ]
        });

        // delete quotation
        function deleteQuotation(url, id)
        {
            // show modal
            $('#delete_quotation').toggleClass('open');
            $('.main').toggleClass('zIndex');

            // set attr
            $('#delete form').attr('action', url)

            // set id
            $('#id').val(id);

            $('#delete .modal-overlay', '#delete [data-modal="cancel"]', '#delete [data-modal="close"]').on('click', function() {
                $('.main').toggleClass('zIndex');
                $('#delete_quotation').removeClass('open');
            });

            $('#delete_quotation').on('submit', function() {
                event.preventDefault();

                var formulario = document.getElementById('form_delete_quotation');
                var formData = new FormData(formulario);

                $.ajax({
                    url: url,
                    type: "POST",
                    data: formData,
                    dataType: 'json',
                    processData: false,  
                    contentType: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (response) {
                        console.log(response);
                        $('#tableQuotation').DataTable().ajax.reload();
                        $('.app').append('<div class="alert alert-success" onshow="alert()"> <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg"> <circle cx="8" cy="8" r="8" fill="#3fbd63c4"/> <path d="M4.5 7L7.39393 9.89393C7.45251 9.95251 7.54749 9.95251 7.60607 9.89393L15.5 2" stroke="#fff" stroke-width="1.2"/> <path d="M15.3578 6.54654C15.6899 8.22773 15.4363 9.97195 14.6391 11.4889C13.8419 13.0059 12.5493 14.2041 10.9763 14.8842C9.40333 15.5642 7.64492 15.6851 5.99369 15.2267C4.34247 14.7682 2.89803 13.7582 1.90077 12.3646C0.903508 10.9709 0.413576 9.27783 0.512509 7.56701C0.611442 5.85619 1.29327 4.23085 2.44453 2.96147C3.59578 1.6921 5.14703 0.855265 6.84009 0.590236C8.53315 0.325207 10.2659 0.64797 11.75 1.50481" stroke="#3fbd63c4" stroke-linecap="round"/> </svg>'+response+'<div class="close" id="close-alert"> <svg width="30" height="30" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg"> <path d="M6.00009 11.9997L12.0001 5.99966" stroke="#5d6672" stroke-width="1.2"/> <path d="M12 12L6 6" stroke="#5d6672" stroke-width="1.2"/> </svg> </div></div>');
                        $('.main').toggleClass('zIndex');
                        $('#delete_quotation').removeClass('open');

                        setTimeout(() => {
                            $('.alert.alert-success').remove();
                        }, "1500");
                    }
                })
            });
        }

        $("#spinner").hide();

        $('#form_import').submit(function(event) {
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
                                alert(response);
                                $('#tableQuotation').DataTable().ajax.reload();
                            }
                        })
                        $(this).remove();
                    });

                    $("[data-modal=close]").on('click', function(){
                        $(this).parent().remove();
                    });

                    $('.app').append('<div class="alert alert-success" onshow="alert()"> <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg"> <circle cx="8" cy="8" r="8" fill="#3fbd63c4"/> <path d="M4.5 7L7.39393 9.89393C7.45251 9.95251 7.54749 9.95251 7.60607 9.89393L15.5 2" stroke="#fff" stroke-width="1.2"/> <path d="M15.3578 6.54654C15.6899 8.22773 15.4363 9.97195 14.6391 11.4889C13.8419 13.0059 12.5493 14.2041 10.9763 14.8842C9.40333 15.5642 7.64492 15.6851 5.99369 15.2267C4.34247 14.7682 2.89803 13.7582 1.90077 12.3646C0.903508 10.9709 0.413576 9.27783 0.512509 7.56701C0.611442 5.85619 1.29327 4.23085 2.44453 2.96147C3.59578 1.6921 5.14703 0.855265 6.84009 0.590236C8.53315 0.325207 10.2659 0.64797 11.75 1.50481" stroke="#3fbd63c4" stroke-linecap="round"/> </svg> Produtos importados! <div class="close" id="close-alert"> <svg width="30" height="30" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg"> <path d="M6.00009 11.9997L12.0001 5.99966" stroke="#5d6672" stroke-width="1.2"/> <path d="M12 12L6 6" stroke="#5d6672" stroke-width="1.2"/> </svg> </div></div>');

                    setTimeout(() => {
                            $('.alert.alert-success').remove();
                    }, "1500");
                },
                error: function (error) {
                    console.log(error.responseText);
                }
            })
        }); 
    </script>
@endsection