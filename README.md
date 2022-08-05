# Store Products CRUD

#**Requísitos**#

Aplicação desenvolvida em Laravel 9
```
PHP 8
```

#**Instalação**#

Para começar use o Composer para instalação das dependências do projeto:

```bash
composer install
```

Edite o arquivo `.env`.

Configuração do banco de dados
```dotenv
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=db
DB_USERNAME=root
DB_PASSWORD=
```

Migrar Banco de Dados

```bash
php artisan migrate
```