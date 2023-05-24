<table>
    <tbody style="border: 1px solid #000;">
    <tr>
        <td width="20"><strong>{{__('messages.Customer name')}}</strong></td>
        <td width="25">{{ $quotation->customer_name }}</td>
    </tr>

    <tr>
        <td width="20"><strong>{{__('messages.Requester for quotation')}}</strong></td>
        <td width="25">{{ $quotation->requester_quotation }}</td>
    </tr>

    <tr>
        <td width="20"><strong>{{__('messages.Quotation type')}}</strong></td>
        <td width="25">{{ $quotation->urgent == "S" ? "SPOT" : "Contrato" }}</td>
    </tr>

    <tr>
        <td width="20"><strong>{{__('messages.General observations')}}</strong></td>
        <td width="25">{{ $quotation->general_observation }}</td>
    </tr>
    
    <tr></tr>
    <tr></tr>
    <tr></tr>

    <tr>
        <td align="center" style="vertical-align: center;" height="30" width="20"><strong>Quantidade</strong></td>
        <td align="center" style="vertical-align: center;" height="30" width="25"><strong>Part number</strong></td>
        <td align="center" style="vertical-align: center;" height="30" width="30"><strong>Descrição</strong></td>
        <td align="center" style="vertical-align: center;" height="30" width="10"><strong>Lead time</strong></td>
        <td align="center" style="vertical-align: center;" height="30" width="20"><strong>Local de fornecimento</strong></td>
        <td align="center" style="vertical-align: center;" height="30" width="15"><strong>Preço Encoparts</strong></td>
        <td align="center" style="vertical-align: center;" height="30" width="10"><strong>Total</strong></td>
        <td align="center" style="vertical-align: center;" height="30" width="8"><strong>Peso</strong></td>
        <td align="center" style="vertical-align: center;" height="30" width="10"><strong>NCM</strong></td>
        <td align="center" style="vertical-align: center;" height="30" width="8"><strong>HS Code</strong></td>
        <td align="center" style="vertical-align: center;" height="30" width="20"><strong>Quantidade em estoque</strong></td>
    </tr>

    @foreach($quotation['QuotationItem'] as $quotation_item)
        <tr>
            <td align="left" width="20">{{$quotation_item->quantity}}</td>
            <td align="left" width="25">{{$quotation_item->product_sisrev_id}}</td>
            <td align="left" width="30">{{$quotation_item->description ? $quotation_item->description : ''}}</td>
            <td align="left" width="10">{{$quotation_item['ProductSisrev'][0]['lead_time_eua']}}</td>
            <td align="left" width="20">{{$quotation_item['ProductSisrev'][0]['local_fornecimento_usa']}}</td>
            <td align="left" width="15">Preço Encoparts</td>
            <td align="left" width="15">Total</td>
            <td align="left" width="15">{{$quotation_item['ProductSisrev'][0]['peso']}}</td>
            <td align="left" width="15">{{$quotation_item['ProductSisrev'][0]['ncm']}}</td>
            <td align="left" width="15">{{$quotation_item['ProductSisrev'][0]['hscode']}}</td>
            <td align="left" width="20">{{$quotation_item['ProductSisrev'][0]['saldo_eua']}}</td>
        </tr>
    @endforeach
    </tbody>
</table>