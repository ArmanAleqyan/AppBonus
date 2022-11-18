<table>
    <style>
        .td {
            width: 2000px !important;
        }
        th{
            width: 2000px !important;
        }
    </style>
    <thead>
    <tr>
        <th>ID</th>
        <th style=" width: 250px !important;">Nombre</th>
        <th style=" width: 250px !important;">Dirección</th>
        <th style=" width: 250px !important;">Importe del descuento, %</th>
    </tr>
    </thead>
    <tbody>
    @foreach($user as $item)
        <tr>
            <td >{{$item->id}}</td>
            <td style=" width: 250px !important;">{{$item->company_name}}</td>
            <td style=" width: 250px !important;">{{$item->address}}</td>
            <td style=" width: 250px !important;">{{$item->bonus}}</td>
    @endforeach
    </tbody>

</table>