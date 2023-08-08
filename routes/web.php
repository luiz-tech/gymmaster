<?php

use Illuminate\Support\Facades\Route;

//importando modelos
use App\Http\Controllers\UserController;

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
Route::post('/load_data_chart',[UserController::class,'load_data_chart'])->name('load_data_chart');