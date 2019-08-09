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
$registro="";
$publicar="";
$descripcion="";
$error="";
$opc=$_REQUEST['opc'];
$periodo="";

if($opc=="SAVE")
{
	$registro=htmlentities($_POST['registro']);
	$descripcion=htmlentities($_POST['content']);//editor1 descripcion
	$publicar=htmlentities($_POST['publicar']);
	$periodo=htmlentities($_POST['periodo']);
 	
	if($id==0||$id==''){
		$query = "insert into cat_transparencia (registro,descripcion,publicar,UC,UUM,FC,FUM,periodo) values ('$registro','$descripcion','$publicar','$IdUsuario','$IdUsuario',Now(),Now(),$periodo)";
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
		$query = "update cat_transparencia
					  set 
					  registro = '$registro',
					  descripcion = '$descripcion',
					  publicar = '$publicar',
					  FUM = NOW(),
					  UUM = '$IdUsuario',
					  periodo= '$periodo'
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
		$res=mysql_query("SELECT * FROM cat_transparencia where id='$id'");
		if($res){
			$row=mysql_fetch_array($res);
			$registro=utf8_encode($row['registro']);
			$descripcion=utf8_decode($row['descripcion']);
			$publicar=utf8_decode($row['publicar']);
			$periodo=utf8_decode($row['periodo']);
		}
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title></title>
	
	<script type="text/javascript" src="../script/jquery/jquery-2.1.3.min.js"></script> 
    
	<link rel="stylesheet" href="../script/bootstrap/css/bootstrap.min.css" />
	<script type="text/javascript" src="../script/bootstrap/js/bootstrap.min.js"></script>
	
	
	<script type="text/javascript" src="../script/tinymce/js/tinymce/tinymce.min.js"></script>
	<script>
		//Inicializa el editor de texto
		tinymce.init({
			selector: '#content',
			language: 'es_MX',
			branding: false,
			menubar: false
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
        width:auto%; height:35px; border:#CCCCCC solid 1px;
    }
    </style>
</head>

<body>

<form id="frm" name="frm" method="post" action="" enctype="multipart/form-data">
    <fieldset style="margin-top:20px; border:#CCCCCC solid 2px; padding:10px;">
		<?php if (isset($error) && $error=="SI"){ ?>
            <div id="msgContainer" class="error">Ocurri&oacute; un error al momento de guardar la informaci&oacute;n. Intente de nuevo por favor.</div>
        <?php } ?>
        <?php if (isset($error) && $error=="NO"){ ?>
         <script>parent.parent.recargaInformacion();</script>
            <div id="msgContainer" class="saved">
                Se ha guardado correctamente la informaci&oacute;n. <br />
                <a href="#" onclick="parent.parent.recargaInformacion();">Cerrar Ventana</a>,&nbsp;<a href="#" onclick="cleanFormulario();">Agregar Nuevo Registro.</a>
            </div>
        <?php } ?>
        <table width="100%" cellspacing="2" border="0">
        <tr>
			<td>
				<label for="txttitulo">Registro:</label>
				<br /><input type="text" id="registro" name="registro" value="<?=$registro?>" />
			</td>
        </tr>
        <tr>
			<td colspan="2"><label for="descripcion">Descripción:</label>
				<textarea id="content" name="content" title="content"><?=$descripcion;?></textarea><p id="eMessage"></p>
			</td>
        </tr>

        <tr>
			<td>
				<label for="publicar">¿Publicar?:</label>
				<select id="publicar" name="publicar" style="width:unset;">
					<option value="SI" <?php echo $publicar=='SI' ? 'selected' : ''; ?> >SI</option>
					<option value="NO" <?php echo $publicar=='NO' ? 'selected' : ''; ?> >NO</option>
				</select>
			</td>
			<td><label for="periodo"><b>Periodo:</b>
				<select id="periodo" name="periodo">
					<option value="0" <?php echo $periodo=='0' ? 'selected' : ''; ?> >Sin periodo</option>
					<option value="1" <?php echo $periodo=='1' ? 'selected' : ''; ?> >2018</option>
					<option value="2" <?php echo $periodo=='2' ? 'selected' : ''; ?> >2019</option>
					<option value="3" <?php echo $periodo=='3' ? 'selected' : ''; ?> >2020</option>
					<option value="4" <?php echo $periodo=='4' ? 'selected' : ''; ?> >2021</option>			
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