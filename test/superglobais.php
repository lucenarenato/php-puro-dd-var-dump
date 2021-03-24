<?php
$tipo_conexao = $_SERVER['HTTP_HOST'];
 
if (($tipo_conexao == 'localhost') || ($tipo_conexao == '127.0.0.1')){
	// para uso local
	$hostname = 'localhost';
	$username = 'informe_o_usuario_local';
	$password = 'informe_a_senha_local';
	$database = 'nome_da_basededados_local';
}else{
	// para uso externo
	$hostname = 'dbxxxx.whservidor.com'; // ex: servidor com hospedagem no uolhost
	$username = 'informe_o_usuario_externo';
	$password = 'informe_a_senha_externo';
	$database = 'nome_da_basededados_externo';
}
 
$link = mysql_connect($hostname, $username, $password);
if (!$link) {
    die('Erro na conexão: ' . mysql_error());
}
 
if (! mysql_select_db($database) ) {
    die ('Não é possível acessar o bando de dados : ' . mysql_error());
}
