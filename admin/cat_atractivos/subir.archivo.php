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
$contenido='';
$nombre='';
$publicar='';
$archivo='';$NombreArchivoSaneado='';

if($tipo=="IMAGEN") $ruta_files='multimedia/imagen/';

if($opcion=='UPD'){
	$id = intval($_REQUEST['id']);
	$query="SELECT * FROM cat_atractivos where id = '$id' limit 1";
 	$resultado=mysql_query($query);
	if(mysql_num_rows($resultado)>0){
		$row = mysql_fetch_array($resultado);
		$nombre= html_entity_decode($row['nombre'], ENT_QUOTES);	
		$contenido= html_entity_decode($row['contenido'], ENT_QUOTES);	
		$publicar=html_entity_decode($row['publicar'],ENT_QUOTES);
		$archivo=$row['imagen'];
	}
}
else{
	if($opcion=='SAVE'){
		$id=$_POST["id"];
		$publicar=$_POST["publicar"];
		$contenido= html_entity_decode($_POST['contenido'], ENT_QUOTES);
		$nombre= html_entity_decode($_POST['nombre'], ENT_QUOTES);
												
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
				$NombreArchivoSaneado=friendly_url($_FILES['archivo']['name']);
				if (uploadFileWithNewName($urlfile,$NombreArchivoSaneado)){
					$archivo=$NombreArchivoSaneado;
					$db -> begin();
					if($id!=0){
						$Sql="update cat_atractivos set 
								   nombre='$nombre',
								   contenido='$contenido',
								   publicar='$publicar',
								   imagen='$archivo',
								   FUM = NOW(),
								   UUM = '$IdUsuario'
 							 where id='$id'";
						$res = $db -> openTransaction($Sql);
						$OldArchivo=$_POST["hiurl"];
						deleteFiles($ruta_files.$OldArchivo);
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
					$Sql="update cat_atractivos set 
									nombre='$nombre',
									contenido='$contenido',
									publicar='$publicar',
									imagen='$archivo',
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
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" href="../script/bootstrap/css/bootstrap.min.css" />
	<script type="text/javascript" src="../script/jquery/jquery-2.1.3.min.js"></script>
	<script type="text/javascript" src="../script/bootstrap/js/bootstrap.min.js"></script>

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
    #form input,#form select {
        width:100%; height:35px;border:#CCCCCC solid 1px;
    }
	textarea{
        border:#CCCCCC solid 1px;
	}
	td{
		padding: 0.2rem !important;
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
		<table width="100%">
			<tr colspan="2">
				<td colspan="2">
					<label for="nombre">Nombre</label>
					<br /><input type="text" id="nombre" name="nombre" value="<?=$nombre?>" />
				</td>
			</tr>
			<tr>
				<td width="50%" colspan="1"><label for="imagen"><b>Imagen</b></label>
					<input name="archivo" id="archivo" type="file" size="40" style="border:none;"/>
					<input type="hidden" id="hiurl" name="hiurl" value="<?php echo $archivo ?>"/>
					
				</td>
				<td width="50%" colspan="1" align="right">
					<div id="anexo" style="margin:2px #090 solid;">
					<?php if (!empty($archivo)){ ?>
						<img style="border:#090 2px double;" width="30%" height="auto" src="<?=$ruta_files.$archivo;?>" alt="Sin imagen" /><br />
						<b style="font-size:9px;"><?php  echo $archivo ?></b>
					<?php } ?>
					</div>        
				</td>
			</tr>
			
			<tr colspan="2">
				<td colspan="2" ><label for="contenido"><b>Información</b></label><br />
					<textarea  style="width:100%;" id="contenido" name="contenido" rows=4><?=$contenido;?></textarea>        
				</td>
			</tr>
			<tr colspan="2">
				<td width="20%">
					<label for="publicar"><b>¿Publicar?</b></label><br />   
					<select id="publicar" name="publicar">
						<option value="SI" <?php echo $publicar=='SI' ? 'selected' : ''; ?> >SI</option>
						<option value="NO" <?php echo $publicar=='NO' ? 'selected' : ''; ?> >NO</option>
					</select>
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