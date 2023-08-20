<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

//recursos extras
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

//serviço personalizado de validação
use App\Services\ValidationService;

//usando modelos
use App\Models\Pessoas;
use App\Models\Instrutores;
use App\Models\Enderecos;
use App\Models\Contatos;

class InstrutorController extends Controller
{
    public function load_instrutores(Request $request)
    {
        $status = $request->query('status', 'all');

        $instrutoresQuery = DB::table('instrutores')
            ->join('pessoas', 'instrutores.id_pessoa', '=', 'pessoas.id')
            ->join('contatos', 'pessoas.id', '=', 'contatos.id_pessoa')
            ->join('enderecos', 'pessoas.id', '=', 'enderecos.id_pessoa')
            ->select(
                'instrutores.id as instrutor_id',
                'instrutores.id_pessoa',
                'instrutores.salario',
                'instrutores.especialidade',
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
                'contatos.instagram'
            )->orderBy('pessoas.created_at');

        switch ($status) {
            case 'a':
                $instrutoresQuery->where('pessoas.status', '=', 'A');
                break;
            case 'i':
                $instrutoresQuery->where('pessoas.status', '=', 'I');
                break;
            default:
                // Para 'all' e outros valores inválidos, não aplicar filtro de status
                break;
        }

        $instrutores = $instrutoresQuery->get();

        // Retornando a página com os dados
        return view('pesquisa_instrutores', compact('instrutores'));
    }

    public function delete_instrutor(Request $request)
    {
        Pessoas::where('id','=',$request->id)
        ->delete();

        Enderecos::where('id_pessoa','=',$request->id)
        ->delete();

        Contatos::where('id_pessoa','=',$request->id)
        ->delete();

        Instrutores::where('id','=',$request->id)->delete();

        return response()->json(true);
    }

    public function new_instrutor(Request $request)
    {

        // Validação dos campos
        $validationResult = $this->validateInstrutores($request->all(),'novo_');

        if ($validationResult !== true)
        {
            return $validationResult;
        }

        try {
            // Dados do formulário de cadastro de novo Instrutor
            $instrutorData = $request->except('_token');

            // Inserir na tabela pessoas
            $pessoaId = Pessoas::insertGetId([
                'nome' => $instrutorData['novo_nome'],
                'email' => Str::trim($instrutorData['novo_email']),
                'password' => Hash::make(Str::random(6)),
                'cpf' => $instrutorData['novo_cpf'],
                'dt_nascimento' => $instrutorData['novo_dt_nascimento'],
                'sexo' => $instrutorData['novo_sexo'],
                'status' => $instrutorData['novo_status'],
                'created_at' => now(),
                'updated_at' => now()
            ]);

            // Inserir na tabela enderecos usando o ID gerado da tabela pessoas
            Enderecos::insert([
                'id_pessoa' => $pessoaId,
                'rua' => $instrutorData['novo_rua'],
                'numero' => $instrutorData['novo_numero'],
                'complemento' => $instrutorData['novo_complemento'],
                'bairro' => $instrutorData['novo_bairro'],
                'cidade' => $instrutorData['novo_cidade'],
                'cep' => $instrutorData['novo_cep'],
                'created_at' => now(),
                'updated_at' => now()
            ]);

            // Inserir na tabela contatos usando o ID gerado da tabela pessoas
            Contatos::insert([
                'id_pessoa' => $pessoaId,
                'celular1' => $instrutorData['novo_celular1'],
                'celular2' => $instrutorData['novo_celular2'],
                'instagram' => $instrutorData['novo_instagram'],
                'created_at' => now(),
                'updated_at' => now()
            ]);

            // Inserir na tabela instrutores usando o ID gerado da tabela pessoas
            Instrutores::insert([
                'id_pessoa' => $pessoaId,
                'especialidade' => $instrutorData['novo_especialidade'],
                'salario' => $instrutorData['novo_salario'],
                'created_at' => now(),
                'updated_at' => now()
            ]);

            return json_encode(true);

        } catch (Exception $e) {
            return json_encode(['erro' => $e->getMessage()]);
        } 
    }

    public function edit_instrutor(Request $request)
    {   
        // Validação dos campos
        $validationResult = $this->validateInstrutores($request->all(),null);

        if ($validationResult !== true)
        {
            return $validationResult;
        }

        try {
            $instrutorData = $request->except('_token');

            // Editar tabela pessoas
            Pessoas::where('id', $instrutorData['instrutor_id'])
                ->update([
                    'nome' => $instrutorData['nome'],
                    'email' => Str::trim($instrutorData['email']),
                    'cpf' => $instrutorData['cpf'],
                    'dt_nascimento' => $instrutorData['dt_nascimento'],
                    'sexo' => $instrutorData['sexo'],
                    'status' => $instrutorData['status'],
                    'updated_at' => now()
                ]);

            // Editar tabela enderecos
            Enderecos::where('id_pessoa', $instrutorData['instrutor_id'])
                ->update([
                    'rua' => $instrutorData['rua'],
                    'numero' => $instrutorData['numero'],
                    'complemento' => $instrutorData['complemento'],
                    'bairro' => $instrutorData['bairro'],
                    'cidade' => $instrutorData['cidade'],
                    'cep' => $instrutorData['cep'],
                    'updated_at' => now()
                ]);

            // Editar tabela contatos
            Contatos::where('id_pessoa', $instrutorData['instrutor_id'])
                ->update([
                    'celular1' => $instrutorData['celular1'],
                    'celular2' => $instrutorData['celular2'],
                    'instagram' => $instrutorData['instagram'],
                    'updated_at' => now()
                ]);

            // Editar tabela instrutores
            Instrutores::where('id_pessoa', $instrutorData['instrutor_id'])
                ->update([
                    'especialidade' => $instrutorData['especialidade'],
                    'salario' => $instrutorData['salario'],
                    'updated_at' => now()
                ]);

            return response()->json(true);

        } catch (Exception $e) {
            return response()->json(['error' => 'Erro ao editar instrutor']);
        } 
    }

    // Validar os campos específicos dos alunos
    public function validateInstrutores($data,$prefix)
    {   
        // Definição das regras de integridade
        $rules = [
            $prefix.'nome'          => 'required|string',
            $prefix.'email'         => 'required|email',
            $prefix.'cpf'           => 'required',
            $prefix.'dt_nascimento' => 'required',
            $prefix.'sexo'          => 'required',
            $prefix.'especialidade' => 'required',
            $prefix.'salario'       => 'required|numeric|min:0',
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
            $prefix.'salario.required' => 'O campo salario é obrigatório.',
            $prefix.'salario.numeric' => 'O salario deve ser um valor numérico em reais (R$)',
            $prefix.'salario.min' => 'O salario não pode ser um valor negativo',
            $prefix.'especialidade.required' => 'O campo especialidade é obrigatório.',
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
