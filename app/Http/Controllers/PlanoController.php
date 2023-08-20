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
        Planos::where('id','=',$request->id)->delete();
    }

    public function edit_planos(Request $request)
    {
        try {
            
            Planos::where('id','=',$request->idplano)->update([

                'plano' => $request->nomeplano,
                'mensalidade' => $request->mensalidade,
                'descricao' => $request->descricao,
                'status' => $request->status
            ]);

            return response()->json(true);

        } catch (Exception $e) {
            return response()->json($e);    
        }  
    }

    public function new_planos(Request $request)
    {
        try {
            
            Planos::insert([

                'plano' => $request->novo_nomeplano,
                'mensalidade' => $request->novo_mensalidade,
                'descricao' => $request->novo_descricao,
                'status' => 'A',
                'created_at' => now(),
                'updated_at' => now()
            ]);

            return response()->json(true);

        } catch (Exception $e) {
            return response()->json($e);    
        }    
    }
}
