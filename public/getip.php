<?php

date_default_timezone_set("America/Recife");

if (file_exists($_SERVER['DOCUMENT_ROOT'] . "UserInfo.php")) {
    require_once $_SERVER['DOCUMENT_ROOT'] . "UserInfo.php";
} else {
    die("Arquivo da vendor não encontrado.");
}

//require 'UserInfo.php';

$c_info = new UserInfo;
echo "Seu Ip é: " . $c_info->get_ip();

echo "</br>";
echo "Seu Sistema operacional é: " . $c_info->get_os();

echo "</br>";
echo "Seu Navegador é: " . $c_info->get_browser();

echo "</br>";
echo "Seu Navegador é: " . $c_info->get_device();
