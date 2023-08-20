<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Pessoas;
use App\Models\Alunos;
use App\Models\Pagamentos;

class PagamentoController extends Controller
{
    public function load_pagamentos()
    {
        $pagamentos = Pagamentos::join('alunos', 'pagamentos.id_aluno', '=', 'alunos.id')
        ->join('pessoas', 'alunos.id_pessoa', '=', 'pessoas.id')
        ->join('contatos', 'pessoas.id', '=', 'contatos.id_pessoa')
        ->join('planos', 'alunos.id_plano', '=', 'planos.id')
        ->select('pagamentos.*', 'pessoas.nome as nome_aluno', 'contatos.celular1', 'planos.plano', 'planos.mensalidade')
        ->orderBy('pagamentos.dt_vencimento','asc')
        ->get();

        return view('pagamentos',compact('pagamentos'));
    }

    public function historicoPagamentos($alunoNome = null)
    {
    
        // Recuperar o histórico de pagamentos
        $query = Pagamentos::join('alunos', 'pagamentos.id_aluno', '=', 'alunos.id')
            ->join('pessoas', 'alunos.id_pessoa', '=', 'pessoas.id')
            ->join('planos', 'alunos.id_plano', '=', 'planos.id')
            ->select(
                'pagamentos.*',
                'pessoas.nome as nome_aluno',
                'planos.plano',
                'planos.mensalidade'
            )
            ->orderBy('dt_pagamento', 'desc');

        if ($alunoNome !== null) {
            $query->where('pessoas.nome', $alunoNome);
        }

        $historicoPagamentos = $query->get();
    }

}
