<?php

namespace App\Http\Controllers;

use App\Models\Endereco;
use App\Models\Usuario;
use Illuminate\Http\Request;

class enderecoController extends Controller
{
    public function listagem(Request $request)
    {
        $endereco = Endereco::all();

        return response()->json($endereco);
    }

    public function adicionar(Request $request)
    {
        if($request->logradouro != "" && $request->cep != "") {
        $endereco = new Endereco();
        $endereco->logradouro = $request->logradouro;
        $endereco->cep = $request->cep;
        $endereco->save();

        $endereco->usuarios()->attach($request->id_usuario);
    
        return response()->json($endereco);
    }

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

}
