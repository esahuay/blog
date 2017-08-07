<!--
/**
 * Created by PhpStorm.
 * User: Eliseo
 * Date: 06/08/2017
 * Time: 04:40 PM
 */
-->
@extends('admin.template.main')
@section('title','Editar Categoria '. $category->name)
@section('content')
    {!! Form::open(['route' => ['admin.categories.update', $category], 'method' => 'PUT']) !!}
    <div class="form-group">
        {!! Form::label('name','Nombre') !!}
        {!! Form::text('name',  $category->name , ['class' => 'form-control', 'placeholder'=>'Nombre de la categoria','required']) !!}
    </div>

    <div class="form-group">
        {!! Form::submit('Editar', ['class' => 'btn btn-primary']) !!}
    </div>
    {!! Form::close() !!}
@endsection
