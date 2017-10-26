<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Article;
use App\Student;
use App\Tag;
use App\Profesor;

class CalendarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('report.calendarios');
    }

    public function publico()
    {
        return view('report.calendario');
    }

    public function profesor()
    {
        return view('report.profesorcalendar');
    }

    public function student()
    {
        return view('report.studentcalendario');
    }
    /*
    * Despliega los eventos en el calendario
    */
    public function vereventosColegio($authid)
    {
        $collegeid = \Auth::user()->id;
        $data = array(); //declaramos un array principal que va contener los datos
        $id = Article::where('user_id',$collegeid)->lists('id'); //listamos todos los id de los eventos
        $titulo = Article::where('user_id',$collegeid)->lists('title'); //lo mismo para lugar y fecha
        $descripcion = Article::where('user_id',$collegeid)->lists('content');
        $fechaIni = Article::where('user_id',$collegeid)->lists('fecha_inic');
        $fechaFin = Article::where('user_id',$collegeid)->lists('fecha_fin');
        $count = count($id); //contamos los ids obtenidos para saber el numero exacto de eventos
        $slug = Article::where('user_id',$collegeid)->lists('slug');
        //hacemos un ciclo para anidar los valores obtenidos a nuestro array principal $data
        for($i=0;$i<$count;$i++){
            $data[$i] = array(
                "title"=>$titulo[$i], //obligatoriamente "title", "start" y "url" son campos requeridos
                "start"=>$fechaIni[$i], //por el plugin asi que asignamos a cada uno el valor correspondiente
                "end"=>$fechaFin[$i],
                "id"=>$id[$i],
                "slug"=>"articles/" . $slug[$i],
                "content"=>$descripcion[$i] . $authid
                //"url"=>"cargaEventos".$id[$i]
                //en el campo "url" concatenamos el el URL con el id del evento para luego
                //en el evento onclick de JS hacer referencia a este y usar el método show
                //para mostrar los datos completos de un evento
            );
        }
 
        json_encode($data); //convertimos el array principal $data a un objeto Json 
        return $data; //para luego retornarlo y estar listo para consumirlo
    }

    public function StudentEventos(){
        $Studentid = \Auth::user('student')->id;
        $Student = Student::find($Studentid);
        $col;
        $resul = "";
        $data = array();

        /*
        foreach ($Student->college as $colegio) {
            $cole =  $colegio->id;
        }
        */
        $cole =  $Student->college[0]->id;

        $ltag_id = Article::whereHas('tags', function($query) {
         return $query->where('tag_id', 1);  
        })->get();

        $id;
        foreach ($Student->tags as $tag) {
            $resul =$tag->id; //obtenemos el id del tag al que esta relacionado.

            $id = Article::whereHas('tags', function($query) use ($resul) {
                return $query->where('tag_id', $resul);
            })->where('user_id',$cole)->lists('id');
            $titulo = Article::whereHas('tags', function($query) use ($resul) {
                return $query->where('tag_id', $resul);  
            })->where('user_id',$cole)->lists('title');
            $descripcion = Article::whereHas('tags', function($query) use ($resul)  {
                return $query->where('tag_id', $resul);  
            })->where('user_id',$cole)->lists('content');
            $fechaIni = Article::whereHas('tags', function($query) use ($resul)  {
                return $query->where('tag_id', $resul);
            })->where('user_id',$cole)->lists('fecha_inic');
            $fechaFin = Article::whereHas('tags', function($query) use ($resul)  {
                return $query->where('tag_id', $resul);
            })->where('user_id',$cole)->lists('fecha_fin');
            $count = count($id);
            $slug = Article::whereHas('tags', function($query) use ($resul)  {
                return $query->where('tag_id', $resul);
            })->where('user_id',$cole)->lists('slug');
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
        return $data;
        }
    }

    public function ProfesorEventos()
    {

        $Profesorid = \Auth::user('profesor')->id;
        $profesorAct = Profesor::find($Profesorid);

        $col = $profesorAct->college[0]->id;

        $data = array();
        $data2 = array();
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
                "content"=>$descripcion[$i] . $authid
            );
        }
        json_encode($data); //convertimos el array principal $data a un objeto Json 
        return $data; //para luego retornarlo y estar listo para consumirlo
    }
}
