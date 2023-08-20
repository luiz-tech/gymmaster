<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

//recursos extras
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

//serviço personalizado de validação
use App\Services\ValidationService;

//usando modelos
use App\Models\Pessoas;
use App\Models\Alunos;
use App\Models\Enderecos;
use App\Models\Contatos;

class UserController extends Controller
{
    public function user_login(Request $request)
    {
        $email = trim($request->input('email'));
        $password = $request->input('password');

        $user = Pessoas::where('email', $email)->first();

        if ($user) 
        {  
            if(Hash::check($password, $user->password))
            {
                //realizar login do usuario
                Auth::login($user);

                Session::put($user->toArray());

                return redirect()->intended('/painel');
            
            } else {
                // email incorreto
                return back()->withErrors(['email' => 'E-mail Inválido.']);
            }
            
        } else {
            // senha incorreta
            return back()->withErrors(['senha' => 'Senha Incorreta.']);
        }
    }

    public function user_logout()
    {
        Auth::logout();
        return redirect()->route('Login'); 
    }

    public function load_alunos(Request $request)
    {   
        $status = $request->query('status', 'all');

        $alunosQuery = DB::table('alunos')
            ->join('pessoas', 'alunos.id_pessoa', '=', 'pessoas.id')
            ->join('contatos', 'pessoas.id', '=', 'contatos.id_pessoa')
            ->join('enderecos', 'pessoas.id', '=', 'enderecos.id_pessoa')
            ->join('planos', 'alunos.id_plano', '=', 'planos.id')
            ->leftJoin('instrutores', 'pessoas.id', '=', 'instrutores.id_pessoa')
            ->select(
                'alunos.id as aluno_id',
                'alunos.id_plano',
                'alunos.peso',
                'alunos.altura',
                'alunos.objetivos',
                'pessoas.id as id_pessoa_master',
                'pessoas.nome',
                'pessoas.email',
                'pessoas.password',
                'pessoas.cpf',
                'pessoas.dt_nascimento',
                'pessoas.sexo',
                'pessoas.status',
                'pessoas.created_at',
                'pessoas.updated_at',
                'enderecos.rua',
                'enderecos.numero',
                'enderecos.complemento',
                'enderecos.bairro',
                'enderecos.cidade',
                'enderecos.cep',
                'contatos.celular1',
                'contatos.celular2',
                'contatos.instagram',
                'planos.plano',
                'planos.descricao',
                'planos.mensalidade'
            )
            ->whereNull('instrutores.id')
            ->orderBy('pessoas.created_at');

        switch ($status) {
            case 'all':
                // Mantém a query como está
                break;
            case 'a':
                $alunosQuery->where('pessoas.status', '=', 'A');
                break;
            case 'i':
                $alunosQuery->where('pessoas.status', '=', 'I');
                break;
            default:
                // Caso inválido ou vazio, mantém a query como está
                break;
        }

        $alunos = $alunosQuery->get();

        $planos = DB::table('planos')->select('id','plano')->get();

        // Retornando a página com os dados
        return view('pesquisa_alunos', compact('alunos','planos'));
    }

    public function edit_aluno(Request $request)
    {   
        // Validação dos campos
        $validationResult = $this->validateAlunos($request->all(),null);

        if ($validationResult !== true)
        {
            return $validationResult;
        }

        try {
            $alunoId = $request->input('aluno_id');

            // Atualizar os dados do aluno na tabela pessoas
            Pessoas::where('id', $alunoId)
                ->update([
                    'nome' => $request->input('nome'),
                    'email' => Str::trim($request->input('email')),
                    'cpf' => $request->input('cpf'),
                    'dt_nascimento' => $request->input('dt_nascimento'),
                    'status' => $request->input('status'),
                    'sexo' => $request->input('sexo'),
                    'updated_at' => now()
                ]);

            // Atualizar o endereço do aluno
            Enderecos::where('id_pessoa', $alunoId)
                ->update([
                    'rua' => $request->input('rua'),
                    'numero' => $request->input('numero'),
                    'complemento' => $request->input('complemento'),
                    'bairro' => $request->input('bairro'),
                    'cidade' => $request->input('cidade'),
                    'cep' => $request->input('cep'),
                    'updated_at' => now()
                ]);

            // Atualizar os contatos do aluno
            Contatos::where('id_pessoa', $alunoId)
                ->update([
                    'celular1' => $request->input('celular1'),
                    'celular2' => $request->input('celular2'),
                    'instagram' => $request->input('instagram'),
                    'updated_at' => now()
                ]);

            // Atualizar os dados do aluno na tabela alunos
            Alunos::where('id_pessoa', $alunoId)
                ->update([
                    'id_plano' => $request->input('plano'),
                    'peso' => $request->input('peso'),
                    'altura' => $request->input('altura'),
                    'objetivos' => $request->input('objetivos'),
                    'updated_at' => now()
                ]);

            // Resposta de sucesso
            return response()->json(['message' => 'Aluno atualizado com sucesso']);

        } catch (\Exception $e) {
            // Resposta de erro
            return response()->json(['error' => 'Erro ao atualizar aluno: ' . $e->getMessage()], 500);
        }
    }
      
    public function delete_aluno(Request $request)
    {
        DB::table('pagamentos')->where('id_aluno', $request->id)->delete();

        DB::table('alunos')->where('id','=',$request->id)->delete();

        DB::table('pessoas')->where('id','=',$request->id)
        ->delete();

        DB::table('enderecos')->where('id_pessoa','=',$request->id)
        ->delete();

        DB::table('contatos')->where('id_pessoa','=',$request->id)
        ->delete();

        return response()->json(true);
    }

    public function new_aluno(Request $request)
    {   

        // Validação dos campos
        $validationResult = $this->validateAlunos($request->all(),'novo_');

        if ($validationResult !== true)
        {
            //return $validationResult;
            return $validationResult;

        }

        try {
            // Dados do formulário de cadastro de novo aluno
            $alunoData = $request->except('_token');

            // Inserir na tabela "pessoas"
            $pessoaId = DB::table('pessoas')->insertGetId([
                'nome' => $alunoData['novo_nome'],
                'email' => Str::trim($alunoData['novo_email']),
                'password' => Hash::make('123'),
                'cpf' => $alunoData['novo_cpf'],
                'dt_nascimento' => $alunoData['novo_dt_nascimento'],
                'sexo' => $alunoData['novo_sexo'],
                'status' => $alunoData['novo_status'],
                'created_at' => now(),
                'updated_at' => now()
            ]);

            // Inserir na tabela "enderecos" usando o ID gerado da tabela "pessoas"
            DB::table('enderecos')->insert([
                'id_pessoa' => $pessoaId,
                'rua' => $alunoData['novo_rua'],
                'numero' => $alunoData['novo_numero'],
                'complemento' => $alunoData['novo_complemento'],
                'bairro' => $alunoData['novo_bairro'],
                'cidade' => $alunoData['novo_cidade'],
                'cep' => $alunoData['novo_cep']
            ]);

            // Inserir na tabela "contatos" usando o ID gerado da tabela "pessoas"
            DB::table('contatos')->insert([
                'id_pessoa' => $pessoaId,
                'celular1' => $alunoData['novo_celular1'],
                'celular2' => $alunoData['novo_celular2'],
                'instagram' => $alunoData['novo_instagram']
            ]);

            // Inserir na tabela "alunos" usando o ID gerado da tabela "pessoas"
            DB::table('alunos')->insert([
                'id_pessoa' => $pessoaId,
                'id_plano' => $alunoData['novo_plano'],
                'peso' => $alunoData['novo_peso'],
                'altura' => $alunoData['novo_altura'],
                'objetivos' => $alunoData['novo_objetivos'],
            ]);

            return response()->json(true);

        } catch (Exception $e) {
            return response()->json($pessoaId);
        } 
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('Login');
    }

    // Validar os campos específicos dos alunos
    public function validateAlunos($data,$prefix)
    {   
        // Definição das regras de integridade
        $rules = [
            $prefix.'nome'         => 'required|string',
            $prefix.'email'         => 'required|email',
            $prefix.'cpf'           => 'required',
            $prefix.'dt_nascimento' => 'required',
            $prefix.'sexo'          => 'required',
            $prefix.'peso'          => 'required|numeric|min:0',
            $prefix.'altura'        => 'required|numeric|min:0',
            $prefix.'rua'       => 'required',
            $prefix.'numero'    => 'required|numeric',
            $prefix.'bairro'    => 'required',
            $prefix.'cidade'    => 'required',
            $prefix.'cep'       => 'required',
            $prefix.'celular1'  => 'required',
        ];

        // Definição das mensagens de erro
        $messages = [
            $prefix.'nome.required' => 'O campo nome é obrigatório.',
            $prefix.'nome.string' => 'Nome não pode conter números',
            $prefix.'email.email' => 'Digite um endereço de e-mail válido.',
            $prefix.'email.required' => 'O campo e-mail é obrigatório.',
            $prefix.'cpf.required' => 'O campo CPF é obrigatório.',
            $prefix.'dt_nascimento.required' => 'O campo Data de Nascimento é obrigatório.',
            $prefix.'sexo.required' => 'O campo Gênero é obrigatório.',
            $prefix.'peso.required' => 'O campo peso é obrigatório.',
            $prefix.'peso.numeric' => 'O peso deve ser um valor numérico em kilogramas (Kg)',
            $prefix.'peso.min' => 'O peso não pode ser um valor negativo',
            $prefix.'altura.required' => 'O campo altura é obrigatório.',
            $prefix.'altura.numeric' => 'O peso deve ser um valor numérico em metros (m)',
            $prefix.'altura.min' => 'A altura não pode ser um valor negativo',
            $prefix.'rua.required' => 'O campo rua na sessão endereço é obrigatório.',
            $prefix.'numero.required' => 'O campo número na sessão endereço é obrigatório.',
            $prefix.'numero.numeric' => 'O campo número deve ser um valor numérico',
            $prefix.'bairro.required' => 'O campo bairro na sessão endereço é obrigatório.', 
            $prefix.'cidade.required' => 'O campo cidade na sessão endereço é obrigatório.',
            $prefix.'cep.required' => 'O campo cep na sessão endereço é obrigatório.',
            $prefix.'celular1.required' => 'Pelo menos o campo Celular 1 é obrigatório',
        ];

        // Validação dos campos
        $validationResult = ValidationService::validateFields($data, $rules, $messages);

        if ($validationResult !== true) {
            return response()->json(['errors' => $validationResult], 422); // HTTP status code for validation errors
        }

        return true;
    }
}
