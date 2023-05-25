<table>
    <tbody style="border: 1px solid #000;">
    <tr>
        <td style="border: 1px solid #000;" width="20"><strong>{{__('messages.Customer name')}}</strong></td>
        <td style="border: 1px solid #000;" width="25">{{ $quotation->customer_name }}</td>
    </tr>

    <tr>
        <td style="border: 1px solid #000;" width="20"><strong>{{__('messages.Requester for quotation')}}</strong></td>
        <td style="border: 1px solid #000;" width="25">{{ $quotation->requester_quotation }}</td>
    </tr>

    <tr>
        <td style="border: 1px solid #000;" width="20"><strong>{{__('messages.Quotation type')}}</strong></td>
        <td style="border: 1px solid #000;" width="25">{{ $quotation->urgent == "S" ? "SPOT" : "Contrato" }}</td>
    </tr>

    <tr>
        <td style="border: 1px solid #000;" width="20"><strong>{{__('messages.General observations')}}</strong></td>
        <td style="border: 1px solid #000;" width="25">{{ $quotation->general_observation }}</td>
    </tr>
    
    <tr></tr>
    <tr></tr>
    <tr></tr>

    <tr>
        <td align="center" style="vertical-align: center; border: 1px solid #000;" height="30" width="20"><strong>Quantidade</strong></td>
        <td align="center" style="vertical-align: center; border: 1px solid #000;" height="30" width="25"><strong>Part number</strong></td>
        <td align="center" style="vertical-align: center; border: 1px solid #000;" height="30" width="30"><strong>Descrição</strong></td>
        <td align="center" style="vertical-align: center; border: 1px solid #000;" height="30" width="10"><strong>Lead time</strong></td>
        <td align="center" style="vertical-align: center; border: 1px solid #000;" height="30" width="20"><strong>Local de fornecimento</strong></td>
        <td align="center" style="vertical-align: center; border: 1px solid #000;" height="30" width="15"><strong>Preço Encoparts</strong></td>
        <td align="center" style="vertical-align: center; border: 1px solid #000;" height="30" width="10"><strong>Total</strong></td>
        <td align="center" style="vertical-align: center; border: 1px solid #000;" height="30" width="8"><strong>Peso</strong></td>
        <td align="center" style="vertical-align: center; border: 1px solid #000;" height="30" width="10"><strong>NCM</strong></td>
        <td align="center" style="vertical-align: center; border: 1px solid #000;" height="30" width="8"><strong>HS Code</strong></td>
        <td align="center" style="vertical-align: center; border: 1px solid #000;" height="30" width="20"><strong>Quantidade em estoque</strong></td>
    </tr>

    @foreach($product as $product)
        <tr>
            <td align="left" style="border: 1px solid #000;" width="20">{{$product['quantity']}}</td>
            <td align="left" style="border: 1px solid #000;" width="25">{{$product['part_number']}}</td>
            <td align="left" style="border: 1px solid #000;" width="30">{{$product['description']}}</td>
            <td align="left" style="border: 1px solid #000;" width="10">{{$product['lead_time']}}</td>
            <td align="left" style="border: 1px solid #000;" width="20">{{$product['local_fornecimento']}}</td>
            <td align="left" style="border: 1px solid #000;" width="15">{{$product['custo_liquido_original']}}</td>
            <td align="left" style="border: 1px solid #000;" width="15">{{$product['total']}}</td>
            <td align="left" style="border: 1px solid #000;" width="15">{{$product['weight']}}</td>
            <td align="left" style="border: 1px solid #000;" width="15">{{$product['ncm']}}</td>
            <td align="left" style="border: 1px solid #000;" width="15">{{$product['hscode']}}</td>
            <td align="left" style="border: 1px solid #000;" width="20">{{$product['saldo']}}</td>
        </tr>
    @endforeach
    </tbody>
</table>