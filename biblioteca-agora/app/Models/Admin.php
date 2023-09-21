<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;

    protected $table = 'admin';
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
}
