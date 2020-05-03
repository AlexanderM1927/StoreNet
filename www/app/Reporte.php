<?php

namespace App;

use Illuminate\Support\Facades\DB;
use App\Mail\MessageSend;
use Illuminate\Support\Facades\Mail;
use DateTime;

class Reporte
{
    
    public function registrarReporte($titulo,$contenido,$correo)
    {
        DB::insert("INSERT INTO reporte(titulo,contenido,mail,estado,fecha) VALUES (?,?,?,1,now())",[$titulo,$contenido,$correo]);
    }

    public function responderReporte($id,$titulo,$contenido,$correo)
    {
        DB::update("UPDATE reporte SET estado = 0 WHERE id = $id");
        Mail::to($correo)->send(new MessageSend($titulo,$contenido,$correo));
    }

    public function listarReportes()
    {
        $arrayReportes = DB::select("SELECT * FROM reporte WHERE estado = 1 ORDER BY id DESC");

        return json_encode($arrayReportes);
    }

    public function listarReportes_fecha($fechas)
    {
        $fechas = json_decode($fechas);
        if($fechas->desde != null && $fechas->hasta != null)
        {
            $desde = date("Y-m-d",strtotime($fechas->desde));
            $hasta = date("Y-m-d",strtotime($fechas->hasta));
            $arrayNominas = DB::select("SELECT * FROM reporte WHERE (fecha BETWEEN CAST('$desde' AS DATE) AND CAST('$hasta' AS DATE))  ORDER BY id DESC");
            return json_encode($arrayNominas);
        }
    }

}
