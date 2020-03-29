<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ActionController extends Controller
{
    /**
     * undocumented function
     *
     * @return void
     * @author 
     **/

    public function comprar ()
    {
        echo $_POST["dato"];
    }

    public function procesaProductos ($type,$params)
    {
        if($type==0 && $params==0)
        {
            $arrayProductos = DB::select("SELECT * FROM producto LIMIT 50");
            return json_encode($arrayProductos);
        }
    }
}
