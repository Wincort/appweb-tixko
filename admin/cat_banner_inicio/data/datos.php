<?php
	require("../../codebase/connector/grid_connector.php");
	require("../../classes/conectando.php");
	
	$conn = new GridConnector($res,"MySQL");
	$conn->render_table("cat_banner_inicio","id","imagen,publicar");
?>