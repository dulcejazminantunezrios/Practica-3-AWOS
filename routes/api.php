<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::middleware('auth:sanctum')->get('users','UserController@read');

//PERSONAS
Route::get("persona","PersonaController@read");
Route::get("persona/{id?}","PersonaController@read")->where("id","[1-101]+");
Route::post("persona","PersonaController@create")->middleware('checar.edad');
Route::put("persona/{id}","PersonaController@update")->where("id","[1-101]+")->middleware('checar.edad');
Route::delete("persona{id}","PersonaController@delete")->where("id","[1-101]+");
//PRODUCTOS
Route::get("producto","ProductoController@read");
Route::get("producto/{id?}","ProductoController@read")->where("id","[1-100]+");
Route::post("producto","ProductoController@create")->middleware('checar.precio');
Route::put("producto/{id}","ProductoController@update")->where("id","[1-100]+")->middleware('checar.precio');
Route::delete("producto{id}","ProductoController@delete")->where("id","[1-100]+");
//COMENTARIOS
Route::get("comentario","ComentarioController@read");
Route::get("comentario/{id?}","ComentarioController@read")->where("id","[1-100]+");
Route::post("comentario","ComentarioController@create");
Route::put("comentario/{id}","ComentarioController@update")->where("id","[1-100]+");
Route::delete("comentario/{id}","ComentarioController@delete")->where("id","[1-100]+");
//USUARIOS
Route::get("usuario","UserController@read");
Route::get("usuario/{id?}","UserController@read")->where("id","[1-101]+");
Route::post("usuario","UserController@create");
Route::post("usuario_login","UserController@login");
Route::put("usuario/{id}","UserController@update")->where("id","[1-101]+");
Route::delete("usuario/{id}","UserController@delete")->where("id","[1-102]+");
Route::delete("logout","UserController@logout");

//RELACIONES
Route::get("compe/{id}","ComentarioController@c_pe")->where("id","[1-101]+");
Route::get("compd/{id}","ComentarioController@c_pd")->where("id","[1-101]+");
Route::get("compdpe","ComentarioController@c_pd_pe");

//ARCHIVOS
Route::post('upload','FilesController@SavePublic')->middleware('Files');
Route::post('photo','FilesController@SavePrivate')->middleware('Files');
Route::post('download','FilesController@Down');
Route::get('valida/{id}','PermisosController@permisos');


//EMAIL
//Route::post('mail', 'MailController@MandarCorreo');