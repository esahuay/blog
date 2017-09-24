@extends('admin.template.main');
@section('title','Agregar Articulo');
@section('content')

    {!! Form::open(['route'=>'admin.articles.store','method'=>'POST', 'files'=>true])!!}
        <div class="form-group">
            {!! Form::label('title','Titulo') !!}
            {!! Form::text('title',null,['class'=>'form-control', 'placeholder'=>'Titulo del articulo','required']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('category_id','Tipo Anuncio') !!}
            {!! Form::select('category_id',$categories,null,['class'=>'form-control select-category', 'placeholder'=>'Seleccione una categoria']) !!}
        </div>
        
        <div class="form-group">
            {!! Form::label('fecha_fin','Fecha Entrega') !!}
            {!! Form::input('date', 'fecha_fin', null, ['class' => 'form-control']) !!}
        </div>

<!--        <div class="form-group">-->
<!--            {!! Form::label('time','Hora') !!}      -->
<!--            {!! Form::input('time','hora', null, ['class'=>'form-control']) !!}-->
<!--        </div>-->

        <div class="form-group">
            {!! Form::label('content','Contenido') !!}
            {!! Form::textarea('content',null,['class'=>'form-control textarea-content']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('tags','Salones') !!}
            {!! Form::select('tags_id[]',$tags, null,['class'=> 'form-control select-tag','multiple']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('image','Archivos') !!}
            {!! Form::file('image') !!}
        </div>

        <div class="form-group">
            {!! Form::submit('Agregar Articulo',['class'=>'btn btn-primary']) !!}
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