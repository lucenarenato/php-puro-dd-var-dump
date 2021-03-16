# dd laravel sem laravel

> Para reproduzi-lo você não precisa usar o Laravel. Você pode reproduzir isso com as seguintes etapas:


```
mkdir test
cd test
composer init
composer require symfony/var-dumper
echo "<?php require __DIR__ . '/vendor/autoload.php'; dd(['foo' => [1,2,3]]);" > index.php
php -S localhost:8000
``
