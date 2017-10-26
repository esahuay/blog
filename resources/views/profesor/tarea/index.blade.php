@extends('profesor.template.main')

@section('title','Lista de Tareas')

@section('content')
    <hr>
    <a href="{{ route('profesor.tareas.create') }}" class="btn btn-primary">Agregar Tarea</a>
    <hr>
    <table class="table table-striped">
        <thead>
            <th>ID</th>
            <th>Titulo</th>
            <th>Categorias</th>
            <th>User</th>
            <th>Acción</th>
        </thead>
        <tbody>
            @foreach($tareas as $tarea)
            <tr>
                    <td>{{ $tarea->id }}</td>
                    <td>{{ $tarea->title }}</td>
                    <td>{{ $tarea->category->name }}</td>
                    <td>{{ $tarea->profesor->name }}</td>
                    <td>
                        <a href="{{route('profesor.tareas.edit', $tarea->id)}}" class="btn btn-warning">
                            <span class="glyphicon glyphicon-edit"></span>
                        </a>
                        <a href="{{route('profesor.tareas.destroy', $tarea->id)}}" onclick="return confirm('Seguro deseas eliminarlo')" class="btn btn-danger">
                            <span class="glyphicon glyphicon-remove"></span>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div>
    {!! $tareas->render() !!}
    </div>
@endsection
