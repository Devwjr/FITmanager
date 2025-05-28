<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Academia ForteFit</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    .slider {
      animation: slide 20s infinite;
    }
    @keyframes slide {
      0% { transform: translateX(0); }
      20% { transform: translateX(-100%); }
      40% { transform: translateX(-200%); }
      60% { transform: translateX(-300%); }
      80% { transform: translateX(-400%); }
      100% { transform: translateX(0); }
    }
  </style>
</head>
<body class="bg-yellow-50 text-gray-800 flex flex-col min-h-screen">

  <!-- Topo -->
  <header class="bg-yellow-400 text-white p-6 shadow-md">
    <div class="container mx-auto flex justify-between items-center">
      <h1 class="text-2xl font-bold">🏋️‍♂️ Academia ForteFit</h1>
      <div class="space-x-4">
        <a href="login.php" class="bg-white text-yellow-600 px-4 py-2 rounded shadow hover:bg-yellow-100 font-semibold">Login Admin</a>
        <a href="aluno/login.php" class="bg-white text-yellow-600 px-4 py-2 rounded shadow hover:bg-yellow-100 font-semibold">Login Aluno</a>
        <a href="aluno/cadastro.php" class="bg-yellow-700 text-white px-4 py-2 rounded shadow hover:bg-yellow-800 font-semibold">Quero me matricular</a>
      </div>
    </div>
  </header>

  <!-- Slider -->
  <div class="overflow-hidden w-full h-64 bg-yellow-100">
    <div class="flex slider w-[500%] h-full">
      <img src="https://source.unsplash.com/800x300/?gym,1" class="w-full h-full object-cover" />
      <img src="https://source.unsplash.com/800x300/?fitness,2" class="w-full h-full object-cover" />
      <img src="https://source.unsplash.com/800x300/?workout,3" class="w-full h-full object-cover" />
      <img src="https://source.unsplash.com/800x300/?crossfit,4" class="w-full h-full object-cover" />
      <img src="https://source.unsplash.com/800x300/?bodybuilding,5" class="w-full h-full object-cover" />
    </div>
  </div>

  <!-- Conteúdo principal -->
  <main class="flex-1 container mx-auto text-center py-10 px-4">
    <h2 class="text-4xl font-bold text-yellow-700 mb-6">Transforme seu corpo com a ForteFit</h2>
    <p class="text-lg mb-8 max-w-2xl mx-auto">Somos a academia número 1 em resultados e inovação! Treine com segurança, tenha acompanhamento personalizado e acesse seus dados diretamente pela plataforma.</p>
    <div class="space-x-4">
      <a href="aluno/cadastro.php" class="bg-yellow-600 text-white px-6 py-3 rounded-full text-lg font-semibold shadow hover:bg-yellow-700 transition">Matricule-se agora</a>
      <a href="aluno/login.php" class="bg-white border border-yellow-500 text-yellow-700 px-6 py-3 rounded-full text-lg font-semibold shadow hover:bg-yellow-100 transition">Sou aluno</a>
    </div>
  </main>

  <!-- Rodapé -->
  <footer class="bg-yellow-400 text-white text-center py-4 mt-10">
    &copy; <?= date('Y') ?> Academia ForteFit — Todos os direitos reservados
  </footer>

</body>
</html>
