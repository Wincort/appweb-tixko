<?php
	include_once('admin/classes/BO.php');
	$oWEB = new PaginaWEB();
	$Gaceta = new PaginaWEB();
	$ListaGaceta= $Gaceta->TraerListaGaceta();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Gaceta</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="lib/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="css/Fuentes.css">
	<link rel="stylesheet" href="css/Navegador-Footer.css">
	<link rel="stylesheet" href="css/Gaceta.css">

	<script src="js/jquery/3.4.1/jquery.min.js"></script>
	<script src="lib/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</head>
<body>

<?php include("Navegador.php"); ?>

<div class=""></div>

<div class="container">
	<h1 id="Titulo"><b>GACETA</b></h1>
	<div class="rows">
		<div class="col-sm-12">			
			<div class="panel-group"  id="accordion1"></div> 
		</div>			
	</div>
</div>

<?php include("Footer.php"); ?>

<script type="text/javascript">

	var ar = <?php echo json_encode($ListaGaceta) ?>;
	$(document).ready(function() {
		GenerarContenido();
	});

	let GenerarContenido = () => {
		for(let i in ar){
			let IdGrupo=ar[i].id;
			let NombreGrupo=ar[i].registro;
			let DirectorioGrupo=ar[i].dirRegistroPagina;
			let StringHTML=`
			<div class="panel panel-default">
				<div class="panel-heading" data-toggle="collapse" data-parent="#accordion1" href="#collapse${IdGrupo}">
					<h2 class="Subtitulo">${NombreGrupo}</h2>
				</div>
				<div id="collapse${IdGrupo}" class="panel-collapse collapse">
					<div class="table-responsive">     
						<table id="Tabla${IdGrupo}" class="table table-condensed">
						</table>
					</div>
				</div>
			</div>
			`;
			$(StringHTML).appendTo(`#accordion1`);
			GenerarEnlaces(IdGrupo,DirectorioGrupo);
		}
	}

	let GenerarEnlaces = (IdRegistro,Directorio) => {
		TraerElementoGaceta(IdRegistro,Directorio)
			.then(data => {
				for(let i in data){
					let {id, titulo,archivo,tipo}=data[i];
					//archivo=decode_utf8(archivo);
					let Enlace='',Descarga='';
					switch(tipo){
						case 'IMAGEN': Enlace=`admin/cat_lista_transparencia/${Directorio}/imagen/${archivo}`;
						Descarga=Enlace; 
						break;
						case 'AUDIO': Enlace=`admin/cat_lista_transparencia/${Directorio}/audio/${archivo}`; Descarga=Enlace; 
						break;
						case 'DOCTO': Enlace=`admin/ViewerJS/?zoom=page-width#../cat_lista_transparencia/${Directorio}/documentos/${archivo}`; Descarga=`admin/cat_lista_transparencia/${Directorio}/documentos/${archivo}`;  break;
						default: break;
					}
					let LigaElementoHTML=`
					<tbody>
						<tr><td><a href="${Enlace}" target="_blank">${titulo}</a></td><td><a href="${Descarga}" download>DESCARGAR</a></td></tr>
					</tbody>`;
					$(LigaElementoHTML).appendTo(`#Tabla${IdRegistro}`);
				}
			})
			.catch(err => console.error(err));
	}

	let TraerElementoGaceta = async(IdRegistro) => {
		let FetchURL=`admin/operaciones/ProcesarDatos.php?opc=TraerArchivoTransparencia&id=${IdRegistro}`;
		let response = await fetch(FetchURL, { method: "POST",});
		let data = await response.json();
		return data;
	}

	function decode_utf8(s) { 
		return decodeURIComponent(escape(s)); 
	}

	function encode_utf8(s) { 
		return unescape(encodeURIComponent(s)); 
	} 

</script>
</body>
</html>
