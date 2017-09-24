@extends('admin.template.main')
@section('title','crear usuario')
@section('content')

    {!! Form::open(['route' => 'admin.users.store','method'=>'POST']) !!}
        <div class="form-group">
            {!! Form::label('name','Nombre') !!}
            {!! Form::text('name',null, ['class' => 'form-control', 'placeholder'=> 'Nombre Completo', 'Required']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('email','Correo Electronico') !!}
            {!! Form::email('email',null, ['class' => 'form-control', 'placeholder'=> 'example@gmail.com', 'Required']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('password','Contraseña') !!}
            {!! Form::password('password', ['class' => 'form-control', 'placeholder'=> '**********', 'Required']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('type','Tipo') !!}
            {!! Form::select('type', ['member' => 'Miembro', 'parents'=>'Encargado', 'admin' => 'Administrador', 'school' => 'Colegio', 'teacher' => 'Profesor'], null, ['class' =>'form-control','placeholder'=>'selecciona una opcion','required']) !!}
        </div>


    <div class="form-group">
            {!! Form::submit('Registrar',['class' => 'btn btn-primary']) !!}
        </div>

    {!! Form::close() !!}

@endsection