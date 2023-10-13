<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class UsuarioController extends Controller
{
    public function index()
    {
        $usuarios = User::doesntHave('admin')
        ->paginate(10);
        return view('usuarios.index', compact('usuarios'));
    }

    public function pesquisar(Request $request)
    {
        $usuarios = User::doesntHave('admin')
            ->where('name', 'like', '%' . $request->pesquisa . '%')
            ->orWhere('email', 'like', '%' . $request->pesquisa . '%')
            ->paginate(10);
        return view('usuarios.index', compact('usuarios'));
    }

    public function perfil($id)
    {
        $usuario = User::find($id);

        $usuario->locatario->emprestimos->transform(function ($emprestimo) {
            $emprestimo->data_emprestimo = formatarData($emprestimo->data_emprestimo);
            $emprestimo->data_devolucao_esperada = formatarData($emprestimo->data_devolucao_esperada);
            $emprestimo->data_devolucao = $emprestimo->data_devolucao == null ? "Não devolvido" : formatarData($emprestimo->data_devolucao);

            $data_devolucao_esperada = strtotime($emprestimo->data_devolucao_esperada);
            $dataAtual = strtotime(date('Y-m-d'));
            if ($emprestimo->data_devolucao == null && $dataAtual > $data_devolucao_esperada) {
                $emprestimo->atrasado = true;
            } else {
                $emprestimo->atrasado = false;
            }

            return $emprestimo;
        });

        return view('usuarios.perfil', compact('usuario'));
    }

    public function atualizar(Request $request, $id){
        $usuario = User::find($id);

        $dados = $request->all();

        $regras = [
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'telefone' => 'required|unique:locatario,telefone,' . $usuario->locatario->id,
            'cpf' => 'required|unique:locatario,cpf,' . $usuario->locatario->id,
            'old_password' => 'required_with:new_password',
            'new_password' => 'required_with:old_password|confirmed'
        ];

        $mensagens = [
            'required' => 'O campo de :attribute é obrigatório.',
            'max' => 'O campo :attribute deve ter no máximo :max caracteres.',
            'email' => 'O e-mail inserido ser um endereço de e-mail válido.',
            'email.unique' => 'O e-mail informado já está em uso.',
            'telefone.unique' => 'O telefone informado já está em uso.',
            'cpf.unique' => 'O CPF informado já está em uso.',
            'confirmed' => 'As senhas não coincidem.',
            'old_password.required_with' => 'O campo de senha atual é obrigatório.',
            'new_password.required_with' => 'O campo de nova senha é obrigatório.'
        ];

        $validator = Validator::make($dados, $regras, $mensagens);

        if ($validator->fails()) {
            $erro = (object) [
                'tipo' => 'danger',
                'titulo' => 'Erro!',
                'texto' => $validator->errors()->first()
            ];

            return redirect()->back()->with('message', $erro)->withInput();
        }
        
        if ($dados['old_password'] != null && $dados['new_password'] != null) {
            if (password_verify($dados['old_password'], $usuario->password)) {
                $usuario->password = bcrypt($dados['new_password']);
            } else {
                $erro = (object) [
                    'tipo' => 'danger',
                    'titulo' => 'Erro!',
                    'texto' => 'A senha atual não confere com a senha informada.'
                ];

                return redirect()->back()->with('message', $erro)->withInput();
            }
        }

        $usuario->name = $dados['name'];
        $usuario->email = $dados['email'];
        $usuario->locatario->nome = $dados['name'];
        $usuario->locatario->telefone = unmask($dados['telefone']);
        $usuario->locatario->cpf = unmask($dados['cpf']);
        $usuario->locatario->save();
        $usuario->save();

        $mensagem = (object) [
            'tipo' => 'success',
            'titulo' => 'Sucesso!',
            'texto' => 'Usuário atualizado com sucesso.'
        ];

        return redirect()->back()->with('message', $mensagem);
    }
}
