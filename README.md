# EduFit

Gestão de alunos e acompanhamento de treinamento com Laravel e SvelteKit.

- Biblioteca de exercícios com grupo muscular e orientações.
- Fichas por aluno com séries, repetições, carga e frequência semanal.
- Volume planejado por sessão e por semana.
- Registro de sessões realizadas, independente das alterações futuras na ficha.
- Evolução semanal (segunda a domingo) e mensal, com comparação percentual ao período anterior.
- Gráfico de volume por sessão e modelos padrão editáveis (full body, upper/lower e push/pull/legs).
- Séries por grupo muscular, histórico e exclusão de registros incorretos.
- Gestão de alunos, assinaturas e demais recursos já existentes.

O volume em kg corresponde a séries × repetições × carga externa. Não é uma medida isolada de evolução física. Para exercícios sem carga externa, use 0 kg; as séries e repetições continuam contabilizadas. Para séries com cargas diferentes, repita o exercício em linhas separadas. Sem valor no período anterior, a porcentagem é exibida como “Sem base de comparação”.

## Executar localmente

Requisitos: PHP 8.4 com SQLite, mbstring e XML; Composer; Node 20.19+ e npm. O lock atual de dependências PHP exige PHP 8.4.

```bash
composer install
cp .env.example .env
php artisan key:generate
```

Para usar SQLite, crie `database/database.sqlite` e configure no `.env`:

```dotenv
DB_CONNECTION=sqlite
DB_DATABASE=/caminho/absoluto/do/projeto/database/database.sqlite
MAIL_MAILER=log
```

```bash
php artisan migrate --seed
php artisan serve
```

Em outro terminal:

```bash
cd resources/apps/admin
cp .env.example .env
npm ci
npm run dev
```

Abra http://localhost:5173. Login: **edu**, senha inicial: **edu12345**. O seed cria o administrador sem apagar alunos ou redefinir uma senha já alterada. Em um banco existente, execute `php artisan migrate` e `php artisan db:seed --class=AdminSeeder`.

Cadastre alunos em **Alunos → Novo Aluno**, depois abra **Treinos e evolução**. Cadastre exercícios, selecione o aluno e monte uma ficha. Use **Registrar execução**, ajuste os valores realmente realizados e salve a sessão. Selecione semana/mês e uma data para consultar o histórico. A comparação do período atual ainda em andamento pode ter menos dias que o anterior.

Altere a senha inicial em **Minha Conta → Segurança** antes de compartilhar o endereço público.

Os modelos padrão são pontos de partida editáveis, baseados na recomendação pública da [OMS de incluir fortalecimento dos principais grupos musculares em pelo menos dois dias por semana](https://www.who.int/europe/news-room/fact-sheets/item/physical-activity). Eles não são prescrição: revise exercícios, carga, frequência e progressão para cada aluno.

## Hospedagem gratuita

Siga [o guia Render + Neon](docs/HOSPEDAGEM.md). Inclui configurações dos dois serviços, banco persistente e limitações do free tier.

## Verificação

```bash
vendor/bin/phpunit --filter TrainingTest
cd resources/apps/admin
npm run check
npm run build
```
