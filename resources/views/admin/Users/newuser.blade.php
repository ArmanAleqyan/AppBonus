@extends('admin.layouts.default')

@section('content')


    @if(session('UserCreated'))
        <script>
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'Usuario añadido con éxito',
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
                            <h4 class="card-title">Añadir Nuevo Usuario</h4>
                            @if(isset($getUser))
                                @foreach($getUser as $user )
                                <form  action="{{route('Updateuser')}}" method="post" autocomplete="off" class="forms-sample">
                                    @csrf
                                    <input type="hidden" value="{{$user->id}}" name="user_id">
                                    <div class="form-group">
                                        <label for="exampleInputName1">Nombre Сompleto *</label>
                                        <input required  value="{{$user->name}}" name="name"  type="text" class="form-control" id="exampleInputName1" placeholder="Nombre Сompleto">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputName1">Número de teléfono *</label>
                                        <input required value="{{$user->phone}}" name="phone" type="text" class="form-control"  placeholder="Número de teléfono">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputName1">Correo electrónico *</label>
                                        <input required value="{{$user->login}}"   name="login" type="email" class="form-control"  placeholder="Correo electrónico" >
                                        @if ($errors->has('login'))
                                            <span class="text-danger">{{ $errors->first('login') }}</span>
                                        @endif
                                    </div>

                                    @if($user['status'] == 'Y')
                                        <div class="form-group">
                                            <label for="exampleFormControlSelect2">Activación</label>
                                            <select name="TrueOrFalse" class="form-control" id="comboA" onChange="myFunction(this.options[this.selectedIndex].value)" >
                                                <option value="Y" class="asdasd">Sí</option>
                                                <option value="N" class="false">No</option>
                                            </select>
                                        </div>
                                        <div style="display: block;" class="date form-group">
                                            <label for="exampleFormControlSelect2">Fecha de realización {{$user->date}}</label>
                                            @if($user->date != null)
                                                <input    value="{{$user->date}}"   name="date" type="date"  class=" form-control"  >
                                            @else
                                                <input value="<?php echo date('Y-m-d'); ?>"   name="date" type="date"  class=" form-control"  >

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
                                            <input    value="<?php echo date('Y-m-d'); ?>"   name="dates" type="date"  class=" form-control"  >


                                    </div>
                                    <div class="form-group">
                                        <label >Clave *</label>
                                        <input   value="{{$user->origin_password}}"   name="password" type="text" class="form-control"  placeholder="Clave">
                                        @if ($errors->has('password'))
                                            <span class="text-danger">{{ $errors->first('password') }}</span>
                                        @endif
                                    </div>
                                    <div style="display: flex ; justify-content: space-between;">
                                    <button type="submit" class="btn btn-inverse-success btn-fw">Añadir</button>
                                    <a class="btn btn-inverse-danger btn-fw" href="{{route('deleteUser', $user->id)}}">Borrar</a>
                                    </div>
                                </form>
                                @endforeach
                                @else
                                <form  action="{{route('CreateUser')}}" method="post" autocomplete="off" class="forms-sample">
                                    @csrf
                                    <div class="form-group">
                                        <label for="exampleInputName1">Nombre Сompleto *</label>
                                        <input required  value="{{old('name')}}" name="name"  type="text" class="form-control" id="exampleInputName1" placeholder="Nombre Сompleto">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputName1">Número de teléfono *</label>
                                        <input required value="{{old('phone')}}" name="phone" type="text" class="form-control"  placeholder="Número de teléfono">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputName1">Correo electrónico *</label>
                                        <input required value="{{old('login')}}"   name="login" type="email" class="form-control"  placeholder="Correo electrónico" >
                                        @if ($errors->has('login'))
                                            <span class="text-danger">{{ $errors->first('login') }}</span>
                                        @endif
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
                                    <div class="form-group">
                                        <label >Clave *</label>
                                        <input required  value="password"   name="password" type="text" class="form-control"  placeholder="Clave">
                                        @if ($errors->has('password'))
                                            <span class="text-danger">{{ $errors->first('password') }}</span>
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
