@extends('admin.template.main')

@section('title','Lista de Estudiantes')

@section('content')
    <hr>
    <a href="{{ route('admin.students.create') }}" class="btn btn-info">Agregar Estudiante</a>
    <hr>
    <table class="table table-striped">
        <thead>
            <th>ID</th>
            <th>Nombre</th>
            <th>Correo</th>
            <th>Tipo</th>
            <th>Accion</th>
        </thead>
        <tbody>
            @foreach($students as $student)<tr>
                    <td>{{ $student->id }}</td>
                    <td>{{ $student->name }}</td>
                    <td>{{ $student->email }}</td>
                    <td>
                        @if($student->type == "admin")
                            <span class="label label-danger" >{{ $student->type }}</span>
                        @else
                            <span class="label label-primary">{{ $student->type }}</span>
                        @endif
                    </td>
                    <td><a href="{{ route('admin.students.edit',$student->id) }}" class="btn btn-warning">
                            <span class="glyphicon glyphicon-edit"></span> Editar
                        </a>
                        <a href="{{ route('admin.students.destroy',$student->id) }}" onclick="return confirm('Seguro deseas eliminarlo')" class="btn btn-danger">
                            <span class="glyphicon glyphicon-remove"></span> Eliminar
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {!! $students->render() !!}
@endsection
