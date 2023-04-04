
# Realização  de teste para a workana

Este teste foi desenvolvido por mim com a finalidade de demostrar meus conhecimentos em desenvolvimento.
Não utilizei nenhum framework para o desenvolvimento do back-end, que foi contruido utilizando a linguagem PHP na versao mais recente, a 8.2. Para servir esta aplicação web utilizei o Nginx em um conainer no docker, juntamente com o php-fpm, pois o nginx nao possui suporte nativo para a linguagem PHP.
Tambem utilizei a base de banco de dados Mysql, e um arquivo sql se encontra na pasta /devops, com sua autoimplementaçao na instalaçao do projeto  na versao 8 e no front-end utilizei o framework VueJs 3.

Obs: Como é uma demonstrão de conhecimentos não tive a intençã de criação completa, visto que levaria mais tempo e mão de obra, porem, criei um exemplo de implementação de teste, abstração de classes e interfaces.


## Pré-requisitos

- Para facilitar a instalação existe um Makefile.
- Docker e docker compose
- composer
- yarn

## Instalação 

Para uma instalação rapida basta utilizar o comando:


```
  make fast_install
```

Ou manualmente na raiz do projeto:

``` 
    cp ./.env.example ./.env &&
    cd ./core && composer install && cd ../ &&
    cd ./frontend && yarn install && cd ../ &&
    docker compose up -d &&
    docker compose exec -T mysql mysql -uiurru -p5533 iurru < ./ && devops/tables.sql

```
## Vizualização

- O Back-end da aplicação esta na porta 8000
- O front-end da aplicação esta na porta 80

## Documentação 

A api foi documentada utilizando o postman:

[Documentaçao da api](https://www.postman.com/iurruu/workspace/forseti/documentation/17815923-c0b3f25d-3ddc-4c9e-8912-737650289d01)

## Testes

Para vizualização dos testes use:

```
    make run_tests
```