<?php
// Renato Lucena - 05/02/2021
date_default_timezone_set ("America/Recife");

if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/vendor/autoload.php")) {
    require_once $_SERVER['DOCUMENT_ROOT'] . "/vendor/autoload.php";
} else {
    die("Arquivo da vendor não encontrado.");
}

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\RotatingFileHandler;

function logMsg($msg)
{
    $data = date("d-m-Y");
    $arquivo = "logs/Logger_$data.log";
    $log = new Logger('log:');
    $log->pushHandler(new StreamHandler($arquivo, Logger::DEBUG));
    $log->debug($msg);
}


