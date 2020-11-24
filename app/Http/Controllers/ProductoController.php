<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\producto;
use Illuminate\Support\Facades\DB;
use App\User;
use Illuminate\Support\Facades\Mail;
use Laravel\Sanctum\HasApiTokens;
use App\Mail\ProductoNew;

class ProductoController extends Controller
{
    public function read($id=null){
        if($id){
            return response()->json(["Producto:"=>producto::find($id)],201);
        }
        return response()->json(["Todos los productos:"=>producto::all()],201);
    }

    public function create(Request $request){
        $pd=new producto;
        $user=$request->user();
        $pd->nombre_p=$request->nombre_p;
        $pd->descripcion=$request->descripcion;
        $pd->precio=$request->precio;
        $pd->persona=$request->persona;
        if($pd->save()){
            return response()->json(["El producto ha sido creado:"=>$pd],201);
            Mail::to($user->email)->send(new ProductoNew());
        }
        return response()->json(["No se pudo crear :("],400);
    }

    public function update(Request $request, $id){
        $pd=new producto;
        $pd=producto::find($id);
        $pd->nombre_p=$request->nombre_p;
        $pd->descripcion=$request->descripcion;
        $pd->persona=$request->persona;
        $pd->precio=$request->precio;    
        if($pd->save())
            return response()->json(["El producto ha sido actualizado:"=>$pd],201);
        return response()->json(["No se pudo actualizar :("],400);
    }

    public function delete($id){
        $pd=new producto;
        $pd=producto::find($id);
        if($pd->delete()){
            return response()->json(["La persona ha sido eliminada"=>$pd],201);
        }
        return response()->json(["No se pudo eliminar :("],400);
    }
}