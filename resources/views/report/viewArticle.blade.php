@extends('principal.index')

@section('title',$title)

@section('content')
	Categoria:
	<div class="row">
		<div class="col-md-9">
			{{ $category }}
		</div>
	</div>

	<hr>
	Profesor:
	<div class="row">
		<div class="col-md-9">
			{{ $name }}
			</div>
	</div>
	<hr>
	Descripción:
	<div class="row">
	<div class="col-md-9">
			{!! $content !!}
		</div>
	</div>
	<hr>
	Fecha de entrega:
	<div class="row">
	<div class="col-md-9">
			{!! $hour !!}
		</div>
	</div>
@endsection;