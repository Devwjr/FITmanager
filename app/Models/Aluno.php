<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Aluno extends Model
{
    protected $fillable = ['nome', 'email', 'peso', 'altura'];

    public function treinos()
    {
        return $this->hasMany(Treino::class);
    }

    public function dietas()
    {
        return $this->hasMany(Dieta::class);
    }

    public function evolucoes()
    {
        return $this->hasMany(Evolucao::class);
    }

    public function mensalidades()
    {
        return $this->hasMany(Mensalidade::class);
    }
}
