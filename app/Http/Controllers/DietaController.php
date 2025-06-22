<?php

namespace App\Http\Controllers;

use App\Models\Dieta;
use App\Models\Aluno;
use Illuminate\Http\Request;

class DietaController extends Controller
{
    public function index()
    {
        $dietas = Dieta::with('aluno')->get();
        return view('dietas.index', compact('dietas'));
    }

    public function create()
    {
        $alunos = Aluno::all();
        return view('dietas.create', compact('alunos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'aluno_id' => 'required',
            'tipo_dieta' => 'required|string',
            'calorias' => 'nullable|integer',
            'refeicoes' => 'nullable|string',
        ]);

        Dieta::create($request->all());

        return redirect()->route('dietas.index')->with('success', 'Dieta cadastrada com sucesso!');
    }
}
