<?php
error_reporting(0);
include_once("../classes/database.php");
include_once("../classes/login.php");

$membership = new Login();
$membership->confirm_Member(); 
$IdUsuario=$membership->obtenerID();

include_once("../script/files.admin.php");

$db = new Database();
$db -> connect();

$opcion=$_REQUEST["opc"];
$id=0;
$titulo='';
$publicar='';
$archivo='';$NombreArchivoSaneado='';
$IdRegistro=intval($_REQUEST['not']);
$tipo=$_REQUEST['tipo'];
$mes=$_REQUEST['mes'];

if($tipo=="AUDIO")  $ruta_files='multimedia/audio/';
if($tipo=="IMAGEN") $ruta_files='multimedia/imagen/';
if($tipo=="VIDEO")  $ruta_files='multimedia/video/';
if($tipo=="DOCTO")  $ruta_files='multimedia/doctos/';

$MaximaCarga=ini_get('upload_max_filesize').'B';

if($opcion=='UPD'){
	$id = intval($_GET['id']);
	$query="SELECT * FROM cat_transparencia_detalles where IdRegistroDetalle = '$id' limit 1";
	$resultado=mysql_query($query);
	
	if(mysql_num_rows($resultado)>0){
		$row = mysql_fetch_array($resultado);
		$titulo= html_entity_decode($row['titulo'], ENT_QUOTES);					
		$publicar=html_entity_decode($row['publicar'],ENT_QUOTES);
		$archivo=$row['archivo'];
		$mes=$row['mes'];
	}
}
else{
	if($opcion=='SAVE'){
		$id=$_POST["id"];
		$titulo= htmlentities($_POST["titulo"], ENT_QUOTES);
		$publicar='NO';
		if ($_POST["publicar"]=='on'){
			$publicar='SI';
		}
		$mes=$_POST["mes"];
		$urlfile=$_FILES["archivo"];
		$archivo_valido = true;
		$archivo=$_POST["hiurl"];
		if(!empty($_FILES['archivo']['name'])){
			$tipo_archivo = $_FILES['archivo']['type'];
			if($tipo=="AUDIO"){
				if (!(strpos($tipo_archivo, "mpeg") || 
					  strpos($tipo_archivo, "mp3")
					)) {
					$archivo_valido = false;
				}
			}
			if($tipo=="IMAGEN"){
				if (!(strpos($tipo_archivo, "gif")  || 
					  strpos($tipo_archivo, "jpeg") ||
					  strpos($tipo_archivo, "png")
					 )) {
					$archivo_valido = false;
				}				
			}
			if($tipo=="VIDEO"){
				if (!(strpos($tipo_archivo, "flv")  ||
					  strpos($tipo_archivo, "mp4") || 
					  strpos($tipo_archivo, "mov")
					 )) {
					$archivo_valido = false;
				}				
			}
			if($tipo=="DOCTO"){
				if (!(strpos($tipo_archivo, "pdf"))) {
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
						$Sql="update cat_transparencia_detalles 
								   set titulo='$titulo',
								   publicar='$publicar',
								   archivo='$archivo',
								   tipo='$tipo',
								   FUM=Now(),
								   UUM=$IdUsuario,
								   mes=$mes
							 where IdRegistroDetalle='$id'";
						$res = $db -> openTransaction($Sql);
						$OldArchivo=$_POST["hiurl"];
						deleteFiles($ruta_files.$OldArchivo);
					}
					else{
						$Sql="insert into cat_transparencia_detalles 
									(titulo,publicar, archivo,FC,IdRegistro,tipo,FUM,UC,UUM,mes)
							  values('$titulo', '$publicar', '$archivo', Now(),'$IdRegistro','$tipo',Now(),$IdUsuario,$IdUsuario,$mes)";
						$res = $db -> openTransaction($Sql);
						$id=mysql_insert_id();
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
					$Sql="update cat_transparencia_detalles 
							   set titulo='$titulo',
							   publicar='$publicar',
							   FUM=Now(),
							   UUM=$IdUsuario,
							   mes=$mes
						 where IdRegistroDetalle='$id'";
					$res = $db -> openTransaction($Sql);
					$archivo=$_POST["hiurl"];
				}
				else{
					$Sql="insert into cat_transparencia_detalles 
								(titulo, publicar, archivo, FC, tipo,FUM,UC,UUM,IdRegistro,mes)
						  values('$titulo', '$publicar', '$archivo', Now(), '$tipo',Now(),$IdUsuario,$IdUsuario,$IdRegistro,$mes)";
					$res = $db -> openTransaction($Sql);
					$id=mysql_insert_id();
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
<script language="javascript">
	function admRegistro(){
		var msgError = "";
		if($("#id").val() == '0'){
			if($("#filefoto").val() == ''){
				msgError = msgError+"- Imagen\n";
			}		
		}
		if(msgError != ""){
			alert("Por favor, escriba información en los siguientes campos:\n"+msgError);
			return false;
		}
		$("#opc").val("SAVE");
		$("#form").submit();
	}
	function ocultaMensaje(){
		try{
			$('#msgContainer').css('visibility','hidden');
		}
		catch(error){
		}
	}
	$(document).ready(function(){
		$('input[type="text"]').change(ocultaMensaje);
		$('textarea').change(ocultaMensaje);
		$('input[type="checkbox"]').click(ocultaMensaje);
	});

	function cleanFormulario(){
		document.getElementById("titulo").value = '';
		document.getElementById("id").value = 0;
		document.getElementById("publicar").checked = false;
		document.getElementById("anexo").style.display = 'none';
		document.getElementById("mes").value = 0;
		ocultaMensaje();
	}
</script>


<style>
	#msgContainer{
		padding-top:10px;
		padding-bottom:10px;
		text-align:center;
		font-family:Verdana, Arial, Helvetica, sans-serif;
		font-size:12px;
		width:360px;
	}
	#msgContainer a{
		text-decoration:none;
		color:#0066FF;
	}

	div.saved{
		background:#99FF99;
		border-top:1px solid #339900;
		border-bottom:1px solid #339900;
	}
	div.error{
		background:#FFCCCC;
		border-top:1px solid #FF3366;
		border-bottom:1px solid #FF3366;
	}
	table#tblImagenes{
		border:none;
		width:98%;
	}
	.photo_layout{
		margin:4px;
		padding:4px;
		border:1px solid #CCCCCC;
		background:#FFFFFF;
		text-align:center;
	}
	.photo_layout img{
		width:140px;
		height:90px;
	}
	.aciones{
		margin-left:4px;
		margin-right:4px;
	}
	div#postit {
		background-color:#FFFF99;
		padding:10px;
		margin-right:30px;
		margin-top:10px;
		position:absolute;
		right:0;
		text-align:justify;
		width:174px;
		font-size:14px;
		/*font-weight:bold;*/
		font-style:italic;
		border:1px solid #FFCC33;
	}
    #form input[type=text], #form select{
        width:350px;height:25px;
        border:#CCCCCC solid 1px;
    }
    #form textarea{
        width:350px;
        height:40px;
    }
	body{font-family:sans-serif;}

</style>
</head>
<body>

<form id="form" name="form" action="" method="post" enctype="multipart/form-data">
	
	<div id="postit">
		Los archivos permitidos para carga son los siguientes:<br/><b>
		<?php if($tipo=="IMAGEN"){?> PNG, JPG, GIF	<?php }?>
		<?php if($tipo=="DOCTO"){?> PDF <?php }?>
		<?php if($tipo=="AUDIO"){?> MP3	<?php }?>
		<?php if($tipo=="VIDEO"){?>	MP4 <?php }?>
		</b>
		<br><br><!--Tipo de Archivo:<?=$tipo?>-->
		<br>El tamaño del archivo debe ser menor a <b><?=$MaximaCarga?></b>
	</div>
	
	<fieldset style="margin-top:20px; border:#CCCCCC solid 2px; padding:10px;">
	<?php if(isset($estatus) && $estatus == "OK"){ ?>
    <script>parent.parent.actualizaGaleria();</script>
	<div id="msgContainer" class="saved">
		Se ha guardado correctamente la informaci&oacute;n. <br />
		<a href="#" onclick="parent.parent.actualizaGaleria();">Ver lista Actualizada</a>,&nbsp;<a href="#" onclick="cleanFormulario();">Agregar Nuevo Archivo.</a></div>
	<?php }
	   if(isset($estatus) && $estatus == "ERROR"){	?>
		<div id="msgContainer" class="error">Ocurrio un error al intentar guardar la informacion. Por favor Intenta de Nuevo.</div>
	<?php } 
	   if(isset($estatus) && $estatus == "ERROR_ARCHIVO"){	?>
		<div id="msgContainer" class="error">- El archivo que intentas subir no tiene un formato valido!</div>
	<?php } 
	   if(isset($estatus) && $estatus == "ERROR_FOTO_VIDEO"){	?>
	<div id="msgContainer" class="error">* El archivo que intentas subir no tiene un formato valido.</div>
	<?php } ?>
	<dl>
		<dt><label for="titulo"> T&iacute;tulo:</label></dt>
		<dt><input type="text" name="titulo" id="titulo" value="<?=$titulo; ?>" /></dt>
	</dl>
  
        
            <div id="anexo" style="margin:2px #090 solid;">
 <?php if (!empty($archivo)){ ?>
<table><tr>
<td valign="middle" align="center"><img style="border:#090 2px double;" width="40" height="33" 
	<?php if($tipo=="IMAGEN"){?>src="<?=$ruta_files;?><?=$archivo;?>"<?php }?>
	<?php if($tipo=="DOCTO"){?>src="../imagen/pdf.png"<?php }?>
	<?php if($tipo=="AUDIO"){?>src="../imagen/mp3.png"<?php }?>
	<?php if($tipo=="VIDEO"){?>src="../imagen/mp4.png"<?php }?>
	/>

</td>
<td><?php  echo $archivo ?></td></tr></table>
<!--[<a href="< ?php echo $ruta_files.$archivo ?>" target="_blank">Ver Archivo</a>]multimedia/imagen/--><?php } ?></div>

	<dl>
		<dt><label for="imagen">* Archivo:</label></dt>
	  	<dt><input name="archivo" id="archivo" type="file" size="40" />
	  	    <input type="hidden" id="hiurl" name="hiurl" value="<?php echo $archivo ?>"  />
		</dt>
	</dl>
	
	<dl>
		<dt><label for="imagen">Mes:</label></dt>
	  	<dt>
			<select id="mes" name="mes">
				<option value="0" <?php echo $mes=='0' ? 'selected' : ''; ?> >Sin mes</option>
				<option value="1" <?php echo $mes=='1' ? 'selected' : ''; ?> >Enero</option>
				<option value="2" <?php echo $mes=='2' ? 'selected' : ''; ?> >Febrero</option>
				<option value="3" <?php echo $mes=='3' ? 'selected' : ''; ?> >Marzo</option>
				<option value="4" <?php echo $mes=='4' ? 'selected' : ''; ?> >Abril</option>
				<option value="5" <?php echo $mes=='5' ? 'selected' : ''; ?> >Mayo</option>
				<option value="6" <?php echo $mes=='6' ? 'selected' : ''; ?> >Junio</option>
				<option value="7" <?php echo $mes=='7' ? 'selected' : ''; ?> >Julio</option>
				<option value="8" <?php echo $mes=='8' ? 'selected' : ''; ?> >Agosto</option>	
				<option value="9" <?php echo $mes=='9' ? 'selected' : ''; ?> >Septiembre</option>
				<option value="10" <?php echo $mes=='10' ? 'selected' : ''; ?> >Octubre</option>
				<option value="11" <?php echo $mes=='11' ? 'selected' : ''; ?> >Noviembre</option>
				<option value="12" <?php echo $mes=='12' ? 'selected' : ''; ?> >Diciembre</option>					
			</select>
		</dt>
	</dl>
    
    

    
	<dl>
		<dt><input name="publicar" id="publicar" type="checkbox" <?php if ($publicar=="SI") { echo 'checked="checked"'; } ?>/><label for="publicar">Publicar:</label></dt>
	</dl>
	</fieldset>
	<div align="center" style="margin-top:20px;"><input name="guardar" type="button" id="guardar" value="Guardar" onclick="admRegistro();" /></div>
	<input type="hidden" id="id" name="id" value="<?=$id; ?>" />
    <input type="hidden" id="tipo" name="tipo" value="<?=$tipo; ?>" />
    <input type="hidden" id="not" name="not" value="<?=$IdRegistro; ?>" />
	<input type="hidden" id="opc" name="opc" value="" />
</form>
</body>
</html>

	
