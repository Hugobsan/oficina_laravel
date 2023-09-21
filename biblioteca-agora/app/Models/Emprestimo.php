<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Emprestimo extends Model
{
    use HasFactory;

    protected $table = 'emprestimo';
    protected $primaryKey = 'id';

    protected $fillable = [
        'locatario_id',
        'livro_id',
        'data_emprestimo',
        'data_devolucao_esperada',
        'data_devolucao',
        'quantidade_renovacoes'
    ];

    public function locatario()
    {
        //Relacionamento N para 1
        return $this->belongsTo(Locatario::class);
    }

    public function livro()
    {
        //Relacionamento N para 1
        return $this->belongsTo(Livro::class);
    }
}
