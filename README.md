
# Realização  de teste para a workana

Este teste foi desenvolvido por mim com a finalidade de demostrar meus conhecimentos em desenvolvimento.
Não utilizei nenhum framework para o desenvolvimento do back-end, que foi contruido utilizando a linguagem PHP na versao mais recente, a 8.2. Para servir esta aplicação web utilizei o Nginx em um conainer no docker, juntamente com o php-fpm, pois o nginx nao possui suporte nativo para a linguagem PHP.
Tambem utilizei a base de banco de dados Mysql na versao 8 e no front-end utilizei o framework VueJs 3.

Obs: Esta arquitetura nao visa sua utilização em produção.


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

## Documentação 

A api foi documentada utilizando o postman:

[Documentaçao da api](https://www.postman.com/iurruu/workspace/forseti/documentation/17815923-c0b3f25d-3ddc-4c9e-8912-737650289d01)