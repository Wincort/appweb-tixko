<?php
error_reporting(0);
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
$nombre='';
$puesto='';
$publicar='';
$archivo='';$NombreArchivoSaneado='';
$orden='';
$email='';

if($tipo=="IMAGEN") $ruta_files='multimedia/imagen/';

$queryOrden="SELECT * FROM cat_cabildo";
$resultOrden=mysql_query($queryOrden);
$CantidadRegistros=mysql_num_rows($resultOrden);

if($opcion=='UPD'){
	$id = intval($_REQUEST['id']);
	$query="SELECT * FROM cat_cabildo where Id = '$id' limit 1";
 	$resultado=mysql_query($query);
	if(mysql_num_rows($resultado)>0){
		$row = mysql_fetch_array($resultado);
		$nombre= html_entity_decode($row['nombre'], ENT_QUOTES);
		$puesto= html_entity_decode($row['puesto'], ENT_QUOTES);	
		$publicar=html_entity_decode($row['publicar'],ENT_QUOTES);
		$orden= $row['orden']==0?$CantidadRegistros:$row['orden'];
		$email= html_entity_decode($row['email'], ENT_QUOTES);	
		$archivo=$row['archivo'];
	}
}
else{
	if($opcion=='SAVE'){
		$id=$_POST["id"];
		$publicar=$_POST["publicar"];
		$nombre= html_entity_decode($_POST['nombre'], ENT_QUOTES);
		$puesto= html_entity_decode($_POST['puesto'], ENT_QUOTES);
		$orden= $_POST['orden'];
		$email= html_entity_decode($_POST['email'], ENT_QUOTES);
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
						$Sql="update cat_cabildo set 
 								   nombre='$nombre',
 								   puesto='$puesto',publicar='$publicar',
									archivo='$archivo',
									orden='$orden',
									email='$email',
								   FUM = NOW(),
								   UM = '$IdUsuario'
 							 where Id='$id'";
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
					$Sql="update cat_cabildo set 
 								   nombre='$nombre',
 								   puesto='$puesto',publicar='$publicar',
									archivo='$archivo',
									orden='$orden',
									email='$email',
								   FUM = NOW(),
								   UM = '$IdUsuario'
 							 where Id='$id'";
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
	<script type="text/javascript" src="../script/jquery/jquery-2.1.3.min.js"></script> 
	<link rel="stylesheet" href="../script/bootstrap/css/bootstrap.min.css" />
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
        width:99%; height:35px;border:#CCCCCC solid 1px;padding: 1rem;;
    }
	/*#form select{
        width:99%; height:35px; border:#CCCCCC solid 1px;
	}*/
	td{
    	padding: 0.3rem;
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
		<!-- <div id="anexo" style="margin:2px #090 solid;">
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
		</div> -->

		<table width="100%">
			<tr>
				<td colspan="2">
					<label for="txttitulo"><b>Nombre</b></label><br />
					<input type="text" id="nombre" name="nombre" value="<?=$nombre?>" />
				</td>
			</tr>
			<tr>
				<td colspan="2"><label for="puesto"><b>Puesto</b></label>
					<input type="text" id="puesto" name="puesto" value="<?=$puesto;?>"/>          
				</td>
			</tr>
			
			<tr>
				<td><label for="email"><b>Email</b></label>
					<input type="text" id="email" name="email" value="<?=$email;?>"/>          
				</td>
				<td><label for="orden"><b>Orden:</b></label>
					<input type="text" id="orden" name="orden" value="<?=$orden;?>"/>          
				</td>
			</tr>
			<tr>	
				<td><label for="imagen"><b>Imagen</b></label>
					<input name="archivo" id="archivo" type="file" size="40" style="border:none;height: auto;padding: 0;"/>
					<input type="hidden" id="hiurl" name="hiurl" value="<?php echo $archivo ?>"/>
				</td>
				<td id="anexo" style="margin:2px #090 solid;">
				<?php if (!empty($archivo)){ ?>
					<table>
						<tr>
							<td valign="middle" align="center">
								<img style="border:#090 2px double;" width="40" height="33" src="multimedia/imagen/<?=$archivo;?>" />
							</td>
							<td><?php  echo $archivo ?></td>
						</tr>
					</table>
				<?php } ?>
				</td>
			</tr>
				<td ><label for="publicar"><b>¿Publicar?</b></label>         
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
	echo '<script> parent.recargarGrid();parent.myCellA.expand();parent.myCellB.collapse(); </script> ';
}
?>
<script>parent.progressOff(false);</script>
</body>
</html>