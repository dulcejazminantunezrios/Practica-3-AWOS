<?php

namespace App\Http\Middleware;

use Closure;

class Files
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
        if($request->hasFile('file'))
        {
            return $next($request);

        }
        return response()->json(["Carga un archivo",400]);
    }
}
