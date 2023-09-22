<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AutenticacaoController extends Controller
{
    public function index()
    {
        return view('autenticacao.index');
    }

    public function login(Request $request)
    {
        //Executa a verificação de credenciais e de lembrar-me
        $credenciais = $request->only(['email', 'password']);

        if (auth()->attempt($credenciais, $request->input('remember'))) {
            return redirect()->route('livros.index');
        }

        $mensagem = (object) [
            'tipo' => 'danger',
            'titulo' => 'Erro',
            'texto' => 'Usuário e/ou senha inválidos.'
        ];

        return redirect()->back()->with('message', $mensagem)->withInput();
    }

    public function logout()
    {
        auth()->logout();
        return redirect()->route('login.index');
    }

    public function registrar()
    {
        return view('autenticacao.registrar');
    }
}
