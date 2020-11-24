<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\MailUser;
use Illuminate\Mail\Mailable;

class MailController extends Controller
{
    public function MandarCorreo()
    {
        $correo= Mail::to('dulcejazmin2403@gmail.com')->send(new MailUser());
        return response()->json(["Correo enviado:"=>$correo],200);
    }
}
