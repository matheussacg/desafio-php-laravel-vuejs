<?php

namespace App\Http\Controllers;

use App\Models\Perfil;
use Illuminate\Http\Request;

class perfilController extends Controller
{
    public function listarperfils(Request $request)
    {
        $perfil = Perfil::all();

        return response()->json($perfil);
    }

    public function buscarPerfil($id)
    {
        $perfil = Perfil::find($id);
        return response()->json($perfil);
    }

}
