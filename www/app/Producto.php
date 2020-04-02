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
    
}

?>