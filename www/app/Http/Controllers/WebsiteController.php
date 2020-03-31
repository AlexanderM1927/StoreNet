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

    public function clienteRegistrado ()
    {
        return view('cliente')->with('usuario',session('usuario'))->with('clienteRegistrado', 'Se ha agregado el cliente correctamente');
    }

    public function clienteModificado ()
    {
        return view('cliente')->with('usuario',session('usuario'))->with('clienteModificado', 'Se ha modificado el cliente correctamente');
    }
}
