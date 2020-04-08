<?php

namespace App;

use Illuminate\Support\Facades\DB;

class Compra
{

    public function listarCompras($idcliente)
    {
        $productos = array();
        $arrayCompras = DB::select("SELECT * FROM factura WHERE idcliente = $idcliente AND anulada = 0");
        foreach($arrayCompras as $compra)
        {
            $idafiliado = $compra->idafiliado;
            $idfactura = $compra->id;
            $fecha = $compra->fecha;
            $stockQ = DB::select("SELECT COUNT(*) as cuenta FROM venta WHERE idfactura = $idfactura AND idafiliado = $idafiliado");
            $stock = $stockQ[0]->cuenta;
            $afiliadoQ = DB::select("SELECT nombre FROM afiliado WHERE id = $idafiliado");
            $afiliado = $afiliadoQ[0]->nombre;
            $valortotalQ = DB::select("SELECT SUM(P.precioventa*V.cantidad) as suma FROM producto as P, venta as V WHERE V.idproducto=P.id AND V.idfactura = $idfactura AND V.idafiliado = $idafiliado");
            $valortotal = $valortotalQ[0]->suma;
            array_push($productos, ['id' => $idfactura, 'idafiliado' => $idafiliado, 'afiliado' => $afiliado, 'fecha' => $fecha, 'valortotal' => $valortotal, 'stock' => $stock]);
        }
        return $productos;
    }

    public function listarCompras_fecha($idcliente,$fechas)
    {
        $fechas = json_decode($fechas);
        if($fechas->desde != null && $fechas->hasta != null)
        {
        $desde = date("Y-m-d",strtotime($fechas->desde));
        $hasta = date("Y-m-d",strtotime($fechas->hasta));
        $productos = array();
        $arrayCompras = DB::select("SELECT * FROM factura WHERE idcliente = $idcliente AND (fecha BETWEEN CAST('$desde' AS DATE) AND CAST('$hasta' AS DATE)) AND anulada = 0");
        foreach($arrayCompras as $compra)
        {
            $idafiliado = $compra->idafiliado;
            $idfactura = $compra->id;
            $fecha = $compra->fecha;
            $stockQ = DB::select("SELECT COUNT(*) as cuenta FROM venta WHERE idfactura = $idfactura AND idafiliado = $idafiliado");
            $stock = $stockQ[0]->cuenta;
            $afiliadoQ = DB::select("SELECT nombre FROM afiliado WHERE id = $idafiliado");
            $afiliado = $afiliadoQ[0]->nombre;
            $valortotalQ = DB::select("SELECT SUM(P.precioventa*V.cantidad) as suma FROM producto as P, venta as V WHERE V.idproducto=P.id AND V.idfactura = $idfactura AND V.idafiliado = $idafiliado");
            $valortotal = $valortotalQ[0]->suma;
            array_push($productos, ['id' => $idfactura, 'idafiliado' => $idafiliado, 'afiliado' => $afiliado, 'fecha' => $fecha, 'valortotal' => $valortotal, 'stock' => $stock]);
        }
        return $productos;
        }else{
            return $this->listarCompras($idcliente);
        }

    }

    public function listarCompras_productos($idfactura,$idafiliado)
    {
        $productos = array();
        $arrayCompras = DB::select("SELECT * FROM venta WHERE idfactura = $idfactura AND idafiliado = $idafiliado");
        foreach($arrayCompras as $compra)
        {
            $id=$compra->id;
            $cantidad=$compra->cantidad;
            $idproducto=$compra->idproducto;
            $arrayProductos = DB::select("SELECT * FROM producto WHERE idafiliado = $idafiliado AND id = $idproducto");
            foreach($arrayProductos as $producto)
            {
                $nombre = $producto->nombre;
                $valorUnitario = $producto->precioventa;
                $valorTotal = ($producto->precioventa*$cantidad);
                array_push($productos, ['id' => $id, 'cantidad' => $cantidad, 'nombre' => $nombre, 'valorUnitario' => $valorUnitario, 'valortotal' => $valorTotal ]);
            }
        }

        return $productos;
    }

    public function registrarCompra($productos,$idcliente)
    {
        $costosProductos = 0;
        $respuesta = 0;

        //Calcular costo total de todos los productos seleccionados
        foreach($productos as $producto)
        {
            $costosProductos+=($producto['cantidad']*$producto['producto']['precioventa']);
        }
        $arrayClientes = DB::select("SELECT * FROM tarjeta WHERE idcliente = $idcliente");
        foreach($arrayClientes as $cliente)
        {
             if($cliente->saldo >= $costosProductos)
             {
                foreach($productos as $producto)
                {
                    $id = $producto['producto']['id'];
                    $cantidad=$producto['cantidad'];
                    $idafiliado=$producto['producto']['idafiliado'];
                    $arrayProductos = DB::select("SELECT * FROM producto WHERE id = $id AND idafiliado = $idafiliado");
                    foreach($arrayProductos as $item)
                    {
                        if($cantidad<=$item->cantidad)
                        {
                            DB::insert('INSERT INTO factura(idafiliado, idcliente, fecha) values (?, ?, now())', [ $item->idafiliado,$idcliente ]);
                            $idfactura = DB::getPdo()->lastInsertId();
                            DB::insert('INSERT INTO pedido(idcliente,idafiliado,idfactura,estado,fecha) VALUES (?,?,?,0,now())',[ $idcliente,$item->idafiliado,$idfactura ]);
                            DB::insert('INSERT INTO venta(idafiliado,idfactura,idproducto,cantidad) VALUES (?,?,?,?)',[ $item->idafiliado,$idfactura,$item->id,$cantidad ]);
                            DB::update('UPDATE producto SET cantidad = cantidad - ? WHERE id = ? AND idafiliado = ?', [ $producto['cantidad'],$item->id,$item->idafiliado ]);
                            $valortotal=$cantidad*$item->precioventa;
                            DB::update('UPDATE tarjeta SET saldo = saldo - ? WHERE idcliente = ?', [ $valortotal,$idcliente ]);
                            $respuesta = 0;
                        }else{
                            $respuesta = 2;
                        }
                    }
                }
             }else{
                 $respuesta = 1;
             }
        }

        return $respuesta;

    }

    public function anularFactura($idafiliado,$idfactura)
    {
        $estado = 0;
        $factura = DB::select("SELECT COUNT(*) as registros FROM factura WHERE idafiliado = $idafiliado AND id = $idfactura AND anulada = 0");
        $registros = $factura[0]->registros;
        
        if($registros==0)
        {
            $estado = 0;
        }else{
            $factura = DB::select("SELECT * FROM factura WHERE id = $idfactura AND idafiliado = $idafiliado");
            $idcliente = $factura[0]->idcliente;
            DB::update("UPDATE factura SET anulada = 1 WHERE idafiliado = $idafiliado AND id = $idfactura");
            DB::update("UPDATE producto as p, venta as v SET p.cantidad = p.cantidad + v.cantidad
                                                         WHERE p.id = v.idproducto AND v.idfactura = $idfactura AND v.idafiliado = $idafiliado");
            DB::update("UPDATE pedido as p SET p.estado = 2 WHERE p.idfactura = $idfactura AND p.idafiliado = $idafiliado");
            $arrayVentas = DB::select("SELECT * FROM venta WHERE idafiliado = $idafiliado AND idfactura = $idfactura");
            DB::delete("DELETE FROM venta WHERE idfactura = $idfactura AND idafiliado = $idafiliado"); //ESTO PUEDE CAMBIAR CON EL TIEMPO
            $valortotal = 0;
            foreach($arrayVentas as $venta)
            {
                $cantidad=$venta->cantidad;
                $idproducto = $venta->idproducto;
                $productos = DB::select("SELECT * FROM producto WHERE id = $idproducto AND idafiliado = $idafiliado");
                $valorUnitario = $productos[0]->precioventa;
                $valor=$cantidad*$valorUnitario;
                $valortotal+=$valor;
            }
            DB::update("UPDATE tarjeta SET saldo = saldo + $valortotal WHERE idcliente = $idcliente");
            $estado=1;
        }

        
        return $registros;

    }
    
}

?>