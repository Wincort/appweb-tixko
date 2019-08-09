<?php 
include_once("../classes/database.php");
include_once("../classes/login.php");
$membership = new Login();
$membership->confirm_Member(); 

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<link rel="stylesheet" type="text/css" href="../css/noticias.css" />

<script type="text/javascript" src="../script/jquery/jquery-2.1.3.min.js"></script> 

<!--<script type="text/javascript" src="../script/jquery/jquery.json.js"></script>
<script type="text/javascript" src="../script/funciones.js"></script>-->

<script type="text/javascript">var GB_ROOT_DIR = "../script/greybox/";</script>
<script type="text/javascript" src="../script/greybox/AJS.js"></script>
<script type="text/javascript" src="../script/greybox/AJS_fx.js"></script>
<script type="text/javascript" src="../script/greybox/gb_scripts.js"></script>
<link href="../script/greybox/gb_styles.css" rel="stylesheet" type="text/css" />

<script type="text/javascript">
$(document).ready(function() {
	cargaInformacion();
});

function cargaInformacion(){
	$("#lyfgral").load("pagina.listado.php?t=tb&rnd="+Math.random());
}
function recargaInformacion(){
	cargaInformacion();
	GB_hide();
}
</script>
</head>
<body>
	<div id="contenido">
		<div class="box">
		  <div class="left"></div>
		  <div class="right"></div>
		  <div class="heading">
		  <h1>Transparencia</h1></div>
         
		  <div class="content">
            <style>
            .fila_par{
                background-color:#FFFFFF;
            }
            .fila_impar{
                background-color:#E5E5E5;
            }
            .new_row{
                background:#FFFFCC;
            }
            .tabla_encabezado {
                background-color:#D1D1D1;
                color:#000000;
                font-family:'Arial';
                font-size:11px;
                font-weight:bold;
            }
            
            #modTitle{
                font-family:Verdana, Arial, Helvetica, sans-serif; 
                font-weight:bold;
            }
            
            #GB_frame {
            vertical-align:middle;
            }
            </style>	
            <div id="lysi" name="lysi" style="margin-top:5px; margin-bottom:20px;" width="98%">
                <div id="toolsContainer">
                    <table style="width:100%;">
                        <tr>
                            <td width="550px;"></td>
                            <td align="right"><a href="pagina.formulario.php" onclick="return GB_showCenter('Nuevo', this.href, 450, 550);">Agregar Nueva Entrada</a></td>
                        </tr>
                    </table>
                </div>
                <div id="lyfgral"></div>
            </div>          
          </div>
		</div>
	</div>
</body>
</html>