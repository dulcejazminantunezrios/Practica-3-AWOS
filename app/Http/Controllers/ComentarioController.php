<?php

namespace App\Http\Controllers;

use App\comentario;
use App\ProductoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
use Illuminate\Support\Facades\Hash;
use Log;
use App\Mail\Permisos;
use App\Mail\ComentarioNew;
use App\Mail\ComentarioNwew2;
use Illuminate\Support\Facades\Mail;
use Laravel\Sanctum\HasApiTokens;

class ComentarioController extends Controller
{
    public function read($id=null){
        if($id){
            return response()->json(["Comentario:"=>comentario::find($id)],201);
        }
        return response()->json(["Comentarios:"=>comentario::all()],201);
    }
    public function create(Request $request){
        $producto=DB::table('productos')
        ->join('personas','personas.id','=','productos.persona')
        ->where('productos.id','=',$request->producto)
        ->select('users.email')->get();
        $user=$request->user();

        $com= new comentario;
        $com->titulo=$request->titulo;
        $com->cuerpo=$request->cuerpo;
        $com->producto_id=$request->producto_id;
        $com->persona_id=$request->persona_id;
        if($com->save()){
            return response()->json(["El comentario ha sido creado:"=>$com],201);
        Mail::to($user->email)->send(new ComentarioNew());
        Mail::to($producto)->send(new ComentarioNew2($user));
        }
        return response()->json(["No se pudo crear :("],401);
    }
    public function update(Request $request, $id){
        $com=new comentario;
        $com=comentario::find($id);
        $com->titulo=$request->titulo;
        $com->cuerpo=$request->cuerpo;
        $com->producto_id=$request->producto_id;
        $com->persona_id=$request->persona_id;
        if($com->save()){
            return response()->json(["El comentario fue actualizado:"=>$com],201);
        }
        return response()->json(["No se pudo actualizar :("],401);
    }
    public function delete($id){
        $com=new comentario;
        $com=comentario::find($id);
        if($com->delete()){
            return response()->json(["El comentario ha sido eliminado"=>$com],201);
        }
        return response()->json(["No se pudo eliminar :("],400);        
    }
    public function c_pd(Request $id){
            $prod_com=DB::table('comentarios')
            ->join('productos','comentarios.producto_id','=','productos.id')
            ->where('productos.id','=',$id->id)
            ->select('comentarios.titulo','comentarios.cuerpo','productos.nombre_p','productos.precio')
            ->get();
            return response()->json(["Los comentarios del producto son:"=>$prod_com],201);
    }
    public function c_pe(Request $id){
        $per_com=DB::table('comentarios')->join('personas','comentarios.persona_id','=','personas.id')
        ->where('personas.id','=',$id->id)->select('comentarios.titulo','comentarios.cuerpo','personas.nombre','personas.apellidos',)
        ->get();
        return response()->json(["Los comentarios realizados por la persona son:"=>$per_com],201);
    }
    public function c_pd_pe(){
        $relacion=DB::table('comentarios')
        ->join('productos','comentarios.producto_id','=','productos.id')
        ->join('personas', 'comentarios.persona_id','=','personas.id')
        ->select('productos.nombre_p','productos.precio','personas.nombre','personas.apellidos','comentarios.titulo','comentarios.cuerpo')
        ->get();
        return response()->json(["Comentarios, personas y productos:"=>$relacion],201);
    }
}