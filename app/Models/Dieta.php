<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dieta extends Model
{
    protected $fillable = ['aluno_id', 'tipo_dieta', 'calorias', 'refeicoes'];

    public function aluno() {
        return $this->belongsTo(Aluno::class);
    }
}
