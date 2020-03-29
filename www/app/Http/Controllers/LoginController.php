<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Usuario;

class LoginController extends Controller
{
    /**
     * undocumented function
     *
     * @return void
     * @author 
     **/

    public function login ()
    {
        $mail = $_POST["mail"];
        $password = $_POST["password"];
        $arrayEmpleados = DB::select("SELECT * FROM empleado WHERE mail = '$mail' and password = '$password'");
        if(!empty($arrayEmpleados))
        {
            foreach($arrayEmpleados as $empleado)
            {
                $usuario = new Usuario();
                $usuario->setCliente($empleado);
                session(['usuario' => $usuario]);
                return view('home')->with('usuario',$usuario);
            }
        }else{
            $arrayClientes = DB::select("SELECT * FROM cliente WHERE mail = '$mail' and password = '$password'");
            if(!empty($arrayClientes))
            {
                foreach($arrayClientes as $cliente)
                {
                    $usuario = new Usuario();
                    $usuario->setCliente($cliente);
                    session(['usuario' => $usuario]);
                    return view('home')->with('usuario',$usuario);
                }
            }else{
                return view('index')->with('errorLogin','No se ha encontrado el usuario');
            }
        }
    }

    public function logout()
    {
        session()->forget('usuario');
        return redirect('/');
    }

}
