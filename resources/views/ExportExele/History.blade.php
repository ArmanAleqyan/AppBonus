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
        <th style=" width: 250px !important;">Acceso</th>
        <th style=" width: 250px !important;">Clave</th>
        <th>Se aprovechó de todo</th>
        @foreach($company as $companys)
        <th style=" width: 150px !important;">{{$companys->company_name}}</th>
            @endforeach
    </tr>
    </thead>
    <tbody>
    @foreach($State as $item)
        <tr>
            <td >{{$item->ScanReceiver->id}}</td>
            <td style=" width: 250px !important;">{{$item->ScanReceiver->name}}</td>
            <td style=" width: 250px !important;"> {{$item->ScanReceiver->login}}</td>
            <td style=" width: 250px !important;">{{$item->ScanReceiver->origin_password}}</td>
            <?php $getCount = \App\Models\ScanState::where('receiver_id', $item->ScanReceiver->id)->count() ?>
            <td>{{$getCount}}</td>

            @foreach($company as $tyu)
            <?php $companyCount  =   \App\Models\ScanState::where('receiver_id', $item->ScanReceiver->id)->where('company_id',$tyu->id )->count()?>
            <td>{{$companyCount}}</td>
                @endforeach
        </tr>
    @endforeach
    </tbody>

</table>