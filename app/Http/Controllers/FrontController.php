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
        $article->category;
        $article->user;
        $article->tags;
        $article->images;
        return view('report.viewArticle')->with('article',$article);
    }
}
