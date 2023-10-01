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
        $livro = Livro::find($id);
        $autores = Autor::all();
        $generos = Genero::all();
        return view('livros.detalhes', compact('livro', 'autores', 'generos'));
    }
}
