<?php

namespace App\Http\Middleware;

use Closure;

class ChecarEdad
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if($request->edad<=18){
            return abort(400,"No se logra procesar tu petición. Verificar edad");
        }
        return $next($request);
    }
}
