<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    //
    protected  $table = "tags";
    protected  $fillable = ['name'];

    public function Articles()  
    {
        return $this->belongsToMany('App\Article')->withTimestamps();
    }

    public function scopeSearch($query, $name)
    {
        return $query->where('name','LIKE',"%$name%");
    }
}
