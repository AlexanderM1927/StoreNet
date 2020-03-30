<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Producto;
use App\Cliente;

class ActionController extends Controller
{
    /**
     * undocumented function
     *
     * @return void
     * @author 
     **/

    public function procesaProductos($type,$params = '0')
    {
        $producto = new Producto();
        if($type==0 && $params=='0')
        {
            return $producto->listarProductos();
        }else if($type==0 && $params != '0')
        {
            return $producto->listarProductos_nombre($params);
        }
    }
    public function procesaClientes($type,$params = '0',$data='0')
    {
        $cliente = new Cliente();
        if($type==0 && $params=='0')
        {
            return $cliente->listarClientes();
        }else if($type==0 && $params != '0' && $data != '0')
        {
            return $cliente->listarClientes_parametro($params,$data);
        }else if($type==1)
        {
            $nombres = $_POST['nombres'];
            $apellidos = $_POST['apellidos'];
            $mail = $_POST['mail'];
            $password = $_POST['password'];
            $direccion = $_POST['direccion'];
            $telefono = $_POST['telefono'];
            $cliente->registrarCliente($nombres,$apellidos,$mail,$password,$direccion,$telefono);
            return redirect()->route('clienteRegistrado');
        }
    }
}
