<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Article;
use App\Student;
use App\Tag;

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

    public function student()
    {
        return view('report.studentcalendario');
    }
    /*
    * Despliega los eventos en el calendario
    */
    public function vereventos($authid)
    {
        $data = array(); //declaramos un array principal que va contener los datos
        $studentact = Student::find($authid);
        $id = Article::all()->lists('id'); //listamos todos los id de los eventos
        $titulo = Article::all()->lists('title'); //lo mismo para lugar y fecha
        $descripcion = Article::all()->lists('content');
        $fechaIni = Article::all()->lists('fecha_inic');
        $fechaFin = Article::all()->lists('fecha_fin');
        $count = count($id); //contamos los ids obtenidos para saber el numero exacto de eventos
        $slug = Article::all()->lists('slug');
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
}
