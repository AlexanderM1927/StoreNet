<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Producto;
use App\Cliente;
use App\Empleado;

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
            $elCliente = json_decode($params);
            $nombres = $elCliente->nombres;
            $apellidos = $elCliente->apellidos;
            $mail = $elCliente->mail;
            $password = $elCliente->password;
            $direccion = $elCliente->direccion;
            $telefono = $elCliente->telefono;
            $cliente->registrarCliente($nombres,$apellidos,$mail,$password,$direccion,$telefono);
            return $cliente->listarClientes();
        }else if($type==2)
        {
            $elCliente = json_decode($params);
            $id = $elCliente->id;
            $nombres = $elCliente->nombres;
            $apellidos = $elCliente->apellidos;
            $mail = $elCliente->mail;
            $password = $elCliente->password;
            $direccion = $elCliente->direccion;
            $telefono = $elCliente->telefono;
            $cliente->modificarCliente($id,$nombres,$apellidos,$mail,$password,$direccion,$telefono);
            return $cliente->listarClientes();
        }else if($type==3)
        {
            $id = $params;
            $cliente->eliminarCliente($id);
            return $cliente->listarClientes();
        }
    }

    public function procesaEmpleados($type,$idafiliado='0',$params = '0',$data='0')
    {
        $empleado = new Empleado();
        if($type==0 && $params=='0')
        {
            return $empleado->listarEmpleados($idafiliado);
        }else if($type==0 && $params != '0' && $data != '0')
        {
            return $empleado->listarEmpleados_parametro($idafiliado,$params,$data);
        }else if($type==1)
        {
            $elEmpleado = json_decode($params);
            $idafiliado = $idafiliado;
            $rango = $elEmpleado->rango;
            $sueldo = $elEmpleado->sueldo;
            $nombres = $elEmpleado->nombres;
            $apellidos = $elEmpleado->apellidos;
            $mail = $elEmpleado->mail;
            $password = $elEmpleado->password;
            $direccion = $elEmpleado->direccion;
            $telefono = $elEmpleado->telefono;
            $empleado->registrarEmpleado($idafiliado,$rango,$sueldo,$nombres,$apellidos,$mail,$password,$direccion,$telefono);
            return $empleado->listarEmpleados($idafiliado);
        }else if($type==2)
        {
            $elEmpleado = json_decode($params);
            $id = $elEmpleado->id;
            $idafiliado = $idafiliado;
            $rango = $elEmpleado->rango;
            $sueldo = $elEmpleado->sueldo;
            $nombres = $elEmpleado->nombres;
            $apellidos = $elEmpleado->apellidos;
            $mail = $elEmpleado->mail;
            $password = $elEmpleado->password;
            $direccion = $elEmpleado->direccion;
            $telefono = $elEmpleado->telefono;
            $empleado->modificarEmpleado($id,$idafiliado,$rango,$sueldo,$nombres,$apellidos,$mail,$password,$direccion,$telefono);
            return $empleado->listarEmpleados($idafiliado);
        }else if($type==3)
        {
            $id = $params;
            $empleado->eliminarEmpleado($id,$idafiliado);
            return $empleado->listarEmpleados($idafiliado);
        }
    }
}
