<?php
error_reporting(0);
include_once('../../classes/ConexionBaseDatos.php');
header('Content-type: text/xml; charset=utf-8');
$id=$_REQUEST['id'];
$conexionBaseDatos= new ConexionBaseDatos();
$sql="SELECT * FROM cat_iniciativas where id=".$id." LIMIT 1";

$result=$conexionBaseDatos->ejecutar_consulta($sql);
$resultados=array();
echo '<rows id="0">';
while($row = mysql_fetch_array($result)){
	$registro=array();
	print("<row id='nombre'>");
	print("<cell><![CDATA[Nombre]]></cell>");
	print("<cell><![CDATA[".html_entity_decode(utf8_decode($row['nombre']))."]]></cell>");
	print("</row>");
	print("<row id='apellido'>");
	print("<cell><![CDATA[Apellido]]></cell>");
	print("<cell><![CDATA[".html_entity_decode(utf8_decode($row['apellido']))."]]></cell>");
	print("</row>");
	print("<row id='correo'>");
	print("<cell><![CDATA[Email]]></cell>");
	print("<cell><![CDATA[".html_entity_decode(utf8_decode($row['correo']))."]]></cell>");
	print("</row>");
	print("<row id='telefono'>");
	print("<cell><![CDATA[Teléfono]]></cell>");
	print("<cell><![CDATA[".html_entity_decode(utf8_decode($row['telefono']))."]]></cell>");
	print("</row>");
	print("<row id='Fecha'>");
	print("<cell><![CDATA[Fecha]]></cell>");
	print("<cell><![CDATA[".html_entity_decode(utf8_decode($row['FC']))."]]></cell>");
	print("</row>");	
	print("<row id='nombreIniciativa'>");
	print("<cell><![CDATA[Nombre de Iniciativa]]></cell>");
	print("<cell><![CDATA[".html_entity_decode(utf8_decode($row['nombreIniciativa']))."]]></cell>");
	print("</row>");
	print("<row id='iniciativa'>");
	print("<cell><![CDATA[Iniciativa]]></cell>");
	print("<cell><![CDATA[".html_entity_decode(utf8_decode($row['iniciativa']))."]]></cell>");
	print("</row>");
	print("<row id='beneficios'>");
	print("<cell><![CDATA[Beneficios]]></cell>");
	print("<cell><![CDATA[".html_entity_decode(utf8_decode($row['beneficios']))."]]></cell>");
	print("</row>");
			
	array_push($resultados,$registro);
}
echo '</rows>';

mysql_free_result($result);
$conexionBaseDatos->desconectar();
?>