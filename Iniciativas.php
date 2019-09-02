<?php
include_once('admin/classes/BO.php');
$oWEB = new PaginaWEB();

include_once('admin/contadorweb.php');
$page_name="Iniciativas Sociales";
visitante($page_name);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Iniciativas Sociales</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="lib/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/Fuentes.css">
  <link rel="stylesheet" href="css/Navegador-Footer.css">
  <link rel="stylesheet" href="css/Iniciativas.css">
  <!-- Metro Notification Style -->
  <link rel="stylesheet" type="text/css" href="lib/metro-notifications/static/css/MetroNotificationStyle.min.css">
  <!-- Font Awesome v4.2 -->
  <link rel="stylesheet" type="text/css" href="lib/font-awesome/css/font-awesome.min.css">

</head>
<body>

<?php include("Navegador.php"); ?>
     
<div class="container-fluid" style="MARGIN-TOP: 2REM;">          
    <div class="row">
        <div class="col-sm-6 col-xs-12 img-contacto"></div>
        <div class="col-sm-6 col-xs-12 form-contacto">
             
            <form id='formulario' method='post' action='' target='_self' onsubmit="return false;" enctype="multipart/form-data" autocomplete="off">                
                 
                    <div class="row">
                        <div>
                            <input id="opc" name="opc" type="hidden" value="GuardarIniciativa">
                        </div>
                        <div class="col-sm-6 ColFormulario">
                            <input id="nombre" name="nombre" type="text" class="form-control requerido" placeholder="NOMBRE">
                        </div>
                        <div class="col-sm-6 ColFormulario">
                            <input id="apellido" name="apellido" type="text" class="form-control requerido" placeholder="APELLIDO">
                        </div>
                    </div>	
                    <div class="row">
                        <div class="col-sm-6 ColFormulario">
                            <input id="correo" name="correo" type="email" class="form-control requerido" onblur="validaMail(this.value, this.id);return false;" placeholder="EMAIL">
                        </div>
                        <div class="col-sm-6 ColFormulario">
                            <input id="telefono" name="telefono" type="text" class="form-control" onkeypress="return isNumberKey(event);" onblur="validaLongitud(this.id,10);return false;" maxlength="10" placeholder="TELÉFONO">
                        </div>
                    </div>	
                    <div class="row">	
                        <div class="col-sm-12 ColFormulario">
                            <input id="NombreIniciativa" name="NombreIniciativa" type="text" class="form-control requerido" placeholder="NOMBRE DE SU INICIATIVA SOCIAL">
                        </div>
                        <div class="col-sm-12 ColFormulario">
                            <textarea id="Iniciativa" name="Iniciativa" class="form-control requerido" rows="3" placeholder="DESCRIBA BREVEMENTE SU PROPUESTA "></textarea>
                        </div>
                        <div class="col-sm-12 ColFormulario">
                            <textarea id="Beneficios" name="Beneficios" class="form-control requerido" rows="3" placeholder="EXPLIQUE LOS BENEFICIOS DE IMPLEMENTAR SU PROPUESTA"></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 DivGuardar">
                            <button type="submit" id="enviarcorreo" onclick="ValidarFormulario();return false;" class="btn btn-success">ENVIAR</button>
                        </div>
                    </div>
            </form>

        </div>
    </div>
</div>

<?php include("Footer.php"); ?>

<script src="js/jquery/3.4.1/jquery.min.js"></script>
<script src="lib/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="lib/metro-notifications/static/js/MetroNotification.min.js"></script>
<script type="text/javascript" src="js/Notificaciones.js"></script>  
<script type="text/javascript" src="js/ValidarDatos.js"></script>
<script type="text/javascript" src="js/ProcesarMensajes.js"></script>   
<script>

    $(document).ready(function() {
        $(window).resize(function() {
            AjustarAltura();
        }).resize();
    });

    function AjustarAltura() {
        $(".img-contacto").height("auto");
        let MaximaAltura = 0;
        MaximaAltura = $(".form-contacto").outerHeight();
        $(".img-contacto").height(MaximaAltura);
    }

</script>
</body>
</html>
