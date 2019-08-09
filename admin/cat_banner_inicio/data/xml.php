<?php
error_reporting(0);
include_once('../../classes/ConexionBaseDatos.php');
header('Content-type: text/xml; charset=utf-8');

$conexionBaseDatos= new ConexionBaseDatos();
$sql="SELECT * FROM cat_banner_inicio";

$result=$conexionBaseDatos->ejecutar_consulta($sql);
$resultados=array();
echo '<rows id="0">';
while($row = mysql_fetch_array($result)){
	$registro=array();
	print("<row id='".$row['id']."'>");
	$temp=$row['publicar'];
	if($temp!=''){
	print('<cell name="img"><![CDATA[<a href="#"><input type="image" src="multimedia/imagen/'.html_entity_decode($row['imagen']).'" style="width:30%; height:auto" align="center alt="img"></a>]]></cell>');print("<cell><![CDATA[".html_entity_decode($row['contenido'])."]]></cell>"); 
	
	}else{
		print("<cell><![CDATA[Nuevo Registro sin editar]]></cell>");
	}
	print("<cell><![CDATA[".html_entity_decode($row['publicar'])."]]></cell>");
	print("</row>");			
	array_push($resultados,$registro);
}
echo '</rows>';

mysql_free_result($result);
$conexionBaseDatos->desconectar();
?>