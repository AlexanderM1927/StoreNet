<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Producto;
use App\Cliente;
use App\Empleado;
use App\Tarjeta;
use App\Compra;
use App\Pedido;
use App\Estadistica;
use App\Afiliado;
use App\Usuario;
use App\Visor;
use App\Nomina;

class ActionController extends Controller
{
    /**
     * undocumented function
     *
     * @return void
     * @author 
     **/


    public function administrador()
    {
        $usuario = session('usuario');
        $usuario->setIdAfiliado($_POST['id']);
        session(['usuario' => $usuario]);
        return redirect('/');
    }
     
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
        }else if($type==4)
        {
            return $producto->listarInventario($params,$idafiliado);
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
        }else if($type==3)
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
        }else if($type == 0 && $idfactura != '0')
        {
            return $compra->listarCompras_fecha($idcliente,$idfactura);
        }else if($type == 2 && $idfactura != '0' && $idafiliado != '0')
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

    public function procesaPedidos($type,$idcliente='0',$fecha='0',$estado='0',$idafiliado='0')
    {
        $pedido = new Pedido();
        $_POST = json_decode(file_get_contents("php://input"),true);
        if($type == 0 && $fecha == '0')
        {
            return $pedido->listarPedidos($idcliente);
        }else if($type == 1)
        {
            return $pedido->listarPedidos_fecha($idcliente,$fecha,$estado,$idafiliado);
        }else if($type == 2)
        {
            return $pedido->listarPedidos_estado($idcliente,$estado,$idafiliado);
        }else if($type == 3)
        {
            $id = $_POST['id'];
            $estado = $_POST['estado'];
            $idafiliado = $_POST['idafiliado'];
            $pedido->modificarEstado($id,$idafiliado,$estado);
            return $pedido->listarPedidos_estado($idcliente,4,$idafiliado);
        }
    }

    public function procesaDevoluciones()
    {
        $compra = new Compra();
        $_POST = json_decode(file_get_contents("php://input"),true);

        $idafiliado = $_POST['idafiliado'];
        $idfactura = $_POST['idfactura'];
        
        $estado = $compra->anularFactura($idafiliado,$idfactura);
        if($estado == 0)
        {
            $mensaje = response()->json(['texto' => 'La factura no fue anulada', 'tipo' => 'error']);
        }else{
            $mensaje = response()->json(['texto' => 'La factura ha sido anulada con éxito', 'tipo' => 'success']);
        }

        return $mensaje;
        
    }

    public function procesaEstadisticas($type,$idafiliado,$fechas='0')
    {
        $estadistica = new Estadistica();
        if($type==1)
        {
            return $estadistica->listarVentasMeses_data($idafiliado);
        }else if($type==2)
        {
            return $estadistica->listarVentasMeses_head($idafiliado);
        }else if($type==3)
        {
            return $estadistica->listarProductosVendidos_data($idafiliado,$fechas);
        }else if($type==4)
        {
            return $estadistica->listarProductosVendidos_head($idafiliado,$fechas);
        }
    }

    public function procesaAfiliados($type,$idafiliado="0")
    {
        $afiliado = new Afiliado();
        $_POST = json_decode(file_get_contents("php://input"),true);

        if($type==0)
        {
            if($idafiliado=="0")
            {
                return $afiliado->listarAfiliados();
            }else{
                return $afiliado->listarAfiliados_nombre($idafiliado);
            }
        }else if($type==1)
        {
            $nombre = $_POST['nombre'];
            $estado = $_POST['estado'];

            $afiliado->registrarAfiliado($nombre,$estado);
            return $afiliado->listarAfiliados();
        }else if($type==2)
        {
            $id = $_POST['id'];
            $nombre = $_POST['nombre'];
            $estado = $_POST['estado'];

            $afiliado->modificarAfiliado($id,$nombre,$estado);
            return $afiliado->listarAfiliados();
        }else if($type==3)
        {
            $afiliado->eliminarAfiliado($idafiliado);
            return $afiliado->listarAfiliados();
        }
    }

    public function procesaAjustes($type,$idafiliado="",$rango="",$idusuario="")
    {
        $cliente = new Cliente();
        $empleado = new Empleado();
        $_POST = json_decode(file_get_contents("php://input"),true);

        if($type==0)
        {
            if($rango>0)
            {
                return $empleado->getEmpleado($idusuario,$idafiliado);
            }else{
                return $cliente->getCliente($idusuario);
            }
        }else if($type==1)
        {
            $id = $_POST['id'];
            $rango = $_POST['rango'];
            $nombres = $_POST['nombres'];
            $apellidos = $_POST['apellidos'];
            $direccion = $_POST['direccion'];
            $telefono = $_POST['telefono'];
            if($rango>0)
            {
                $idafiliado = $_POST['idafiliado'];
                $empleado->setEmpleado($id,$idafiliado,$nombres,$apellidos,$direccion,$telefono);
                return $empleado->getEmpleado($id,$idafiliado);
            }else{
                $cliente->setCliente($id,$nombres,$apellidos,$direccion,$telefono);
                return $cliente->getCliente($id);
            }
        }
    }

    public function procesaVisor($type,$idafiliado,$fecha="")
    {
        $visor = new Visor();
        if($type == 0)
        {
            return $visor->getFacturas($idafiliado,$fecha);
        }
    }

    public function procesaNomina($type,$idafiliado="",$idusuario="")
    {
        $nomina = new Nomina();
        $_POST = json_decode(file_get_contents("php://input"),true);
        if($type == 0)
        {
            return $nomina->getNomina($idafiliado,$idusuario);
        }else if($type == 1)
        {
            return array("","Nomina liquidada y guardada correctamente","success");
        }
    }
}