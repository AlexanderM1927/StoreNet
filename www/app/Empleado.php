<?php

namespace App;

use Illuminate\Support\Facades\DB;

class Empleado
{

    public function listarEmpleados($idafiliado){
        $arrayEmpleados = DB::select("SELECT * FROM empleado WHERE idafiliado = $idafiliado LIMIT 10");
        return json_encode($arrayEmpleados);
    }

    public function listarEmpleados_parametro($idafiliado,$param,$data){
        if($param == 'nombres' || $param == 'apellidos'){
            $arrayEmpleados = DB::select("SELECT * FROM empleado WHERE CONCAT(nombres,' ',apellidos) LIKE '%".$data."%' AND idafiliado = $idafiliado");
            return json_encode($arrayEmpleados);
        }else{
            $arrayEmpleados = DB::select("SELECT * FROM empleado WHERE ".$param." LIKE '%".$data."%' AND idafiliado = $idafiliado LIMIT 20");
            return json_encode($arrayEmpleados);
        }
    }

    public function registrarEmpleado($idafiliado,$rango,$sueldo,$nombres,$apellidos,$mail,$password,$direccion,$telefono)
    {
        DB::insert('INSERT INTO empleado (idafiliado, rango, sueldo, nombres, apellidos, mail, password, direccion, telefono) values (?, ?, ?,?, ?, ?, ?, ?, ?)', [ $idafiliado, $rango, $sueldo, $nombres,
         $apellidos, $mail, $password, $direccion, $telefono]);
    }

    public function modificarEmpleado($id,$idafiliado,$rango,$sueldo,$nombres,$apellidos,$mail,$password,$direccion,$telefono)
    {
        DB::update('UPDATE empleado SET rango = ?, sueldo = ?, nombres = ?, apellidos = ?, mail = ?, password = ?, direccion = ?, telefono = ?  WHERE id = ? AND idafiliado = ?', [ $rango, $sueldo, $nombres,
         $apellidos, $mail, $password, $direccion, $telefono, $id, $idafiliado ]);
    }

    public function eliminarEmpleado($id,$idafiliado)
    {
        DB::delete('DELETE FROM empleado WHERE id = ? AND idafiliado = ?', [ $id,$idafiliado ]);
    }
    

}

?>