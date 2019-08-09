<?php
	require("../../codebase/connector/grid_connector.php");
	require("../../classes/conectando.php");
	
	$conn = new GridConnector($res,"MySQL");
	$conn->render_table("admin_usuario","id_usuario","nombre,primer_apellido,login,contrasena,email,telefono,estatus");
?>