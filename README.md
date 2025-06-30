# 💪 FITmanager

Sistema web para gerenciamento de academias. Criado com **Laravel** no backend e **Tailwind CSS** no frontend.  

---

## 🚀 Funcionalidades já implementadas

✅ Cadastro e login de usuários  
✅ Controle de alunos e suas fichas  
✅ Área do aluno (consulta de treino, dieta, mensalidades)  
✅ Controle de planos e mensalidades  
✅ Tela de login estilizada (fundo vermelho, campos brancos)  
✅ Layout responsivo com Tailwind CDN  

---

## 🛠️ Funcionalidades em desenvolvimento

⚙️ **Dashboard administrativo com resumo financeiro**  
- Visão geral de receitas e despesas
- Gráfico de mensalidades pagas x pendentes
- Contagem de alunos ativos

⚙️ **Integração com pagamento via Pix**  
- Geração de QR Code para pagamento
- Confirmação automática de pagamento

⚙️ **Emissão de recibos digitais**  
- Recibo em PDF
- Envio automático por e-mail

⚙️ **Controle de presença do aluno**  
- Registro de entrada/saída
- Histórico de frequência

---

## 🏋️ Visão geral do sistema

![Dashboard exemplo](https://via.placeholder.com/800x400.png?text=Dashboard+Financeiro+%28Em+Desenvolvimento%29)

---

## 💻 Tecnologias utilizadas

- PHP (Laravel)
- Tailwind CSS (via CDN)
- Blade (Laravel Views)
- MySQL ou MariaDB

---

## ⚡ Como rodar

```bash
git clone https://github.com/Devwjr/FITmanager.git
cd FITmanager
composer install
cp .env.example .env
php artisan key:generate
# Configurar o banco no .env
php artisan migrate
php artisan serve
 
