<?php
//***********Parentesco************//
error_reporting(0);
include_once('../../classes/ConexionBaseDatos.php');
header('Content-type: text/xml; charset=utf-8');
/*echo('<?xml version="1.0" encoding="iso-8859-1"?>'); */
$Id=$_REQUEST['Id'];

		 $conexionBaseDatos= new ConexionBaseDatos();
		 $sql="SELECT * FROM cat_comentarios where IdBlog=$Id";
		
		$result=$conexionBaseDatos->ejecutar_consulta($sql);
		$resultados=array();
		echo '<rows id="0">';
		while($row = mysql_fetch_array($result)){
			$registro=array();
			print("<row id='".$row['Id']."'>");
			//print('<cell name="img"><![CDATA[<a href="#" title=""><input type="image" src="'.html_entity_decode($row['archivo']).'" id="imagen" style="width:80%; height:90px;" align="top" title="Imágen"></a>]]></cell>');  			
			//print("<cell><![CDATA[<img src=".html_entity_decode($row['nombreImagen'])."]]></cell>");
			print("<cell><![CDATA[".html_entity_decode($row['nombre'])."]]></cell>");
			print("<cell><![CDATA[".html_entity_decode($row['correo'])."]]></cell>");
			print("<cell><![CDATA[".html_entity_decode($row['mensaje'])."]]></cell>");
			print("<cell><![CDATA[".html_entity_decode($row['publicar'])."]]></cell>");
//			print("<cell><![CDATA[".html_entity_decode($row['telefono'])."]]></cell>");
			print("</row>");			
			array_push($resultados,$registro);
		}
		echo '</rows>';
		
		mysql_free_result($result);
		$conexionBaseDatos->desconectar();
?>