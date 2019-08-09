<?php
error_reporting(0);
include_once('../../classes/ConexionBaseDatos.php');
header('Content-type: text/xml; charset=utf-8');

$conexionBaseDatos= new ConexionBaseDatos();
$sql="SELECT * FROM cat_servicios order by nombre asc";

$result=$conexionBaseDatos->ejecutar_consulta($sql);
$resultados=array();
echo '<rows id="0">';
while($row = mysql_fetch_array($result)){
	$registro=array();
	print("<row id='".$row['id']."'>");
    print("<cell><![CDATA[".html_entity_decode(utf8_decode($row['nombre']))."]]></cell>");
    print("<cell><![CDATA[".html_entity_decode(utf8_decode($row['responsable']))."]]></cell>");
    print("<cell><![CDATA[".html_entity_decode(utf8_decode($row['footer']))."]]></cell>");
    print("<cell><![CDATA[".html_entity_decode(utf8_decode($row['publicar']))."]]></cell>");
    print("<cell><![CDATA[".html_entity_decode( "<a href='pagina.formulario.php?id=".utf8_decode($row['id'])."' onclick='AbrirEditor(this.href);return false;'><img src='../images/captura.png' alt='Editar' title='Editar' width='24' /></a>")."]]></cell>");
	print("</row>");			
    array_push($resultados,$registro);
}
echo '</rows>';

mysql_free_result($result);
$conexionBaseDatos->desconectar();
?>