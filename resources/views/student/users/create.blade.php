@extends('admin.template.main')
@section('title','Inscribir Estudiante')
@section('content')

    {!! Form::open(['route' => 'admin.students.store','method'=>'POST']) !!}
        <div class="form-group">
            {!! Form::label('College','College') !!}
            {!! Form::text('college',Auth::user()->id, ['class' => 'form-control', 'Required', 'readonly']) !!}
        </div>
        
        <div class="form-group">
            {!! Form::label('name','Nombre') !!}
            {!! Form::text('name',null, ['class' => 'form-control', 'placeholder'=> 'Nombre Completo', 'Required']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('email','Correo Electronico') !!}
            {!! Form::email('email',null, ['class' => 'form-control', 'placeholder'=> 'example@gmail.com', 'Required']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('password','Contraseña') !!}
            {!! Form::password('password', ['class' => 'form-control', 'placeholder'=> '**********', 'Required']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('tags','Salones') !!}
            {!! Form::select('tags_id[]',$tags, null,['class'=> 'form-control select-tag']) !!}
        </div>

    <div class="form-group">
            {!! Form::submit('Registrar',['class' => 'btn btn-primary']) !!}
        </div>

    {!! Form::close() !!}

@endsection

@section('js')
    <script>
        $('.select-tag').chosen({
            placeholder_text_multiple: 'Seleccione los destinatarios.',
            no_results_text: 'No existe destinatario'
        });
        $('.select-category').chosen({
            placeholder_text_single: 'Seleccione una categoria.',
            no_results_text: 'No existe la categoria'
        });
        $('.textarea-content').trumbowyg();

    </script>
@endsection