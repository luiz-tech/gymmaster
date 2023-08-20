<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

//usando modelos
use App\Models\Alunos;
use App\Models\Planos;

class Pagamentos extends Model
{
    use HasFactory;

    protected $fillable = ['id_aluno', 'id_plano', 'dt_pagamento','metodo_pagamento'];

    public function aluno()
    {
        return $this->belongsTo(Alunos::class);
    }

    public function plano()
    {
        return $this->belongsTo(Planos::class);
    }
}
