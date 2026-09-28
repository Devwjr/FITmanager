# Hospedar o EduFit no free tier

Arquitetura: dois Web Services Docker no Render (API Laravel e painel SvelteKit), com PostgreSQL no Neon. Os Dockerfiles e um Blueprint `render.yaml` já estão no projeto. Você precisa criar suas contas e conectar seu repositório; nenhum serviço foi publicado automaticamente.

## 1. Envie o código para seu GitHub

Envie os arquivos versionados do projeto para um repositório seu. Não envie `.env`, `database.sqlite`, senhas do banco nem `vendor`/`node_modules`.

## 2. Banco Neon

1. Crie um projeto Free em https://console.neon.tech.
2. Escolha uma região próxima à usada no Render.
3. Em **Connect**, copie a URL PostgreSQL com SSL (`postgresql://...?...sslmode=require`). Ela é secreta.
4. Confira os limites vigentes do [Neon Free](https://neon.com/pricing). O plano possui cotas de armazenamento e computação; não significa capacidade ilimitada.

## 3. API no Render

Você pode usar o fluxo manual abaixo ou, no Render, escolher **New → Blueprint** e apontar para `render.yaml`. O Blueprint cria os dois serviços. Quando o Render pedir a variável secreta `DATABASE_URL`, cole a URL do Neon; não a coloque no GitHub.

1. Crie **New → Web Service**, conecte o repositório e selecione **Docker**.
2. Nome sugerido: `edufit-api`; Root Directory vazio; Dockerfile Path `./Dockerfile`; instância **Free**.
3. Configure as variáveis abaixo (substitua os endereços pelos seus):

```dotenv
APP_NAME=EduFit
APP_ENV=production
APP_DEBUG=false
APP_KEY=base64:SUA_CHAVE_GERADA
APP_URL=https://edufit-api.onrender.com
SPA_URL=https://edufit-painel.onrender.com
DB_CONNECTION=pgsql
DATABASE_URL=URL_SECRETA_DO_NEON_COM_SSL
CACHE_DRIVER=file
SESSION_DRIVER=file
QUEUE_CONNECTION=sync
LOG_CHANNEL=stderr
MAIL_MAILER=log
```

Gere uma chave com `php artisan key:generate --show` na sua máquina e copie o resultado para `APP_KEY`. Mantenha essa mesma chave nos próximos deploys. Não use o texto de exemplo.

4. Clique em **Deploy Web Service**. O script de inicialização executa as migrações e cria `edu` com senha `edu12345` apenas se esse usuário ainda não existir. Não execute os seeders antigos de dados fictícios em produção, pois alguns apagam tabelas.
5. O Apache atende na porta 80, detectada pelo Render. Aguarde o serviço ficar disponível e anote a URL real.

## 4. Painel no Render

1. Crie outro **Web Service**, usando o mesmo repositório, **Docker**, instância **Free**.
2. Nome sugerido: `edufit-painel`.
3. Root Directory: `resources/apps/admin`; Dockerfile Path: `./Dockerfile` (relativo à raiz selecionada).
4. Configure:

```dotenv
PUBLIC_API_URL=https://edufit-api.onrender.com
ORIGIN=https://edufit-painel.onrender.com
NODE_ENV=production
PORT=10000
```

Use a URL real da API, sem `/api` no final. `ORIGIN` deve ser exatamente o endereço público do painel. `PUBLIC_API_URL` é incorporada na compilação; se mudar, faça novo deploy.

5. Publique, atualize `SPA_URL` da API com a URL real do painel e faça novo deploy da API.
6. Abra o painel, entre com `edu` / `edu12345`, troque a senha em **Minha Conta → Segurança**, cadastre um aluno e registre uma sessão para conferir o funcionamento.

## Limites e persistência

- O [Render Free](https://render.com/docs/free) desliga serviços após 15 minutos sem tráfego; o primeiro acesso pode demorar. Os dois serviços compartilham a cota mensal de horas gratuitas do workspace. Verifique a cota no painel; não há garantia de dois serviços ligados continuamente dentro da franquia.
- Os dados de alunos e treinos ficam no Neon e sobrevivem aos redeploys. O disco do Render é temporário: fotos de perfil enviadas para armazenamento local não persistem. Para fotos persistentes, configure um serviço de arquivos externo antes de usar esse recurso.
- Não use SQLite no Render gratuito. Também não use o PostgreSQL gratuito do Render como banco permanente: ele expira após 30 dias, conforme a documentação.
- `MAIL_MAILER=log` permite cadastrar alunos, mas não envia recuperação de senha por email. Para envio real, configure um provedor SMTP e um remetente válido.
- Faça backup periódico do Neon (por exemplo, exportação com `pg_dump`). Verifique limites e condições dos provedores antes de depender do sistema no dia a dia.
- O projeto usa Laravel 9; planeje atualização do framework antes de uma operação pública de longo prazo.

Referências: [Docker no Render](https://render.com/docs/docker), [limites gratuitos do Render](https://render.com/docs/free), [planos Neon](https://neon.com/pricing).
