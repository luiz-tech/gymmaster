<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Contracts\Auth\Authenticatable;

use App\Models\Enderecos;
use App\Models\Contatos;


class Pessoas extends Model implements Authenticatable
{
    use HasFactory;

    //métodos de configuração de relacionamentos
    public function endereco()
    {
        return $this->hasOne(Enderecos::class, 'id_pessoa');
    }

    public function contato()
    {
        return $this->hasOne(Contatos::class, 'id_pessoa');
    }

    //metódos de autenticablidade da tabela
    public function getAuthIdentifierName()
    {
        return 'id';
    }

    public function getAuthIdentifier()
    {
        return $this->getKey();
    }

    public function getAuthPassword()
    {
        return $this->senha;
    }

    
    public function getRememberToken()
    {
        return $this->{$this->getRememberTokenName()};
    }

    public function setRememberToken($value)
    {
        $this->{$this->getRememberTokenName()} = $value;
    }

    public function getRememberTokenName()
    {
        return 'remember_token';
    }

}
