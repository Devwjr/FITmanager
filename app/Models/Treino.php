<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Treino extends Model
{
    protected $fillable = ['aluno_id', 'tipo_treino', 'series', 'repeticoes'];

    public function aluno() {
        return $this->belongsTo(Aluno::class);
    }
}
