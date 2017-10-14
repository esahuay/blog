@extends('admin.template.main')
@section('title','Editar Profesor ' . $profesor->name)
@section('content')
    {!! Form::open(['route' => ['admin.profesors.update',$profesor->id],'method'=>'PUT']) !!}
    <div class="form-group">
        {!! Form::label('name','Nombre') !!}
        {!! Form::text('name',$profesor->name, ['class' => 'form-control', 'placeholder'=> 'Nombre Completo', 'Required']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('email','Correo Electronico') !!}
        {!! Form::email('email', $profesor->email , ['class' => 'form-control', 'placeholder'=> 'example@gmail.com', 'Required']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('tags','Salones') !!}
        {!! Form::select('my_tags[]',$tags, $my_tags,['class'=> 'form-control select-tag']) !!}
    </div>

    <div class="form-group">
        {!! Form::submit('Actualizar',['class' => 'btn btn-primary']) !!}
    </div>

    {!! Form::close() !!}
@endsection