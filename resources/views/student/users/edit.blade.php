@extends('admin.template.main')
@section('title','Editar estudiante ' . $Student->name)
@section('content')
    {!! Form::open(['route' => ['students.update',$Student->id],'method'=>'PUT']) !!}
    <div class="form-group">
        {!! Form::label('name','Nombre') !!}
        {!! Form::text('name',$Student->name, ['class' => 'form-control', 'placeholder'=> 'Nombre Completo', 'Required']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('email','Correo Electronico') !!}
        {!! Form::email('email', $Student->email , ['class' => 'form-control', 'placeholder'=> 'example@gmail.com', 'Required']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('type','Tipo') !!}
        {!! Form::select('type', ['kinder' => 'Kinder', 'high' => 'High'], $Student->type, ['class' =>'form-control','placeholder'=>'selecciona la etapa','required']) !!}
    </div>

    <div class="form-group">
        {!! Form::submit('Editar',['class' => 'btn btn-primary']) !!}
    </div>

    {!! Form::close() !!}
@endsection