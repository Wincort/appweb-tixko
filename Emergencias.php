<?php
    include_once('admin/classes/BO.php');
    $oWEB = new PaginaWEB();
    $Emergencias= new PaginaWeb();
    $ListaEmergencias=$Emergencias->TraerNumerosEmergencia();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Números de Emergencia</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="lib/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="css/Fuentes.css">
	<link rel="stylesheet" href="css/Navegador-Footer.css">
	<link rel="stylesheet" href="css/Emergencias.css">
</head>
<body>

<?php include("Navegador.php"); ?>

<div class="container">
	<h1 id="Titulo"><b>NÚMEROS DE EMERGENCIA</b></h1>
	<div class="row">
		<div class="col-sm-2"></div>
		<div class="col-sm-8">
			<div class="panel-group"  id="accordion"></div> 
		</div>
		<div class="col-sm-2"></div>			
	</div>
</div>

<?php include("Footer.php"); ?>

<script src="js/jquery/3.4.1/jquery.min.js"></script>
<script src="lib/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<script>

    let ListaEmergencias = <?php echo json_encode($ListaEmergencias) ?>;

    $(document).ready(function() {
		GenerarContenido();
    });
    let GenerarContenido = () => {
		for(let i in ListaEmergencias){

			let IdEmergencia=ListaEmergencias[i].Id;
            let Nombre=decode_utf8(ListaEmergencias[i].nombre!=""?ListaEmergencias[i].nombre:"---");
			let Telefono=decode_utf8(ListaEmergencias[i].telefono!=""?ListaEmergencias[i].telefono:"---");
			let Contenido=decode_utf8(ListaEmergencias[i].contenido!=""?ListaEmergencias[i].contenido:"---");

            let StringHTML=`
            <div class="panel panel-default">
				<div class="panel-heading" data-toggle="collapse" data-parent="#accordion" href="#collapse${IdEmergencia}">
					<h2 class="Subtitulo">${Nombre}</h2>
				</div>
				<div id="collapse${IdEmergencia}" class="panel-collapse collapse">
					<h3>Teléfono: ${Telefono} </h3>
					<p>${Contenido}</p>
				</div>
			</div>
			`;
			$(StringHTML).appendTo(`#accordion`);
		}
	}

    function decode_utf8(s) { 
		return decodeURIComponent(escape(s)); 
	}

</script>

</body>
</html>
