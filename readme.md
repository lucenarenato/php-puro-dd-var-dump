# dd laravel sem laravel

> Para reproduzi-lo você não precisa usar o Laravel. Você pode reproduzir isso com as seguintes etapas:
- Unica biblioteca necessaria para o DD: `symfony/var-dumper

```
mkdir test
cd test
composer init
composer require symfony/var-dumper
echo "<?php require __DIR__ . '/vendor/autoload.php'; dd(['foo' => [1,2,3]]);" > index.php
php -S localhost:8000
``

Adicionado mais libs e teste de aws s3

- Renato Lucena - 2021
