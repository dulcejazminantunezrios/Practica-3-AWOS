<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class persona extends Model
{
    protected $table= 'personas';

    public function comentarios(){
        return $this->hasMany('App\comentario');
    }
}
