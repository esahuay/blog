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

    public function Tareas()  
    {
        return $this->belongsToMany('App\Tarea')->withTimestamps();
    }

    public function Students()  
    {
        return $this->belongsToMany('App\Student')->withTimestamps();
    }

    public function scopeSearch($query, $name)
    {
        return $query->where('name','LIKE',"%$name%");
    }
}
