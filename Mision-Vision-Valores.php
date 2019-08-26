<?php
include_once('admin/classes/BO.php');
$oWEB = new PaginaWEB();
$ListaMVV=$oWEB->TraerMVV();
$Mision=$ListaMVV[0]['mision'];
$Vision=$ListaMVV[0]['vision'];
$Valores=$ListaMVV[0]['valores'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Misión-Visión-Valores</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="lib/bootstrap/3.3.7/css/bootstrap.min.css">
  
  <script src="js/jquery/3.4.1/jquery.min.js"></script>
  <script src="lib/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  
  <link rel="stylesheet" href="css/Fuentes.css">
  <link rel="stylesheet" href="css/Navegador-Footer.css">
  <link rel="stylesheet" href="css/Mision-Vision-Valores.css">

</head>
<body>

<?php include("Navegador.php"); ?>

<div class="Header-Bkg"></div>

<div class="container-fluid">   
    <div class="row">
        <div id="Mision" class="col-sm-4 col-xs-12 Ficha">
            <div class="Icono-Bkg Icono-Bkg-Mision"><div class="IconoMision"></div></div>
            <div class="Subtitulo">
                <h1>MISIÓN</h1>
            </div>
            <div class="Contenido">
            <?=$Mision;?>    
            </div>
            <div class="linea"></div>
        </div>
        
        <div id="Vision" class="col-sm-4 col-xs-12 Ficha">
            <div class="Icono-Bkg Icono-Bkg-Vision"><div class="IconoVision"></div></div>
            <div class="Subtitulo">
                <h1>VISIÓN</h1>
            </div>
            <div class="Contenido">
            <?=$Vision;?>    
            </div>
            <div class="linea"></div>
        </div>
        <div id="Valores" class="col-sm-4 col-xs-12 Ficha">
            <div class="Icono-Bkg Icono-Bkg-Valores"><div class="IconoValores"></div></div>
            <div class="Subtitulo">
                <h1>VALORES</h1>
            </div>
            <div class="Contenido">
            <?=$Valores;?>    
            </div>
            <div class="linea"></div>
        </div>
    </div>
</div>

<?php include("Footer.php"); ?>

<script>

    function AjustarAlturaDeFichas() {
        $(".Ficha").height("auto");
        let MaximaAltura = 0;
        $(".Ficha").each(function(index) {
            let AlturaFicha = $(this).height();
            MaximaAltura = (AlturaFicha > MaximaAltura) ? AlturaFicha : MaximaAltura;
        });
        $(".Ficha").height(MaximaAltura);
    }
    $(document).ready(function() {
        AjustarAlturaDeFichas();
        $(window).resize(function() {
            AjustarAlturaDeFichas();
        }).resize();
    });
</script>

</body>
</html>
