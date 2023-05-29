@extends('layouts.direct-distributor')

@section('content')
    <section class="page">
        <!-- Title -->
        <h1 class="title">{{__('messages.Update products')}}</h1>

        <!-- Card -->            
        <div class="card">
            <div class="tab-nav">
                <a href="{{route('direct.distributor.distributor.product.value.general.value.index', $id)}}" class="tab-link" type="button">
                    {{__('messages.General update')}}
                </a>

                <a href="{{route('direct.distributor.distributor.product.value.unitary.index', $id)}}" class="tab-link" type="button">
                    {{__('messages.Unitary')}}
                </a>

                <a href="{{route('direct.distributor.distributor.product.value.import.index', $id)}}" class="tab-link active" type="button">
                    {{__('messages.Via spreadsheet')}}
                </a>
            </div>

            <div class="tab-content">
                <!-- import -->
                <div class="tab-pane show" id="nav-excel">
                    <form action="{{ route('direct.distributor.distributor.product.value.import.import') }}" class="tab-header mb-0" id="form_import" enctype="multipart/form-data">
                        @csrf 
                        @method('POST')
                        <div class="col-12 mb-1">
                            <div class="file-drop-area">
                                <span class="fake-btn">{{__('messages.Choose files')}}</span>
                                <span class="file-msg">{{__('messages.or drag and drop files here')}}</span>
                                <input class="file-input" type="file" name="excel">
                                <input type="hidden" name="distributor_id" value="{{$id}}">
                            </div>
                        </div>

                        <div class="col-12">
                            <input  type="submit" 
                                    value="{{__('messages.Import')}}" 
                                    class="button-yellow-1 button-small">
                        </div>
                    </form>

                    <div class="table d-none">
                        <!-- thead -->
                        <div class="thead">
                            <div class="th">{{__('messages.Part number')}}</div>
                            <div class="th">{{__('messages.Percentage')}}</div>
                            <div class="th">{{__('messages.Unit price')}}</div>
                            <div class="th"></div>
                        </div>

                        <form method="POST" action="{{route('direct.distributor.distributor.product.value.import.store')}}" class="table-row-group">
                            @csrf @method('POST')
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('endBody')
    <script>
        $(function(){
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
                    success: function (response) {
                        // se a sua solicitação for feita com sucesso, a resposta representará os dados
                        $('#form_import').toggleClass('d-none');
                        $('.table').removeClass('d-none');
                        $('.submitForm').removeClass('d-none');  
                        $('.table .table-row-group').append(JSON.parse(response));
                        $('.table .table-row-group').append("<button type='submit' class='button-yellow-1 button-small mt-1'>{{__('messages.Save')}}</button>");
                    }
                })
            }); 
        });
    </script>
@endsection