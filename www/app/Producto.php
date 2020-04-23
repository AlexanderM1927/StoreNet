<?php

namespace App;

use Illuminate\Support\Facades\DB;

class Producto
{

    public function listarProductos($idafiliado){
        if($idafiliado=='0')
            $arrayProductos = DB::select("SELECT * FROM producto LIMIT 50");
        else
            $arrayProductos = DB::select("SELECT * FROM producto WHERE idafiliado = ".$idafiliado." LIMIT 50");

        return json_encode($arrayProductos);
    }

    public function listarProductos_param($param,$data,$idafiliado){
        if($idafiliado=='0')
            $arrayProductos = DB::select("SELECT * FROM producto WHERE ".$param." LIKE '%$data%' LIMIT 50");
        else
            $arrayProductos = DB::select("SELECT * FROM producto WHERE idafiliado = ".$idafiliado." AND ".$param." LIKE '%$data%' LIMIT 50");
        
            return json_encode($arrayProductos);
    }

    public function registrarProducto($idafiliado,$nombre,$precioventa,$precioproveedor,$imgurl,$cantidad)
    {
        DB::insert('INSERT INTO producto (idafiliado, nombre, precioventa, precioproveedor, imgurl, cantidad) values (?, ?, ?, ?, ?, ?)', [ $idafiliado, $nombre, $precioventa, $precioproveedor, $imgurl, $cantidad ]);
    }

    public function modificarProducto($id,$idafiliado,$nombre,$precioventa,$precioproveedor,$imgurl,$cantidad)
    {
        DB::update('UPDATE producto SET nombre = ?, precioventa = ?, precioproveedor = ?, imgurl = ?, cantidad = ?  WHERE id = ? AND idafiliado = ?', [ $nombre, $precioventa, $precioproveedor, $imgurl, $cantidad, $id, $idafiliado ]);
    }

    public function eliminarProducto($id,$idafiliado)
    {
        DB::delete('DELETE FROM producto WHERE id = ? AND idafiliado = ?', [ $id,$idafiliado ]);
    }

    public function listarInventario($filtro,$idafiliado)
    {
        $productos = array();
        if($filtro==0)
        {
            $arrayProductos = DB::select("SELECT p.id as id,
            p.nombre as nombre,
            p.precioproveedor as precioproveedor,
            p.precioventa as precioventa,
            p.cantidad as cantidad,
            (p.precioventa-p.precioproveedor) as utilidad,
            IFNULL(SUM(v.cantidad), 0) as ventas  
            FROM producto as p 
            LEFT JOIN venta as v ON p.id = v.idproducto AND v.idafiliado = $idafiliado
            WHERE p.idafiliado = ".$idafiliado." GROUP BY id");
        }else if($filtro==1)
        {
            $arrayProductos = DB::select("SELECT p.id as id,
            p.nombre as nombre,
            p.precioproveedor as precioproveedor,
            p.precioventa as precioventa,
            p.cantidad as cantidad,
            (p.precioventa-p.precioproveedor) as utilidad,
            IFNULL(SUM(v.cantidad), 0) as ventas  
            FROM producto as p 
            LEFT JOIN venta as v ON p.id = v.idproducto AND v.idafiliado = $idafiliado
            WHERE p.idafiliado = ".$idafiliado." GROUP BY id ORDER BY cantidad ASC");
        }else if($filtro==2)
        {
            $arrayProductos = DB::select("SELECT p.id as id,
            p.nombre as nombre,
            p.precioproveedor as precioproveedor,
            p.precioventa as precioventa,
            p.cantidad as cantidad,
            (p.precioventa-p.precioproveedor) as utilidad,
            IFNULL(SUM(v.cantidad), 0) as ventas  
            FROM producto as p 
            LEFT JOIN venta as v ON p.id = v.idproducto AND v.idafiliado = $idafiliado
            WHERE p.idafiliado = ".$idafiliado." GROUP BY id ORDER BY cantidad DESC");
        }else if($filtro==3)
        {
            $arrayProductos = DB::select("SELECT p.id as id,
            p.nombre as nombre,
            p.precioproveedor as precioproveedor,
            p.precioventa as precioventa,
            p.cantidad as cantidad,
            (p.precioventa-p.precioproveedor) as utilidad,
            IFNULL(SUM(v.cantidad), 0) as ventas  
            FROM producto as p 
            LEFT JOIN venta as v ON p.id = v.idproducto AND v.idafiliado = $idafiliado
            WHERE p.idafiliado = ".$idafiliado." GROUP BY id ORDER BY utilidad ASC");
        }else if($filtro==4)
        {
            $arrayProductos = DB::select("SELECT p.id as id,
            p.nombre as nombre,
            p.precioproveedor as precioproveedor,
            p.precioventa as precioventa,
            p.cantidad as cantidad,
            (p.precioventa-p.precioproveedor) as utilidad,
            IFNULL(SUM(v.cantidad), 0) as ventas  
            FROM producto as p 
            LEFT JOIN venta as v ON p.id = v.idproducto AND v.idafiliado = $idafiliado
            WHERE p.idafiliado = ".$idafiliado." GROUP BY id ORDER BY utilidad DESC");
        }else if($filtro==5)
        {
            $arrayProductos = DB::select("SELECT p.id as id,
            p.nombre as nombre,
            p.precioproveedor as precioproveedor,
            p.precioventa as precioventa,
            p.cantidad as cantidad,
            (p.precioventa-p.precioproveedor) as utilidad,
            IFNULL(SUM(v.cantidad), 0) as ventas  
            FROM producto as p 
            LEFT JOIN venta as v ON p.id = v.idproducto AND v.idafiliado = $idafiliado
            WHERE p.idafiliado = ".$idafiliado." GROUP BY id ORDER BY precioventa ASC");
        }else if($filtro==6)
        {
            $arrayProductos = DB::select("SELECT p.id as id,
            p.nombre as nombre,
            p.precioproveedor as precioproveedor,
            p.precioventa as precioventa,
            p.cantidad as cantidad,
            (p.precioventa-p.precioproveedor) as utilidad,
            IFNULL(SUM(v.cantidad), 0) as ventas  
            FROM producto as p 
            LEFT JOIN venta as v ON p.id = v.idproducto AND v.idafiliado = $idafiliado
            WHERE p.idafiliado = ".$idafiliado." GROUP BY id ORDER BY precioventa DESC");
        }else if($filtro==7)
        {
            $arrayProductos = DB::select("SELECT p.id as id,
            p.nombre as nombre,
            p.precioproveedor as precioproveedor,
            p.precioventa as precioventa,
            p.cantidad as cantidad,
            (p.precioventa-p.precioproveedor) as utilidad,
            IFNULL(SUM(v.cantidad), 0) as ventas  
            FROM producto as p 
            LEFT JOIN venta as v ON p.id = v.idproducto AND v.idafiliado = $idafiliado
            WHERE p.idafiliado = ".$idafiliado." GROUP BY id ORDER BY ventas ASC");
        }else if($filtro==8)
        {
            $arrayProductos = DB::select("SELECT p.id as id,
            p.nombre as nombre,
            p.precioproveedor as precioproveedor,
            p.precioventa as precioventa,
            p.cantidad as cantidad,
            (p.precioventa-p.precioproveedor) as utilidad,
            IFNULL(SUM(v.cantidad), 0) as ventas  
            FROM producto as p 
            LEFT JOIN venta as v ON p.id = v.idproducto AND v.idafiliado = $idafiliado
            WHERE p.idafiliado = ".$idafiliado." GROUP BY id ORDER BY ventas DESC");
        }

        return $arrayProductos;
    }
    
}

?>