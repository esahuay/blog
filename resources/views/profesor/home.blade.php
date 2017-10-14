@extends('profesor.template.main')

@section('title', 'home')

@section('content')
hola desde el view student
{{ \Auth::user('profesor')->name }}
@endsection