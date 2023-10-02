<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Livro;
use App\Models\Autor;
use App\Models\Genero;
use Illuminate\Support\Facades\Validator;

class LivroController extends Controller
{
    public function index()
    {
        $livros = Livro::paginate(10);
        $autores = Autor::all();
        $generos = Genero::all();
        return view('livros.index', compact('livros','autores','generos'));
    }

    public function pesquisar(Request $request)
    {   
        $livros = Livro::where('titulo', 'like', '%' . $request->pesquisa . '%')
            ->orWhere('editora', 'like', '%' . $request->pesquisa . '%')
            ->orWhereHas('autor', function ($query) use ($request) {
                $query->where('nome', 'like', '%' . $request->pesquisa . '%');
            })
            ->orWhereHas('genero', function ($query) use ($request) {
                $query->where('nome', 'like', '%' . $request->pesquisa . '%');
            })
            ->paginate(10);
        
        $autores = Autor::all();
        $generos = Genero::all();
        
        return view('livros.index', compact('livros', 'autores', 'generos'));
    }

    public function criar(Request $request){
        $dados = $request->all();
        
        $regras = [
            'titulo' => 'required|max:255',
            'autor' => 'required|max:255',
            'genero' => 'required|max:255',
            'editora' => 'required|max:255',
            'edicao' => 'required|numeric',
            'volume' => 'required|numeric',
            'paginas' => 'required|numeric',
            'quant-exemplares' => 'required|numeric',
            'isbn' => 'required|numeric|digits:13|unique:livro,isbn',
        ];

        $mensagens = [
            'required' => 'O campo :attribute é obrigatório',
            'max' => 'O campo :attribute deve ter no máximo :max caracteres',
            'numeric' => 'O campo :attribute deve ser um número',
            'digits' => 'O campo :attribute deve ter :digits dígitos',
            'unique' => 'O campo :attribute já está cadastrado',
        ];

        $validator = Validator::make($dados, $regras, $mensagens);

        if ($validator->fails()) {
            $mensagem = (object) [
                'tipo' => 'danger',
                'titulo' => 'Erro',
                'texto' => $validator->errors()->first(),
            ];

            return redirect()->back()->with('message', $mensagem)->withInput();
        }
        $autor = Autor::firstOrCreate(['nome' => $dados['autor']]);
        $genero = Genero::firstOrCreate(['nome' => $dados['genero']]);

        Livro::create([
            'titulo' => $dados['titulo'],
            'autor_id' => $autor->id,
            'genero_id' => $genero->id,
            'editora' => $dados['editora'],
            'edicao' => $dados['edicao'],
            'volume' => $dados['volume'],
            'numero_paginas' => $dados['paginas'],
            'quantidade' => $dados['quant-exemplares'],
            'isbn' => $dados['isbn'],
        ]);

        $mensagem = (object) [
            'tipo' => 'success',
            'titulo' => '',
            'texto' => 'Livro cadastrado com sucesso',
        ];

        return redirect()->back()->with('message', $mensagem);
    }

    public function livro(string $id){
        $livro = Livro::with('emprestimos')->find($id);
        
        foreach ($livro->emprestimos as $emprestimo) {
            //convertendo datas para o formato brasileiro
            $emprestimo->data_emprestimo = date('d/m/Y', strtotime($emprestimo->data_emprestimo));
            $emprestimo->data_devolucao_esperada = date('d/m/Y', strtotime($emprestimo->data_devolucao_esperada));
            if($emprestimo->data_devolucao != null){
                $emprestimo->data_devolucao = date('d/m/Y', strtotime($emprestimo->data_devolucao));
            }

            //Verificando se empréstimo não foi devolvido e está atrasado
            $data_devolucao_esperada = strtotime($emprestimo->data_devolucao_esperada);
            $dataAtual = strtotime(date('Y-m-d'));
            if($emprestimo->data_devolucao == null && $dataAtual > $data_devolucao_esperada){
                $emprestimo->atrasado = true;
            }else{
                $emprestimo->atrasado = false;
            }
        }

        $autores = Autor::all();
        $generos = Genero::all();
        return view('livros.detalhes', compact('livro', 'autores', 'generos'));
    }

    public function atualizar(Request $request, string $id){
        $dados = $request->all();

        $regras = [
            'titulo' => 'required|max:255',
            'autor' => 'required|max:255',
            'genero' => 'required|max:255',
            'editora' => 'required|max:255',
            'edicao' => 'required|numeric',
            'volume' => 'required|numeric',
            'paginas' => 'required|numeric',
            'quant-exemplares' => 'required|numeric',
            'isbn' => 'required|numeric|digits:13|unique:livro,isbn,'.$id,
        ];

        $mensagens = [
            'required' => 'O campo :attribute é obrigatório',
            'max' => 'O campo :attribute deve ter no máximo :max caracteres',
            'numeric' => 'O campo :attribute deve ser um número',
            'digits' => 'O campo :attribute deve ter :digits dígitos',
            'unique' => 'O campo :attribute já está cadastrado',
        ];

        $validator = Validator::make($dados, $regras, $mensagens);

        if ($validator->fails()) {
            $mensagem = (object) [
                'tipo' => 'danger',
                'titulo' => 'Erro',
                'texto' => $validator->errors()->first(),
            ];

            return redirect()->back()->with('message', $mensagem)->withInput();
        }

        $autor = Autor::firstOrCreate(['nome' => $dados['autor']]);
        $genero = Genero::firstOrCreate(['nome' => $dados['genero']]);

        $livro = Livro::find($id);
        $livro->titulo = $dados['titulo'];
        $livro->autor_id = $autor->id;
        $livro->genero_id = $genero->id;
        $livro->editora = $dados['editora'];
        $livro->edicao = $dados['edicao'];
        $livro->volume = $dados['volume'];
        $livro->numero_paginas = $dados['paginas'];
        $livro->quantidade = $dados['quant-exemplares'];
        $livro->isbn = $dados['isbn'];
        $livro->save();

<<<<<<< HEAD
        $mensagem = [
=======
        $mensagem = (object) [
>>>>>>> debug
            'tipo' => 'success',
            'titulo' => '',
            'texto' => 'Livro atualizado com sucesso',
        ];
        return redirect()->back()->with('message', $mensagem)->send();
    }
}
