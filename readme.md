#Instalação e inicialização do Backend

Ferramentas utilizadas:

- php 8.2
- laravel 10
- postgres

Abrir o diretório *api* que se encontra no diretório raiz

clonar o arquivo .env.example para .env
Preencher com os dados para teste

Abrir o terminal dentro do diretorio Backend encontrado no diretório raiz e executar os seguinte comandos:

- composer install
- php artisan serve (Irá subir o servidor padrão do PHP com a porta 8000), importante manter na 8000, pois é a porta
  configurada no proxy do frontend

Tests:

- Foi criado um novo schema no banco chamado testing para isso foi criar um .env.testing para o php unit
- Estou utilizando a lib PEST
- para rodar o watch é necessario instalar o fswatch: https://github.com/emcrisostomo/fswatch#getting-fswatch

#Instalação e inicialização do Frontend

Ferramentas utilizadas:

Vue 3
Vite
Typescript

Abrir o diretório *app* que se encontra no diretório raiz

Abrir o terminal dentro do diretorio Frontend encontrado no diretório raiz e executar o seguintes comandos:

- yarn
- yarn dev

Utilização básica:

- Signup
- Login
- Criar uma Tax
- Criar um Product Type
- Criar um Product
- Fazer p lançamento em PDV
- conferir no menu Sells
