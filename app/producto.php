<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class producto extends Model
{
    protected $table= 'productos';

    public function comentarios(){
        return $this->hasMany('App\comentario');
    }
}
