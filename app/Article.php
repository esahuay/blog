<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;


class Article extends Model  /* implements  SluggableInterface*/
{

    use Sluggable;

    public function sluggable(){
        return [
            'slug' =>[
                'source' => 'title'
            ]
        ];

    }


    protected  $table = "articles";

    protected  $fillable = ['title','content','category_id','fecha_inic','fecha_fin','todoeldia','user_id'];

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function images()
    {
        return $this->hasMany('App\Image');
    }

    public function tags()
    {
        return $this->belongsToMany('App\Tag');
    }
}
