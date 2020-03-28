<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WebsiteController extends Controller
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
}
