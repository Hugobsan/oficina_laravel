<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Locatario extends Model
{
    use HasFactory;

    protected $table = 'locatario';
    protected $primaryKey = 'id';

    protected $fillable = [
        'nome',
        'cpf',
        'telefone',
        'user_id'
    ];

    public function user()
    {   
        //Relacionamento 1 para 1
        return $this->belongsTo(User::class);
    }

    public function emprestimos()
    {
        //Relacionamento 1 para N
        return $this->hasMany(Emprestimo::class);
    }
}
