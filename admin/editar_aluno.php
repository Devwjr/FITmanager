<?php
require_once '../includes/protect.php';
require_once '../includes/database.php';

$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM alunos WHERE id = ?");
$stmt->execute([$id]);
$aluno = $stmt->fetch();

if (!$aluno) {
    echo "Aluno não encontrado.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $idade = $_POST['idade'];
    $telefone = $_POST['telefone'];

    $stmt = $pdo->prepare("UPDATE alunos SET nome=?, email=?, idade=?, telefone=? WHERE id=?");
    $stmt->execute([$nome, $email, $idade, $telefone, $id]);
    header("Location: alunos.php");
    exit;
}
?>

<h2>Editar Aluno</h2>
<form method="post">
  Nome: <input type="text" name="nome" value="<?= $aluno['nome'] ?>" required><br>
  Email: <input type="email" name="email" value="<?= $aluno['email'] ?>" required><br>
  Idade: <input type="number" name="idade" value="<?= $aluno['idade'] ?>" required><br>
  Telefone: <input type="text" name="telefone" value="<?= $aluno['telefone'] ?>"><br>
  <button type="submit">Salvar Alterações</button>
</form>
<a href="alunos.php">← Voltar</a>
