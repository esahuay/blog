@extends('admin.template.main')
@section('title','Home Administrador')
@section('content')
    <h5>Hola bienvenido {{ Auth::user()->name }}. </h5>
@endsection