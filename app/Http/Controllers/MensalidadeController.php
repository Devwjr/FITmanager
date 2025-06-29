<?php

// app/Http/Controllers/MensalidadeController.php
namespace App\Http\Controllers;

use App\Models\Mensalidade;
use App\Models\Aluno;
use Illuminate\Http\Request;

class MensalidadeController extends Controller
{
    public function index()
    {
        $mensalidades = Mensalidade::with('aluno')->orderBy('vencimento', 'asc')->get();
        return view('mensalidades.index', compact('mensalidades'));
    }

    public function pagar($id)
    {
        $mensalidade = Mensalidade::findOrFail($id);
        $mensalidade->update([
            'status' => 'pago',
            'pagamento_em' => now(),
        ]);

        return redirect()->back()->with('success', 'Mensalidade marcada como paga.');
    }

    public function create()
    {
        $alunos = Aluno::all();
        return view('mensalidades.create', compact('alunos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'aluno_id' => 'required|exists:alunos,id',
            'valor' => 'required|numeric',
            'vencimento' => 'required|date',
        ]);

        Mensalidade::create([
            'aluno_id' => $request->aluno_id,
            'valor' => $request->valor,
            'vencimento' => $request->vencimento,
            'status' => 'pendente',
        ]);

        return redirect()->route('mensalidades.index')->with('success', 'Mensalidade criada com sucesso.');
    }
}
