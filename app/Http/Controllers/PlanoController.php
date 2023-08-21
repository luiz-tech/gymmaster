<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

//serviço personalizado de validação
use App\Services\ValidationService;

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
        // Validação dos campos
        $validationResult = $this->validatePlanos($request->all(),null);

        if ($validationResult !== true)
        {
            return $validationResult;
        }

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
        // Validação dos campos
        $validationResult = $this->validatePlanos($request->all(),'novo_');

        if ($validationResult !== true)
        {
            return $validationResult;
        }

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


    // Validar os campos específicos dos alunos
    public function validatePlanos($data,$prefix)
    {   
        // Definição das regras de integridade
        $rules = [
            $prefix.'nomeplano'     => 'required',
            $prefix.'mensalidade'   => 'required',
            $prefix.'descricao'     => 'required',
        ];

        // Definição das mensagens de erro
        $messages = [
            $prefix.'nomeplano.required' => 'O campo nome é obrigatório.',
            $prefix.'descricao.required' => 'O campo descrição é obrigatório.',
            $prefix.'mensalidade.required' => 'O campo mensalidade é obrigatório.',
        ];

        // Validação dos campos
        $validationResult = ValidationService::validateFields($data, $rules, $messages);

        if ($validationResult !== true) {
            return response()->json(['errors' => $validationResult], 422); // HTTP status code for validation errors
        }

        return true;
    }
}
