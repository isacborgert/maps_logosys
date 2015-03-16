<?php
$user= 'root';
$pwd= 'thmpv';
$host= 'localhost';
$db = 'isac';
$msg[0] = "<br /><center><b>Conexão com o banco falhou!</b></center>";
$msg[1] = "<br /><center><b>Não foi possível selecionar o banco de dados!</b></center>";
$con = mysql_connect($host,$user,$pwd) or die($msg[0]);
mysql_select_db($db) or die($msg[1]);
?>
