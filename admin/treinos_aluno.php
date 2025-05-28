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

// Cadastro de treino
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $titulo = $_POST['titulo'];
  $descricao = $_POST['descricao'];
  $data = $_POST['data'];

  $stmt = $pdo->prepare("INSERT INTO treinos (aluno_id, titulo, descricao, data) VALUES (?, ?, ?, ?)");
  $stmt->execute([$aluno_id, $titulo, $descricao, $data]);
  header("Location: treinos_aluno.php?id=$aluno_id");
  exit;
}

// Lista de treinos
$stmt = $pdo->prepare("SELECT * FROM treinos WHERE aluno_id = ? ORDER BY data DESC");
$stmt->execute([$aluno_id]);
$treinos = $stmt->fetchAll();
?>

<h2>Treinos de <?= $aluno['nome'] ?></h2>
<a href="treinos.php">← Voltar</a>

<h3>Novo Treino</h3>
<form method="post">
  Título: <input type="text" name="titulo" required><br>
  Descrição: <textarea name="descricao"></textarea><br>
  Data: <input type="date" name="data" required><br>
  <button type="submit">Adicionar Treino</button>
</form>

<h3>Histórico de Treinos</h3>
<table border="1" cellpadding="5">
  <tr>
    <th>Data</th><th>Título</th><th>Descrição</th><th>Ações</th>
  </tr>
  <?php foreach ($treinos as $treino): ?>
    <tr>
      <td><?= $treino['data'] ?></td>
      <td><?= $treino['titulo'] ?></td>
      <td><?= $treino['descricao'] ?></td>
      <td>
        <a href="excluir_treino.php?id=<?= $treino['id'] ?>&aluno=<?= $aluno_id ?>"
           onclick="return confirm('Excluir este treino?')">Excluir</a>
      </td>
    </tr>
  <?php endforeach; ?>
</table>
