<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\File;
use app\Mail\SendEmail;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use App\User;
use Illuminate\Support\Facades\Hash;


class FilesController extends Controller
{

    public function SavePublic(Request $request)
    {
        $file=Storage::disk('public')->put('PublicFiles/Saved', $request->file);
        return response()->json(["Archivo guardado:"=>$file],200);
    }

    public function SavePrivate(Request $request)
    {
        $path = Storage::putFileAs('PrivateFiles/Saved', $request->file('file'), $request->user()->id.".jpg");
        return response()->json(["Archivo guardado"=>$path],200);
    }

    public function Down($file=null)
    {
        if($file)
        return Storage::download('PrivateFiles/Saved{{$file}}');
    }
    
}
