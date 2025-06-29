<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Financeiro</title>
    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold mb-8 text-gray-800">Dashboard Financeiro</h1>

        <!-- Cards Resumo -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white shadow rounded-lg p-6">
                <h2 class="text-gray-500 text-sm">Receita Total</h2>
                <p class="text-2xl font-bold text-green-600 mt-2">R$ 45.000</p>
            </div>
            <div class="bg-white shadow rounded-lg p-6">
                <h2 class="text-gray-500 text-sm">Despesas</h2>
                <p class="text-2xl font-bold text-red-600 mt-2">R$ 12.000</p>
            </div>
            <div class="bg-white shadow rounded-lg p-6">
                <h2 class="text-gray-500 text-sm">Saldo</h2>
                <p class="text-2xl font-bold text-blue-600 mt-2">R$ 33.000</p>
            </div>
        </div>

        <!-- Gráfico (placeholder) -->
        <div class="bg-white shadow rounded-lg p-6 mb-8">
            <h2 class="text-gray-700 font-semibold mb-4">Fluxo Mensal</h2>
            <div class="h-48 bg-gray-200 rounded flex items-center justify-center">
                <span class="text-gray-500">[ Gráfico aqui ]</span>
            </div>
        </div>

        <!-- Tabela Últimos Pagamentos -->
        <div class="bg-white shadow rounded-lg p-6">
            <h2 class="text-gray-700 font-semibold mb-4">Últimos Pagamentos</h2>
            <div class="overflow-x-auto">
                <table class="min-w-full text-left">
                    <thead>
                        <tr>
                            <th class="py-2 px-4 text-gray-600">Aluno</th>
                            <th class="py-2 px-4 text-gray-600">Data</th>
                            <th class="py-2 px-4 text-gray-600">Valor</th>
                            <th class="py-2 px-4 text-gray-600">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-t">
                            <td class="py-2 px-4">João Silva</td>
                            <td class="py-2 px-4">25/06/2025</td>
                            <td class="py-2 px-4">R$ 250</td>
                            <td class="py-2 px-4">
                                <span class="inline-flex px-2 py-1 text-xs font-medium rounded bg-green-100 text-green-800">Pago</span>
                            </td>
                        </tr>
                        <tr class="border-t">
                            <td class="py-2 px-4">Maria Souza</td>
                            <td class="py-2 px-4">23/06/2025</td>
                            <td class="py-2 px-4">R$ 300</td>
                            <td class="py-2 px-4">
                                <span class="inline-flex px-2 py-1 text-xs font-medium rounded bg-yellow-100 text-yellow-800">Pendente</span>
                            </td>
                        </tr>
                        <tr class="border-t">
                            <td class="py-2 px-4">Carlos Lima</td>
                            <td class="py-2 px-4">20/06/2025</td>
                            <td class="py-2 px-4">R$ 200</td>
                            <td class="py-2 px-4">
                                <span class="inline-flex px-2 py-1 text-xs font-medium rounded bg-green-100 text-green-800">Pago</span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>
</html>
