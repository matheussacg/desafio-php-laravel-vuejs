<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Models\Endereco;
use Illuminate\Http\Request;

class usuarioController extends Controller
{
    public function listagem(Request $request)
    {
        $user = Usuario::with('enderecos','perfil');

        if ($request->nome != "") {
            $user->where('nome', 'LIKE', '%' . $request->nome . '%');
        }
    
        if ($request->cpf != "") {
            $user->where('cpf', 'LIKE', '%' . $request->cpf . '%');
        }
    
        if ($request->datai != "" && $request->dataf != "") {
            $user->whereDate('created_at', '>=', $request->datai);
            $user->whereDate('created_at', '<=', $request->dataf);
        }

        return response()->json($user->get());
    }

    public function adicionar(Request $request)
    {   
        $user = new Usuario();
        $user->nome = $request->nome;
        $user->cpf = $request->cpf;
        $user->email = $request->email;
        $user->perfil_id = $request->perfil_id;
        $user->save();

        return response()->json($user);
    }

    public function editar(Usuario $user, Request $request)
    {
        return response()->json($user);
    }

    public function update(Usuario $user, Request $request)
    {
        $user->nome = $request->nome;
        $user->cpf = $request->cpf;
        $user->email = $request->email;
        $user->perfil_id = $request->perfil_id;
        $user->save();

        return response()->json('success');
    }

    public function delete(Usuario $user, Request $request)
    {
        $user->delete();
        return response()->json('success');
    }

    public function detalhar($id)
    {
        $user = Usuario::with('enderecos', 'perfil')->find($id);
        return response()->json($user);
    }

}
