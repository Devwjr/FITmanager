<?php
session_start();
$conn = new mysqli("localhost", "root", "", "academia");
if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}

$msg = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $conn->real_escape_string($_POST['email']);
    $senha = $_POST['senha'];

    $res = $conn->query("SELECT * FROM alunos WHERE email = '$email' LIMIT 1");
    if ($res->num_rows > 0) {
        $aluno = $res->fetch_assoc();
        if (password_verify($senha, $aluno['senha'])) {
            $_SESSION['aluno_id'] = $aluno['id'];
            $_SESSION['aluno_nome'] = $aluno['nome'];
            header("Location: dashboard.php");
            exit;
        } else {
            $msg = "Senha incorreta.";
        }
    } else {
        $msg = "E-mail não encontrado.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Login do Aluno - ForteFit</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-yellow-50 flex items-center justify-center min-h-screen">

  <div class="bg-white p-8 rounded shadow-md w-full max-w-md">
    <h2 class="text-2xl font-bold text-yellow-700 mb-6 text-center">🔐 Login do Aluno</h2>

    <?php if ($msg): ?>
      <div class="bg-red-100 text-red-700 px-4 py-2 rounded mb-4 text-center"><?= $msg ?></div>
    <?php endif; ?>

    <form method="POST" class="space-y-4">
      <input type="email" name="email" placeholder="Seu e-mail" required class="w-full px-4 py-2 border border-yellow-300 rounded">
      <input type="password" name="senha" placeholder="Sua senha" required class="w-full px-4 py-2 border border-yellow-300 rounded">
      <button type="submit" class="bg-yellow-500 hover:bg-yellow-600 text-white px-6 py-2 rounded w-full font-semibold">Entrar</button>
    </form>

    <div class="text-center mt-4">
      <a href="cadastro.php" class="text-yellow-700 hover:underline">Ainda não sou aluno</a><br>
      <a href="../index.php" class="text-yellow-700 hover:underline">← Voltar para o início</a>
    </div>
  </div>

</body>
</html>
