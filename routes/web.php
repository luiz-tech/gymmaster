<?php

use Illuminate\Support\Facades\Route;

//importando classes controladoras
use App\Http\Controllers\UserController;
use App\Http\Controllers\SystemController;
use App\Http\Controllers\InstrutorController;
use App\Http\Controllers\PlanoController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//rota principal pro login
Route::get('/', function () {
    return view('login');
})->name('Login');

//autenticação do usuario
Route::post('/login',[UserController::class,'login'])->name('auth');

//dashboard admnistrativa
Route::get('/painel', function () {
    return view('painel');
})->name('Painel');

//carregar os dados pro gráfico
Route::post('/load_data_chart',[SystemController::class,'load_data_chart'])->name('load_data_chart');

Route::get('/load_planos',[SystemController::class,'load_planos'])->name('load_planos');

Route::get('/alunos',[UserController::class,'load_alunos'])->name('Lista de Alunos');

Route::post('/editar_aluno',[UserController::class,'edit_aluno'])->name('Editar Aluno');

Route::post('/excluir_aluno',[UserController::class,'delete_aluno'])->name('Excluir Aluno');

Route::post('/novo_aluno',[UserController::class,'new_aluno'])->name('Novo Aluno');


// --------------------------------------------------------- //

Route::get('/instrutores',[InstrutorController::class,'load_instrutores'])->name('Lista de Instrutores');

Route::post('/novo_instrutor',[InstrutorController::class,'new_instrutor'])->name('Novo Instrutor');

Route::post('/excluir_instrutor',[InstrutorController::class,'delete_instrutor'])->name('Excluir Instrutor');

Route::post('/editar_instrutor',[InstrutorController::class,'edit_instrutor'])->name('Editar Instrutor');

// --------------------------------------------------------- //

Route::get('/planos',[PlanoController::class,'load_planos'])->name('Lista de Planos');

Route::post('/excluir_plano',[PlanoController::class,'delete_planos'])->name('Excluir Plano');

Route::post('/editar_plano',[PlanoController::class,'edit_planos'])->name('Editar Plano');

Route::post('/new_plano',[PlanoController::class,'new_planos'])->name('Novo Plano');