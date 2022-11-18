@extends('admin.layouts.default')

@section('content')


    @if(session('created'))
        <script>
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'Empresa añadida con éxito',
                showConfirmButton: false,
                timer: 2500
            })
        </script>
    @endif

    @if(session('updated'))
        <script>
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'Datos actualizados',
                showConfirmButton: false,
                timer: 2500
            })
        </script>
    @endif
    <style>
        input{
            color: white !important;
        }
        .text-danger{
            font-size: 10px;
        }
    </style>
    <div class="main-panel">
        <div class="content-wrapper">

            <div class="row">

                <div class="col-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Añadir una nueva empresa</h4>
                        @if(isset($get))
                            @foreach($get as $company)



                                <form  action="{{route('UpdateCompany')}}"  method="post" autocomplete="off" class="forms-sample">
                                    @csrf
                                    <input type="hidden" >
                                    <div class="form-group">
                                        <label for="exampleInputName1">Nombre de empresa *</label>
                                        <input required  value="{{$company->company_name}}" name="company_name"  type="text" class="form-control" id="exampleInputName1" placeholder="Nombre Сompleto">
                                        @if ($errors->has('company_name'))
                                            <span class="text-danger">{{ $errors->first('company_name') }}</span>
                                        @endif
                                    </div>
                                    <input type="hidden" value="{{$company->id}}" name="company_id">
                                    <div class="form-group">
                                        <label for="exampleInputName1">Número de teléfono *</label>
                                        <input required value="{{$company->phone}}" name="phone" type="text" class="form-control"  placeholder="Número de teléfono">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputName1">Dirección de la empresa *</label>
                                        <input required value="{{$company->address}}" name="address" type="text" class="form-control"  placeholder="Dirección de la empresa">
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputName1">Interés en una compra*</label>
                                        <input required value="{{$company->bonus}}" name="bonus" type="number" class="form-control"  placeholder="Interés en una compra">
                                    </div>
                                    @if($company['status'] == 'Y')

                                        <div class="form-group">
                                            <label for="exampleFormControlSelect2">Activación</label>
                                            <select name="TrueOrFalse" class="form-control" id="comboA" onChange="myFunction(this.options[this.selectedIndex].value)" >
                                                <option value="Y" class="asdasd">Sí</option>
                                                <option value="N" class="false">No</option>
                                            </select>
                                        </div>
                                        <div style="display: block;" class="date form-group">
                                            <label for="exampleFormControlSelect2">Fecha de realización</label>
                                            @if($company['date'] != null)
                                                <input    value="{{$company['date']}}"   name="dates" type="date"  class=" form-control"  >
                                            @else
                                                <input value="<?php echo date('Y-m-d'); ?>"   name="dates" type="date"  class=" form-control"  >

                                            @endif
                                        </div>

                                    @else
                                        <div class="form-group">
                                            <label for="exampleFormControlSelect2">Activación</label>
                                            <select name="TrueOrFalse" class="form-control" id="comboA" onChange="myFunction(this.options[this.selectedIndex].value)" >
                                                <option value="N" class="false">No</option>
                                                <option value="Y" class="asdasd">Sí</option>
                                            </select>
                                        </div>
                                    @endif

                                    <input type="hidden" name="role_id" value="3">
                                    <div style="display: none;" class="date form-group">
                                        <label for="exampleFormControlSelect2">Fecha de realización</label>
                                        @if(old('date') != null)
                                            <input    value="{{old('date')}}"   name="date" type="date"  class=" form-control"  >
                                        @else
                                            <input value="<?php echo date('Y-m-d'); ?>"   name="date" type="date"  class=" form-control"  >
                                        @endif
                                    </div>

                                    <button type="submit" class="btn btn-inverse-success btn-fw">Añadir</button>
                                </form>
                                @endforeach
                                <style>
                                    .close{
                                        color: white !important;
                                    }
                                </style>
                                 <br>
                                <br>
                                <div class="card-body">
                                    <div style="display: flex; justify-content: space-between">
                                        <h4 class="card-title">Gerentes de la empresa</h4>
                                        <a data-toggle="modal" data-target="#exampleModalCenter" class="btn btn-success btn-fw" href="">Agregar nuevo administrador</a>
                                        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLongTitle">Agregar nuevo administrador</h5>
                                                        <button  type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="" class="forms-sample chaguchForm" >
                                                            @csrf
                                                            <input type="hidden" name="company_id" value="{{$get[0]->id}}">
                                                            <div class="form-group">
                                                                <label for="exampleInputName1">Nombre Сompleto *</label>
                                                                <input required value=""  name="MeanagerName" type="text" class="form-control"  placeholder="Nombre Сompleto">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="exampleInputName1">Número de teléfono *</label>
                                                                <input required value=""  name="Meanagerphone" type="text" class="form-control"  placeholder="Número de teléfono">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="exampleInputName1">Acceso *</label>
                                                                <input required  name="loginOs" type="text" class="existEmail  form-control"  placeholder="Acceso">
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="exampleInputName1">Clave *</label>
                                                                <input required  name="password" type="text" class="form-control"  placeholder="Clave">
                                                            </div>
{{--                                                            <div class="form-group">--}}
{{--                                                                <label for="exampleFormControlSelect2">Activación</label>--}}
{{--                                                                <select name="TrueOrFalse" class="form-control" id="comboAAS">--}}
{{--                                                                    <option value="N" class="false">No</option>--}}
{{--                                                                    <option value="Y" class="asdasd">Sí</option>--}}
{{--                                                                </select>--}}
{{--                                                            </div>--}}

                                                    </div>
                                                    <div class="modal-footer">

                                                        <button type="submit" class="btn btn-success btn-fw">Save changes</button>
                                                    </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Acceso</th>
                                                <th>Nombre de empresa</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($user as $users)
                                            <tr>
                                                <td> {{$users->id}} </td>
                                                <td> {{$users->login}} </td>
                                                <td>  {{$users->name}}</td>
                                                <td>{{$users->status}}</td>
                                                <td style="    display: flex;   justify-content: end;">
                                                    <?php $id =  str_replace(' ', '', $users->Commpany->company_name); ?>
                                                    <a data-toggle="modal" data-target="#{{$id}}{{$users->id}}" href="" class="btn btn-success btn-fw">Vista</a>
                                                </td>
                                            </tr>
                                            <div class="modal fade" id="{{$id}}{{$users->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLongTitle">administrador</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="" class="forms-sample UpdateFormsd<?php echo $users->id ?>" >
                                                                @csrf
                                                                <input type="hidden" name="company_id" value="{{$users->company_id}}">
                                                                <input type="hidden" name="user_idMeaneger<?php echo $users->id ?>" value="{{$users->id}}">
                                                                <div class="form-group">
                                                                    <label for="exampleInputName1">Nombre Сompleto *</label>
                                                                    <input required value="{{$users->name}}"  name="UpdMeanagerName<?php echo $users->id ?>" type="text" class="form-control"  placeholder="Nombre Сompleto">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="exampleInputName1">Número de teléfono *</label>
                                                                    <input required value="{{$users->phone}}"  name="UpdMeanagerphone<?php echo $users->id ?>" type="text" class="form-control"  placeholder="Número de teléfono">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="exampleInputName1">Acceso *</label>
                                                                    <input required value="{{$users->login}}"  name="loginOsUpdate<?php echo $users->id ?>" type="text" class="existEmail  form-control"  placeholder="Acceso">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="exampleInputName1">Clave *</label>
                                                                    <input  name="passwordUpdate<?php echo $users->id ?>" value="{{$users->origin_password}}" type="text" class="form-control"  placeholder="Clave">
                                                                </div>
{{--                                                                <div class="form-group">--}}
{{--                                                                    <label for="exampleFormControlSelect2">Activación</label>--}}
{{--                                                                    <select name="TrueOrFalse" class="form-control" id="TruOrfalseCombo<?php echo $users->id ?>">--}}
{{--                                                                        <option value="N" class="false">No</option>--}}
{{--                                                                        <option value="Y" class="asdasd">Sí</option>--}}
{{--                                                                    </select>--}}
{{--                                                                </div>--}}
                                                        </div>
                                                        <div class="modal-footer">

                                                            <button type="submit" class="btn btn-success btn-fw">Save changes</button>
                                                        </div>
                                                        </form>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>

                                    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
                                    <script>



                                        $(".UpdateFormsd<?php echo $users->id ?>").submit(function(e){
                                            e.preventDefault();

                                            $.ajaxSetup({
                                                headers: {
                                                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                                                }
                                            });
                                            var login =  $("input[name=loginOsUpdate<?php echo $users->id ?>]").val();
                                            var password = $("input[name=passwordUpdate<?php echo $users->id ?>]").val();
                                            var TrueOrFalse = $('#TruOrfalseCombo<?php echo $users->id ?>').val();
                                            var User_id = $("input[name=user_idMeaneger<?php echo $users->id ?>]").val();
                                            var name = $("input[name=UpdMeanagerName<?php echo $users->id ?>]").val();
                                            var phone = $("input[name=UpdMeanagerphone<?php echo $users->id ?>]").val();

                                            // console.log(login, password, TrueOrFalse, User_id, name , phone)

                                            $.ajax({
                                                type:'POST',
                                                url:URL+'UpdateMeaneger',
                                                data:{login:login, password:password, TrueOrFalse:TrueOrFalse, user_id:User_id ,name:name, phone:phone},
                                                success:function (response) {
                                                    if(response.status == false){
                                                        $('.existEmail').css("border", "1px solid red");
                                                    }else{
                                                        Swal.fire({
                                                            position: 'center',
                                                            icon: 'success',
                                                            title: 'Datos del administrador actualizados',
                                                            showConfirmButton: false,
                                                            timer: 1000
                                                        })

                                                        setTimeout(function() {
                                                            window.location.reload(true);
                                                        }, 1000);
                                                    }
                                                }

                                            });

                                        });
                                    </script>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            @else
                                <form  action="{{route('CreateCompany')}}" method="post" autocomplete="off" class="forms-sample">
                                    @csrf
                                    <div class="form-group">
                                        <label for="exampleInputName1">Nombre de empresa *</label>
                                        <input required  value="{{old('company_name')}}" name="company_name"  type="text" class="form-control" id="exampleInputName1" placeholder="Nombre Сompleto">
                                        @if ($errors->has('company_name'))
                                            <span class="text-danger">{{ $errors->first('company_name') }}</span>
                                        @endif
                                    </div>


                                    <div class="form-group">
                                        <label for="exampleInputName1">Número de teléfono *</label>
                                        <input required value="{{old('phone')}}" name="phone" type="text" class="form-control"  placeholder="Número de teléfono">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputName1">Dirección de la empresa *</label>
                                        <input required value="{{old('address')}}" name="address" type="text" class="form-control"  placeholder="Dirección de la empresa">
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputName1">Interés en una compra*</label>
                                        <input required value="{{old('bonus')}}" name="bonus" type="number" class="form-control"  placeholder="Interés en una compra">
                                    </div>
                                    @if(old('TrueOrFalse') == 'Y')
                                        <div class="form-group">
                                            <label for="exampleFormControlSelect2">Activación</label>
                                            <select name="TrueOrFalse" class="form-control" id="comboA" onChange="myFunction(this.options[this.selectedIndex].value)" >
                                                <option value="Y" class="asdasd">Sí</option>
                                                <option value="N" class="false">No</option>
                                            </select>
                                        </div>
                                        <style>
                                            .date{
                                                display: block !important;
                                            }
                                        </style>
                                    @else
                                        <div class="form-group">
                                            <label for="exampleFormControlSelect2">Activación</label>
                                            <select name="TrueOrFalse" class="form-control" id="comboA" onChange="myFunction(this.options[this.selectedIndex].value)" >
                                                <option value="N" class="false">No</option>
                                                <option value="Y" class="asdasd">Sí</option>
                                            </select>
                                        </div>
                                    @endif

                                    <input type="hidden" name="role_id" value="3">
                                    <div style="display: none;" class="date form-group">
                                        <label for="exampleFormControlSelect2">Fecha de realización</label>
                                        @if(old('date') != null)
                                            <input    value="{{old('date')}}"   name="date" type="date"  class=" form-control"  >
                                        @else
                                            <input value="<?php echo date('Y-m-d'); ?>"   name="date" type="date"  class=" form-control"  >

                                        @endif
                                    </div>

                                    <button type="submit" class="btn btn-inverse-success btn-fw">Añadir</button>
                                </form>
                            @endif


                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>


@endsection
