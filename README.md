# Projeto de Gerenciamento de Consultas

## Descrição
Este projeto é uma aplicação de gerenciamento de consultas médicas. Ele permite o cadastro e gerenciamento de pacientes e consultas, com os médicos já previamente configurados na base de dados. O front-end é desenvolvido utilizando Vue.js com Vite, Tailwind CSS, Axios e Element Plus, enquanto o back-end utiliza Laravel.

## Funcionalidades
- CRUD de Pacientes: Criar, Ler, Atualizar e Deletar informações de pacientes.
- CRUD de Consultas: Criar, Ler, Atualizar e Deletar informações de consultas.
- Listagem de Médicos: Médicos já pré-configurados na base de dados.
- Listagem e Criação de Pacientes e Consultas: Usando DataTables do Element Plus.

## Tecnologias utilizadas
### Front-end

- Vue.js: Framework JavaScript progressivo para construção de interfaces de usuário.
- Vite: Ferramenta de build rápida e minimalista para projetos Vue.js.
- Tailwind CSS: Framework CSS utilitário para estilização rápida e eficiente.
- Axios: Biblioteca para fazer requisições HTTP.
- Element Plus: Biblioteca de componentes UI para Vue 3.

### Back-end
- Laravel: Framework PHP para desenvolvimento de aplicações web.

# Instalação
## Back-end
- Clone o projeto `git clone https://github.com/seu-usuario/projeto-gerenciamento-consultas.git`
  `cd projeto-gerenciamento-consultas`
- Instale as dependências do Laravel
- Configure o arquivo .env com as informações do seu banco de dados.
- Execute as migrações para configurar o banco de dados
- Inicie o servidor Laravel `php artisan serve`

## Front-end
- Navegue até o diretório frontend: `cd frontend`
- Instale as dependências do projeto: `npm install`
- Inicie o servidor de desenvolvimento: `npm run dev`

# Licença
Este projeto está licenciado sob a licença MIT. Veja o arquivo LICENSE para mais detalhes.

