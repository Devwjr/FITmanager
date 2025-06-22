<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mensalidade extends Model
{
    protected $fillable = ['aluno_id', 'valor', 'vencimento', 'status'];

    public function aluno() {
        return $this->belongsTo(User::class, 'aluno_id');
    }
}
