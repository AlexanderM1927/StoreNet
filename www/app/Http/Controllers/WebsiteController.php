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
    public function index ()
    {
        return view('index');
    }

    public function home ()
    {
        return view('home');
    }

    public function comprar ()
    {
        return view('comprar');
    }
}
