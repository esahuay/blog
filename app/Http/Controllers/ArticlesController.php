<?php

namespace App\Http\Controllers;

use App\Image;
use App\Tag;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Category;
use App\Article;
use Illuminate\Support\Facades\Redirect;
use Laracasts\Flash\Flash;
use App\Http\Requests\ArticleRequest;
use Carbon\Carbon;

class ArticlesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::orderBy('id','DESC')->paginate(5);
        $articles->each(function($articles){
            $articles->category;
            $articles->user;
        });
        return view('admin.articles.index')->with('articles',$articles);
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
        return view('admin.articles.create')
            ->with('categories',$categories)
            ->with('tags',$tags);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArticleRequest $request)
    {
        //Manipulacion de imagenes
        if($request->file('image'))
        {
            $file = $request->file('image');
            $name = 'blog' . time() . '.' . $file->getClientOriginalExtension();
            $path = public_path() . '\images\articles';
            // Nombre del path y el nombre del archivo.
            $file->move($path, $name);
        }

        $date = Carbon::now('America/Guatemala');

        $article = new Article($request->all());
        $article->user_id = \Auth::user()->id;
        $article->fecha_inic = $date;
        $enIf = "no";
        $f_entrega;
        if(empty($request->fecha_fin)){
            $f_entrega = $date;
            $enIf = "si";       
            $f_entrega = Carbon::parse($f_entrega);    
            $f_entrega->addMinutes(30);
            $article->fecha_fin = $f_entrega;
            $article->save();
        }else{
            $fecha_entrega = $request->fecha_fin . ' ' . $date->hour . ':' . $date->minute . ':' . $date->second;
            $f_entrega = Carbon::parse($fecha_entrega);    
            $f_entrega->addMinutes(30);
            $article->fecha_fin = $fecha_entrega;
            $article->save();
        }

        // actualizar la tabla muchos a muchos
        $article->tags()->sync($request->tags_id);

        if($request->file('image')){
            // relacionar nuevo articulo recien creado.
            $imag = new Image();
            $imag->name = $name;
            $imag->article()->associate($article);
            $imag->save();
        }

        Flash::success($enIf. ' Se a creado el articulo '.$article->title.' de forma satisfactoria ! '.$article->fecha_fin. ' fecha actual '.$date. ' parseado '. $f_entrega . ' diferencia ' . $f_entrega->diffInMinutes($date));
        return redirect()->route('admin.articles.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $article = Article::find($id);
        $article->category;
        $categories = Category::orderby('name','ASC')->lists('name','id');
        $d_fin = Carbon::parse($article->fecha_fin);
        $date_fin = $d_fin->toDateString();
        $hora_fin = $d_fin->toTimeString();
        $my_tags = $article->tags->lists('id')->ToArray();
        $tags = Tag::orderby('name','ASC')->lists('name','id');
        return view('admin.articles.edit')
            ->with('categories',$categories)
            ->with('article',$article)
            ->with('tags',$tags)
            ->with('date_fin',$date_fin)
            ->with('hora_fin',$hora_fin)
            ->with('my_tags',$my_tags);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $article = Article::find($id);
        $article->category;
        $categories = Category::orderby('name','ASC')->lists('name','id');
        $d_fin = Carbon::parse($article->fecha_fin);
        $date_fin = $d_fin->toDateString();
        $hora_fin = $d_fin->toTimeString();
        $my_tags = $article->tags->lists('id')->ToArray();
        $tags = Tag::orderby('name','ASC')->lists('name','id');
        return view('admin.articles.edit')
            ->with('categories',$categories)
            ->with('article',$article)
            ->with('tags',$tags)
            ->with('date_fin',$date_fin)
            ->with('hora_fin',$hora_fin)
            ->with('my_tags',$my_tags);
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
        $article = Article::find($id);
        $article->fill($request->all());
        $article->save();

        $article->tags()->sync($request->tags);
        Flash::warning('El Arituclo ' . $article->title . ' se a sido editado con exito!');
        return redirect()->route('admin.articles.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $article = Article::find($id);
        $article->delete();

        Flash::error('Se ha borrado el articulo ' . $article->title . 'de forma exitosa!');
        return redirect()->route('admin.articles.index');
    }
}
