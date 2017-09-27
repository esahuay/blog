<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;

class Article extends Model  implements  SluggableInterface
{

    use SluggableTrait;

    protected $sluggable=[
        'build_from'    =>  'title',
        'save_to'       =>  'slug'
    ];


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
