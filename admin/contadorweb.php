<?php

include_once("classes/config.php");

function visitante($record) {
    $db_host = SERVIDOR_HOST;
    $db_username = USUARIO_BD ; 
    $db_password = PASSWORD_BD;
    $db_name = BASE_DE_DATOS;
    $db_table = "cat_visitas";
    $counter_page = "access_page";
    $counter_field = "access_counter";
    $db = mysqli_connect ($db_host, $db_username, $db_password, $db_name) or die("Host o base de datos no disponible");
    $sql_call = "INSERT INTO ".$db_table." (".$counter_page.", ".$counter_field.") VALUES ('".$record."', 1) ON DUPLICATE KEY UPDATE ".$counter_field." = ".$counter_field." + 1"; 
    mysqli_query($db, $sql_call) or die("Error al introducir los datos");
    mysqli_close($db);

  }
?>