<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class comentario extends Model
{
    use Notifiable, HasApiTokens;
    
    protected $table = "comentarios";

    public function personas()
    {
        return $this->belongTo('App\persona');
        //muchos comentario tienen una persona
    }
    public function productos()
    {
        return $this->belongTo('App\producto');
        //muchos comentario tiene un producto
    }
}
