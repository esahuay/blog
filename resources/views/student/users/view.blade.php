@extends('principal.main')

@section('title', 'home')

@section('content')
hola desde el view student
{{ \Auth::user('student')->name }}
@endsection