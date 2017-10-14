<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Laracasts\Flash\Flash;
use App\Http\Requests\ArticleRequest;
use Carbon\Carbon;
use App\Tarea;
use App\Tag;
use App\Category;
use App\Document;

class TareaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tareas = Tarea::orderBy('id','DESC')->paginate(5);
        $tareas->each(function($tareas){
            $tareas->category;
            $tareas->profesor;
        });
        return view('profesor.tarea.index')->with('tareas',$tareas);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::orderby('name','ASC')->lists('name','id');
        $tags = Tag::orderby('name','ASC')->lists('name','id');
        return view('profesor.tarea.create')
            ->with('categories',$categories)
            ->with('tags',$tags);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->file('image'))
        {
            $file = $request->file('image');
            $name = 'tarea' . time() . '.' . $file->getClientOriginalExtension();
            $path = public_path() . '\images\tareas';
            // Nombre del path y el nombre del archivo.
            $file->move($path, $name);
        }

        $date = Carbon::now('America/Guatemala');

        $tarea = new tarea($request->all());
        $tarea->profesor_id = \Auth::user('profesor')->id;
        $tarea->fecha_inic = $date;
        $enIf = "no";
        $f_entrega;
        if(empty($request->fecha_fin)){
            $f_entrega = $date;
            $enIf = "si";       
            $f_entrega = Carbon::parse($f_entrega);    
            $f_entrega->addMinutes(30);
            $tarea->fecha_fin = $f_entrega;
            $tarea->save();
        }else{
            $fecha_entrega = $request->fecha_fin . ' ' . $date->hour . ':' . $date->minute . ':' . $date->second;
            $f_entrega = Carbon::parse($fecha_entrega);    
            $f_entrega->addMinutes(30);
            $tarea->fecha_fin = $fecha_entrega;
            $tarea->save();
        }

        // actualizar la tabla muchos a muchos
        $tarea->tags()->sync($request->tags_id);

        if($request->file('image')){
            // relacionar nuevo articulo recien creado.
            $Document = new Image();
            $Document->name = $name;
            $Document->tarea()->associate($tarea);
            $Document->save();
        }

        Flash::success($enIf. ' Se a creado el articulo '.$tarea->title.' de forma satisfactoria ! '.$tarea->fecha_fin. ' fecha actual '.$date. ' parseado '. $f_entrega . ' diferencia ' . $f_entrega->diffInMinutes($date));
        return redirect()->route('profesor.tareas.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
