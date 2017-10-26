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
use App\Article;
use App\Tarea;

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

        $Profesorid = \Auth::user('profesor')->id;
        $profesorAct = Profesor::find($Profesorid);

        $col = $profesorAct->college[0]->id;

        $data = array();
        $data2 = array();
        $dataresul = array();
        $id = Article::where('user_id',$col)->lists('id');
        $titulo = Article::where('user_id',$col)->lists('title');
        $descripcion = Article::where('user_id',$col)->lists('content');
        $fechaIni = Article::where('user_id',$col)->lists('fecha_inic');
        $fechaFin = Article::where('user_id',$col)->lists('fecha_fin');
        $count = count($id);
        $slug = Article::where('user_id',$col)->lists('slug');
        
        for($i=0;$i<$count;$i++){
            $data[$i] = array(
                "title"=>$titulo[$i],
                "start"=>$fechaIni[$i],
                "end"=>$fechaFin[$i],
                "id"=>$id[$i],
                "slug"=>"articles/" . $slug[$i],
                "content"=>$descripcion[$i]
            );
        }
        json_encode($data);

        foreach ($profesorAct->tags as $tag) {
            $resul =$tag->id; //obtenemos el id del tag al que esta relacionado.
            $id = Tarea::whereHas('tags', function($query) use ($resul) {
                return $query->where('tag_id', $resul);
            })->where('user_id',$col)->lists('id');
            $titulo = Tarea::whereHas('tags', function($query) use ($resul) {
                return $query->where('tag_id', $resul);  
            })->where('user_id',$col)->lists('title');
            $descripcion = Tarea::whereHas('tags', function($query) use ($resul)  {
                return $query->where('tag_id', $resul);  
            })->where('user_id',$col)->lists('content');
            $fechaIni = Tarea::whereHas('tags', function($query) use ($resul)  {
                return $query->where('tag_id', $resul);
            })->where('user_id',$col)->lists('fecha_inic');
            $fechaFin = Tarea::whereHas('tags', function($query) use ($resul)  {
                return $query->where('tag_id', $resul);
            })->where('user_id',$col)->lists('fecha_fin');
            $count2 = count($id);
            $slug = Tarea::whereHas('tags', function($query) use ($resul)  {
                return $query->where('tag_id', $resul);
            })->where('user_id',$col)->lists('slug');     

            $resul = $count + $count2;
            $j=0;
            for($i;$i<$resul;$i++){
                $data[$i] = array(
                    "title"=>$titulo[$j],
                    "start"=>$fechaIni[$j],
                    "end"=>$fechaFin[$j],
                    "id"=>$id[$j],
                    "slug"=>"tarea/" . $slug[$j],
                    "content"=>$descripcion[$j]
                );
                $j++;
            }
        json_encode($data);
        }

        dd($data);
        return view('profesor.home');
    }
}
