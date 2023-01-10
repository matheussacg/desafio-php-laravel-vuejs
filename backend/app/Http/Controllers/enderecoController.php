<?php

namespace App\Http\Controllers;

use App\Models\Endereco;
use App\Models\Usuario;
use Illuminate\Http\Request;

class enderecoController extends Controller
{
    public function listagem(Request $request)
    {
        $Endereco = Endereco::all();

        return response()->json($Endereco);
    }

    public function adicionar(Request $request)
    {
        $novoEndereco = new Endereco();
        $novoEndereco->logradouro = $request->logradouro;
        $novoEndereco->cep = $request->cep;
        $novoEndereco->save();

        $novoEndereco->usuarios()->attach($request->id_usuario);

        return response()->json('success');
    }

    public function editar(Endereco $endereco, Request $request)
    {
        return response()->json($endereco);
    }

    public function update(Endereco $endereco, Request $request)
    {
        $endereco->logradouro = $request->logradouro;
        $endereco->cep = $request->cep;
        $endereco->save();

        return response()->json('success');
    }

    public function delete(Endereco $endereco, Request $request)
    {
        $endereco->delete();
        return response()->json('success');
    }

    public function usuarioEndereco($usuario, $endereco){
        $user = Usuario::with('enderecos')->find($usuario);
        $endereco = Endereco::find($endereco);
        $user->enderecos()->save($endereco);
    }

}
