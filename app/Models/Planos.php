<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Alunos;

class Planos extends Model
{
    use HasFactory;

    public function alunos()
    {
        return $this->hasMany(Alunos::class, 'id_plano');
    }
}
