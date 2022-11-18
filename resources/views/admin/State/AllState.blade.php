@extends('admin.layouts.default')

@section('content')
    <style>
        input{
            color: white !important;
        }
        .modal-dialog {
            margin: 10% auto !important;
        }
    </style>
    <div class="main-panel">
        <div class="content-wrapper">

            <div class="row ">
                <div class="col-12 grid-margin">
                    <div class="card">
                        <div class="card-body">
                            <div style="display: flex; justify-content: space-between">
                                <h4  class="card-title">Statistics</h4>
                                <a style="display: flex; justify-content: center; align-items: center;" class="btn btn-success btn-fw" href="{{route('DownloadStateExcel')}}">Descargar archivo Excel</a>
                            </div>
                            <br>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Usuario </th>
                                        <th> Compañía </th>
                                        <th> Gerente </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($get as $user)

                                        <tr>
                                            <td>{{$user->id}}</td>
                                            <td> {{$user->ScanReceiver->login}} </td>
                                            <td> {{$user->StateCompany->company_name}} </td>
                                            <td> {{$user->ScanSender->login}} </td>
                                            <td> {{$user->created_at}} </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>

                        </div>
                        <div style="display: flex; justify-content: center">{{$get->links()}}</div>
                    </div>
                </div>
            </div>

        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->

        <!-- partial -->
    </div>

@endsection
