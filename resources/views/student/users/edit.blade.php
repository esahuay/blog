@extends('admin.template.main')
@section('title','Editar estudiante ' . $Student->name)
@section('content')
    {!! Form::open(['route' => ['admin.students.update',$Student->id],'method'=>'PUT']) !!}
    <div class="form-group">
        {!! Form::label('name','Nombre') !!}
        {!! Form::text('name',$Student->name, ['class' => 'form-control', 'placeholder'=> 'Nombre Completo', 'Required']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('email','Correo Electronico') !!}
        {!! Form::email('email', $Student->email , ['class' => 'form-control', 'placeholder'=> 'example@gmail.com', 'Required']) !!}
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