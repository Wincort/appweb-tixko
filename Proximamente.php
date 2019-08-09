<?php
include_once('admin/classes/BO.php');
$oWEB = new PaginaWEB();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Inicio</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="lib/bootstrap/3.3.7/css/bootstrap.min.css">
  
  <script src="js/jquery/3.4.1/jquery.min.js"></script>
  <script src="lib/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  
  <link rel="stylesheet" href="css/Fuentes.css">
  <link rel="stylesheet" href="css/Navegador-Footer.css">
  <link rel="stylesheet" href="css/Inicio.css">
  <style>
		#MensajeInicio{
			font-family: Soberana Sans Bold;
            text-align: center;
            color:#327522;
		}
	
		.container{
            height:100vh;
            transform: translateY(15vh);
        }
    </style>

</head>
<body>

<?php include("Navegador.php"); ?>

<div class="container">

<h1 id="MensajeInicio">¡Página en construcción!<br><br>El contenido de esta sección se encontrará disponible próximamente</h1>
</div>

<?php include("Footer.php"); ?>

</body>
</html>
