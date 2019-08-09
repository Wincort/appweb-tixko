<?php

include_once("config.php");

class ConexionBaseDatos
{
	var $servidor;
	var $base_datos;
	var $usuario;
	var $password;
	var $conexion;

	function ConexionBaseDatos(){
		$this->servidor=SERVIDOR_HOST; 
		$this->base_datos=BASE_DE_DATOS; 
		$this->usuario=USUARIO_BD;
		$this->password=PASSWORD_BD;
	}
	function conectar(){
		$this->conexion=mysql_connect($this->servidor,$this->usuario,$this->password);
		mysql_select_db($this->base_datos,$this->conexion);
	}
	function desconectar(){
		mysql_close($this->conexion);
	}
	function ejecutar_consulta($sql){
		$this->conectar();
		$resultados=mysql_query($sql,$this->conexion);

    	if(preg_match("/insert/i", $sql))
   		$resultados = mysql_insert_id($this->conexion);

		$this->desconectar();
		return$resultados;
	}
	
	public function getSubString($string, $length=NULL){
		//Si no se especifica la longitud por defecto es 50
		if ($length == NULL)$length = 50;
		//Primero eliminamos las etiquetas html y luego cortamos el string
		$stringDisplay = substr(strip_tags($string), 0, $length);
		//Si el texto es mayor que la longitud se agrega puntos suspensivos
		if (strlen(strip_tags($string)) > $length)$stringDisplay .= ' ...';
		return $stringDisplay;
	}
	
}

?>
