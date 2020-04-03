<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Producto;
use App\Cliente;
use App\Empleado;
use App\Tarjeta;
use App\Compra;

class ActionController extends Controller
{
    /**
     * undocumented function
     *
     * @return void
     * @author 
     **/

    public function procesaProductos($type,$params = '0',$data = '0',$idafiliado='0')
    {
        $producto = new Producto();
        $_POST = json_decode(file_get_contents("php://input"),true);
        if($type==0 && $params=='0')
        {
            return $producto->listarProductos($idafiliado);
        }else if($type==0 && $params != '0')
        {
            return $producto->listarProductos_param($params,$data,$idafiliado);
        }else if($type==1)
        {
            $idafiliado=$_POST['idafiliado'];
            $nombre=$_POST['nombre'];
            $precioventa=$_POST['precioventa'];
            $precioproveedor=$_POST['precioproveedor'];
            $imgurl=$_POST['imgurl'];
            $cantidad=$_POST['cantidad'];
            $producto->registrarProducto($idafiliado,$nombre,$precioventa,$precioproveedor,$imgurl,$cantidad);
            return $producto->listarProductos($idafiliado);
        }else if($type==2)
        {
            $id=$_POST['id'];
            $idafiliado=$_POST['idafiliado'];
            $nombre=$_POST['nombre'];
            $precioventa=$_POST['precioventa'];
            $precioproveedor=$_POST['precioproveedor'];
            $imgurl=$_POST['imgurl'];
            $cantidad=$_POST['cantidad'];
            $producto->modificarProducto($id,$idafiliado,$nombre,$precioventa,$precioproveedor,$imgurl,$cantidad);
            return $producto->listarProductos($idafiliado);
        }else if($type==3)
        {
            $id = $params;
            $producto->eliminarProducto($id,$idafiliado);
            return $producto->listarProductos($idafiliado);
        }
    }

    public function procesaClientes($type,$params = '0',$data='0')
    {
        $cliente = new Cliente();
        $_POST = json_decode(file_get_contents("php://input"),true);
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
            return $cliente->listarClientes();
        }else if($type==2)
        {
            $id = $_POST['id'];
            $nombres = $_POST['nombres'];
            $apellidos = $_POST['apellidos'];
            $mail = $_POST['mail'];
            $password = $_POST['password'];
            $direccion = $_POST['direccion'];
            $telefono = $_POST['telefono'];
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
        $_POST = json_decode(file_get_contents("php://input"),true);
        if($type==0 && $params=='0')
        {
            return $empleado->listarEmpleados($idafiliado);
        }else if($type==0 && $params != '0' && $data != '0')
        {
            return $empleado->listarEmpleados_parametro($idafiliado,$params,$data);
        }else if($type==1)
        {
            $idafiliado = $_POST['idafiliado'];
            $rango = $_POST['rango'];
            $sueldo = $_POST['sueldo'];
            $nombres = $_POST['nombres'];
            $apellidos = $_POST['apellidos'];
            $mail = $_POST['mail'];
            $password = $_POST['password'];
            $direccion = $_POST['direccion'];
            $telefono = $_POST['telefono'];
            $empleado->registrarEmpleado($idafiliado,$rango,$sueldo,$nombres,$apellidos,$mail,$password,$direccion,$telefono);
            return $empleado->listarEmpleados($idafiliado);
        }else if($type==2)
        {
            $id = $_POST['id'];
            $idafiliado = $_POST['idafiliado'];
            $rango = $_POST['rango'];
            $sueldo = $_POST['sueldo'];
            $nombres = $_POST['nombres'];
            $apellidos = $_POST['apellidos'];
            $mail = $_POST['mail'];
            $password = $_POST['password'];
            $direccion = $_POST['direccion'];
            $telefono = $_POST['telefono'];
            $empleado->modificarEmpleado($id,$idafiliado,$rango,$sueldo,$nombres,$apellidos,$mail,$password,$direccion,$telefono);
            return $empleado->listarEmpleados($idafiliado);
        }else if($type==3)
        {
            $id = $params;
            $empleado->eliminarEmpleado($id,$idafiliado);
            return $empleado->listarEmpleados($idafiliado);
        }
    }

    public function procesaTarjetas($type,$idcliente='0')
    {
        $tarjeta = new Tarjeta();
        $_POST = json_decode(file_get_contents("php://input"),true);
        if($type=='0' && $idcliente == '0')
        {
            return $tarjeta->listarTarjetas();
        }if($type=='0' && $idcliente != '0' )
        {
            return $tarjeta->listarTarjetas_cliente($idcliente);
        }else if($type==1)
        {
            $idcliente = $_POST['idcliente'];
            $tarjeta->registrarTarjeta($idcliente);
            return $tarjeta->listarTarjetas();
        }else if($type==2)
        {
            $id = $_POST['id'];
            $saldo = $_POST['saldo'];
            $tarjeta->modificarTarjeta($id,$saldo);
            return $tarjeta->listarTarjetas();
        }else if($type==e)
        {
            $id = $idcliente;
            $tarjeta->eliminarTarjeta($id);
            return $tarjeta->listarTarjetas();
        }
    }

    public function procesaCompras($type,$idcliente='0',$idfactura='0',$idafiliado='0')
    {
        $compra = new Compra();
        $_POST = json_decode(file_get_contents("php://input"),true);

        if($type == 0 && $idfactura=='0' && $idafiliado == '0')
        {
            return $compra->listarCompras($idcliente);
        }else if($type == 0 && $idfactura != '0' && $idafiliado != '0')
        {
            return $compra->listarCompras_productos($idfactura,$idafiliado);
        }
        else if($type==1)
        {
            $mensaje = "";
            $productos = $_POST['productos'];
            $idcliente = $_POST['idcliente'];
            $operacion = $compra->registrarCompra($productos,$idcliente);
            if($operacion==0)
            {
                $mensaje= response()->json(['texto' => 'Compra realizada con éxtio', 'type' => 'success']);
            }else if($operacion==1){
                $mensaje= response()->json(['texto' => 'No posees fondos suficientes para realizar esta compra', 'type' => 'error']);
            }else if($operacion==2){
                $mensaje= response()->json(['texto' => 'Al momento de hacer efectiva su compra, los productos ya no se encontraban en el inventario.', 'type' => 'error']);
            }

            return $mensaje;
        }
    }
}
