<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Hash;
use Log;

class UserController extends Controller
{
    public function read($id=null){
        if($id){
            return response()->json(["Usuario:"=>User::find($id)],201);
        }
        return response()->json(["Usuarios:"=>User::all()],201);
    }
    public function create(Request $request){
        $request->validate([
            'email'=>'required|email',
            'password'=>'required',
            'name'=>'required',
            'persona'=>'required',
            'permiso'=>'required'
        ]);
        
        $usu=new User;
        $usu->name=$request->name;
        $usu->email=$request->email;
        $usu->password=$request->password;
        $usu->persona=$request->persona;
        $usu->permiso=$request->permiso;    
        if($usu->save()){
            return response()->json(["El usuario se ha creado:"=>$usu],201);
        }
        return response()->json(["No se pudo crear :("],400);
    }
    public function update(Request $request){
        $usuario=User::find($request->id);
        $usuario->name=$request->name;  
        $usuario->permiso=$request->permiso;
        if($usu->save()){
            return response()->json(["El usuario se ha actualizado:"=>$usu],201);
        }
        return response()->json(["No se pudo actualizar :("],400);
    }
    public function delete($id){
        $usu=new User;
        $usu=User::find($id);
        if($usu->delete()){
            return response()->json(["El usuario se ha eliminado:"=>$usu],201);
        }
        return response()->json(["No se pudo eliminar :("],400);
    }
    public function login(Request $request){
        $request->validate([
            'email'=>'required|email',
            'password'=>'required'
        ]);

        $usuario= User::where('email',$request->email)->first();

        if(!$usuario || !Hash::check($request->password, $usuario->password)){
            throw ValidationException::withMessages([
                'email|password'=>['Datos Incorrectos']
            ]);
        }

        $token=$usuario->createToken($request->email, ['admin:admin'])->plainTextToken;
        return response()->json(201,["token"=>$token]);
        /*if($usuario->permiso==1){
            $tkn=$usuario->createToken($request->email,['admin:admin'])->plainTextToken;
            return response()->json([201,"Tu token de admin es:"=>$tkn]);
        }*/

        /*$tkn=$usuario->createToken($request->email,['user:info'])->plainTextToken;
        return response()->json(["Tu token es:"=>$tkn],201);*/
    }
    public function logout(Request $request){
        return response()->json(["afectados"=>$request->user()->tokens()->delete()],200);
    }
}
