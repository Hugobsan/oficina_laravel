<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genero extends Model
{
    use HasFactory;

    protected $table = 'genero';
    protected $primaryKey = 'id';

    protected $fillable = [
        'nome'
    ];

    public function livros()
    {
        //Relacionamento 1 para N
        return $this->hasMany(Livro::class);
    }
}
