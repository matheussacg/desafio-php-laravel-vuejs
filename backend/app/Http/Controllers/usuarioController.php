<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Models\Endereco;
use Illuminate\Http\Request;

class usuarioController extends Controller
{
    public function listagem(Request $request)
    {
        $Usuario = Usuario::with('enderecos','perfil')->get();

        return response()->json($Usuario);
    }

    public function adicionar(Request $request)
    {   
        $novoUsuario = new Usuario();
        $novoUsuario->nome = $request->nome;
        $novoUsuario->cpf = $request->cpf;
        $novoUsuario->email = $request->email;
        $novoUsuario->perfil_id = $request->perfil_id;
        $novoUsuario->save();

        return response()->json($novoUsuario);
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
