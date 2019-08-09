<?php
error_reporting(0);
include_once('../classes/login.php');
require_once('../classes/ConsultasBD.php');

$ConsultasBD = new ConsultasBD();
$id=isset($_REQUEST["id"])?utf8_encode($_REQUEST["id"]):0;
$nombre=isset($_REQUEST["nombre"])?utf8_encode($_REQUEST["nombre"]):'';
$apellido=isset($_REQUEST["apellido"])?utf8_encode($_REQUEST["apellido"]):'';
$correo=isset($_REQUEST["correo"])?utf8_encode($_REQUEST["correo"]):'';
$telefono=isset($_REQUEST["telefono"])?utf8_encode($_REQUEST["telefono"]):'';
$mensaje=isset($_REQUEST["mensaje"])?utf8_encode($_REQUEST["mensaje"]):'';
$NombreIniciativa=isset($_REQUEST["NombreIniciativa"])?utf8_encode($_REQUEST["NombreIniciativa"]):'';
$Iniciativa=isset($_REQUEST["Iniciativa"])?utf8_encode($_REQUEST["Iniciativa"]):'';
$Beneficios=isset($_REQUEST["Beneficios"])?utf8_encode($_REQUEST["Beneficios"]):'';
$estatus=isset($_REQUEST["estatus"])?utf8_encode($_REQUEST["estatus"]):'';

$opc=$_REQUEST['opc'];

switch ($opc){
		case 'GuardarComentario':
			$resultado=$ConsultasBD->GuardarMensajeContacto($nombre,$apellido,$correo,$telefono,$mensaje);
			$arrjson=json_decode($resultado);
			return $arrjson;	   		   
		break;

		case 'GuardarIniciativa':
			$resultado=$ConsultasBD->GuardarIniciativa($nombre,$apellido,$correo,$telefono,$NombreIniciativa,$Iniciativa,$Beneficios);
			$arrjson=json_decode($resultado);
			return $arrjson;	   		   
		 break;
		 
		 case 'TraerArchivoTransparencia':
			$resultado=$ConsultasBD->TraerEnlaceTransparencia($id);
			return $resultado;	   		   
 		break;
		 
}
?>