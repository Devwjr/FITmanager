@extends('layouts.app')

@section('content')
<h1>Dashboard Financeiro</h1>
<p><strong>Receitas:</strong> R$ {{ number_format($totalReceitas, 2, ',', '.') }}</p>
<p><strong>Despesas:</strong> R$ {{ number_format($totalDespesas, 2, ',', '.') }}</p>
<p><strong>Saldo:</strong> R$ {{ number_format($saldo, 2, ',', '.') }}</p>
<p><strong>Alunos Ativos:</strong> {{ $alunosAtivos }}</p>

<canvas id="graficoMensalidades"></canvas>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('graficoMensalidades');
    new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ['Pagas', 'Pendentes'],
            datasets: [{
                data: [{{ $pagas }}, {{ $pendentes }}],
                backgroundColor: ['#22c55e', '#ef4444']
            }]
        }
    });
</script>
@endsection
