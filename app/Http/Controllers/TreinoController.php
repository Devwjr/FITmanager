<?php

namespace App\Http\Controllers;

use App\Models\Treino;
use App\Models\Aluno;
use Illuminate\Http\Request;

class TreinoController extends Controller
{
    public function index()
    {
        $treinos = Treino::with('aluno')->get();
        return view('treinos.index', compact('treinos'));
    }

    public function create()
    {
        $alunos = Aluno::all();
        return view('treinos.create', compact('alunos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'aluno_id' => 'required',
            'tipo_treino' => 'required|string',
            'series' => 'nullable|string',
            'repeticoes' => 'nullable|string',
        ]);

        Treino::create($request->all());

        return redirect()->route('treinos.index')->with('success', 'Treino cadastrado!');
    }
}
