<?php
error_reporting(0);
include_once('admin/classes/BO.php');
$oWEB = new PaginaWEB();
$IdTramite=$_REQUEST['id'];
$Tramite = $oWEB->TraerTramite($IdTramite);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>H. Ayuntamiento de Tixkokob</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="lib/bootstrap/3.3.7/css/bootstrap.min.css">
  
  <script src="js/jquery/3.4.1/jquery.min.js"></script>
  <script src="lib/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  
  <link rel="stylesheet" href="css/Fuentes.css">
  <link rel="stylesheet" href="css/Navegador-Footer.css">
  <link rel="stylesheet" href="css/Tramite.css">

</head>
<body>

<?php include("Navegador.php"); ?>

<div id="BodyTramite"></div>

<?php include("Footer.php"); ?>

<script type="text/javascript">
    const ArrayTramite = <?php echo json_encode($Tramite) ?>;
    let ExisteResultado=true;
    let StringHTML="";

    if(ArrayTramite[0]==undefined) ExisteResultado=false;

    $(document).ready(function() {
		GenerarContenido(ExisteResultado);
    });

    let GenerarContenido = (ExisteResultado) => {
        if(ExisteResultado){
            let {id, nombre, responsable:resp,descripcion:des, requisitos:req, presentacion:pres, tiempo, horario, costo, fundamento:fund, contacto, modulo}=ArrayTramite[0];
    
            nombre=nombre!=""?nombre:"N/A";
            resp=resp!=""?resp:"N/A";
            des=des!=""?des:"N/A";
            req=req!=""?req:"N/A";
            pres=pres!=""?pres:"N/A";
            tiempo=tiempo!=""?tiempo:"N/A";
            horario=horario!=""?horario:"N/A";
            costo=costo!=""?costo:"N/A";
            fund=fund!=""?fund:"N/A";
            contacto=contacto!=""?contacto:"N/A";
            modulo=modulo!=""?modulo:"N/A";
    
            StringHTML=`
            <div class="container">   
                <div class="row">
                    <div class="col-sm-12">
                        <div class="Titulo">
                            <h2>${nombre}</h2>          
                        </div>
                        <div class="Contenido">
                            <h3 class="Subtitulo">Área responsable</h3><h4>${resp}</h4>
                            <h3 class="Subtitulo">Descripción (casos en los que debe o puede realizarse)</h3><h4>${des}</h4>
                            <h3 class="Subtitulo">Requisitos</h3><h4>${req}</h4>
                            <h3 class="Subtitulo">Forma de presentarse</h3><h4>${pres}</h4>
                            <h3 class="Subtitulo">Tiempo de respuesta</h3><h4>${tiempo}</h4>
                            <h3 class="Subtitulo">Horario de atención</h3><h4>${horario}</h4>
                            <h3 class="Subtitulo">Costo</h3><h4>${costo}</h4>
                            <h3 class="Subtitulo">Fundamento jurídico</h3><h4>${fund}</h4>
                            <h3 class="Subtitulo">Información de contacto</h3><h4>${contacto}</h4>
                            <h3 class="Subtitulo">Módulo en el que puede realizarse</h3><h4>${modulo}</h4>
                        </div>
                    </div>
                </div>
            </div>`;
        }
        else{
            StringHTML=`
            <div class="container errorContenido">   
                <div class="row">
                    <div class="col-sm-12">
                        <div class="Titulo">
                            <h1>Trámite/Servicio Inválido</h1>          
                        </div>
                    </div>
                </div>
            </div>`;
        }
        $(StringHTML).appendTo(`#BodyTramite`);
    }

    function decode_utf8(s) { 
		return decodeURIComponent(escape(s)); 
	}
</script>
</body>
</html>
