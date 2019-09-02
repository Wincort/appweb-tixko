<?php
include_once('admin/classes/BO.php');
$oWEB = new PaginaWEB();
$ListaHistoria=$oWEB->TraerHistoria();
$Historia=$ListaHistoria[0]['historia'];

include_once('admin/contadorweb.php');
$page_name="Historia";
visitante($page_name);

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Historia</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="lib/bootstrap/3.3.7/css/bootstrap.min.css">
  
  <script src="js/jquery/3.4.1/jquery.min.js"></script>
  <script src="lib/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  
  <link rel="stylesheet" href="css/Fuentes.css">
  <link rel="stylesheet" href="css/Navegador-Footer.css">
  <link rel="stylesheet" href="css/Historia.css">

</head>
<body>

<?php include("Navegador.php"); ?>

<div class="Header-Bkg"></div>
<h1 id="Titulo">HISTORIA</h1>
<div class="container">   
    <div class="row">
        <div class="col-sm-12">
            <div class="Subtitulo">
                <h2>RESEÑA HISTÓRICA</h2>
            </div>
            <div class="Contenido">
                <h3>
                <?=$Historia;?> 
                </h3>
            </div>
        </div>
    </div>
</div>

<?php include("Footer.php"); ?>

</body>
</html>
