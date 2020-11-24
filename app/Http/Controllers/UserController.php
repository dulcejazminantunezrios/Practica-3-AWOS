<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use App\User;
use Illuminate\Support\Facades\Hash;
use Log;
use App\Mail\validacion;
use App\Mail\Permisos;
use Illuminate\Support\Facades\Mail;


class UserController extends Controller
{
    public function read(Request $request){
        if($request->user()->tokenCan('user:user'))
        {
            return response()->json(['Perfil'=>$request->user()],200);
        }
        if($request->user()->tokenCan('admin:admin'))
        {
            return response()->json(['todos los usuarios'=>User::all()],200);
        }  
        $user = new User();
        $user=$request->user();
        $user->permiso=2;
  
        $i=Mail::to('dulcejazmin2403@gmail.com')->send(new Permisos($user));    
        return abort(402, "No se pudo mostrar :(");
    }
    public function create(Request $request){
        $request->validate([
            'email'=>'required|email',
            'password'=>'required',
            'name'=>'required',
            'persona'=>'required'
        ]);
        $user = new User();
        $user->name=$request->name;
        $user->email=$request->email;
        $user->password=Hash::make($request->password);
        $user->permiso=2;
        $user->persona=$request->persona;
        if($user->save()){
            $i=Mail::to($user->email)->send(new validacion($user));
            return response()->json($user);
        }
        return abort(402, "Error al Insertar");
    }
    public function update(Request $request){
        $usuario=User::find($request->id); 
        $usuario->permiso=$request->permiso;
        if($usuario->save()){
            return response()->json(["El permiso de usuario se ha actualizado:"=>$usuario],201);
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
            'password'=>'required',
        ]);
        $user=User::where('email',$request->email)->first();

        if(!$user || !Hash::check($request->password, $user->password)){
            throw ValidationException::withMessages([
                'email|password'=>['Datos Incorrectos']
            ]);
        }
        if($user->permiso == 1)
        {
            $token=$user->createToken($request->email, ['admin:admin'])->plainTextToken;
            return response()->json(["token"=>$token],201);
        }
        else
        {
            if($user->permiso == 2 )
            {
                $token=$user->createToken($request->email, ['user:user'])->plainTextToken;
                return response()->json(["token"=>$token],201);
            }
        }
    }
    public function logout(Request $request){
        return response()->json(["afectados"=>$request->user()->tokens()->delete()],200);
    }
}
