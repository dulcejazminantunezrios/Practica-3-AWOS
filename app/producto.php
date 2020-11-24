<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class producto extends Model
{
    protected $table= 'productos';

    public function comentarios(){
        return $this->hasMany('App\comentario');
    }
    public function personas()
    {
        return $this->hasOne('App\persona');
    }
}
