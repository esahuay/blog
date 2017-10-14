@extends('admin.template.main')

@section('title','Lista de Estudiantes')

@section('content')
    <hr>
    <a href="{{ route('admin.profesors.create') }}" class="btn btn-info">Agregar Profesor</a>
    <hr>
    <table class="table table-striped">
        <thead>
            <th>ID</th>
            <th>Nombre</th>
            <th>Correo</th>
            <th>Accion</th>
        </thead>
        <tbody>
            @foreach($profesors as $profesor)<tr>
                    <td>{{ $profesor->id }}</td>
                    <td>{{ $profesor->name }}</td>
                    <td>{{ $profesor->email }}</td>
                    <td><a href="{{ route('admin.profesors.edit',$profesor->id) }}" class="btn btn-warning">
                            <span class="glyphicon glyphicon-edit"></span> Editar
                        </a>
                        <a href="{{ route('admin.profesors.destroy',$profesor->id) }}" onclick="return confirm('Seguro deseas eliminarlo')" class="btn btn-danger">
                            <span class="glyphicon glyphicon-remove"></span> Eliminar
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {!! $profesors->render() !!}
@endsection
