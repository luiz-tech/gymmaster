<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

//recursos extras
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {

            // Preencher a sessão com os dados do usuário
            $usuario = Auth::user();

            Session::put($usuario->toArray());

            //carregando dados necessários
        
        } else {

            //pagina de login com mensagem de erro
            return back()->withErrors(['credentials' => 'Credenciais inválidas Verifique Novamente']);
        }
    }

    public function load_data_chart()
    {
       $alunosSemanais = DB::table('pessoas')
        ->join('alunos', 'pessoas.id', '=', 'alunos.id_pessoa')
        ->select(DB::raw('WEEKOFYEAR(pessoas.created_at) as week'), DB::raw('COUNT(*) as student_count'))
        ->groupBy('week')
        ->orderBy('week')
        ->get();

        return json_encode($alunosSemanais);
    }
}
