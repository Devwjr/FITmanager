<?php
require_once '../includes/protect.php';
require_once '../includes/database.php';

// Dados principais
$totalAlunos = $pdo->query("SELECT COUNT(*) FROM alunos")->fetchColumn();
$totalTreinos = $pdo->query("SELECT COUNT(*) FROM treinos")->fetchColumn();
$totalRecebido = $pdo->query("SELECT SUM(valor) FROM pagamentos WHERE status = 'pago'")->fetchColumn() ?? 0;

// Inadimplentes
$inadimplentes = $pdo->query("
  SELECT a.nome, a.email
  FROM alunos a
  JOIN pagamentos p ON a.id = p.aluno_id
  WHERE p.status = 'pendente'
  GROUP BY a.id
")->fetchAll();

// Dados mensais fictícios (você pode gerar com base no banco depois)
$meses = ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun'];
$valores = [800, 1200, 900, 1500, 1100, 1800];
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Painel Administrativo</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <link href="https://unpkg.com/@heroicons/vue@2.0.13/24/solid/index.css" rel="stylesheet">
</head>
<body class="bg-yellow-50 text-gray-800 p-6">

  <h1 class="text-3xl font-bold text-yellow-700 mb-6 flex items-center gap-2">
    <svg class="w-8 h-8 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-6h.01M15 17v-4h.01M12 17v-2h.01M4 6h16M4 10h16M4 14h16M4 18h16" /></svg>
    Painel da Academia
  </h1>

  <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <div class="bg-yellow-100 p-4 rounded-lg shadow flex flex-col items-center">
      <svg class="w-8 h-8 text-yellow-600 mb-2" fill="currentColor" viewBox="0 0 24 24"><path d="M12 12c2.21 0 4-1.79 4-4S14.21 4 12 4 8 5.79 8 8s1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
      <h2 class="text-xl font-semibold">Alunos</h2>
      <p class="text-3xl font-bold"><?= $totalAlunos ?></p>
    </div>

    <div class="bg-yellow-100 p-4 rounded-lg shadow flex flex-col items-center">
      <svg class="w-8 h-8 text-yellow-600 mb-2" fill="currentColor" viewBox="0 0 24 24"><path d="M20 13V8h-4V3H8v5H4v5H0v7h24v-7z"/></svg>
      <h2 class="text-xl font-semibold">Treinos</h2>
      <p class="text-3xl font-bold"><?= $totalTreinos ?></p>
    </div>

    <div class="bg-yellow-100 p-4 rounded-lg shadow flex flex-col items-center">
      <svg class="w-8 h-8 text-yellow-600 mb-2" fill="currentColor" viewBox="0 0 24 24"><path d="M12 1C5.92 1 1 5.92 1 12s4.92 11 11 11 11-4.92 11-11S18.08 1 12 1zm1 17h-2v-2h2v2zm0-4h-2V7h2v7z"/></svg>
      <h2 class="text-xl font-semibold">Recebido</h2>
      <p class="text-3xl font-bold">R$ <?= number_format($totalRecebido, 2, ',', '.') ?></p>
    </div>
  </div>

  <div class="bg-yellow-100 p-6 rounded-lg shadow mb-8">
    <h2 class="text-xl font-semibold mb-4">📊 Recebimentos Mensais</h2>
    <canvas id="graficoPagamentos" width="400" height="200"></canvas>
    <script>
      const ctx = document.getElementById('graficoPagamentos').getContext('2d');
      new Chart(ctx, {
        type: 'bar',
        data: {
          labels: <?= json_encode($meses) ?>,
          datasets: [{
            label: 'R$ Recebido',
            data: <?= json_encode($valores) ?>,
            backgroundColor: '#facc15'
          }]
        },
        options: {
          responsive: true,
          plugins: {
            legend: { display: false }
