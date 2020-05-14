<?php

namespace App;

use Illuminate\Support\Facades\DB;
use DateTime;

class Visor
{
    public function getFacturas($idafiliado,$fechas)
    {
        $fechas = json_decode($fechas);
        if($fechas->desde != null && $fechas->hasta != null)
        {
        $desde=date_create_from_format('D M d Y H:i:s e+', $fechas->desde);
        $desde=$desde->format("Y-m-d");
        $hasta=date_create_from_format('D M d Y H:i:s e+', $fechas->hasta);
        $hasta=$hasta->format("Y-m-d");
        $arrayFacturas = DB::select("SELECT f.id as id,
        f.idafiliado as idafiliado,
        SUM(p.precioventa*v.cantidad) as totalventa,
        f.fecha as fecha
        FROM factura as f
        LEFT JOIN venta as v ON f.id=v.idfactura AND v.idafiliado = $idafiliado
        LEFT JOIN producto as p ON v.idproducto=p.id AND p.idafiliado = $idafiliado
        WHERE f.idafiliado = $idafiliado AND (f.fecha BETWEEN CAST('$desde' AS DATE) AND CAST('$hasta' AS DATE)) AND f.anulada=0 GROUP BY id");
        }else{
        $arrayFacturas = DB::select("SELECT f.id as id,
        f.idafiliado as idafiliado,
        SUM(p.precioventa*v.cantidad) as totalventa,
        f.fecha as fecha
        FROM factura as f
        LEFT JOIN venta as v ON f.id=v.idfactura
        LEFT JOIN producto as p ON v.idproducto=p.id
        WHERE f.idafiliado = $idafiliado AND f.anulada=0 GROUP BY id");
        }
        

        return json_encode($arrayFacturas);
    }

    public function getBalance($idafiliado,$desde,$hasta)
    {
        $desde=date_create_from_format('D M d Y H:i:s e+', $desde);
        $desde=$desde->format("Y-m-d");
        $hasta=date_create_from_format('D M d Y H:i:s e+', $hasta);
        $hasta=$hasta->format("Y-m-d");
        
        $afiliadoQ = DB::select("SELECT nombre
        FROM afiliado
        WHERE id = $idafiliado");

        $nominasQ = DB::select("SELECT SUM(n.totalnomina) as nominas
        FROM nomina as n, afiliado as a
        WHERE n.idafiliado = $idafiliado AND n.idafiliado = a.id");

        $ventasQ = DB::select("SELECT * FROM balanceVentas WHERE idafiliado = $idafiliado");

        $nombre = $afiliadoQ[0]->nombre;
        $nominas = $nominasQ[0]->nominas;
        $ventas = $ventasQ[0]->ventas;
        $nventas = $ventasQ[0]->nventas;
        $costosv = $ventasQ[0]->costosv;
        $utilidades = $ventasQ[0]->utilidades;


        return array("nombre" => $nombre, "nominas" => $nominas, "ventas" => $ventas, "nventas" => $nventas, "costosv" => $costosv, "utilidades" => $utilidades);
    }

}
