<?php
    include_once('admin/classes/BO.php');
    $oWEB = new PaginaWEB();
    $Preguntas= new PaginaWeb();
	$ListaPreguntas=$Preguntas->TraerPreguntasFrecuentes();
	
	include_once('admin/contadorweb.php');
	$page_name="Preguntas Frecuentes";
	visitante($page_name);

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Preguntas Frecuentes</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="lib/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="css/Fuentes.css">
	<link rel="stylesheet" href="css/Navegador-Footer.css">
	<link rel="stylesheet" href="css/Preguntas.css">
</head>
<body>

<?php include("Navegador.php"); ?>

<div class="container">
	<h1 id="Titulo"><b>PREGUNTAS FRECUENTES</b></h1>
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

    let ListaPreguntas = <?php echo json_encode($ListaPreguntas) ?>;

    $(document).ready(function() {
		GenerarContenido();
    });
    let GenerarContenido = () => {
		for(let i in ListaPreguntas){

			let IdPregunta=ListaPreguntas[i].Id;
			let Pregunta=decode_utf8(ListaPreguntas[i].pregunta!=""?ListaPreguntas[i].pregunta:"---");
			let Respuesta=decode_utf8(ListaPreguntas[i].respuesta!=""?ListaPreguntas[i].respuesta:"---");

            let StringHTML=`
            <div class="panel panel-default">
				<div class="panel-heading" data-toggle="collapse" data-parent="#accordion" href="#collapse${IdPregunta}">
					<h2 class="Subtitulo">${Pregunta}</h2>
				</div>
				<div id="collapse${IdPregunta}" class="panel-collapse collapse">
					<p>${Respuesta}</p>
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
