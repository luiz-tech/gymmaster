<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

//usando modelos
use App\Models\Planos;


class PlanoController extends Controller
{
    public function load_planos()
    {   
        $planos = Planos::withCount('alunos')->get();

        return view('pesquisa_planos',compact('planos'));
    }

    public function delete_planos(Request $request)
    {
        
    }

    public function edit_planos(Request $request)
    {
        
    }
}
