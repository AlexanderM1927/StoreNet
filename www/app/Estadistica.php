<?php

namespace App;

use Illuminate\Support\Facades\DB;

class Estadistica
{

    public function listarVentasMeses_data($idafiliado)
    {
        $arrayProductos = DB::select("SELECT SUM(v.cantidad) as ventas 
        FROM factura as f,venta as v
        WHERE (f.fecha BETWEEN DATE_ADD(DATE_SUB(CURDATE(), INTERVAL 3 MONTH), INTERVAL 1 DAY) AND DATE_SUB(CURDATE(), INTERVAL 2 MONTH)) AND f.idafiliado = $idafiliado AND v.idfactura = f.id");
        $mes1 = $arrayProductos[0]->ventas;
        $arrayProductos1 = DB::select("SELECT SUM(v.cantidad) as ventas 
        FROM factura as f,venta as v 
        WHERE (f.fecha BETWEEN DATE_ADD(DATE_SUB(CURDATE(), INTERVAL 2 MONTH), INTERVAL 1 DAY) AND DATE_SUB(CURDATE(), INTERVAL 1 MONTH)) AND f.idafiliado = $idafiliado AND v.idfactura = f.id");
        $mes2 = $arrayProductos1[0]->ventas;
        $arrayProductos2 = DB::select("SELECT SUM(v.cantidad) as ventas 
        FROM factura as f, venta as v
        WHERE (f.fecha BETWEEN DATE_ADD(DATE_SUB(CURDATE(), INTERVAL 1 MONTH), INTERVAL 1 DAY) AND CURDATE()) AND f.idafiliado = $idafiliado AND v.idfactura = f.id");
        $mes3 = $arrayProductos2[0]->ventas;
        
        return response()->json(["label"=> "Ventas", "backgroundColor"=> "#1e87f0", "data"=> [$mes1,$mes2,$mes3]]);
    }

    public function listarVentasMeses_head($idafiliado)
    {
        $fecha_actual = date("d-m-Y");
        $mes3 = date("d-m-Y",strtotime($fecha_actual."- 3 month")).' a '.date("d-m-Y",strtotime($fecha_actual."- 2 month"));
        $mes2 = date("d-m-Y",strtotime($fecha_actual."- 2 month")).' a '.date("d-m-Y",strtotime($fecha_actual."- 1 month"));
        $mes1 = date("d-m-Y",strtotime($fecha_actual."- 1 month")).' a Hoy';
        return array($mes3,$mes2,$mes1);
    }

    public function listarProductosVendidos_data($idafiliado,$fechas)
    {
        $arrayProductos = DB::select("SELECT p.id as id,
            p.cantidad as cantidad,
            IFNULL(SUM(v.cantidad), 0) as ventas  
            FROM producto as p
            LEFT JOIN venta as v ON p.id = v.idproducto 
            WHERE p.idafiliado = ".$idafiliado." GROUP BY id ORDER BY ventas DESC LIMIT 5");
        return response()->json(["label"=> "Data One","backgroundColor"=> ["#41B883", "#E46651", "#00D8FF", "#FFFF00", "#000000"],"data"=>[$arrayProductos[0]->ventas, $arrayProductos[1]->ventas, $arrayProductos[2]->ventas, $arrayProductos[3]->ventas, $arrayProductos[4]->ventas]]);
    }

    public function listarProductosVendidos_head($idafiliado,$fechas)
    {
        $arrayProductos = DB::select("SELECT p.id as id,
            p.nombre as nombre,
            p.cantidad as cantidad,
            IFNULL(SUM(v.cantidad), 0) as ventas  
            FROM producto as p 
            LEFT JOIN venta as v ON p.id = v.idproducto 
            WHERE p.idafiliado = ".$idafiliado." GROUP BY id ORDER BY ventas DESC LIMIT 5");
        return array($arrayProductos[0]->nombre,$arrayProductos[1]->nombre,$arrayProductos[2]->nombre,$arrayProductos[3]->nombre, $arrayProductos[4]->nombre);
    }

    public function buscarProductos($idafiliado,$fechas)
    {

    }
    
}

?>