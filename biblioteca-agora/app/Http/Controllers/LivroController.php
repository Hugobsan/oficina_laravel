<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Livro;
use App\Models\Autor;
use App\Models\Genero;

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

    }
}
