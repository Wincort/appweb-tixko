<?php
error_reporting(0);
include_once('../../classes/ConexionBaseDatos.php');
header('Content-type: text/xml; charset=utf-8');
$conexionBaseDatos= new ConexionBaseDatos();
$sql="SELECT * FROM cat_direcciones";

$result=$conexionBaseDatos->ejecutar_consulta($sql);
$resultados=array();
echo '<rows id="0">';
while($row = mysql_fetch_array($result)){
	$registro=array();
	print("<row id='".$row['Id']."'>");
	print("<cell><![CDATA[".html_entity_decode($row['registro'])."]]></cell>");
	print("<cell><![CDATA[".html_entity_decode($row['descripcion'])."]]></cell>");
	//print("<cell><![CDATA[".html_entity_decode($row['estatus'])."]]></cell>");
	print("</row>");			
	array_push($resultados,$registro);
}
echo '</rows>';

mysql_free_result($result);
$conexionBaseDatos->desconectar();
?>