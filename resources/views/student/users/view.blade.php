@extends('principal.main')

@section('title', 'home')

@section('content')
hola desde el view student
{{ \Auth::user('student')->name }}
@foreach ($tags->tag as $tag) {
    echo $tag->name;
}
@endforeach
@endsection