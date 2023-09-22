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
            return redirect()->route('livros.index');
        }

        return redirect()->back()->withErrors('Usuário e/ou senha incorretos')->withInput();
    }

    public function logout()
    {
        auth()->logout();
        return redirect()->route('login.index');
    }
}
