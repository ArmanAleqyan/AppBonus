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

    @if(session('delete'))
        <script>
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'Usuario eliminado con éxito',
                showConfirmButton: false,
                timer: 2500
            })
        </script>
    @endif

    <div class="main-panel">
        <div class="content-wrapper">

            <div class="row ">
                <div class="col-12 grid-margin">
                    <div class="card">
                        <div class="card-body">
                            <div style="display: flex; justify-content: space-between">
                                <h4  class="card-title">Usuarios</h4>
                                <a style="display: flex; justify-content: center; align-items: center" class="btn btn-inverse-success btn-fw" href="{{route('CreateNewCompany')}}">Añadir una nueva empresa</a>
                            </div>
                            <form action="{{route('searchCompany')}}" method="get">
                                <div style="display: flex;justify-content: space-between; align-items: center;">
                                <div class="form-group" style="width: 60%">
                                    <div class="input-group">
                                        <input required type="text" name="search" class="form-control" placeholder="Introduzca el nombre de la empresa" aria-label="Recipient's username" aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-inverse-success btn-fw" type="submit">Búsqueda</button>
                                        </div>
                                    </div>
                                    <br>
                                </div>
                                <a class="btn btn-inverse-success btn-fw" href="{{route('DownloadCompanyExcel')}}">Descargar listado de empresas</a>
                                </div>
                            </form>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nombre de empresa </th>
                                        <th> Bonos </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($get as $user)
                                        <tr>
                                            <td> {{$user->id}} </td>
                                            <td> {{$user->company_name}} </td>
                                            <td> {{$user->bonus}} </td>
                                            <td style="    display: flex;   justify-content: end;" >
                                                <a href="{{route('ShowCompany', $user->id)}}" class="btn btn-success btn-fw">Vista</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div style="display: flex; justify-content: center;">{{$get->links()}}</div>
                    </div>
                </div>
            </div>

        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->

        <!-- partial -->
    </div>

@endsection
