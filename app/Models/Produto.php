<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use App\Models\Categoria;
use App\Models\User;

class Produto extends Model
{
    use HasFactory;

      protected $fillable = [
        'nome',
        'descricao',
        'preco',
        'foto',
        'decada',
        'quantidade',
        'vendido',
        'categoria_id',
        'usuario_id',
    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }  
}