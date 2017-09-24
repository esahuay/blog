@extends('admin.template.main')
@section('title','Agregar Salones')

@section('content')
    {!! Form::open(['route'=>'admin.tags.store', 'metho'=>'POST']) !!}
        <div class="form-group">
            {!! Form::label('name','Salon') !!}
            {!! Form::text ('name',null,['class'=>'form-control', 'placeholder'=>'Nombre del tag','required']) !!}
        </div>
        <div class="form-group">
            {!! Form::submit('Registrar',['class'=>'btn btn-primary']) !!}
        </div>
    {!! Form::close() !!}
@endsection

