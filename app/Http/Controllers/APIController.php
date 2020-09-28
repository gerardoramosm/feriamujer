<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class APIController extends Controller
{
    //
    function buscar_ciudad(Request $request) {
        $ciudades=DB::table('localidades')->where('id_pais',$request->search)->orderBy('nombre','ASC')->get();
        return $ciudades;
    }
}
