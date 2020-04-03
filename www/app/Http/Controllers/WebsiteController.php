<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WebsiteController extends Controller
{
    /**
     * undocumented function
     *
     * @return void
     * @author 
     **/
    public function index ()
    {
        if(empty(session('usuario')))
            return view('index');
        else
            return view('home')->with('usuario',session('usuario'));
    }

    public function home ()
    {
        return view('home')->with('usuario',session('usuario'));
    }

    public function comprar ()
    {
        return view('comprar')->with('usuario',session('usuario'));
    }

    public function empleado ()
    {
        return view('empleado')->with('usuario',session('usuario'));
    }

    public function cliente ()
    {
        return view('cliente')->with('usuario',session('usuario'));
    }

    public function producto ()
    {
        return view('producto')->with('usuario',session('usuario'));
    }

    public function tarjeta ()
    {
        return view('tarjeta')->with('usuario',session('usuario'));
    }

    public function tarjetas ()
    {
        return view('tarjetas')->with('usuario',session('usuario'));
    }

    public function compras ()
    {
        return view('compras')->with('usuario',session('usuario'));
    }
}
