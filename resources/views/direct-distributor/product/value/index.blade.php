@extends('layouts.DirectDistributor')

@section('content')
    @if($type AND $general)
        <section class="page">
            <!-- Title -->
            <h1 class="title">{{__('messages.Update products')}}</h1>

            <!-- Card -->            
            <div class="card">
                <div class="tab-nav">
                    <button class="tab-link active" data-tab="#nav-geral" type="button">
                        {{__('messages.General update')}}
                    </button>

                    <button class="tab-link" data-tab="#nav-unitary" type="button">
                        {{__('messages.Unitary')}}
                    </button>

                    <button class="tab-link" data-tab="#nav-excel" type="button">
                        {{__('messages.Via spreadsheet')}}
                    </button>
                </div>

                <div class="tab-content">
                    <!-- geral -->
                    <div class="tab-pane show" id="nav-geral">
                        <form method="POST" action="{{ url('/produto/valor/geral') }}" class="tab-header mb-0">
                            @csrf @method('POST')
                            <div class="col-lg-6 mb-1 mb-lg-0">
                                <div class="form-select">
                                    <select name="option_general_value" required >
                                        @if ($general->option_general_value == '')
                                            <option selected>{{ __('messages.Select') }}</option>
                                        @endif
                                        <option value="PERCENTAGE" {{ $general->option_general_value == "PERCENTAGE" ? 'selected' : '' }}>{{ __('messages.Percentage') }}</option>
                                        <option value="UNIT_PRICE" {{ $general->option_general_value == "UNIT_PRICE" ? 'selected' : '' }}>{{ __('messages.Unit price') }}</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-6 mb-1 mb-lg-0">
                                <input type="text" class="form-control" name="general_value" value="{{ $general->general_value }}">
                            </div>

                            <div class="col-lg-6 mt-lg-1">
                                <input type="submit" value="{{__('messages.Save')}}" class="button-yellow-1 button-small">
                            </div>
                        </form>
                    </div>

                    <!-- unit -->
                    <div class="tab-pane" id="nav-unitary">
                        <!-- header -->
                        <div class="tab-header">
                            <!-- search -->
                            <form action="{{ url('/produto/valor') }}/" class="form-search" >
                                @csrf @method('POST')
                                <input type="text" name="part_number" placeholder="{{ __('messages.Type the code') }}" class="form-control" >
            
                                <button type="submit"></button>
                            </form>
                            
                            <!-- add row -->
                            <button type="button" class="button-yellow-1 button-small" data-form="add" >
                                {{__('messages.Add')}}
                            </button>
                        </div>

                        <!-- table -->
                        <div class="table">
                            <!-- thead -->
                            <div class="thead">
                                <div class="th">{{__('messages.Part number')}}</div>
                                <div class="th">{{__('messages.Value')}}</div>
                                <div class="th">{{__('messages.Option')}}</div>
                                <div class="th"></div>
                            </div>

                            <!-- add -->
                            <form method="POST" action="{{url('/produto/valor/unitario/adicionar')}}" class="tbody d-none @error('product_value') d-table-row @enderror" data-form="new">
                                @csrf
                                @method('POST')
                                <div class="td">
                                    <input type="text" name="part_number" placeholder="{{__('messages.Part number')}}" class="form-input" >
                                </div>

                                <div class="td">
                                    <input type="text" name="product_value" placeholder="{{__('messages.Type the value')}}" class="form-input" >
                                </div>

                                <div class="td">
                                    <div class="form-select">
                                        <select name="value_type" >
                                            <option value="PERCENTAGE">{{ __('messages.Percentage') }}</option>
                                            <option value="UNIT_PRICE">{{ __('messages.Unit price') }}</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="td">
                                    <div class="table-button">
                                        <button type="submit" data-trigger="save"></button>
                                        <button type="button" data-trigger="close" ></button>
                                    </div>
                                </div>
                            </form>

                            <!-- list -->
                            @foreach ($type as $key => $item)
                                <form method="POST" action="{{url('/produto/valor/unitario/atualizar')}}" class="tbody" id="form-{{$key}}">
                                    @csrf @method('POST')
                                    <!-- required input -->
                                    <input type="hidden" name="id" value="{{$item->id}}">

                                    <div class="td">
                                        <input type="text" name="part_number" value="{{trim($item->part_number)}}" class="form-input" readonly >
                                    </div>

                                    <div class="td">
                                        <input type="text" name="product_value" value="{{trim($item->product_value)}}" class="form-input on-change" disabled >
                                    </div>

                                    <div class="td">
                                        <div class="form-select on-change disabled">
                                            <select name="value_type" disabled >
                                                <option value="PERCENTAGE" {{ $item->value_type == 'PERCENTAGE' ? 'selected' : '' }}>
                                                    {{ __('messages.Percentage') }}
                                                </option>

                                                <option value="UNIT_PRICE" {{ $item->value_type == 'UNIT_PRICE' ? 'selected' : '' }}>
                                                    {{ __('messages.Unit price') }}
                                                </option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="td">
                                        <div class="table-button">
                                            <button type="button" data-trigger="edit" data-form="#form-{{$key}}" ></button>
                                            <button type="submit" data-trigger="save" class="d-none" ></button>
                                            <button type="button" data-trigger="delete" onclick="triggerModal('/produto/valor/unitario/excluir', {{$item->id}})" ></button>
                                        </div>
                                    </div>
                                </form>
                            @endforeach
                        </div>
                        {{ $type->links() }}
                    </div>

                    <!-- geral -->
                    <div class="tab-pane" id="nav-excel">
                        <form action="{{ route('produto.valor.index') }}/" class="tab-header mb-0" id="form_import" enctype="multipart/form-data">
                            @csrf @method('POST')
                            <div class="col-12 mb-1">
                                <div class="file-drop-area">
                                    <span class="fake-btn">{{__('messages.Choose files')}}</span>
                                    <span class="file-msg">{{__('messages.or drag and drop files here')}}</span>
                                    <input class="file-input" type="file" name="excel">
                                </div>
                            </div>

                            <div class="col-12">
                                <input  type="submit" 
                                        value="{{__('messages.Import')}}" 
                                        class="button-yellow-1 button-small">
                            </div>
                        </form>

                        <div class="table">
                            <!-- thead -->
                            <div class="thead d-none">
                                <div class="th">{{__('messages.Part number')}}</div>
                                <div class="th">{{__('messages.Percentage')}}</div>
                                <div class="th">{{__('messages.Unit price')}}</div>
                                <div class="th"></div>
                            </div>
                        </div>

                        <button type="button" class="button-yellow-1 button-small submitForm mt-1 d-none">{{__('messages.Save')}}</button>
                    </div>
                </div>
            </div>
        </section>
    @endif
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
                    url: "/produto/valor/import",
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
                        $('.thead').removeClass('d-none');
                        $('.table').append(JSON.parse(response));
                        $('.submitForm').removeClass('d-none');
                    },
                    error: function(jqXHR, textStatus, errorThrown) { // What to do if we fail
                        console.log(JSON.stringify(jqXHR));
                        console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
                    }
                })
            }); 

            $('.submitForm').on('click', function(event) {
                // Evita que o formulário faça seu envio padrão
                event.preventDefault();

                // Instância o FormData passando como parâmetro o formulário
                var formulario = document.querySelectorAll('.submitFormProduct');
                
                $.each(formulario, function (index, value) {
                    // form data
                    var formData = new FormData(value);

                    // action
                    var action = $(this).attr('action');

                    $.ajax({  
                        url: "/produto/valor/import/store",
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
                            $('#form_import').remove();
                            $('.submitForm').remove();
                            $('.table').html('<div class="tab-content"><svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M7 8L10.2581 10.4436C10.6766 10.7574 11.2662 10.6957 11.6107 10.3021L18 3" stroke="#33363F" stroke-width="2" stroke-linecap="round"/><path d="M19 10C19 11.8805 18.411 13.7137 17.3156 15.2423C16.2203 16.7709 14.6736 17.9179 12.893 18.5224C11.1123 19.1268 9.18696 19.1583 7.38744 18.6125C5.58792 18.0666 4.00459 16.9707 2.85982 15.4789C1.71505 13.987 1.06635 12.174 1.00482 10.2945C0.943291 8.41499 1.47203 6.56344 2.51677 4.99987C3.56152 3.4363 5.06979 2.23925 6.82975 1.57685C8.58971 0.914444 10.513 0.819961 12.3294 1.30667" stroke="#33363F" stroke-width="2" stroke-linecap="round"/></svg> Seus dados foram importados</div>');
                            $('.tbody').addClass('d-none');
                            console.log(response);
                            //$('.table').append(JSON.parse(response));
                        },
                        error: function(jqXHR, textStatus, errorThrown) { // What to do if we fail
                            console.log(JSON.stringify(jqXHR));
                            console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
                        }
                    })
                });
            }); 
        });
    </script>
@endsection