<?php

namespace App\Http\Middleware;

use Closure;

class VerificarPermiso
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
        if($request->permiso==1){
            return abort(400,"No se logra procesar tu petición.");
        }
        else if($request->permiso=2)
            return $next($request);
    }
}
