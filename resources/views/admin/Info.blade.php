@extends('admin.layouts.default')
@section('title')

@endsection

@section('content')

    <style>
        input{
            color: white !important;
        }
    </style>

    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">

            </div>



            <div class="row ">
                <div class="col-12 grid-margin">
                    <div class="card">
                        <div class="card-body">
                            {{--                            @error('oldpassword')--}}
                            {{--                            <div class="alert alert-danger">{{ $message }}</div>--}}
                            {{--                            @enderror--}}

                        </div>
                        <div class="card-body">

                            <div style="display: flex ; width: 100%; justify-content: center">

                                <form action="{{route('UpdateInfo')}}" method="post" style=" width: 100%;">
                                <?php $get =  \App\Models\ReplayInfo::get(); ?>
                                    <h1 style="display: flex; justify-content: center">Comunicación con el Administrador</h1>
                                    <br><br>
                                    @csrf
                                    @foreach($get as $rty)
                                        <input name="info_id" type="hidden" value="{{$rty->id}}">
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Nmero de teléfono</label>
                                        <input value="{{$rty->phone}}" name="phone" type="text" class="form-control input1" id="exampleInputPassword1"  placeholder="Nmero de teléfono">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Correo electrónico</label>
                                        <input value="{{$rty->email}}"   name="email" type="text" class="form-control input1" id="exampleInputPassword1" placeholder="Correo electrónico">
                                    </div>
                                    @endforeach



                                    <button type="submit" class="btn btn-success">Guardar cambios</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>

    </div>
    @endsection