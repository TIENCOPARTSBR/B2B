<form class="form-quotation" id="form-quotation">
    <input type="hidden" name="quotation_id" value="{{$id}}">
    <input type="text" id="part_number" name="part_number" placeholder="{{__('messages.Type the code')}}">

    <button type="submit">
        <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
            <circle cx="8" cy="8" r="7" stroke-width="2"/>
            <path d="M17 17L13 13" stroke-width="2" stroke-linecap="round"/>
        </svg>
    </button>

    <i class="warning">Pesquisar um part number por vez.</i>
</form>

<script defer>
    $(document).ready(function(){
        $('#form-quotation').on('submit', function(event) {
            event.preventDefault();
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
                        console.log(formData);
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
                }
            });
        });
    });
</script>