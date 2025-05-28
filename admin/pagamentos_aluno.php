<?php
require_once '../includes/protect.php';
require_once '../includes/database.php';

$aluno_id = $_GET['id'];

// Verifica se o aluno existe
$stmt = $pdo->prepare("SELECT * FROM alunos WHERE id = ?");
$stmt->execute([$aluno_id]);
$aluno = $stmt->fetch();

if (!$aluno) {
  echo "Aluno não encontrado.";
  exit;
}

// Cadastro de pagamento
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $valor = $_POST['valor'];
  $data_pagamento = $_POST['data_pagamento'];
  $status = $_POST['status'];
  $obs = $_POST['observacao'];

  $stmt = $pdo->prepare("INSERT INTO pagamentos (aluno_id, valor, data_pagamento, status, observacao) VALUES (?, ?, ?, ?, ?)");
  $stmt->execute([$aluno_id, $valor, $data_pagamento, $status, $obs]);

  header("Location: pagamentos_aluno.php?id=$aluno_id");
  exit;
}

// Lista de pagamentos
$stmt = $pdo->prepare("SELECT * FROM pagamentos WHERE aluno_id = ? ORDER BY data_pagamento DESC");
$stmt->execute([$aluno_id]);
$pagamentos = $stmt->fetchAll();
?>

<h2>Pagamentos de <?= $aluno['nome'] ?></h2>
<a href="pagamentos.php">← Voltar</a>

<h3>Registrar Novo Pagamento</h3>
<form method="post">
  Valor (R$): <input type="number" step="0.01" name="valor" required><br>
  Data do Pagamento: <input type="date" name="data_pagamento" required><br>
  Status:
  <select name="status">
    <option value="pago">Pago</option>
    <option value="pendente">Pendente</option>
  </select><br>
  Observação: <textarea name="observacao"></textarea><br>
  <button type="submit">Registrar</button>
</form>

<h3>Histórico de Pagamentos</h3>
<table border="1" cellpadding="5">
  <tr>
    <th>Data</th><th>Valor</th><th>Status</th><th>Observação</th><th>Ações</th>
  </tr>
  <?php foreach ($pagamentos as $p): ?>
    <tr>
      <td><?= $p['data_pagamento'] ?></td>
      <td>R$ <?= number_format($p['valor'], 2, ',', '.') ?></td>
      <td><?= ucfirst($p['status']) ?></td>
      <td><?= $p['observacao'] ?></td>
      <td>
        <a href="excluir_pagamento.php?id=<?= $p['id'] ?>&aluno=<?= $aluno_id ?>" onclick="return confirm('Excluir pagamento?')">Excluir</a>
      </td>
    </tr>
  <?php endforeach; ?>
</table>
