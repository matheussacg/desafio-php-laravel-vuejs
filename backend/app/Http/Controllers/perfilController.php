<?php

namespace App\Http\Controllers;

use App\Models\Perfil;
use Illuminate\Http\Request;

class perfilController extends Controller
{
    public function listarperfils(Request $request)
    {
        $Perfil = Perfil::all();

        return response()->json($Perfil);
    }

    public function buscarPerfil($id)
    {
        $Perfil = Perfil::find($id);
        return response()->json($Perfil);
    }

}
