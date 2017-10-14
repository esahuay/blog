<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProfesorRequest;
use Laracasts\Flash\Flash;
use App\Profesor;
use App\User;
use App\Tag;

class ProfesorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $profesors = Profesor::orderBy('id','ASC')->paginate(20);
        return view('admin.profesors.index')->with('profesors',$profesors);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = Tag::orderby('name','ASC')->lists('name','id');
        return view('admin.profesors.create')
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
        $Profesor = new Profesor($request->all());
        $Profesor->password = bcrypt($request->password);
        $Profesor->save();
        $idcol[0] = \Auth::user()->id;


        // actualizar la tabla muchos a muchos
        $Profesor->college()->sync($idcol);
        $Profesor->tags()->sync($request->tags_id);

        Flash::success("Se ha registrado " . $Profesor->name . " de forma exitosa"); //<!--  Enviar mensajes a otra pagina -->
        return redirect()->route('admin.profesors.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tags = Tag::orderby('name','ASC')->lists('name','id');
        $Profesor = Profesor::find($id);
        $my_tags = $Profesor->tags->lists('id')->ToArray();

        return view('student.users.edit')
        ->with('Profesor',$Profesor)
        ->with('my_tags',$my_tags)
        ->with('tags',$tags);
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
        $Profesor = Profesor::find($id);
        $Profesor -> name = $request -> name;
        $Profesor -> email = $request->email;
        $Profesor->save();
        $Profesor->tags()->sync($request->my_tags);
        Flash::warning('El Profesor ' . $Student->name . ' a sido editado con exito!');
        return redirect()->route('admin.profesors.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Profesor = Profesor::find($id);
        $id_el = $Profesor->id;
        $Profesor->delete();

        Flash::error('El Profesor: ' . $Student->name . ' a sido borrado de forma exitosa');
        return redirect()->route('admin.profesors.index');
    }

    /**
    * 
    */
    public function home()
    {
        return view('profesor.home');
    }
}
