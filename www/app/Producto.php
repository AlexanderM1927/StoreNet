<?php

namespace App;

use Illuminate\Support\Facades\DB;

class Producto
{

    public function listarProductos(){
        $arrayProductos = DB::select("SELECT * FROM producto LIMIT 50");
        return json_encode($arrayProductos);
    }

    public function listarProductos_nombre($param){
        $arrayProductos = DB::select("SELECT * FROM producto WHERE nombre LIKE '%$param%' LIMIT 50");
        return json_encode($arrayProductos);
    }
    

}

?>