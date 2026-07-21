## FITmanager - Sistema de Gerenciamento de Academia

Sistema completo de gerenciamento de academia, desenvolvido com Laravel e SvelteKit. Com recursos poderosos que permitem gerenciar facilmente sua academia ou centro de fitness.

## Funcionalidades

1. **Pacotes** - criar pacotes personalizados para alunos.
2. **Alunos** - sistema completo de gerenciamento de usuários.
3. **Serviços e ciclos de cobrança** - anual, semanal, diário, fixo etc.
4. **Presença** - acompanha quem está atualmente na academia.
5. **Atividades** - registros do sistema.
6. **Gerenciamento de assinaturas/mensalidades.**
7. **Filiais** - caso sua academia tenha mais de uma unidade.

## Frontend

O frontend é desenvolvido com **SvelteKit** para uma experiência rápida e moderna.

## Tecnologias

- **Backend:** Laravel 9 (PHP 8.0+), MySQL 8.0, Redis, Sanctum Auth
- **Frontend:** SvelteKit 2, Svelte 5, Skeleton UI, Tailwind CSS
- **Infra:** Docker Compose

## Instalação

### 1. Configuração da API (Backend)

```bash
git clone https://github.com/Devwjr/FITmanager.git project
cd project
composer install
cp .env.example .env # Edite este arquivo conforme suas configurações
php artisan key:generate
php artisan storage:link
php artisan migrate
php artisan db:seed
php artisan serve
```

### 2. Configuração do Frontend

```bash
cd resources/apps/admin
cp .env.example .env # Edite este arquivo conforme suas configurações
npm install
npm run dev
```

### 3. Docker (Opcional)

```bash
docker-compose up -d
```

Isso irá iniciar:
- MySQL na porta 3306
- Redis na porta 6379
- MailHog (para testes de email) na porta 8025

## Testes

Para contribuir ou testar funcionalidades:

```bash
# Testes Backend (PHPUnit)
./vendor/bin/phpunit

# Testes Frontend (Playwright + Vitest)
cd resources/apps/admin
npm run test
```

## Rotas

Todas as rotas podem ser conferidas acessando a documentação interna do sistema ou via:

```bash
php artisan route:list
```

## Estrutura do Projeto

```
FITmanager/
├── app/                    # Código PHP (Models, Controllers, Services)
├── config/                 # Configurações do Laravel
├── database/               # Migrations, Seeders, Factories
├── resources/apps/admin/   # Frontend SvelteKit
│   ├── src/
│   │   ├── lib/           # Componentes, Stores, Utilitários
│   │   └── routes/        # Páginas (Admin + Auth)
│   └── tests/             # Testes Frontend
├── routes/                 # Rotas da API
└── tests/                  # Testes Backend
```

## Contribuição

Este projeto foi desenvolvido para fins de estudo e uso próprio. Se você tiver sugestões ou melhorias, sinta-se à vontade para contribuir ou abrir uma issue.

## Licença

Este software é fornecido "como está", sem garantias de qualquer tipo. Fique à vontade para usar, modificar e distribuir conforme suas necessidades.
