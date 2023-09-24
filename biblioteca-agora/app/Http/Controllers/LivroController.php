<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LivroController extends Controller
{
    protected $menuAtivo;

    public function __construct()
    {
        $this->menuAtivo = 'livros';
    }

    public function index()
    {
        $menuAtivo = $this->menuAtivo;
        return view('livros.index', compact('menuAtivo'));
    }
}
