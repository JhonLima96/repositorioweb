<?php
//evitar a mensagem de erro de "DEPRECATED"
error_reporting (E_ALL & ~ E_NOTICE & ~ E_DEPRECATED);

//CRIAÇAO DAS VARIAVEIS DO BANCO DE DADOS
$host = "localhost";
$db = "produtos";
$user = "admin";
$pass = "admin";

// conecta ao banco de dados
$con = mysql_pconnect($host, $user, $pass) or trigger_error(mysql_error(),E_USER_ERROR);

// seleciona a base de dados em que vamos trabalhar
mysql_select_db($db, $con);

?>
