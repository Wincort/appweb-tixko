<?php
error_reporting(0);
include_once('../../classes/ConexionBaseDatos.php');
header('Content-type: text/xml; charset=utf-8');

$conexionBaseDatos= new ConexionBaseDatos();
$sql="SELECT * FROM cat_lista_transparencia order by registro asc";

$result=$conexionBaseDatos->ejecutar_consulta($sql);
$resultados=array();
echo '<rows id="0">';
while($row = mysql_fetch_array($result)){
	$registro=array();
	print("<row id='".$row['id']."'>");
	print("<cell><![CDATA[".html_entity_decode(utf8_decode($row['registro']))." ".html_entity_decode(utf8_decode($row['apellido']))."]]></cell>");
    print("<cell><![CDATA[".html_entity_decode(utf8_decode($row['pagina']))."]]></cell>");
    print("<cell><![CDATA[".html_entity_decode(utf8_decode($row['publicar']))."]]></cell>");
    print("<cell><![CDATA[".html_entity_decode( "<a href='pagina.detalles.php?n=".utf8_decode($row['id'])."'><img src='../imagen/insert-image.png' alt='Agregar Archivo' title='Agregar Archivo' width='24' /></a>")."]]></cell>");
    print("<cell><![CDATA[".html_entity_decode( "<a href='pagina.formulario.php?id=".utf8_decode($row['id'])."' onclick='AbrirEditor(this.href);return false;'><img src='../images/captura.png' alt='Editar' title='Editar' width='24' /></a>")."]]></cell>");
	print("</row>");			
    array_push($resultados,$registro);
}
echo '</rows>';

mysql_free_result($result);
$conexionBaseDatos->desconectar();
?>