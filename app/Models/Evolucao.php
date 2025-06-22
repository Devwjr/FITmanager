<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Evolucao extends Model
{
    protected $fillable = ['aluno_id', 'peso', 'medidas'];

    public function aluno() {
        return $this->belongsTo(Aluno::class);
    }
}
