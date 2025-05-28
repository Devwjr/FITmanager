<?php
require_once 'includes/database.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $email = $_POST['email'];
  $senha = $_POST['senha'];

  $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE email = ?");
  $stmt->execute([$email]);
  $usuario = $stmt->fetch();

  if ($usuario && password_verify($senha, $usuario['senha'])) {
    $_SESSION['usuario_id'] = $usuario['id'];
    $_SESSION['tipo'] = $usuario['tipo'];

    if ($usuario['tipo'] === 'admin') {
      header("Location: admin/dashboard.php");
    } else {
      header("Location: aluno/dashboard.php");
    }
    exit;
  } else {
    echo "Usuário ou senha inválidos.";
  }
}
?>

<form method="post">
  Email: <input type="email" name="email"><br>
  Senha: <input type="password" name="senha"><br>
  <button type="submit">Entrar</button>
</form>
