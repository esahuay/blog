<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fullcalendarevent extends Model
{
      //
    protected $table = "Fullcalendarevents";

    protected $fillable = ['titulo','fecha_inic','fecha_fin','todoeldia'];
}
