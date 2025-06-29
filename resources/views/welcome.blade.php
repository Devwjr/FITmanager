<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fit Manager - Sistema de Gerenciamento de Academia</title>
    <!-- Tailwind CSS via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'red': {
                            50: '#fef2f2',
                            100: '#fee2e2',
                            200: '#fecaca',
                            300: '#fca5a5',
                            400: '#f87171',
                            500: '#ef4444',
                            600: '#dc2626',
                            700: '#b91c1c',
                            800: '#991b1b',
                            900: '#7f1d1d',
                        }
                    }
                }
            }
        }
    </script>
    <style type="text/tailwindcss">
        @layer utilities {
            .transition-all {
                transition-property: all;
            }
        }
    </style>
</head>
<body class="bg-gray-50 font-sans antialiased">
    <!-- Barra de Navegação -->
    <nav class="bg-red-600 text-white shadow-lg">
        <div class="container mx-auto px-4 py-3 flex justify-between items-center">
            <div class="flex items-center space-x-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                </svg>
                <span class="text-xl font-bold">Fit Manager</span>
            </div>
            
            <div class="hidden md:flex space-x-6">
                <a href="#" class="hover:text-red-200 font-medium">Início</a>
                <a href="#" class="hover:text-red-200 font-medium">Funcionalidades</a>
                <a href="#" class="hover:text-red-200 font-medium">Planos</a>
                <a href="#" class="hover:text-red-200 font-medium">Contato</a>
            </div>
            
            <div class="flex items-center space-x-4">
                <a href="/login" class="hover:text-red-200 font-medium">Login</a>
                <a href="/register" class="bg-white text-red-600 px-4 py-2 rounded-lg font-medium hover:bg-red-50 transition-all duration-300">Registrar</a>
            </div>
            
            <button class="md:hidden focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="bg-gradient-to-r from-red-600 to-red-500 text-white py-20">
        <div class="container mx-auto px-4 text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-6">Gerencie sua academia com eficiência</h1>
            <p class="text-xl md:text-2xl mb-8 max-w-3xl mx-auto">O Fit Manager oferece todas as ferramentas necessárias para administrar alunos, pagamentos, treinos e muito mais.</p>
            <div class="flex flex-col sm:flex-row justify-center gap-4">
                <a href="/register" class="bg-white text-red-600 px-8 py-3 rounded-lg font-bold hover:bg-red-50 transition-all duration-300 text-lg">Experimente Grátis</a>
                <a href="#" class="border-2 border-white px-8 py-3 rounded-lg font-bold hover:bg-white hover:text-red-600 transition-all duration-300 text-lg">Saiba Mais</a>
            </div>
        </div>
    </section>

    <!-- Recursos -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center text-gray-800 mb-12">Recursos Completos</h2>
            
            <div class="grid md:grid-cols-3 gap-8">
                <!-- Recurso 1 -->
                <div class="bg-red-50 p-6 rounded-lg shadow-md hover:shadow-lg transition-all duration-300">
                    <div class="text-red-600 mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-3">Gestão de Alunos</h3>
                    <p class="text-gray-600">Controle completo de cadastro, histórico de treinos, avaliações físicas e muito mais.</p>
                </div>
                
                <!-- Recurso 2 -->
                <div class="bg-red-50 p-6 rounded-lg shadow-md hover:shadow-lg transition-all duration-300">
                    <div class="text-red-600 mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-3">Controle Financeiro</h3>
                    <p class="text-gray-600">Gerenciamento de mensalidades, pagamentos, relatórios financeiros e controle de inadimplência.</p>
                </div>
                
                <!-- Recurso 3 -->
                <div class="bg-red-50 p-6 rounded-lg shadow-md hover:shadow-lg transition-all duration-300">
                    <div class="text-red-600 mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-3">Prescrição de Treinos</h3>
                    <p class="text-gray-600">Crie e gerencie treinos personalizados para cada aluno com acompanhamento de evolução.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Depoimentos -->
    <section class="py-16 bg-gray-100">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center text-gray-800 mb-12">O que dizem nossos clientes</h2>
            
            <div class="grid md:grid-cols-2 gap-8">
                <!-- Depoimento 1 -->
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <div class="flex items-center mb-4">
                        <div class="h-12 w-12 rounded-full bg-red-100 flex items-center justify-center text-red-600 font-bold mr-4">AC</div>
                        <div>
                            <h4 class="font-bold text-gray-800">Alex Costa</h4>
                            <p class="text-gray-600">Academia Power Fit</p>
                        </div>
                    </div>
                    <p class="text-gray-700">"O Fit Manager revolucionou nossa gestão. Agora temos controle total sobre nossos alunos e finanças em um só lugar."</p>
                </div>
                
                <!-- Depoimento 2 -->
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <div class="flex items-center mb-4">
                        <div class="h-12 w-12 rounded-full bg-red-100 flex items-center justify-center text-red-600 font-bold mr-4">MF</div>
                        <div>
                            <h4 class="font-bold text-gray-800">Mariana Fernandes</h4>
                            <p class="text-gray-600">Studio Corpo & Saúde</p>
                        </div>
                    </div>
                    <p class="text-gray-700">"A facilidade de prescrever treinos e acompanhar a evolução dos alunos nos ajudou a aumentar a retenção em 30%."</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Final -->
    <section class="py-16 bg-red-600 text-white">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-3xl font-bold mb-6">Pronto para transformar sua academia?</h2>
            <p class="text-xl mb-8 max-w-2xl mx-auto">Experimente o Fit Manager gratuitamente por 14 dias e descubra como podemos ajudar seu negócio a crescer.</p>
            <a href="/register" class="bg-white text-red-600 px-8 py-3 rounded-lg font-bold hover:bg-red-50 transition-all duration-300 text-lg">Comece Agora</a>
        </div>
    </section>

    <!-- Rodapé -->
    <footer class="bg-gray-800 text-white py-8">
        <div class="container mx-auto px-4">
            <div class="grid md:grid-cols-4 gap-8">
                <div>
                    <h3 class="text-xl font-bold mb-4">Fit Manager</h3>
                    <p class="text-gray-400">O sistema completo de gerenciamento para academias e estúdios de treinamento.</p>
                </div>
                
                <div>
                    <h4 class="font-bold mb-4">Links Rápidos</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-400 hover:text-white">Início</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Funcionalidades</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Planos</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Contato</a></li>
                    </ul>
                </div>
                
                <div>
                    <h4 class="font-bold mb-4">Contato</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li>contato@fitmanager.com</li>
                        <li>(11) 99999-9999</li>
                        <li>São Paulo, SP</li>
                    </ul>
                </div>
                
                <div>
                    <h4 class="font-bold mb-4">Redes Sociais</h4>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M22.675 0h-21.35c-.732 0-1.325.593-1.325 1.325v21.351c0 .731.593 1.324 1.325 1.324h11.495v-9.294h-3.128v-3.622h3.128v-2.671c0-3.1 1.893-4.788 4.659-4.788 1.325 0 2.463.099 2.795.143v3.24l-1.918.001c-1.504 0-1.795.715-1.795 1.763v2.313h3.587l-.467 3.622h-3.12v9.293h6.116c.73 0 1.323-.593 1.323-1.325v-21.35c0-.732-.593-1.325-1.325-1.325z"/>
                            </svg>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                            </svg>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="border-t border-gray-700 mt-8 pt-8 text-center text-gray-400">
                <p>&copy; 2023 Fit Manager. Todos os direitos reservados.</p>
            </div>
        </div>
    </footer>
</body>
</html>