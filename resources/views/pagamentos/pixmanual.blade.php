<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Pagamento Pix Manual</title>
</head>
<body class="bg-vermelho text-white flex flex-col items-center justify-center min-h-screen">

    <h1 class="text-xl mb-4">Escaneie ou copie o código Pix</h1>

    <img src="{{ $qrcode }}" alt="QR Code Pix" class="w-64 h-64 mb-4">

    <p class="mb-2">Copia e Cola Pix:</p>
    <textarea readonly class="w-80 p-2 text-black">{{ $payload }}</textarea>

</body>
</html>
