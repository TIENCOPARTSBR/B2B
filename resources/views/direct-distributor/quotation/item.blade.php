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
                <form action="{{ route('direct.distributor.product.show') }}" class="form-quotation">
                    <input type="text" name="part_number" placeholder="{{__('messages.Type the code')}}">

                    <ul class="list">
                        <li class="item">

                        </li>
                    </ul>
                </form>
            </div>

            <table id="tableQuotation" class="display nowrap hover row-borde stripe" style="width: 100%">
                <thead>
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
                    </tr>
                </thead>
                <tbody align="left"></tbody>
            </table>
        </div>        
    </section>
@endsection

@section('endBody')
    <script>
        $('#tableQuotation').DataTable({
            autoWidth: true,
            processing: true,
            serverSide: true,
            ajax: "{{route('direct.distributor.quotation.datatable', $id)}}",
            columns: [
                {data: 'part_number'},
                {data: 'description'},
                {data: 'custo_liquido_original'},
                {data: 'custo_liquido'},
                {data: 'quantity', name: 'quantity'},
                {data: 'total'},
                {data: 'weight'},
                {data: 'ncm'},
                {data: 'hscode'},
                {data: 'local_fornecimento'},
                {data: 'saldo'},
                {data: 'lead_time'},
                {data: 'photo', 
                    render: function( data, type, full, meta ) {
                        return '<a href="'+ data +'" target="blank" data-fslightbox="gallery"><svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0 8C0 4.22876 0 2.34315 1.17157 1.17157C2.34315 0 4.22876 0 8 0H10C13.7712 0 15.6569 0 16.8284 1.17157C18 2.34315 18 4.22876 18 8V10C18 13.7712 18 15.6569 16.8284 16.8284C15.6569 18 13.7712 18 10 18H8C4.22876 18 2.34315 18 1.17157 16.8284C0 15.6569 0 13.7712 0 10V8Z" fill="#7E869E" fill-opacity="0.25"/><circle cx="14" cy="4" r="1" fill="#222222"/><circle cx="9" cy="9" r="3" fill="#222222"/></svg></a>';
                    }
                },
            ]
        });

        $('#tableQuotation').on('draw.dt', function(){
            $('#tableQuotation').Tabledit({
            url:'action.php',
            dataType:'json',
            columns:{
                identifier : [0, 'part_number'],
                editable:[[1, 'quantity'], [2, 'description']]
            },
            restoreButton:false,
            onSuccess:function(data, textStatus, jqXHR)
            {
                if(data.action == 'delete')
                {
                $('#' + data.id).remove();
                $('#tableQuotation').DataTable().ajax.reload();
                }
            }

            });
        });

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
                $('.table .table-row-group').append(JSON.parse(response));
            }
        })
    </script>
@endsection