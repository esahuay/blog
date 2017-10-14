@extends('principal.main')

@section('title', 'home')

@section('content')
	<div align="center">
		<p>
          Bienvenidos a Reminder, 
          <p>
          somos una organización que
          <p>
          tiene como objetivo acercarte 
          <p>
          a las tareas de los más pequeños.
	</div>
     <a href="{{ route('admin.auth.login') }}">Admin</a>
@endsection