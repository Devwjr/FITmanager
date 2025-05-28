<?php
session_start();
if (!isset($_SESSION['aluno_id'])) {
    header("Location: login.php");
    exit;
}

$conn = new mysqli("localhost", "root", "", "academia");
if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}

// Dados do aluno
$id = $_SESSION['aluno_id'];
$res = $conn->query("SELECT * FROM alunos WHERE id = $id LIMIT 1");
$aluno = $res->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Área do Aluno - ForteFit</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://unpkg.com/@phosphor-icons/web"></script>
</head>
<body class="bg-yellow-50 min-h-screen flex flex-col">

  <header class="bg-yellow-500 text-white py-4 px-6 flex justify-between items-center">
    <h1 class="text-xl font-bold">💪 ForteFit</h1>
    <a href="logout.php" class="bg-white text-yellow-600 px-4 py-1 rounded hover:bg-yellow-100 font-medium">Sair</a>
  </header>

  <main class="flex-1 p-6 max-w-4xl mx-auto">
    <h2 class="text-2xl font-bold mb-4">Olá, <?= htmlspecialchars($aluno['nome']) ?>!</h2>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

      <!-- Cartão do plano -->
      <div class="bg-white shadow-md rounded p-4 flex items-center gap-4">
        <i class="ph ph-id-card text-4xl text-yellow-600"></i>
        <div>
          <h3 class="text-lg font-semibold text-gray-700">Plano atual</h3>
          <p class="text-gray-800"><?= $aluno['plano'] ?></p>
        </div>
      </div>

      <!-- Cartão de pagamento -->
      <div class="bg-white shadow-md rounded p-4 flex items-center gap-4">
        <i class="ph ph-credit-card text-4xl text-yellow-600"></i>
        <div>
          <h3 class="text-lg font-semibold text-gray-700">Pagamento</h3>
          <p class="text-green-600 font-medium">Em dia ✅</p>
        </div>
      </div>

      <!-- Treino de exemplo -->
      <div class="bg-white shadow-md rounded p-4 md:col-span-2">
        <h3 class="text-lg font-semibold text-gray-700 mb-2"><i class="ph ph-dumbbell text-yellow-600"></i> Seu treino básico:</h3>
        <ul class="list-disc pl-6 text-gray-700">
          <li>3x10 Supino Reto</li>
          <li>3x12 Rosca Direta</li>
          <li>3x15 Agachamento</li>
          <li>3x20 Abdominal</li>
        </ul>
      </div>

    </div>
  </main>

  <footer class="bg-yellow-100 text-center text-sm py-4 text-yellow-800">
    &copy; <?= date('Y') ?> ForteFit - Todos os direitos reservados.
  </footer>

</body>
</html>
