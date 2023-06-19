<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class presidentController extends Controller
{
    //

    public function solde_compte()
    {
        return view('solde_compte_principal');
    }
}
