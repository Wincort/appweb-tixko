<?php
	require("../../codebase/connector/grid_connector.php");
	require("../../classes/conectando.php");
	
	$conn = new GridConnector($res,"MySQL");
	$conn->render_table("cat_atractivos","id","nombre,imagen,publicar");
?>