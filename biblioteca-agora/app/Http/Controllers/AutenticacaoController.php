<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use \App\Models\User;

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
        return redirect()->back()->with('message', 'teste')->withInput();
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

    public function cadastraRegistro()
    {
        $dados = request()->all();

        $regras = [
            'nome' => 'required|max:255',
            'email' => 'required|max:255|email|unique:users,email',
            'password' => 'required|confirmed'
        ];

        $mensagens = [
            'required' => 'O campo de :attribute é obrigatório.',
            'password.required' => 'O campo de senha é obrigatório.',
            'max' => 'O campo :attribute deve ter no máximo :max caracteres.',
            'email' => 'O e-mail inserido ser um endereço de e-mail válido.',
            'email.unique' => 'O e-mail informado já está em uso.',
            'password.confirmed' => 'A confirmação de senha não confere com a senha digitada.'
        ];

        $validador = Validator::make($dados, $regras, $mensagens);

        if ($validador->fails()) {
            $erro = (object) [
                'tipo' => 'danger',
                'titulo' => 'Erro!',
                'texto' => $validador->errors()->first()
            ];

            return redirect()->back()->with('message', $erro)->withInput();
        }
        $user = User::create([
            'name' => $dados['nome'],
            'email' => $dados['email'],
            'password' => bcrypt($dados['password'])
        ]);

        //Criando locatário
        $user->locatario()->create(['nome' => $dados['nome']]);

        $mensagem = (object) [
            'tipo' => 'success',
            'titulo' => '',
            'texto' => 'Usuário cadastrado com sucesso.'
        ];

        return redirect()->route('login.index')->with('message', $mensagem);
    }
}
