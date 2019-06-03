# Profissionais_data
Aplicação Web Laravel para avaliação da Fase 2 do edital – LAIS/UFRN

##Informações Técnicas

####Link para download dos dados: 
* http://cnes2.datasus.gov.br/Mod_Profissional.asp?VCo_Unidade=2408102653982
####Linguagem de Programação:
* PHP 7 com framework [Laravel (versão 5.8)](https://laravel.com/docs/5.8)
####Banco de Dados:
* [Sqlite](https://www.sqlite.org/index.html)

### Requisitos do servidor

Caso não tenha configurado um ambiente Laravel, será necessário instalar os seguintes requisitos:

* PHP >= 7.1.3
* BCMath PHP Extension
* Ctype PHP Extension
* JSON PHP Extension
* Mbstring PHP Extension
* OpenSSL PHP Extension
* PDO PHP Extension
* Tokenizer PHP Extension
* XML PHP Extension

* instalar o [Composer](https://getcomposer.org/download/)

### Como compilar o projeto

Após ter as depêndências e o Composer instalados:


```
sudo apt install php7-sqlite3
sudo apt install php-curl
```
```
cp .env.example .env
```
```
touch database/database.sqlite
```
```
composer install
```
```
php artisan key:generate
```
```
php artisan migrate
```
```
php artisan scraper:mod_profissional
```
```
php artisan serve
```

A partir desse momento, você já pode acessar o projeto em
[http://localhost:8000](http://localhost:8000).

##Informações do Projeto

* Extração dos dados por WebScraper com [GuzzleHttp](https://github.com/guzzle/guzzle)

* Banco de Dados [Sqlite](https://www.sqlite.org/index.html) normalizado

*  AJAX/RESTful na apresentação dos dados com [DataTables](https://datatables.net/examples/index)

* Autenticação com Oauth Google

* Gráficos: [HighCharts](https://www.highcharts.com/docs/)

* Layout: [Laravel-AdminLTE](https://github.com/jeroennoten/Laravel-AdminLTE)

##Autora
* [Kathleen Noemi Duarte Rego](https://github.com/kathleenrego)