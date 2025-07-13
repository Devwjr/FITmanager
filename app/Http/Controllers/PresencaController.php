<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Presenca;

class PresencaController extends Controller
{
    public function registrarEntrada($aluno_id)
    {
        Presenca::create([
            'aluno_id' => $aluno_id,
            'data' => today(),
            'hora_entrada' => now()->format('H:i:s')
        ]);

        return back()->with('success', 'Entrada registrada!');
    }

    public function registrarSaida($aluno_id)
    {
        $presenca = Presenca::where('aluno_id', $aluno_id)->where('data', today())->first();
        if ($presenca) {
            $presenca->hora_saida = now()->format('H:i:s');
            $presenca->save();
        }

        return back()->with('success', 'Saída registrada!');
    }

    public function historico($aluno_id)
    {
        $presencas = Presenca::where('aluno_id', $aluno_id)->get();
        return view('presencas.historico', compact('presencas'));
    }
}
