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
        $credenciais = $request->only(['email', 'password']);

        if (auth()->attempt($credenciais)) {
            return redirect()->route('emprestimos.index');
        }

        return redirect()->back()->withErrors('Usuário e/ou senha incorretos');
    }

    public function logout()
    {
        auth()->logout();
        return redirect()->route('autenticacao.index');
    }
}
