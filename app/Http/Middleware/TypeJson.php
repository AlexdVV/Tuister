<?php

namespace App\Http\Middleware;

use Closure;

class TypeJson
{
    public function handle($request, Closure $next)
    {
      if(!$request->hasfile('imagen')){
        if($request->header('Content-Type') != "application/json"){
            $respuesta = array('error' => "La peticion debe ser en formato Json",'clave'=>500);
            return response()->json($respuesta, 500);
        }
      }
        return $next($request);
    }
}
