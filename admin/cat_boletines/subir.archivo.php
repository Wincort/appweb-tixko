<?php
error_reporting(0);
date_default_timezone_set('America/Merida');
include_once("../classes/database.php");
include_once("../classes/login.php");
include_once("../script/files.admin.php");

$membership = new Login();
$membership->confirm_Member(); 
$db = new Database();
$db -> connect();

$IdUsuario=$membership->obtenerID();

$estatus="";
$opcion=$_REQUEST["opc"];
$tipo=$_REQUEST['tipo'];
$id=0;
$titulo='';
$contenido='';
$publicar='';
$archivo='';
$FechaPublicacion='';
$HoraPublicacion='';

if($tipo=="IMAGEN") $ruta_files='multimedia/imagen/';

if($opcion=='UPD'){
	$id = intval($_REQUEST['id']);
	$query="SELECT * FROM cat_pagina where id = '$id' limit 1";
 	$resultado=mysql_query($query);
	if(mysql_num_rows($resultado)>0){
		$row = mysql_fetch_array($resultado);
		$titulo= html_entity_decode($row['titulo'], ENT_QUOTES);
		$contenido= html_entity_decode($row['contenido'], ENT_QUOTES);	
		$publicar=html_entity_decode($row['publicar'],ENT_QUOTES);
		$FechaPublicacion=html_entity_decode($row['FechaPublicacion'],ENT_QUOTES);
		$HoraPublicacion=html_entity_decode($row['HoraPublicacion'],ENT_QUOTES);
		$archivo=$row['imagen'];
	}
}
else{
	if($opcion=='SAVE'){
		$id=$_POST["id"];
		$publicar=$_POST["publicar"];
		$titulo= html_entity_decode($_POST['titulo'], ENT_QUOTES);
		$contenido= html_entity_decode($_POST['contenido'], ENT_QUOTES);
		$FechaPublicacion= html_entity_decode($_POST['FechaPublicacion'], ENT_QUOTES);
		$HoraPublicacion= html_entity_decode($_POST['HoraPublicacion'], ENT_QUOTES);												
		$urlfile= $_FILES["archivo"];
		$archivo_valido = true;
		$archivo=$_POST["hiurl"];
		if(!empty($_FILES['archivo']['name'])){
			$tipo_archivo = $_FILES['archivo']['type'];
			if($tipo=="IMAGEN"){
				if (!(strpos($tipo_archivo, "gif")  || 
					  strpos($tipo_archivo, "jpeg") ||
					  strpos($tipo_archivo, "png")
					 )) {
					$archivo_valido = false;
				}				
			}							
		}
		if($archivo_valido){
			if(!empty($_FILES['archivo']['name'])){
				if (uploadFiles($urlfile)){
					$archivo=$ruta_files.$_FILES["archivo"]['name'];
					$db -> begin();
					if($id!=0){
						$Sql="update cat_pagina set 
 								   titulo='$titulo',
 								   contenido='$contenido',publicar='$publicar',
									imagen='$archivo',
									FechaPublicacion='$FechaPublicacion',
									HoraPublicacion='$HoraPublicacion',
								   FUM = NOW(),
								   UUM = '$IdUsuario'
 							 where id='$id'";
						$res = $db -> openTransaction($Sql);
					}									
					if(!$res) 
					{
						$db -> rollback();
						deleteFiles($ruta_files.$_FILES["archivo"]['name']);
						$estatus="ERROR";
					}
					else{
						$db -> commit();
						$estatus="OK";
					}
				}
				else{
					$db -> rollback();
					$estatus="ERROR";
				}
			}
			else{
				$db -> begin();
				if($id!=0){
					$Sql="update cat_pagina set 
 								   titulo='$titulo',
 								   contenido='$contenido',publicar='$publicar',
									imagen='$archivo',
									FechaPublicacion='$FechaPublicacion',
									HoraPublicacion='$HoraPublicacion',
								   FUM = NOW(),
								   UUM = '$IdUsuario'
 							 where id='$id'";
					$res = $db -> openTransaction($Sql);
					$archivo=$_POST["hiurl"];
				}			
				if(!$res) 
				{
					$db -> rollback();
					$estatus="ERROR";
				}
				else{
					$db -> commit();
					$estatus="OK";
				}
			}
		}
		else{
			$estatus="ERROR_ARCHIVO";
		}
	}
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<script language="javascript" src="../script/jquery/jquery-1.4.min.js" type="text/javascript"></script>

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" type="text/css" href="../script/jquery-ui/fcss/ui-lightness/jquery-ui-1.8.2.custom.css" />
	<link rel="stylesheet" href="../script/bootstrap/css/bootstrap.min.css" />
	<link rel="stylesheet" href="../script/jquery-timepicker/jquery.timepicker.css" />
	<script type="text/javascript" src="../script/jquery/jquery-2.1.3.min.js"></script>
	<script type="text/javascript" src="../script/jquery/jquery-1.4.min.js"></script> 
	<script type="text/javascript" src="../script/bootstrap/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="../script/jquery-ui/fjs/jquery-ui-1.8.5.custom.min.js"></script>
    <script type="text/javascript" src="../script/jquery-ui/fjs/jquery-ui.min.js"></script>
	<script type="text/javascript" src="../script/jquery-ui/fjs/jquery.ui.datepicker-es.js"></script>
	<script type="text/javascript" src="../script/jquery-timepicker/jquery.timepicker.js"></script>
	<script type="text/javascript" src="../script/tinymce/js/tinymce/tinymce.min.js"></script>

	<script language="javascript">
		function Guardar(){
			$("#opc").val("SAVE");
			$("#form").submit();
		}
		function ocultaMensaje(){
			try{
				$('#msgContainer').css('display', 'none');
			}
			catch(error){
			}
		}
		$(document).ready(function(){
			$('input[type="text"]').change(ocultaMensaje);
			$('textarea').change(ocultaMensaje);
			$('input[type="checkbox"]').click(ocultaMensaje);
		});
	</script>
	<script>
		$(function(){
			$("#FechaPublicacion").datepicker();
			$('#HoraPublicacion').timepicker({
				timeFormat: 'hh:mm p',
				interval: 1,
				minTime: '0',
				maxTime: '23:59pm',
				//defaultTime: 'now',
				dynamic: false,
				dropdown: true,
				scrollbar: true
			});
		});
	</script>
	<script>
		//Inicializa el editor de texto
		tinymce.init({
			selector: '#contenido',
			language: 'es_MX',
			branding: false,
			menubar: false
		});
	</script>
	<style>
	body{
        font-family:Verdana, Arial, Helvetica, sans-serif;font-size:12px;
    }
	#msgContainer{
		padding-top:10px;padding-bottom:10px;
		text-align:center;font-family:Verdana, Arial, Helvetica, sans-serif;font-size:12px;
		width:100%;
	}
	#msgContainer a{
		text-decoration:none;color:#0066FF;
	}
	div.saved{
		background:#99FF99;border-top:1px solid #339900;border-bottom:1px solid #339900;
	}
	div.error{
		background:#FFCCCC;border-top:1px solid #FF3366;border-bottom:1px solid #FF3366;
	}	
    #form input {
        width:99%; height:35px;border:#CCCCCC solid 1px;
    }
	#form select{
        width:99%; height:35px; border:#CCCCCC solid 1px;
    }
	</style>
</head>
<body>

<form id="form" name="form" action="" method="post" enctype="multipart/form-data">
	<fieldset style="border:#CCCCCC solid 2px; padding:10px;">
	<?php if(isset($estatus) && $estatus == "OK"){ ?>
		<div id="msgContainer" class="saved">Se ha guardado correctamente.<br /></div>
	<?php } if(isset($estatus) && $estatus == "ERROR"){	?>
		<div id="msgContainer" class="error">Ocurrio un error al intentar guardar la informacion. Por favor Intenta de Nuevo.</div>
	<?php } if(isset($estatus) && $estatus == "ERROR_ARCHIVO"){	?>
		<div id="msgContainer" class="error">- El archivo que intentas subir no tiene un formato valido.</div>
	<?php } if(isset($estatus) && $estatus == "ERROR_FOTO_VIDEO"){	?>
	<div id="msgContainer" class="error">* El archivo que intentas subir no tiene un formato valido.</div>
	<?php } ?>
	
    <div id="formulario" class="formulario">
		<!--<div id="anexo" style="margin:2px #090 solid;">
		<?php if (!empty($archivo)){ ?>
			<table>
				<tr>
					<td valign="middle" align="center">
						<img style="border:#090 2px double;" width="40" height="33" src="<?=$archivo;?>" />
					</td>
					<td><?php  echo $archivo ?></td>
				</tr>
			</table>
		<?php } ?>
		</div>-->

		<table width="100%">
			<tr>
				<td colspan="3">
					<label for="txttitulo"><b>Título</b></label><br />
					<input type="text" id="titulo" name="titulo" value='<?=$titulo?>'/>
				</td>
			</tr>
			<tr>
				<td colspan="3"><label for="contenido"><b>Contenido</b></label>
					<!--<input type="text" id="contenido" name="contenido" value='<?=$contenido;?>'/>-->  
					<textarea id="contenido" name="contenido"><?=$contenido;?></textarea>        
				</td>
			</tr>
			<tr colspan="3">
				<td width="20%">
					<label for="publicar"><b>¿Publicar?</b></label><br />   
					<select id="publicar" name="publicar">
						<option value="SI" <?php echo $publicar=='SI' ? 'selected' : ''; ?> >SI</option>
						<option value="NO" <?php echo $publicar=='NO' ? 'selected' : ''; ?> >NO</option>
					</select>
				</td>
				<td width="20%">
					<label for="txtInicio"><b>Fecha Publicación</b></label><br /><input type="text" id="FechaPublicacion" name="FechaPublicacion" value="<?php echo $FechaPublicacion!='' ? $FechaPublicacion : date('Y-m-d'); ?>" />
				</td>
				<td width="20%">
					<label for="txtFin"><b>Hora Publicación</b></label><br /><input type="text" id="HoraPublicacion" name="HoraPublicacion" value="<?php echo $HoraPublicacion!='' ? $HoraPublicacion : date('h:i A');?>" />
				</td>
			</tr>
			<tr>
				<td colspan="1"><label for="imagen"><b>Imagen</b></label>
					<input name="archivo" id="archivo" type="file" size="40" style="border:none;"/>
					<input type="hidden" id="hiurl" name="hiurl" value="<?php echo $archivo ?>"/>
					
				</td>
				<td colspan="2" align="right">
						<div id="anexo" style="margin:2px #090 solid;">
						<?php if (!empty($archivo)){ ?>
							<img style="border:#090 2px double;" width="50%" height="auto" src="<?=$archivo;?>" /><br />
							<b style="font-size:9px;"><?php  echo $archivo ?></b>
						<?php } ?>
						</div>        
					</td>
			</tr>
			
		</table>    


    <input type="hidden" id="tipo" name="tipo" value="<?=$tipo;?>" />
    </div>
	</fieldset>

	<div align="center" style="margin-top:20px;"><input name="guardar" type="button" id="guardar" value="Guardar" onclick="Guardar();" /></div>
    <input type="hidden" id="id" name="id" value="<?php echo $id; ?>" />
    <input type="hidden" id="opc" name="opc" value="" />

</form>
<?php
if(isset($estatus) && $estatus == "OK"){
	echo '<script> parent.recargarGrid();</script> ';
}
?>
<script>parent.progressOff(false);</script>
</body>
</html>