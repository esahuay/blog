@extends('admin.template.main')
@section('title','Lista de Tags')
@section('content')
    <a href="{{ route('admin.tags.create') }}" class="btn btn-info">Agregar Salon</a>
    <!-- Buscador de TAGS-->
        {!! Form::open(['route'=>'admin.tags.index', 'method'=>'GET','class'=>'navbar-form pull-right']) !!}
        <div class="input-group">
            {!! Form::text('name',null,['class'=>'form-control','placeholder'=>'buscador tag..','aria-describedby'=>'search']) !!}
            <span class="input-group-addon" id="search" ><span class="glyphicon glyphicon-search" aria-hidden="true"></span></span>

        </div>
        {!! Form::close() !!}
    <!-- Fin del buscador-->
    <hr>
    <table class="table table-striped">
        <thead>
            <th>ID</th>
            <th>Salones</th>
            <th>Accion</th>
        </thead>
        <tbody>
            @foreach($tags as $tag)
                <tr>
                    <td> {{ $tag->id }}</td>
                    <td> {{ $tag->name }}</td>
                    <td>
                        <a href="{{route('admin.tags.edit', $tag->id)}}" class="btn btn-warning">
                            <span class="glyphicon glyphicon-edit"></span> Editar
                        </a>
                        <a href="{{route('admin.tags.destroy', $tag->id)}}" onclick="return confirm('Seguro deseas eliminarlo')" class="btn btn-danger">
                            <span class="glyphicon glyphicon-remove"></span> Eliminar
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="text-center">
        {!! $tags->render() !!}
    </div>
@endsection()