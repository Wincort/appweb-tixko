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
$responsable="";
$descripcion="";
$requisitos="";
$presentacion="";
$tiempo="";
$horario="";
$costo="";
$fundamento="";
$contacto="";
$modulo="";
$footer="";
$publicar="";
$error="";



if($opc=="SAVE")
{
	$nombre=htmlentities($_POST['nombre']);
	$responsable=htmlentities($_POST['responsable']);
	$descripcion=htmlentities($_POST['content']);
	$requisitos=htmlentities($_POST['requisitos']);
	$presentacion=htmlentities($_POST['presentacion']);
	$tiempo=htmlentities($_POST['tiempo']);
	$horario=htmlentities($_POST['horario']);
	$costo=htmlentities($_POST['costo']);
	$fundamento=htmlentities($_POST['fundamento']);
	$contacto=htmlentities($_POST['contacto']);
	$modulo=htmlentities($_POST['modulo']);
	$footer=htmlentities($_POST['footer']);
	$publicar=htmlentities($_POST['publicar']);

	if($id==0||$id==''){
		$query = "insert into cat_servicios (nombre,responsable,descripcion,requisitos,presentacion,tiempo,horario,costo,fundamento,contacto,modulo,footer,publicar,UC,UUM,FC,FUM) values ('$nombre','$responsable','$descripcion','$requisitos','$presentacion','$tiempo','$horario','$costo','$fundamento','$contacto','$modulo','$footer','$publicar','$IdUsuario','$IdUsuario',Now(),Now())";
		//echo $query;
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
		$query = "update cat_servicios
					  set 
					  nombre = '$nombre',
					  responsable = '$responsable',
					  descripcion = '$descripcion',
					  requisitos = '$requisitos',
					  presentacion = '$presentacion',
					  tiempo = '$tiempo',
					  horario = '$horario', 
					  costo = '$costo',
					  fundamento = '$fundamento',
					  contacto = '$contacto',
					  modulo= '$modulo',
					  footer= '$footer',
					  publicar = '$publicar',
					  FUM = NOW(),
					  UUM = '$IdUsuario'
				  where id=$id";
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
		$res=mysql_query("SELECT * FROM cat_servicios where id='$id'");
		if($res){
			$row=mysql_fetch_array($res);
			$nombre=utf8_encode($row['nombre']);
			$responsable=utf8_decode($row['responsable']);
			$descripcion=utf8_decode($row['descripcion']);
			$requisitos=utf8_decode($row['requisitos']);
			$presentacion=utf8_decode($row['presentacion']);
			$tiempo=utf8_decode($row['tiempo']);
			$horario=utf8_decode($row['horario']);
			$costo=utf8_decode($row['costo']);
			$fundamento=utf8_decode($row['fundamento']);
			$contacto=utf8_decode($row['contacto']);
			$modulo=utf8_decode($row['modulo']);
			$footer=utf8_decode($row['footer']);
			$publicar=utf8_decode($row['publicar']);

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
			width:99%; height:35px; border:#CCCCCC solid 1px;
		}
		textarea{
			border:#CCCCCC solid 1px;
		}
		td{
			padding: 0.25rem !important;
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
         <script>parent.recargaInformacion();</script>
            <div id="msgContainer" class="saved">
                Se ha guardado correctamente la informaci&oacute;n. <br />
            </div>
        <?php } ?>
        <table width="100%" cellspacing="2" border="0">
        <tr>
			<td colspan="3">
				<label for="nombre">Nombre de Trámite/Servicio</label>
				<br /><input type="text" id="nombre" name="nombre" value="<?=$nombre?>" />
			</td>
		</tr>
		<tr>
			<td colspan="3">
				<label for="responsable">Área Responsable</label>
				<br /><input type="text" id="responsable" name="responsable" value="<?=$responsable?>" />
			</td>
        </tr>
		<tr>
			<tr>
				<td colspan="3"><label for="descripcion"><b>Descripción</b></label><br />
					<textarea class="textarea-form"  style="width:100%;" id="content" name="content" rows=2><?=$descripcion;?></textarea>        
				</td>
			</tr>
		</tr>
		<tr>
			<tr>
				<td colspan="3"><label for="requisitos"><b>Requisitos</b></label><br />
					<textarea class="textarea-form" style="width:100%;" id="requisitos" name="requisitos" rows=2><?=$requisitos;?></textarea>        
				</td>
			</tr>
		</tr>
		<tr>
			<tr>
				<td colspan="3"><label for="horario"><b>Horario de atención</b></label><br />
					<textarea class="textarea-form" style="width:100%;" id="horario" name="horario" rows=2><?=$horario;?></textarea>        
				</td>
			</tr>
		</tr>
		<tr colspan="3">
			<td width="20%">
				<label for="presentacion"><b>Forma de presentarse</b></label><br />
				<input type="text" id="presentacion" name="presentacion" value="<?=$presentacion?>" />				
			</td>
			<td width="20%">
				<label for="tiempo"><b>Tiempo de espera</b></label><br />
				<input type="text" id="tiempo" name="tiempo" value="<?=$tiempo?>" />			
			</td>
			<td width="20%">
				<label for="modulo">Módulo en el que puede realizarse</label><br />
				<input type="text" id="modulo" name="modulo" value="<?=$modulo?>" />
			</td>
        </tr>
		<tr colspan="3">
			<td width="20%">
				<label for="costo"><b>Costo</b></label><br />
				<input type="text" id="costo" name="costo" value="<?=$costo?>" />				
			</td>
			<td width="20%">
				<label for="fundamento"><b>Fundamento jurídico</b></label><br />
				<input type="text" id="fundamento" name="fundamento" value="<?=$fundamento?>" />			
			</td>
			<td width="20%">
				<label for="contacto">Información de contacto</label><br />
				<input type="text" id="contacto" name="contacto" value="<?=$contacto?>" />
			</td>
        </tr>
        <tr colspan="3">
			<td width="20%">
				<label for="footer"><b>¿Añadir al pie de página?</b></label><br />
				<select id="footer" name="footer">
					<option value="SI" <?php echo $footer=='SI' ? 'selected' : ''; ?> >SI</option>
					<option value="NO" <?php echo $footer=='NO' ? 'selected' : ''; ?> >NO</option>
				</select>				
			</td>
			<td width="20%">
				<label for="publicar">¿Publicar?</label><br />
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
<script type="text/javascript" src="../script/jquery/jquery-2.1.3.min.js"></script> 
<script type="text/javascript" src="../script/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="../script/tinymce/js/tinymce/tinymce.min.js"></script>
<script>
	//Inicializa el editor de texto
	tinymce.init({
		selector: '.textarea-form',
		language: 'es_MX',
		branding: false,
		menubar: false,
		toolbar: false,
		statusbar: false,
		height : 100
	});
</script>
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
		//MostrarPeriodo();	
	});		
	
	function cleanFormulario(){
		document.getElementById("id").value = 0;
		document.getElementById("opc").value = '';
		$("#frm").submit();
	}
	
</script>
<script>
let MostrarPeriodo = () => {
	let TipoPagina=$('#pagina').val();
	TipoPagina=='CONAC' ? $('#periodo').css('display', 'block') : $('#periodo').css('display', 'none');
	TipoPagina=='CONAC' ? $('#labelPeriodo').css('display', 'block') : $('#labelPeriodo').css('display', 'none');
}
</script>
</body>
</html>