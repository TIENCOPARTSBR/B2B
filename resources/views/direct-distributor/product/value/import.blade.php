@extends('layouts.DirectDistributor')

@section('content')
    @if($import)
        <section class="page">
            <!-- Title -->
            <h1 class="title">Dados importandos excel</h1>

            <!-- Card -->            
            <div class="card tab-content">
                <!-- list -->
                <div class="table"> 
                    <!-- thead -->
                    <div class="thead">
                        <div class="th">{{__('messages.Part number')}}</div>
                        <div class="th">{{__('messages.Value')}}</div>
                        <div class="th">{{__('messages.Option')}}</div>
                        <div class="th"></div>
                    </div>

                    @foreach ($import as $item)
                        <form method="POST" action="{{route('produto.valor.import.store')}}" class="tbody" id="form_import">
                            @csrf @method('POST')
                            <div class="td">
                                <input type="text" name="part_number" value="{{trim($item['part_number'])}}" class="form-input" readonly >
                            </div>

                            <div class="td">
                                <input type="text" name="product_value" value="{{trim($item['percente'])}}" class="form-input on-change" disabled >
                            </div>

                            <div class="td">
                                <input type="text" name="product_value" value="{{trim($item['price'])}}" class="form-input on-change" disabled >
                            </div>

                            <div class="td">
                                <div class="table-button">
                                    <button type="button" data-trigger="delete" onclick="triggerModal('/produto/valor/unitario/excluir', '')" ></button>
                                </div>
                            </div>
                        </form>
                    @endforeach
                </div>

                <div class="col-12 mt-1">
                    <button type="submit" class="button-yellow-1 btn-small">{{__('messages.Update products')}}</button>
                </div>
            </div>
        </section>
    @endif
@endsection

<script>
    $('#form_import').submit(function(event) {
        
        // Evita que o formulário faça seu envio padrão
        event.preventDefault();

        // Obtém alguns valores dos elementos da página
        var data = $(this).serialize();

        // action
        var action = $(this).attr('action');

        $.ajax({
            type: "POST",
            url: action,
            dataType: "jsonp"
            
            success: function(response)
            {
                // se a sua solicitação for feita com sucesso, a resposta representará os dados
                $('')
            }
        })

    }); 
</script>