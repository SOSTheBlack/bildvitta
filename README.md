# Coin Conversion

![Currency](public/assests/currency-converter.png)![Tests](public/assests/bild_vitta.png)

Esse software tem o intuito de fazer a conversão de moedas pré cadastradas.

## **Requerimentos**

- PHP 8 ou superior
- Composer
- MySql

Para instalar e testar o projeto siga os passos a seguir:

### Instalação e inicialização do software

Clonando o projeto em sua máquina local

```shell
git clone git@github.com:SOSTheBlack/bildvitta.git
```

Acesse a pasta do projeto

```shell
cd bildvitta
```

Instalando as dependências:

```shell
composer install
```

Crie o seu arquivo de configuração `.env`
Não esqueça de alterar os dados de conexão com o banco de dados.

```shell
cp .env.example .env
```

Gere a chave de segurança do software

```shell
php artisan key:generate
```

Rode as migração de banco de dados
```shell
php artisan migrate --seed
```

Inicializando o software

```shell
php artisan serve
```

### Rodando testes

Execute o comando abaixo:

```shell
php artisan test
```

### Exemplo de uso da API

```
curl -L -X GET "http://127.0.0.1:8000/api/coins/conversions?coin_from=USD&coin_to=GBP&quantity=10" \
-H 'Content-Type: application/json' \
-H 'Accept: application/json' \
-H 'Token: d812b49499b6b3e6b24a70cece02f2f7'
```
