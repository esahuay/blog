<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    //
    protected  $table = "documents";
    protected  $fillable = ['name','tarea_id'];

    public function tarea()
    {
        return $this->belongsTo('App\Tarea');
    }
}
