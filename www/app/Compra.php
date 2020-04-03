<?php

namespace App;

use Illuminate\Support\Facades\DB;

class Compra
{

    public function listarCompras($idcliente)
    {
        $productos = array();
        $arrayCompras = DB::select("SELECT * FROM factura WHERE idcliente = $idcliente");
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
             if($cliente->saldo>=$costosProductos)
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
    
}

?>