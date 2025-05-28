<?php
require_once '../includes/protect.php';
require_once '../includes/database.php';

// Cadastro
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $idade = $_POST['idade'];
    $telefone = $_POST['telefone'];

    $stmt = $pdo->prepare("INSERT INTO alunos (nome, email, idade, telefone) VALUES (?, ?, ?, ?)");
    $stmt->execute([$nome, $email, $idade, $telefone]);
    header("Location: alunos.php");
    exit;
}

// Listagem
$alunos = $pdo->query("SELECT * FROM alunos ORDER BY id DESC")->fetchAll();
?>

<h2>Gerenciar Alunos</h2>
<a href="dashboard.php">← Voltar</a>

<h3>Cadastro de Novo Aluno</h3>
<form method="post">
  Nome: <input type="text" name="nome" required><br>
  Email: <input type="email" name="email" required><br>
  Idade: <input type="number" name="idade" required><br>
  Telefone: <input type="text" name="telefone"><br>
  <button type="submit">Cadastrar</button>
</form>

<h3>Alunos Cadastrados</h3>
<table border="1" cellpadding="5">
  <tr>
    <th>ID</th><th>Nome</th><th>Email</th><th>Idade</th><th>Telefone</th><th>Ações</th>
  </tr>
  <?php foreach ($alunos as $aluno): ?>
    <tr>
      <td><?= $aluno['id'] ?></td>
      <td><?= $aluno['nome'] ?></td>
      <td><?= $aluno['email'] ?></td>
      <td><?= $aluno['idade'] ?></td>
      <td><?= $aluno['telefone'] ?></td>
      <td>
        <a href="editar_aluno.php?id=<?= $aluno['id'] ?>">Editar</a> |
        <a href="excluir_aluno.php?id=<?= $aluno['id'] ?>" onclick="return confirm('Deseja excluir?')">Excluir</a>
      </td>
    </tr>
  <?php endforeach; ?>
</table>
