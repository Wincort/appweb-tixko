<?php
include_once('ConexionBaseDatos.php');

class ConsultasBD {
    
    function GuardarMensajeContacto($nombre,$apellido,$correo,$telefono,$mensaje){	
		$conexionBaseDatos= new ConexionBaseDatos();
		$sql="INSERT INTO cat_comentarios(nombre,apellido,telefono,correo,mensaje,FC) VALUES('".$nombre."','".$apellido."','".$telefono."','".$correo."','".$mensaje."',now())";
		$result= $conexionBaseDatos->ejecutar_consulta($sql);
		if($result>1){$json= '{"status":true,"mensaje":"¡Gracias! Tu mensaje está en revisión.","error":"","titulo":"¡Mensaje Guardado!"}';}
		else{$json= '{"status":false,"mensaje":"No se pudo guardar el mensaje.","error":"ERROR_1'. $result.'","titulo":"¡Mensaje No Guardado!"}';}
		echo $json;
  	}

  	function GuardarIniciativa($nombre,$apellido,$correo,$telefono,$nombreIniciativa,$iniciativa,$beneficios){	
		$conexionBaseDatos= new ConexionBaseDatos();
		$sql="INSERT INTO cat_iniciativas(nombre,apellido,telefono,correo,nombreIniciativa,iniciativa,beneficios,FC) VALUES('".$nombre."','".$apellido."','".$telefono."','".$correo."','".$nombreIniciativa."','".$iniciativa."','".$beneficios."',now())";
		$result= $conexionBaseDatos->ejecutar_consulta($sql);
		if($result>1){$json= '{"status":true,"mensaje":"¡Gracias! Tu iniciativa está en revisión.","error":"","titulo":"¡Iniciativa Guardada!"}';}
		else{$json= '{"status":false,"mensaje":"No se pudo guardar la iniciativa.","error":"ERROR_1'. $result.'","titulo":"¡Iniciativa No Guardada!"}';}
		echo $json;
	}

	function TraerEnlaceTransparencia($id){
		$conexionBaseDatos= new ConexionBaseDatos();
		$sql="SELECT * FROM cat_lista_transparencia_detalles where publicar='SI' and IdRegistro='$id'";
		$result=$conexionBaseDatos->ejecutar_consulta($sql);
		$resultados=array();
		while($row = mysql_fetch_array($result)){
			$registro=array();
			$registro['id']=$row['IdRegistroDetalle'];
			$registro['titulo']=utf8_encode($row['titulo']);
			$registro['archivo']=utf8_encode($row['archivo']);
			$registro['tipo']=utf8_encode($row['tipo']);
			$registro['mes']=utf8_encode($row['mes']);
			array_push($resultados,$registro);
		}
		mysql_free_result($result);
		echo json_encode($resultados);
	}	
  
}
?>