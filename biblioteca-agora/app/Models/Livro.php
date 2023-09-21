<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Livro extends Model
{
    use HasFactory;

    protected $table = 'livro';
    protected $primaryKey = 'id';

    protected $fillable = [
        'titulo',
        'volume',
        'edicao',
        'numero_paginas',
        'isbn',
        'editora',
        'quantidade',
        'autor_id',
        'genero_id'
    ];

    public function autor()
    {
        //Relacionamento 1 para 1
        return $this->belongsTo(Autor::class);
    }

    public function genero()
    {
        //Relacionamento 1 para 1
        return $this->belongsTo(Genero::class);
    }

    public function emprestimos()
    {
        //Relacionamento 1 para N
        return $this->hasMany(Emprestimo::class);
    }
}
