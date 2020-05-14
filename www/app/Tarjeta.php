<?php

namespace App;

use Illuminate\Support\Facades\DB;

class Tarjeta
{

    public function listarTarjetas(){
        $arrayTarjetas = DB::select("SELECT * FROM tarjeta ORDER BY puntos DESC LIMIT 10");
        return json_encode($arrayTarjetas);
    }

    public function listarTarjetas_cliente($idcliente){
        $arrayTarjetas = DB::select("SELECT t.idcliente as idcliente,t.saldo as saldo,t.puntos as puntos,t.id as id,CONCAT(c.nombres,' ',c.apellidos) as nombre FROM tarjeta as t LEFT JOIN cliente as c ON c.id = $idcliente WHERE t.idcliente = $idcliente LIMIT 10");
        return json_encode($arrayTarjetas);
    }

    public function registrarTarjeta($idcliente)
    {
        DB::insert('INSERT INTO tarjeta (idcliente,saldo,puntos) values (?, 0, 0)', [ $idcliente ]);
    }

    public function modificarTarjeta($id,$saldo)
    {
        DB::update('UPDATE tarjeta SET saldo = saldo + ?  WHERE id = ?', [ $saldo,$id ]);
    }

    public function eliminarTarjeta($id)
    {
        DB::delete('DELETE FROM tarjeta WHERE id = ?', [ $id ]);
    }
    

}

?>