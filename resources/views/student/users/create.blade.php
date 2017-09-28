@extends('admin.template.main')
@section('title','Inscribir Estudiante')
@section('content')

    {!! Form::open(['route' => 'students.store','method'=>'POST']) !!}
        <div class="form-group">
            {!! Form::label('College','College') !!}
            {!! Form::text('college',Auth::user()->id, ['class' => 'form-control', 'Required', 'readonly']) !!}
        </div>

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
            {!! Form::select('type', ['kinder' => 'Kinder', 'high' => 'High'], null, ['class' =>'form-control','placeholder'=>'selecciona la etapa','required']) !!}
        </div>


    <div class="form-group">
            {!! Form::submit('Registrar',['class' => 'btn btn-primary']) !!}
        </div>

    {!! Form::close() !!}

@endsection