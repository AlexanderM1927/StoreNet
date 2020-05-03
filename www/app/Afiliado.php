<?php

namespace App;

use Illuminate\Support\Facades\DB;

class Afiliado
{

    public function listarAfiliados()
    {
        $arrayAfiliados = DB::select("SELECT * FROM afiliado WHERE estado = 1");
        return json_encode($arrayAfiliados);
    }

    public function listarAfiliados_nombre($nombre)
    {
        $arrayAfiliados = DB::select("SELECT * FROM afiliado WHERE nombre = '$nombre' AND estado = 1");
        return json_encode($arrayAfiliados);
    }

    public function registrarAfiliado($nombre,$estado)
    {
        DB::insert('INSERT INTO afiliado (nombre,estado) values (?, ?)', [ $nombre, $estado]);
    }

    public function modificarAfiliado($id,$nombre,$estado)
    {
        DB::update('UPDATE afiliado SET nombre = ?, estado = ? WHERE id = ?',[ $nombre,$estado,$id ]);
    }

    public function eliminarAfiliado($id)
    {
        DB::update("UPDATE afiliado SET estado = 0 WHERE id = $id");
        DB::update("UPDATE empleado SET estado = 0 WHERE idafiliado = $id");
    }
    
}

?>