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
        <th>ID del cliente</th>
        <th style=" width: 250px !important;">Nombre completo</th>
        <th style=" width: 250px !important;">Activo/No activo</th>
        <th style=" width: 250px !important;">activo hasta</th>

    </tr>
    </thead>
    <tbody>
    @foreach($user as $item)
        <tr>
            <td >{{$item->id}}</td>
            <td style=" width: 250px !important;">{{$item->name}}</td>
            <td style=" width: 250px !important;">{{$item->status}}</td>
            <td style=" width: 250px !important;">{{$item->date}}</td>
    @endforeach
    </tbody>

</table>