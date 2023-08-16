<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

//recursos extras
use Illuminate\Support\Facades\DB;

class SystemController extends Controller
{
    public function load_data_chart()
    {
       $alunos_a_dia = DB::table('pessoas')
        ->join('alunos', 'pessoas.id', '=', 'alunos.id_pessoa')
        ->select(DB::raw('DAYOFWEEK(pessoas.created_at) as day'), DB::raw('COUNT(*) as student_count'))
        ->groupBy('day')
        ->orderBy('day')
        ->get();

        return response()->json($alunos_a_dia);
    }

    public function load_planos()
    {   
        //consulta pra planos ativos
        $planos = DB::table('planos')->where('status','=','A')->select('id','plano')->get();

        // Retornando os dados
        return response()->json($planos);
    }
}
