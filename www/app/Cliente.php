<?php

namespace App;

use Illuminate\Support\Facades\DB;

class Cliente
{

    public function listarClientes(){
        $arrayClientes = DB::select("SELECT * FROM cliente WHERE estado = 1 LIMIT 10");
        return json_encode($arrayClientes);
    }

    public function listarClientes_parametro($param,$data){
        if($param == 'nombres' || $param == 'apellidos'){
            $arrayClientes = DB::select("SELECT * FROM cliente WHERE CONCAT(nombres,' ',apellidos) LIKE '%".$data."%' AND estado = 1");
            return json_encode($arrayClientes);
        }else{
            $arrayClientes = DB::select("SELECT * FROM cliente WHERE ".$param." LIKE '%".$data."%' AND estado = 1 LIMIT 20");
            return json_encode($arrayClientes);
        }
    }

    public function registrarCliente($nombres,$apellidos,$mail,$password,$direccion,$telefono)
    {
        DB::insert('INSERT INTO cliente (nombres, apellidos, mail, password, direccion, telefono) values (?, ?, ?, ?, ?, ?)', [ $nombres,
         $apellidos, $mail, $password, $direccion, $telefono]);
        $idcliente = DB::getPdo()->lastInsertId();
        DB::insert('INSERT INTO tarjeta (idcliente,saldo,puntos) values (?, 0, 0)', [ $idcliente ]);
    }

    public function modificarCliente($id,$nombres,$apellidos,$mail,$password,$direccion,$telefono)
    {
        DB::update('UPDATE cliente SET nombres = ?, apellidos = ?, mail = ?, password = ?, direccion = ?, telefono = ?  WHERE id = ?', [ $nombres,
         $apellidos, $mail, $password, $direccion, $telefono, $id ]);
    }

    public function eliminarCliente($id)
    {
        DB::update('UPDATE cliente SET estado = 0 WHERE id = ?', [ $id ]);
    }
    
    public function getCliente($id)
    {
        $arrayClientes = DB::select("SELECT * FROM cliente WHERE id = $id");
        return json_encode($arrayClientes[0]);
    }

    public function setCliente($id,$nombres,$apellidos,$direccion,$telefono)
    {
        DB::update('UPDATE cliente SET nombres = ?, apellidos = ?, direccion = ?, telefono = ?  WHERE id = ?', [ $nombres,$apellidos,$direccion,$telefono, $id ]);
    }

}

?>