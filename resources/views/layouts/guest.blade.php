<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Configurar cor vermelha personalizada -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        vermelho: '#e11d48', // vermelho principal
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-vermelho min-h-screen flex items-center justify-center">

    <div class="w-full max-w-md bg-white/10 backdrop-blur-sm rounded-lg p-8 shadow-lg">
        {{ $slot }}
    </div>

</body>
</html>
