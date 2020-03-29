<?php

namespace App;

use Illuminate\Support\Facades\DB;

class Cliente
{

    public function listarClientes(){
        $arrayClientes = DB::select("SELECT * FROM cliente LIMIT 10");
        return json_encode($arrayClientes);
    }

    public function listarClientes_parametro($param){
        $arrayClientes = DB::select("SELECT * FROM cliente WHERE nombres LIKE '%$param%' LIMIT 10");
        return json_encode($arrayClientes);
    }
    

}

?>