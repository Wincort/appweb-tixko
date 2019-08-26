<?php
//error_reporting(0);
include_once('ConexionBaseDatos.php');

class PaginaWEB {
	var $claveImagen;
	var $nombrePersona;
	var $nombrePuesto;
	var $nombreImagen;
	var $modulo;
	var $esconder;
	var $FC;
	var $FUM;
	var $UC;
	var $UM;
	var $Descripcion;
	function PaginaWEB($claveImagen=0,$nombrePersona='',$nombrePuesto='',$nombreImagen='',$modulo=0,$esconder=0,$fc='',$fum='',$uc='',$um='',$Descripcion=''){
		$this->claveImagen=$claveImagen;
		$this->nombrePersona=$nombrePersona;
		$this->nombrePuesto=$nombrePuesto;
		$this->nombreImagen=$nombreImagen;
		$this->modulo=$modulo;
		$this->esconder=$esconder;
		$this->FC=$fc;
		$this->FUM=$fum;
		$this->UC=$uc;
		$this->UM=$um;
		$this->Descripcion=$Descripcion;
	}

	function TraerDirecciones($estatus){
		$conexionBaseDatos= new ConexionBaseDatos();
		$sql="SELECT * FROM cat_direcciones where publicar='$estatus' and Id>0";
		$result=$conexionBaseDatos->ejecutar_consulta($sql);
		$resultados=array();
		while($row = mysql_fetch_array($result)){
			$registro=array();
			$registro['Id']=$row['Id'];
			$registro['registro']=utf8_encode($row['registro']);
			$registro['descripcion']=utf8_encode($row['descripcion']);
			array_push($resultados,$registro);
		}
		mysql_free_result($result);
		return $resultados;
	}

	function TraerHistoria(){
		$conexionBaseDatos= new ConexionBaseDatos();
		$sql="SELECT * FROM cat_historia where publicar='SI' and id=1";
		$result=$conexionBaseDatos->ejecutar_consulta($sql);
		$resultados=array();
		while($row = mysql_fetch_array($result)){
			$registro=array();
			$registro['id']=$row['id'];
			$registro['historia']=html_entity_decode($row['historia']);
			array_push($resultados,$registro);
		}
		mysql_free_result($result);
		return $resultados;
	}

	function TraerMVV(){
		$conexionBaseDatos= new ConexionBaseDatos();
		$sql="SELECT * FROM cat_mvv where publicar='SI' and id=1";
		$result=$conexionBaseDatos->ejecutar_consulta($sql);
		$resultados=array();
		while($row = mysql_fetch_array($result)){
			$registro=array();
			$registro['id']=$row['id'];
			$registro['mision']=html_entity_decode($row['mision']);
			$registro['vision']=html_entity_decode($row['vision']);
			$registro['valores']=html_entity_decode($row['valores']);
			array_push($resultados,$registro);
		}
		mysql_free_result($result);
		return $resultados;
	}

	//Usado en Página CONAC (SIN AGRUPACION POR PERIODO) (old)
	function TraerListaTransparencia($estatus){
		$conexionBaseDatos= new ConexionBaseDatos();
		$sql="SELECT * FROM cat_transparencia where publicar='$estatus' and periodo=0 and Id>0";
		$result=$conexionBaseDatos->ejecutar_consulta($sql);
		$resultados=array();
		while($row = mysql_fetch_array($result)){
			$registro=array();
			$registro['id']=$row['id'];
			$registro['registro']=utf8_encode($row['registro']);
			$registro['publicar']=utf8_encode($row['publicar']);
			array_push($resultados,$registro);
		}
		mysql_free_result($result);
		return $resultados;
	}
	
	//Usado en Página CONAC (LISTA DE TODAS LAS AGRUPACIONES DE ARCHVIOS DE UN PERIODO) (old)
	function TraerListaDelGrupo($idGrupo){
		$conexionBaseDatos= new ConexionBaseDatos();
		$sql="SELECT * FROM cat_transparencia where publicar='SI' and periodo='$idGrupo' and Id>0";
		$result=$conexionBaseDatos->ejecutar_consulta($sql);
		$resultados=array();
		while($row = mysql_fetch_array($result)){
			$registro=array();
			$registro['id']=$row['id'];
			$registro['registro']=utf8_encode($row['registro']);
			array_push($resultados,$registro);
		}
		mysql_free_result($result);
		return $resultados;
	}
	
	//Usado en Explorador CONAC
	function TraerListaCompletaDelPeriodo($id){
		$conexionBaseDatos= new ConexionBaseDatos();
		$sql="SELECT * FROM cat_transparencia_detalles where publicar='SI' and IdRegistro='$id' and IdRegistroDetalle>0";
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
		return $resultados;
	}
	//Usado en Página FAIS (Lista de grupos de archivos)
	function TraerListaFAIS(){
		$conexionBaseDatos= new ConexionBaseDatos();
		$sql="SELECT * FROM cat_lista_transparencia where pagina='FAIS' and publicar='SI'";
		$result=$conexionBaseDatos->ejecutar_consulta($sql);
		$resultados=array();
		while($row = mysql_fetch_array($result)){
			$registro=array();
			$registro['id']=$row['id'];
			$registro['registro']=utf8_encode($row['registro']);
			$registro['dirRegistroPagina']=utf8_encode($row['dirRegistroPagina']);
			array_push($resultados,$registro);
		}
		mysql_free_result($result);
		return $resultados;
	}
	//Usado en Página FAIS (Lista de grupos de archivos)
	function TraerListaGaceta(){
		$conexionBaseDatos= new ConexionBaseDatos();
		$sql="SELECT * FROM cat_lista_transparencia where pagina='GACETA' and publicar='SI'";
		$result=$conexionBaseDatos->ejecutar_consulta($sql);
		$resultados=array();
		while($row = mysql_fetch_array($result)){
			$registro=array();
			$registro['id']=$row['id'];
			$registro['registro']=utf8_encode($row['registro']);
			$registro['dirRegistroPagina']=utf8_encode($row['dirRegistroPagina']);
			array_push($resultados,$registro);
		}
		mysql_free_result($result);
		return $resultados;
	}
	//Usado en Página CONAC (SIN AGRUPACION POR PERIODO) (NUEVA VERSIÓN)
	function TraerListaCONAC_SinPeriodo(){
		$conexionBaseDatos= new ConexionBaseDatos();
		$sql="SELECT * FROM cat_lista_transparencia where pagina='CONAC' and publicar='SI' and periodo=0";
		$result=$conexionBaseDatos->ejecutar_consulta($sql);
		$resultados=array();
		while($row = mysql_fetch_array($result)){
			$registro=array();
			$registro['id']=$row['id'];
			$registro['registro']=utf8_encode($row['registro']);
			$registro['publicar']=utf8_encode($row['publicar']);
			array_push($resultados,$registro);
		}
		mysql_free_result($result);
		return $resultados;
	}

	//Usado en Página CONAC (LISTA DE TODAS LAS AGRUPACIONES DE ARCHVIOS DE UN PERIODO)
	function TraerListaCONAC_ConPeriodo($idPeriodo){
		$conexionBaseDatos= new ConexionBaseDatos();
		$sql="SELECT * FROM cat_lista_transparencia where pagina='CONAC' and publicar='SI' and periodo='$idPeriodo'";
		$result=$conexionBaseDatos->ejecutar_consulta($sql);
		$resultados=array();
		while($row = mysql_fetch_array($result)){
			$registro=array();
			$registro['id']=$row['id'];
			$registro['registro']=utf8_encode($row['registro']);
			array_push($resultados,$registro);
		}
		mysql_free_result($result);
		return $resultados;
	}

	//Usado en Página CONAC (LISTA DEL PERIODOS DISPONIBLES)
	function TraerPeriodos(){
		$conexionBaseDatos= new ConexionBaseDatos();
		$sql="SELECT * FROM periodos where estatus=1 and Id>0";
		$result=$conexionBaseDatos->ejecutar_consulta($sql);
		$resultados=array();
		while($row = mysql_fetch_array($result)){
			$registro=array();
			$registro['id']=$row['id'];
			$registro['nombre']=utf8_encode($row['nombre']);
			array_push($resultados,$registro);
		}
		mysql_free_result($result);
		return $resultados;
	}

	function TraerEnlacesCONAC($id){
		$conexionBaseDatos= new ConexionBaseDatos();
		$sql="SELECT td.*,t.dirRegistroPagina FROM cat_lista_transparencia_detalles td inner join cat_lista_transparencia t on t.id=td.IdRegistro where td.publicar='SI' and td.IdRegistro='$id'";
		$result=$conexionBaseDatos->ejecutar_consulta($sql);
		$resultados=array();
		while($row = mysql_fetch_array($result)){
			$registro=array();
			$registro['id']=$row['IdRegistroDetalle'];
			$registro['titulo']=utf8_encode($row['titulo']);
			$registro['archivo']=utf8_encode($row['archivo']);
			$registro['tipo']=utf8_encode($row['tipo']);
			$registro['mes']=utf8_encode($row['mes']);
			$registro['dirRegistroPagina']=utf8_encode($row['dirRegistroPagina']);
			array_push($resultados,$registro);
		}
		mysql_free_result($result);
		return $resultados;
	}
	
	function TraerCabildo(){
		$conexionBaseDatos= new ConexionBaseDatos();
		$sql="SELECT * FROM cat_cabildo WHERE publicar='SI' ORDER BY Orden";
		$result=$conexionBaseDatos->ejecutar_consulta($sql);
		$resultados=array();
		while($row = mysql_fetch_array($result)){
			$registro=array();
			$registro['Id']=$row['Id'];
			$registro['nombre']=utf8_encode($row['nombre']);
			$registro['puesto']=utf8_encode($row['puesto']);
			$registro['archivo']=utf8_encode($row['archivo']);
			$registro['email']=utf8_encode($row['email']);
			$registro['orden']=utf8_encode($row['orden']);
			array_push($resultados,$registro);
		}
		mysql_free_result($result);
		return $resultados;
	}

	function TraerDirectorio(){
		$conexionBaseDatos= new ConexionBaseDatos();
		$sql="SELECT * FROM cat_directorio WHERE publicar='SI'";
		$result=$conexionBaseDatos->ejecutar_consulta($sql);
		$resultados=array();
		while($row = mysql_fetch_array($result)){
			$registro=array();
			$registro['Id']=$row['Id'];
			$registro['unidad']=utf8_encode($row['unidad']);
			$registro['nombre']=utf8_encode($row['nombre']);
			$registro['email']=utf8_encode($row['email']);
			$registro['telefono']=utf8_encode($row['telefono']);
			array_push($resultados,$registro);
		}
		mysql_free_result($result);
		return $resultados;
	}

	function TraerNumerosEmergencia(){
		$conexionBaseDatos= new ConexionBaseDatos();
		$sql="SELECT * FROM cat_emergencias WHERE publicar='SI'";
		$result=$conexionBaseDatos->ejecutar_consulta($sql);
		$resultados=array();
		while($row = mysql_fetch_array($result)){
			$registro=array();
			$registro['Id']=$row['Id'];
			$registro['nombre']=utf8_encode($row['nombre']);
			$registro['contenido']=utf8_encode($row['contenido']);
			$registro['telefono']=utf8_encode($row['telefono']);
			array_push($resultados,$registro);
		}
		mysql_free_result($result);
		return $resultados;
	}

	function TraerPreguntasFrecuentes(){
		$conexionBaseDatos= new ConexionBaseDatos();
		$sql="SELECT * FROM cat_preguntas WHERE publicar='SI'";
		$result=$conexionBaseDatos->ejecutar_consulta($sql);
		$resultados=array();
		while($row = mysql_fetch_array($result)){
			$registro=array();
			$registro['Id']=$row['Id'];
			$registro['pregunta']=utf8_encode($row['pregunta']);
			$registro['respuesta']=utf8_encode($row['respuesta']);
			array_push($resultados,$registro);
		}
		mysql_free_result($result);
		return $resultados;
	}

	function TraerAtractivos(){
		$conexionBaseDatos= new ConexionBaseDatos();
		$sql="SELECT * FROM cat_atractivos WHERE publicar='SI'";
		$result=$conexionBaseDatos->ejecutar_consulta($sql);
		$resultados=array();
		while($row = mysql_fetch_array($result)){
			$registro=array();
			$registro['id']=$row['id'];
			$registro['nombre']=utf8_encode($row['nombre']);
			$registro['contenido']=utf8_encode($row['contenido']);
			$registro['imagen']=utf8_encode($row['imagen']);
			array_push($resultados,$registro);
		}
		mysql_free_result($result);
		return $resultados;
	}

	function TraerBannerInicio(){
		$conexionBaseDatos= new ConexionBaseDatos();
		$sql="SELECT * FROM cat_banner_inicio where publicar='SI'";
		$result=$conexionBaseDatos->ejecutar_consulta($sql);
		$resultados=array();
		while($row = mysql_fetch_array($result)){
			$registro=array();
			$registro['id']=$row['id'];
			$registro['contenido']=utf8_encode($row['contenido']);
			$registro['imagen']=utf8_encode($row['imagen']);
			array_push($resultados,$registro);
		}
		mysql_free_result($result);
		return $resultados;
	}
	
	function TraerOrganigrama(){
		$conexionBaseDatos= new ConexionBaseDatos();
		$sql="SELECT * FROM cat_organigrama where publicar='SI'";
		$result=$conexionBaseDatos->ejecutar_consulta($sql);
		$resultados=array();
		while($row = mysql_fetch_array($result)){
			$registro=array();
			$registro['id']=$row['id'];
			$registro['imagen']=utf8_encode($row['imagen']);
			array_push($resultados,$registro);
		}
		mysql_free_result($result);
		return $resultados;
	}

	function TraerTop5Boletines(){
		$conexionBaseDatos= new ConexionBaseDatos();
		$sql="SELECT * FROM cat_pagina WHERE publicar='SI' and id>0 ORDER BY FechaPublicacion desc, HoraPublicacion desc LIMIT 5";
		$result=$conexionBaseDatos->ejecutar_consulta($sql);
		$resultados=array();
		while($row = mysql_fetch_array($result)){
			$registro=array();
			$registro['id']=$row['id'];
			$registro['imagen']=utf8_encode($row['imagen']);
			array_push($resultados,$registro);
		}
		mysql_free_result($result);
		return $resultados;
	}

	function TraerBoletines($FilaInicial,$CantidadFilas){
		$conexionBaseDatos= new ConexionBaseDatos();
		$sql="SELECT *,LEFT(contenido , 200) as ContenidoBreve FROM cat_pagina WHERE publicar='SI' and id>0 ORDER BY FechaPublicacion desc, HoraPublicacion desc LIMIT $FilaInicial, $CantidadFilas";
		$result=$conexionBaseDatos->ejecutar_consulta($sql);
		$resultados=array();
		while($row = mysql_fetch_array($result)){
			$registro=array();
			$registro['id']=$row['id'];
			$registro['titulo']=html_entity_decode($row['titulo']);
			$registro['contenido']=html_entity_decode($row['ContenidoBreve']);
			$registro['imagen']=utf8_encode($row['imagen']);
			$registro['FechaPublicacion']=utf8_encode($row['FechaPublicacion']);
			$registro['HoraPublicacion']=utf8_encode($row['HoraPublicacion']);
			array_push($resultados,$registro);
		}
		mysql_free_result($result);
		return $resultados;
	}
	function TraerCuentaBoletines(){
		$conexionBaseDatos= new ConexionBaseDatos();
		$sql="SELECT * FROM cat_pagina WHERE publicar='SI' and id>0";
		$result=$conexionBaseDatos->ejecutar_consulta($sql);
		$Total=mysql_num_rows($result);
		mysql_free_result($result);
		return $Total;
	}

	function TraerPaginaBoletin($IdPagina){
		$conexionBaseDatos= new ConexionBaseDatos();
		$sql="SELECT * FROM cat_pagina where publicar='SI' and id=".$IdPagina;
		$result=$conexionBaseDatos->ejecutar_consulta($sql);
		$resultados=array();
		while($row = mysql_fetch_array($result)){
			$registro=array();
			$registro['id']=$row['id'];
			$registro['titulo']=html_entity_decode($row['titulo']);
			$registro['contenido']=html_entity_decode($row['contenido']);
			$registro['imagen']=utf8_encode($row['imagen']);
			$registro['FechaPublicacion']=utf8_encode($row['FechaPublicacion']);
			$registro['HoraPublicacion']=utf8_encode($row['HoraPublicacion']);
			array_push($resultados,$registro);
		}
		mysql_free_result($result);
		return $resultados;
	}

	function TraerTramite($IdTramite){
		$conexionBaseDatos= new ConexionBaseDatos();
		$sql="SELECT * FROM cat_servicios where publicar='SI' and id=".$IdTramite;
		$result=$conexionBaseDatos->ejecutar_consulta($sql);
		$resultados=array();
		while($row = mysql_fetch_array($result)){
			$registro=array();
			$registro['id']=$row['id'];
			$registro['nombre']=html_entity_decode($row['nombre']);
			$registro['descripcion']=html_entity_decode($row['descripcion']);
			$registro['responsable']=utf8_encode($row['responsable']);
			$registro['requisitos']=html_entity_decode($row['requisitos']);
			$registro['presentacion']=utf8_encode($row['presentacion']);
			$registro['tiempo']=utf8_encode($row['tiempo']);
			$registro['horario']=html_entity_decode($row['horario']);
			$registro['costo']=utf8_encode($row['costo']);
			$registro['fundamento']=utf8_encode($row['fundamento']);
			$registro['contacto']=utf8_encode($row['contacto']);
			$registro['modulo']=utf8_encode($row['modulo']);
			array_push($resultados,$registro);
		}
		mysql_free_result($result);
		return $resultados;
	}

	function TraerCuentaTramites(){
		$conexionBaseDatos= new ConexionBaseDatos();
		$sql="SELECT * FROM cat_servicios WHERE publicar='SI' and id>0";
		$result=$conexionBaseDatos->ejecutar_consulta($sql);
		$Total=mysql_num_rows($result);
		mysql_free_result($result);
		return $Total;
	}

	function TraerTramites($FilaInicial,$CantidadFilas){
		$conexionBaseDatos= new ConexionBaseDatos();
		$sql="SELECT * FROM cat_servicios WHERE publicar='SI' and id>0 ORDER BY FC desc LIMIT $FilaInicial, $CantidadFilas";
		$result=$conexionBaseDatos->ejecutar_consulta($sql);
		$resultados=array();
		while($row = mysql_fetch_array($result)){
			$registro=array();
			$registro['id']=$row['id'];
			$registro['nombre']=html_entity_decode($row['nombre']);
			$registro['responsable']=html_entity_decode($row['responsable']);
			$registro['fundamento']=html_entity_decode($row['fundamento']);
			$registro['presentacion']=html_entity_decode($row['presentacion']);
			array_push($resultados,$registro);
		}
		mysql_free_result($result);
		return $resultados;
	}

	function TraerTramitesFooter(){
		$conexionBaseDatos= new ConexionBaseDatos();
		$sql="SELECT * FROM cat_servicios where publicar='SI' and footer='SI'";
		$result=$conexionBaseDatos->ejecutar_consulta($sql);
		$resultados=array();
		while($row = mysql_fetch_array($result)){
			$registro=array();
			$registro['id']=$row['id'];
			$registro['nombre']=html_entity_decode($row['nombre']);
			array_push($resultados,$registro);
		}
		mysql_free_result($result);
		return $resultados;
		
	}
	
	function TraerCuentaTramitesBusqueda($query){
		$conexionBaseDatos= new ConexionBaseDatos();
		$sql="SELECT * FROM cat_servicios WHERE  publicar='SI' and( (nombre LIKE '%".$query."%') OR (responsable LIKE '%".$query."%') )";
		$result=$conexionBaseDatos->ejecutar_consulta($sql);
		$Total=mysql_num_rows($result);
		mysql_free_result($result);
		return $Total;
	}

	function TraerTramitesBusqueda($query,$FilaInicial,$CantidadFilas){
		$conexionBaseDatos= new ConexionBaseDatos();
		$sql="SELECT * FROM cat_servicios WHERE  publicar='SI' and( (nombre LIKE '%".$query."%') OR (responsable LIKE '%".$query."%') ) ORDER BY FC desc LIMIT $FilaInicial, $CantidadFilas";
		$result=$conexionBaseDatos->ejecutar_consulta($sql);
		$resultados=array();
		while($row = mysql_fetch_array($result)){
			$registro=array();
			$registro['id']=$row['id'];
			$registro['nombre']=html_entity_decode($row['nombre']);
			$registro['responsable']=html_entity_decode($row['responsable']);
			$registro['fundamento']=html_entity_decode($row['fundamento']);
			$registro['presentacion']=html_entity_decode($row['presentacion']);
			array_push($resultados,$registro);
		}
		mysql_free_result($result);
		return $resultados;
	}


	function TraerCuentaResultados($query){
		$conexionBaseDatos= new ConexionBaseDatos();
		$sql="SELECT * FROM cat_pagina WHERE publicar='SI'  and ( (titulo LIKE '%".$query."%') OR (contenido LIKE '%".$query."%') )";
		$result=$conexionBaseDatos->ejecutar_consulta($sql);
		$Total=mysql_num_rows($result);
		mysql_free_result($result);
		return $Total;
	}

	function TraerResultados($query,$FilaInicial,$CantidadFilas){
		$conexionBaseDatos= new ConexionBaseDatos();
		$sql="SELECT *,LEFT(contenido , 200) as ContenidoBreve FROM cat_pagina WHERE publicar='SI'  and ( (titulo LIKE '%".$query."%') OR (contenido LIKE '%".$query."%') ) ORDER BY FechaPublicacion desc, HoraPublicacion desc LIMIT $FilaInicial, $CantidadFilas";
		$result=$conexionBaseDatos->ejecutar_consulta($sql);
		$resultados=array();
		while($row = mysql_fetch_array($result)){
			$registro=array();
			$registro['id']=$row['id'];
			$registro['titulo']=html_entity_decode($row['titulo']);
			$registro['contenido']=html_entity_decode($row['ContenidoBreve']);
			$registro['imagen']=utf8_encode($row['imagen']);
			$registro['FechaPublicacion']=utf8_encode($row['FechaPublicacion']);
			$registro['HoraPublicacion']=utf8_encode($row['HoraPublicacion']);
			array_push($resultados,$registro);
		}
		mysql_free_result($result);
		return $resultados;
	}
	
	function TraerBanner($IdBanner){
		$conexionBaseDatos= new ConexionBaseDatos();
		$sql="SELECT * FROM cat_banner_detalles WHERE publicar='SI' and IdBanner =".$IdBanner;	
		$result=$conexionBaseDatos->ejecutar_consulta($sql);
		$resultados=array();
		while($row = mysql_fetch_array($result)){
			$registro=array();
			$registro['publicar']=$row['publicar'];
			$registro['portada']=$row['portada'];
			$registro['archivo']=$row['archivo'];
			$registro['titulo']=html_entity_decode($row['titulo']);
			$registro['nombre']=$row['nombre'];
			$registro['FC']=$row['FC'];
			$registro['descripcion']=$row['descripcion'];
			array_push($resultados,$registro);
		}
		
		mysql_free_result($result);
		return $resultados;
	}
	
	function TraerPopBanner(){
		$conexionBaseDatos= new ConexionBaseDatos();
		$sql="SELECT * FROM cat_popbanner where estatus=1 and (Vigencia=0 OR (Now() between FechaInicio AND FechaFin))";	
		$result=$conexionBaseDatos->ejecutar_consulta($sql);
		$resultados=array();
		while($row = mysql_fetch_array($result)){
			$registro=array();
			$registro['archivo']=$row['archivo'];
			$registro['Titulo']=html_entity_decode($row['Titulo']);
			$registro['Nombre']=html_entity_decode($row['Nombre']);
			$registro['Texto']=html_entity_decode($row['Texto']);
			$registro['FechaInicio']=html_entity_decode($row['FechaInicio']);
			$registro['FechaFin']=html_entity_decode($row['FechaFin']);
			$registro['TipoLink']=html_entity_decode($row['TipoLink']);
			$registro['URL']=html_entity_decode($row['URL']);
			$registro['seccionWeb']=html_entity_decode($row['seccionWeb']);
			$registro['Vigencia']=html_entity_decode($row['Vigencia']);
			
			array_push($resultados,$registro);
		}
		
		mysql_free_result($result);
		return $resultados;
	}

		
	function TraerContacto($estatus){
		$conexionBaseDatos= new ConexionBaseDatos();
		$sql="SELECT * FROM cat_contacto where publicar='$estatus' and Id=1";
		$result=$conexionBaseDatos->ejecutar_consulta($sql);
		$resultados=array();
		while($row = mysql_fetch_array($result)){
			$registro=array();
			//(`nombrePersona`, `nombrePuesto`, `nombreImagen`, `modulo`, `esconder`, `FC`, `FUM`, `UC`, `UM`)
			$registro['Id']=$row['Id'];
			$registro['nombre']=html_entity_decode($row['nombre']);
			$registro['descripcion']=html_entity_decode($row['descripcion']);
			$registro['publicar']=html_entity_decode($row['publicar']);
			$registro['archivo']=$row['archivo'];
			array_push($resultados,$registro);
		}
		
		mysql_free_result($result);
		return $resultados;
	}	
	
	function TraerCorreo($estatus){
		$conexionBaseDatos= new ConexionBaseDatos();
		$sql="SELECT * FROM cat_redes where publicar='$estatus' and Id=1";
		$result=$conexionBaseDatos->ejecutar_consulta($sql);
		$resultados=array();
		while($row = mysql_fetch_array($result)){
			$registro=array();
			$registro['Id']=$row['Id'];
			$registro['nombre']=html_entity_decode($row['nombre']);
			$registro['descripcion']=html_entity_decode($row['descripcion']);
			$registro['publicar']=html_entity_decode($row['publicar']);
			$registro['archivo']=$row['archivo'];
			array_push($resultados,$registro);
		}
		
		mysql_free_result($result);
		return $resultados;
	}

	function TraerTelefono($estatus){
		$conexionBaseDatos= new ConexionBaseDatos();
		$sql="SELECT * FROM cat_redes where publicar='$estatus' and Id=2";
		$result=$conexionBaseDatos->ejecutar_consulta($sql);
		$resultados=array();
		while($row = mysql_fetch_array($result)){
			$registro=array();
			$registro['Id']=$row['Id'];
			$registro['nombre']=html_entity_decode($row['nombre']);
			$registro['descripcion']=html_entity_decode($row['descripcion']);
			$registro['publicar']=html_entity_decode($row['publicar']);
			$registro['archivo']=$row['archivo'];
			array_push($resultados,$registro);
		}
		
		mysql_free_result($result);
		return $resultados;
	}
	
	function TraerRedesSociales($estatus){
		$conexionBaseDatos= new ConexionBaseDatos();
		$sql="SELECT * FROM cat_redes where publicar='$estatus' and Id>2";
		$result=$conexionBaseDatos->ejecutar_consulta($sql);
		$resultados=array();
		while($row = mysql_fetch_array($result)){
			$registro=array();
			$registro['Id']=$row['Id'];
			$registro['nombre']=html_entity_decode($row['nombre']);
			$registro['descripcion']=html_entity_decode($row['descripcion']);
			$registro['publicar']=html_entity_decode($row['publicar']);
			$registro['archivo']=$row['archivo'];
			array_push($resultados,$registro);
		}
		
		mysql_free_result($result);
		return $resultados;
	}
	
	
	
	function TraeRedesSociales($estatus){
		$conexionBaseDatos= new ConexionBaseDatos();
		$sql="SELECT * FROM cat_redes where estatus='$estatus'";
		$result=$conexionBaseDatos->ejecutar_consulta($sql);
		$resultados=array();
		while($row = mysql_fetch_array($result)){
			$registro=array();
			$registro['Id']=$row['Id'];
			$registro['nombre']=html_entity_decode($row['nombre']);
			$registro['titulo']=html_entity_decode($row['titulo']);
			$registro['descripcion']=html_entity_decode($row['descripcion']);
			$registro['descripcion2']=html_entity_decode($row['descripcion2']);
			$registro['publicar']=html_entity_decode($row['publicar']);
			$registro['archivo']=$row['archivo'];
			array_push($resultados,$registro);
		}
		
		mysql_free_result($result);
		return $resultados;
	}

	public function getSubString($string, $length=NULL)
	{
		//Si no se especifica la longitud por defecto es 50
		if ($length == NULL)
			$length = 50;
		//Primero eliminamos las etiquetas html y luego cortamos el string
		$stringDisplay = substr(strip_tags(utf8_decode($string)), 0, $length);
		//Si el texto es mayor que la longitud se agrega puntos suspensivos
		if (strlen(strip_tags($string)) > $length)
			$stringDisplay .= ' ...';
		return $stringDisplay;
	}
}
?>