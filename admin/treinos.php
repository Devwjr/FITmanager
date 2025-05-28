<?php
require_once '../includes/protect.php';
require_once '../includes/database.php';

$alunos = $pdo->query("SELECT * FROM alunos ORDER BY nome")->fetchAll();
?>

<h2>Gerenciar Treinos</h2>
<a href="dashboard.php">← Voltar</a>

<h3>Selecione um aluno para ver ou adicionar treinos:</h3>
<ul>
  <?php foreach ($alunos as $aluno): ?>
    <li>
      <a href="treinos_aluno.php?id=<?= $aluno['id'] ?>">
        <?= $aluno['nome'] ?> (<?= $aluno['email'] ?>)
      </a>
    </li>
  <?php endforeach; ?>
</ul>
