<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pagamento;
use App\Models\Aluno;
use App\Models\Despesa;

class DashboardController extends Controller
{
    public function index()
    {
        $totalReceitas = Pagamento::where('status', 'pago')->sum('valor');
        $totalDespesas = Despesa::sum('valor');
        $saldo = $totalReceitas - $totalDespesas;

        $alunosAtivos = Aluno::where('status', 'ativo')->count();
        $pagas = Pagamento::where('status', 'pago')->count();
        $pendentes = Pagamento::where('status', 'pendente')->count();

        return view('admin.dashboard', compact(
            'totalReceitas',
            'totalDespesas',
            'saldo',
            'alunosAtivos',
            'pagas',
            'pendentes'
        ));
    }
}
