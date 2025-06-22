<?php

namespace App\Http\Controllers;
use App\Models\Evolucao;
use App\Models\Aluno;
use Illuminate\Http\Request;

class EvolucaoController extends Controller
{
    public function index()
    {
        $evolucoes = Evolucao::with('aluno')->get();
        return view('evolucoes.index', compact('evolucoes'));
    }

    public function create()
    {
        $alunos = Aluno::all();
        return view('evolucoes.create', compact('alunos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'aluno_id' => 'required',
            'peso' => 'nullable|numeric',
            'medidas' => 'nullable|string',
        ]);

        Evolucao::create($request->all());

        return redirect()->route('evolucoes.index')->with('success', 'Evolução registrada com sucesso!');
    }
}

