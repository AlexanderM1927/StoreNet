<?php

namespace App;

use Illuminate\Support\Facades\DB;
use DateTime;

class Nomina
{
    public function getNomina($idafiliado,$idusuario)
    {
        $arrayNominas = DB::select("SELECT * FROM nomina WHERE idafiliado = $idafiliado AND idempleado = $idusuario ORDER BY id DESC");
        return json_encode($arrayNominas);
    }

    public function getNomina_fecha($idafiliado,$idusuario,$fechas)
    {
        $fechas = json_decode($fechas);
        if($fechas->desde != null && $fechas->hasta != null)
        {
            $desde = date("Y-m-d",strtotime($fechas->desde));
            $hasta = date("Y-m-d",strtotime($fechas->hasta));
            $arrayNominas = DB::select("SELECT * FROM nomina WHERE idafiliado = $idafiliado AND idempleado = $idusuario AND (fecha BETWEEN CAST('$desde' AS DATE) AND CAST('$hasta' AS DATE)) ORDER BY id DESC");
            return json_encode($arrayNominas);
        }
    }

    public function getNominaAfiliado($idafiliado)
    {
        $arrayNominas = DB::select("SELECT * FROM nomina WHERE idafiliado = $idafiliado  ORDER BY id DESC");
        return json_encode($arrayNominas);
    }

    public function getNominaAfiliado_fecha($idafiliado,$fechas)
    {
        $fechas = json_decode($fechas);
        if($fechas->desde != null && $fechas->hasta != null)
        {
            $desde = date("Y-m-d",strtotime($fechas->desde));
            $hasta = date("Y-m-d",strtotime($fechas->hasta));
            $arrayNominas = DB::select("SELECT * FROM nomina WHERE idafiliado = $idafiliado AND (fecha BETWEEN CAST('$desde' AS DATE) AND CAST('$hasta' AS DATE))  ORDER BY id DESC");
            return json_encode($arrayNominas);
        }
    }

    public function setNomina($idafiliado,$idusuario,$dias,$hext,$hn,$hdf,$ded,$tdev,$tded,$tpag,$tnom)
    {
        DB::insert("INSERT INTO nomina(idafiliado,idempleado,dias,horasextras,recargonocturno,horasdyf,deducciones,totaldevengado,totaldeducido,totalpago,totalnomina,fecha) VALUES(?,?,?,?,?,?,?,?,?,?,?,now())", [$idafiliado,$idusuario,$dias,$hext,$hn,$hdf,$ded,$tdev,$tded,$tpag,$tnom]);
    }

    public function eliminarNomina($idafiliado,$id)
    {
        DB::delete("DELETE FROM nomina WHERE idafiliado = $idafiliado AND id = $id");
    }
}
