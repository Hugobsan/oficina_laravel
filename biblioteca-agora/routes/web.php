<?php

use App\Http\Controllers\AutenticacaoController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//Redireciona para a rota de login
Route::redirect('/', '/login');

Route::group(['prefix' => 'login', 'as' => 'login.'], function () {
    //Login
    Route::get('/', [AutenticacaoController::class, 'index'])->name('index');
    Route::post('/', [AutenticacaoController::class, 'login'])->name('autenticar');
    Route::get('/sair', [AutenticacaoController::class, 'logout'])->name('sair');

    //Registro
    Route::get('/registrar', [AutenticacaoController::class, 'registrar'])->name('registrar');
    Route::post('/registrar', [AutenticacaoController::class, 'cadastraRegistro'])->name('novo_registro');
});

Route::group(['prefix' => 'usuarios', 'as' => 'usuarios.'], function(){
    Route::get('/', [UsuarioController::class, 'index'])->name('index');
    Route::get('/{id}', [UsuarioController::class, 'perfil'])->name('perfil');
});

