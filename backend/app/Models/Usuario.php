<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;

    public function perfil(){
        return $this->belongsTo('App\Models\Perfil');
    }

    public function enderecos(){
        return $this->belongsToMany('App\Models\Endereco');
    }
}
