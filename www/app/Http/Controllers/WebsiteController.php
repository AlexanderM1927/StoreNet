<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use App\Visor;

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

    public function pedidos ()
    {
        return view('pedidos')->with('usuario',session('usuario'));
    }

    public function gpedidos ()
    {
        return view('gpedidos')->with('usuario',session('usuario'));
    }

    public function devoluciones ()
    {
        return view('devoluciones')->with('usuario',session('usuario'));
    }

    public function inventario ()
    {
        return view('inventario')->with('usuario',session('usuario'));
    }

    public function estadisticas ()
    {
        return view('estadisticas')->with('usuario',session('usuario'));
    }

    public function afiliados ()
    {
        return view('afiliados')->with('usuario',session('usuario'));
    }

    public function ajustes ()
    {
        return view('ajustes')->with('usuario',session('usuario'));
    }

    public function visorfacturas()
    {
        return view('visorfacturas')->with('usuario',session('usuario'));
    }

    public function balance($idafiliado,$desde,$hasta)
    {
        $data = ['title' => 'Balance - Generado por StoreNet'];
        $visor = new Visor();
        $balance = $visor->getBalance($idafiliado,$desde,$hasta);
        $pdf = PDF::loadView('balance', array('usuario' => session('usuario'),'balance' => $balance,'data' => $data, 'desde' => $desde, 'hasta' => $hasta));
  
        return $pdf->stream('balance.pdf');
    }

    public function homeadm()
    {
        return view('homeadm')->with('usuario',session('usuario'));
    }

    public function nomina()
    {
        return view('nomina')->with('usuario',session('usuario'));
    }
    
    public function nominas()
    {
        return view('nominas')->with('usuario',session('usuario'));
    }

    public function reportes()
    {
        return view('reportes')->with('usuario',session('usuario'));
    }

}
