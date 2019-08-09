<?php
include_once("config.php");
// Conectando, seleccionando la base de datos
$res = mysql_connect(SERVIDOR_HOST,USUARIO_BD,PASSWORD_BD) or die('No se pudo conectar: ' . mysql_error());
echo 'Connected successfully';
mysql_select_db(BASE_DE_DATOS) or die('No se pudo seleccionar la base de datos');

?>