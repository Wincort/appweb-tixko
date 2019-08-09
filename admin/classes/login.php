<?php
error_reporting(0);

class Login {
	private $userID="";
	private $userSID="";
	private $userPermisos="";
	private $userPerfiles=""; 
	private $EsSupervisor="";
	private $Perfil="";
	private $Estado="";

	function validate_user($user, $pwd, $user_code){
		//include_once("captcha/php-captcha.inc.php");
		if ($user!='' && $pwd!=''/*PhpCaptcha::Validate($user_code)*/) {
			$db = new Database();
			$db -> connect();
			$busca = "select estatus,id_usuario from admin_usuario where login = '$user' and contrasena = '$pwd'";//md5('$pwd')";
			$resultado=mysql_query($busca);
			if(mysql_num_rows($resultado)>0)
			{
				$row = mysql_fetch_row($resultado);
				if($row[0] == 0) return "No tienes permiso para acceder al sistema.";
				$id_usuario = $row[1];
				$_SESSION['status'] = 'authorized';
				$_SESSION['id_user'] = $id_usuario;
				$_SESSION['system_user'] = $user;
				
				header("location:index.php");
			} else return "Usuario y Contrase&ntilde;a Incorrectos";
		} else {
			return 'Falta Usuario o Contrase&ntilde;a';/*'El Ncodigo de verificación es incorrecto.';*/
		}
	} 
	
	function log_User_Out(){
		if(isset($_SESSION['status'])) {
			unset($_SESSION['status']);
			
			if(isset($_COOKIE[session_name()])) 
				setcookie(session_name(), '', time() - 1000);
				session_id();
				session_destroy();
		}
	}
	
	function confirm_Member(){
		session_id();
		session_start();
		if($_SESSION['status'] !='authorized') header("location: user.login.php");
		$this->userID=$_SESSION['id_user'];		
		$this->userSID=$_SESSION['system_user'];

	}
	function obtenerID(){
		return $this->userID;
	}
	
	function obtenerUsuario(){
		return $this->userSID;
	}
	
	public function getSubString($string, $length=NULL){
    	//Si no se especifica la longitud por defecto es 50
		if ($length == NULL) $length = 50;
		//Primero eliminamos las etiquetas html y luego cortamos el string
		$stringDisplay = substr(strip_tags($string), 0, $length);
		//Si el texto es mayor que la longitud se agrega puntos suspensivos
		if (strlen(strip_tags($string)) > $length) $stringDisplay .= ' ...';
		return $stringDisplay;
	}
	
	
}

?>