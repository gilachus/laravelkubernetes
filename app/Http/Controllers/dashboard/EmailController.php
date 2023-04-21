<?php

namespace App\Http\Controllers\dashboard;

use App\Jobs\SendEmail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EmailController extends Controller
{
    public function index(Request $request)
    {
        SendEmail::dispatch('jesusgilberdugo@gmail.com', 'Email prueba de colas');
        return "enviado";
    }
}
