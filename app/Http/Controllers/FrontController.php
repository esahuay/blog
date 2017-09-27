<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Article;
class FrontController extends Controller
{
    public function viewArticle($slug)
    {
        $article = Article::findBySlugOrFail($slug);
        $cat = $article->category->name;
        $myname = $article->user->name;
        $mytags = $article->tags->lists('id')->ToArray();
        $images = $article->images;
        $mytitle = $article->title;
        $mycontent = $article->content;
        $myhour = $article->fecha_fin;
        return view('report.viewArticle')
        ->with('category',$cat)
        ->with('tags',$mytags)
        ->with('title',$mytitle)
        ->with('content',$mycontent)
        ->with('name',$myname)
        ->with('hour',$myhour);
    }
}
