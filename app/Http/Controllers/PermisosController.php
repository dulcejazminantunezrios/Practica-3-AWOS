<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;

class PermisosController extends Controller
{
    public function permiso($id)
    {
        $u=User::find($id);
        $u->valido='ok';
        if($u->save())
        {
            return response(["Tu cuenta ha sido validada. Permisos".$u->valido]);   
        }
        return response()->json("error al validar",400);
    }
}