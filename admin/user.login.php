<?php
error_reporting(0); 
session_start();
include_once("classes/login.php");
include_once("classes/database.php");

$login = new Login();
// If the user clicks the "Log Out" link on the index page.
$login->log_User_Out();
// Did the user enter a password/username and click submit?
if($_POST && !empty($_POST['text_clave']) && !empty($_POST['pass_password'])){
	$response = $login->validate_User($_POST['text_clave'], $_POST['pass_password'],'');
}
else if($_POST){
	if($_POST['status']=='') $response = "Por favor, introduzca información en todos los campos.";
}
?>
<!DOCTYPE HTML>
<html dir="ltr" lang="en-US">
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Iniciar Sesión</title>

	<link rel="stylesheet" href="css/style_login.css" type="text/css" /> 
    <style>
		.error{color:#FF0000;font-stretch:wider; font-size:14px;}
    </style>
	</head>

	<script>		
		function fLogin(){
			document.getElementById('frmlogin').submit();
		}
	</script>
	<script  src="../admin/script/funciones.js"></script>

	<body>
		<div id="container">
			<form name="frmlogin" method="post" id="frmlogin">
				<input type="hidden" name="href" id="href" value="<?=$index?>" />
				<div class="login"><img src="../images/ICONO ESCUDO TIXKOKOB.png" style="width: 30px;height: 30px"/> Iniciar Sesión</div>
				<div class="username-text">Nombre de Usuario:</div>
				<div class="password-text">Contraseña:</div>
				<div class="username-field">
					<input type="text" name="text_clave" id="text_clave" value="" />
				</div>
				<div class="password-field">
					<input type="password" name="pass_password" id="pass_password" onkeypress="if(fgIsEnter(event)){fLogin();};" value="" />
				</div>
				<?php if(isset($response) && !empty($response)){ ?>
					<div style="margin-left:90px; margin-bottom:-20px;" id="error"><span class="error" style="display:block;"><?php echo $response; ?></span></div>
				<?php } else { ?>
					<div id="error"><span class="error" style="display:block;">&nbsp;</span></div>
				<?php } ?>
				<input type="checkbox" name="remember-me" id="remember-me" /><label for="remember-me">Recordarme</label>
				<div class="forgot-usr-pwd"></div>
				<input type="submit" onclick="fLogin();" name="submit" value="Entrar" />
			</form>
		</div>
		<div id="footer">
		</div>
	</body>
</html>
