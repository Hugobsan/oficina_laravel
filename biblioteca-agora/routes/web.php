<?php

use App\Http\Controllers\AutenticacaoController;
use App\Http\Controllers\EmprestimoController;
use App\Http\Controllers\LivroController;
use App\Http\Controllers\UsuarioController;
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


//Grupo de rotas internas
Route::group(['middleware' => ['auth', 'markmenu']], function () {
    //Rotas de usuarios
    Route::group(['prefix' => 'usuarios', 'as' => 'usuarios.'], function () {
        Route::get('/', [UsuarioController::class, 'index'])->name('index');
        Route::get('/{id}', [UsuarioController::class, 'perfil'])->name('perfil');
        Route::post('/{id}', [UsuarioController::class, 'atualizar'])->name('atualizar');
        Route::get('/{id}/excluir', [UsuarioController::class, 'excluir'])->name('excluir');
    });

    //Rotas de livros
    Route::group(['prefix' => 'livros', 'as' => 'livros.'], function () {
        Route::get('/pesquisar', [LivroController::class, 'index'])->name('index');
        Route::post('/pesquisar', [LivroController::class, 'pesquisar'])->name('pesquisar');
        Route::post('/criar', [LivroController::class, 'criar'])->name('criar');
        Route::get('/{id}', [LivroController::class, 'livro'])->name('detalhes');
        Route::post('/editar/{id}', [LivroController::class, 'atualizar'])->name('atualizar');
        Route::get('/{id}/excluir', [LivroController::class, 'excluir'])->name('excluir');
    });

    //Rotas de emprestimos
    Route::group(['prefix' => 'emprestimos', 'as' => 'emprestimos.'], function () {
        Route::get('/', [EmprestimoController::class, 'index'])->name('index');
        Route::post('/criar', [EmprestimoController::class, 'criar'])->name('criar');
        Route::get('/{id}', [EmprestimoController::class, 'emprestimo'])->name('detalhes');
        Route::post('/devolver/{id}', [EmprestimoController::class, 'devolver'])->name('devolver');
        Route::post('/renovar/{id}', [EmprestimoController::class, 'renovar'])->name('renovar');
    });
});
