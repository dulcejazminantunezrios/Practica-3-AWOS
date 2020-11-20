<?php

namespace App\Http\Middleware;

use Closure;

class ChecarPrecio
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
        if($request->precio>=1000.00){
            return abort(400,"No se logra procesar tu petición. Verifica el precio.");
        }
        return $next($request);
    }
}
