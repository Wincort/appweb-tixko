<?php  //256
error_reporting(0);
date_default_timezone_set('America/Mexico_City');
include_once('../classes/login.php');
include_once("../classes/database.php");

$membership = new Login();
$membership->confirm_Member(); 
$db = new Database();
$db -> connect();

$IdUsuario=$membership->obtenerID();

$id=intval($_REQUEST['id']);
$opc=$_REQUEST['opc'];

$nombre="";
$contenido="";
$telefono="";
$publicar="";
$error="";

if($opc=="SAVE")
{
	$nombre=htmlentities($_POST['nombre']);
	$contenido=htmlentities($_POST['contenido']);
	$telefono=htmlentities($_POST['telefono']);
	$publicar=htmlentities($_POST['publicar']);
 	
	if($id==0||$id==''){
		$query = "insert into cat_emergencias (nombre,contenido,telefono,publicar,UM,FUM) values ('$nombre','$contenido','$telefono','$publicar','$IdUsuario',Now())";
		$db -> begin();
		$res = $db -> openTransaction($query);
		if(!$res){
			$db -> rollback();
			$error="SI";
		}
		else{
			$id = mysql_insert_id();
			$db -> commit();
			$error="NO";
		}
	}
	else{
		$query = "update cat_emergencias
					  set 
					  nombre = '$nombre',
					  contenido = '$contenido',
					  telefono = '$telefono',
					  publicar = '$publicar',
					  FUM = NOW(),
					  UM = '$IdUsuario'
				  where Id=$id";
		$db -> begin();
		$res = $db -> openTransaction($query);
		if(!$res){
			$db -> rollback();
			$error="SI";
		}
		else{
			$db -> commit();
			$error="NO";
		}
	}
}
else{
	if($id!=0&&$id!=''){
		$res=mysql_query("SELECT * FROM cat_emergencias where Id='$id'");
		if($res){
			$row=mysql_fetch_array($res);
			$nombre=utf8_decode($row['nombre']);
			$contenido=utf8_decode($row['contenido']);
			$publicar=utf8_decode($row['publicar']);
			$telefono=utf8_decode($row['telefono']);
		}
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title></title>
	<link rel="stylesheet" href="../script/bootstrap/css/bootstrap.min.css" />
	<script type="text/javascript" src="../script/jquery/jquery-2.1.3.min.js"></script> 
	<script type="text/javascript" src="../script/bootstrap/js/bootstrap.min.js"></script>

    <script type="text/javascript">		
		
		function Guardar(){
			var msgError = "";
			$("#opc").val("SAVE");
			$("#frm").submit();
		}
		function ocultaMensaje(){
			try{
				$('#msgContainer').html('&nbsp;');
				$('#msgContainer').attr('className','');
			}
			catch(error){
			}
		}
		$(document).ready(function(){
			$('input[type="text"]').change(ocultaMensaje);
			$('textarea').change(ocultaMensaje);
			$('input[type="checkbox"]').click(ocultaMensaje);
			parent.progressOff(false);
		});		
		
		function cleanFormulario(){
			document.getElementById("id").value = 0;
			document.getElementById("opc").value = '';
			$("#frm").submit();
		}
		
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
		#frm input {
			width:99%; height:35px;border:#CCCCCC solid 1px;
		}
		#frm select{
			width:15%; height:35px; border:#CCCCCC solid 1px;
		}
		textarea{
			border:#CCCCCC solid 1px;
		}
		td{
			padding: 0.5rem !important;
		}
    </style>
</head>

<body>

<form id="frm" name="frm" method="post" action="" enctype="multipart/form-data">
    <fieldset style="border:#CCCCCC solid 2px;">
		<?php if (isset($error) && $error=="SI"){ ?>
            <div id="msgContainer" class="error">Ocurri&oacute; un error al momento de guardar la informaci&oacute;n. Intente de nuevo por favor.</div>
        <?php } ?>
        <?php if (isset($error) && $error=="NO"){ ?>
         <script>parent.recargarGrid();</script>
            <div id="msgContainer" class="saved">
                Se ha guardado correctamente la informaci&oacute;n. <br />
            </div>
        <?php } ?>
        <table width="100%" cellspacing="2" border="0">
		<tr>
			<td>
				<label for="nombre">Nombre</label>
				<br /><input type="text" id="nombre" name="nombre" value="<?=$nombre?>" />
			</td>
		</tr>
		<tr>
			<td>
				<label for="telefono">Teléfono</label>
				<br /><input type="text" id="telefono" name="telefono" value="<?=$telefono?>" />
			</td>
		</tr>
		<tr>
			<tr>
				<td><label for="contenido"><b>Información</b></label><br />
					<textarea  style="width:100%;" id="contenido" name="contenido" rows=4><?=$contenido;?></textarea>        
				</td>
			</tr>
		</tr>
        <tr>
			<td>
				<label for="publicar">¿Publicar?:</label>
				<select id="publicar" name="publicar">
					<option value="SI" <?php echo $publicar=='SI' ? 'selected' : ''; ?> >SI</option>
					<option value="NO" <?php echo $publicar=='NO' ? 'selected' : ''; ?> >NO</option>
				</select>
			</td>
        </tr>
        </table>
    </fieldset>
    <div align="center" style="margin-top:20px;"><input name="guardar" type="button" id="guardar" value="Guardar" onclick="Guardar();" /></div>
    <input type="hidden" id="id" name="id" value="<?php echo $id; ?>" />
    <input type="hidden" id="opc" name="opc" value="" />
    
</form>
</body>
</html>