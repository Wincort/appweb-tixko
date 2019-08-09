<?php
error_reporting(0);
include_once('../../classes/ConexionBaseDatos.php');
header('Content-type: text/xml; charset=utf-8');

$conexionBaseDatos= new ConexionBaseDatos();
$sql="SELECT * FROM cat_emergencias";

$result=$conexionBaseDatos->ejecutar_consulta($sql);
$resultados=array();
echo '<rows id="0">';
while($row = mysql_fetch_array($result)){
	$registro=array();
	print("<row id='".$row['id']."'>");
	print("<cell><![CDATA[".html_entity_decode($row['nombre'])."]]></cell>");
	print("<cell><![CDATA[".html_entity_decode($row['publicar'])."]]></cell>");
	print("</row>");			
	array_push($resultados,$registro);
}
echo '</rows>';

mysql_free_result($result);
$conexionBaseDatos->desconectar();
?>