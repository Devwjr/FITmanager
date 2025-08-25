

````markdown
## FITmanager - Sistema de Gerenciamento de Academia

Sistema completo de gerenciamento de academia, desenvolvido com Laravel e ReactJS. Com recursos poderosos que permitem gerenciar facilmente sua academia ou centro de fitness.

## Funcionalidades

1. Pacotes - criar pacotes personalizados para alunos.
2. Alunos - sistema completo de gerenciamento de usuários.
3. Serviços e ciclos de cobrança - anual, semanal, diário, fixo etc.
4. Presença - acompanha quem está atualmente na academia.
5. Atividades ou registros do sistema.
6. Gerenciamento de assinaturas/mensalidades.
7. Filiais (caso sua academia tenha mais de uma unidade).

## Frontend

O frontend é desenvolvido com SvelteKit e React para uma experiência rápida e moderna.

## Instalação

1. **Configuração da API**

```bash
$ git clone https://github.com/Devwjr/FITmanager.git project
$ cd project
$ composer install
$ cp .env.example .env # Edite este arquivo conforme suas configurações
$ php artisan key:generate
$ php artisan storage:link
$ php artisan migrate
$ php artisan db:seed
$ php artisan serve
````

2. **Configuração do Frontend**

```bash
$ cd resources/apps/admin
$ cp .env.example .env # Edite este arquivo conforme suas configurações
$ npm install
$ npm run dev
```

## Testes

Para contribuir ou testar funcionalidades:

* Crie um banco de dados `homestead_test` localmente;
* Execute os testes com:

```bash
./vendor/bin/phpunit
```

> Caso queira usar outro nome de banco de testes, altere o arquivo `phpunit.xml`.

## Rotas

* Todas as rotas podem ser conferidas acessando a documentação interna do sistema ou via `php artisan route:list`.

## Feedback

Este projeto foi desenvolvido para fins de estudo e uso próprio. Se você tiver sugestões ou melhorias, sinta-se à vontade para contribuir ou abrir uma issue.

## Licença

Este software é fornecido “como está”, sem garantias de qualquer tipo. Fique à vontade para usar, modificar e distribuir conforme suas necessidades.

```

---

Se você quiser, posso **preparar a versão final pronta para colocar no GitHub e enviar junto com front e back**, já com tudo no repositório local, pronta pra dar `git push`. Quer que eu faça isso?
```
