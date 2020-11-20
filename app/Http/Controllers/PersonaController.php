<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\persona;

class PersonaController extends Controller
{
    public function read($id=null){
        if($id){
            return response()->json(["Persona:"=>persona::find($id)],201);
        }
        return response()->json(["Todas las personas:"=>persona::all()],201);
    }

    public function create(Request $request){
        $pe=new persona;
        $pe->nombre=$request->nombre;
        $pe->apellidos=$request->apellidos;
        $pe->correo=$request->correo;
        $pe->edad=$request->edad;
        if($pe->save()){
            return response()->json(["La persona ha sido creada:"=>$pe],201);
        }
        return response()->json(["No se pudo crear :("],400);
    }

    public function update(Request $request, $id){
        $pe=new persona;
        $pe=persona::find($id);
        $pe->nombre=$request->nombre;
        $pe->apellidos=$request->apellidos;
        $pe->correo=$request->correo;
        $pe->edad=$request->edad;    
        if($pe->save())
            return response()->json(["La persona ha sido actualizada:"=>$pe],201);
        return response()->json(["No se pudo actualizar :("],400);
    }

    public function delete($id){
        $pe=new persona;
        $pe=persona::find($id);
        if($pe->delete()){
            return response()->json(["La persona ha sido eliminada"],201);
        }
        return response()->json(["No se pudo eliminar :("],400);
    }

    /*public function __construct(){
        $this->middleware('checar.edad',['only'=>['actualizar_per','crear_per']]);
    }*/
}
