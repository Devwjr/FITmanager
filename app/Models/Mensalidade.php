<?php

namespace App\Models;
// app/Models/Mensalidade.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mensalidade extends Model
{
    protected $fillable = [
        'aluno_id',
        'valor',
        'status',
        'vencimento',
        'pagamento_em',
    ];

    public function aluno()
    {
        return $this->belongsTo(Aluno::class, 'aluno_id');
    }
}
