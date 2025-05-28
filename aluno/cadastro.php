<?php
// Conexão com o banco
$conn = new mysqli("localhost", "root", "", "academia");
if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}

// Cadastro
$msg = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $conn->real_escape_string($_POST['nome']);
    $email = $conn->real_escape_string($_POST['email']);
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
    $cpf = $conn->real_escape_string($_POST['cpf']);
    $nascimento = $conn->real_escape_string($_POST['nascimento']);
    $plano = $conn->real_escape_string($_POST['plano']);

    $conn->query("INSERT INTO alunos (nome, email, senha, cpf, nascimento, plano) VALUES ('$nome', '$email', '$senha', '$cpf', '$nascimento', '$plano')");
    $msg = "Cadastro realizado com sucesso!";
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Cadastro de Aluno - ForteFit</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-yellow-50 text-gray-800 min-h-screen flex flex-col items-center justify-center py-10">

  <div class="w-full max-w-xl bg-white p-8 rounded shadow-md">
    <h2 class="text-2xl font-bold text-yellow-700 mb-6 text-center">📝 Cadastro de Aluno</h2>

    <?php if ($msg): ?>
      <div class="bg-green-100 text-green-700 px-4 py-2 rounded mb-4 text-center"><?= $msg ?></div>
    <?php endif; ?>

    <form method="POST" class="space-y-4">
      <input type="text" name="nome" placeholder="Nome completo" required class="w-full px-4 py-2 border border-yellow-300 rounded">
      <input type="email" name="email" placeholder="E-mail" required class="w-full px-4 py-2 border border-yellow-300 rounded">
      <input type="password" name="senha" placeholder="Senha" required class="w-full px-4 py-2 border border-yellow-300 rounded">
      <input type="text" name="cpf" placeholder="CPF" required class="w-full px-4 py-2 border border-yellow-300 rounded">
      <input type="date" name="nascimento" required class="w-full px-4 py-2 border border-yellow-300 rounded">

      <select name="plano" required class="w-full px-4 py-2 border border-yellow-300 rounded">
        <option value="">Escolha um plano</option>
        <option value="Mensal">Mensal - R$ 99</option>
        <option value="Trimestral">Trimestral - R$ 270</option>
        <option value="Anual">Anual - R$ 900</option>
      </select>

      <button type="submit" class="bg-yellow-500 hover:bg-yellow-600 text-white px-6 py-2 rounded w-full font-semibold">Cadastrar</button>
    </form>

    <div class="text-center mt-4">
      <a href="../index.php" class="text-yellow-700 hover:underline">← Voltar para a página inicial</a>
    </div>
  </div>

</body>
</html>
