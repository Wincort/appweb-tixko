<?php
    include_once('admin/classes/BO.php');
    $oWEB = new PaginaWEB();
    $Directorio= new PaginaWeb();
    $ListaDirectorio=$Directorio->TraerDirectorio();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Directorio</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="lib/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="css/Fuentes.css">
	<link rel="stylesheet" href="css/Navegador-Footer.css">
	<link rel="stylesheet" href="css/Directorio.css">

	<script src="js/jquery/3.4.1/jquery.min.js"></script>
	<script src="lib/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</head>
<body>

<?php include("Navegador.php"); ?>

<div class="container">
	<h1 id="Titulo"><b>DIRECTORIO</b></h1>
	<div class="row row-directorio">
		<div class="col-sm-6">
			<div class="panel-group" id="accordion1"></div> 
		</div>
		<div class="col-sm-6">
			<div class="panel-group" id="accordion2"></div>
		</div>			
	</div>
</div>

<?php include("Footer.php"); ?>

<script>

    let ListaDirectorio = <?php echo json_encode($ListaDirectorio) ?>;

    $(document).ready(function() {
		GenerarContenido();
		$(window).resize(function() {
            //AjustarAltura();
        }).resize();
    });
	let contador=0;
    let GenerarContenido = () => {
		for(let i in ListaDirectorio){
			contador++;
			let IdDirectorio=ListaDirectorio[i].Id;
			let Unidad=decode_utf8(ListaDirectorio[i].unidad!=""?ListaDirectorio[i].unidad:"---");
            let Nombre=decode_utf8(ListaDirectorio[i].nombre!=""?ListaDirectorio[i].nombre:"---");
			let Telefono=decode_utf8(ListaDirectorio[i].telefono!=""?ListaDirectorio[i].telefono:"---");
			let Email=decode_utf8(ListaDirectorio[i].email!=""?ListaDirectorio[i].email:"---");
			let accordion=contador%2!=0?"#accordion1":"#accordion2";
            let StringHTML=`
            <div class="panel panel-default">
				<div class="panel-heading" data-toggle="collapse" data-parent="${accordion}" href="#collapse${IdDirectorio}">
					<h2 class="Subtitulo">${Unidad}</h2>
				</div>
				<div id="collapse${IdDirectorio}" class="panel-collapse collapse">
					<div class="table-responsive">     
						<table class="table table-condensed">
							<tbody>
								<tr><td width="20%">Nombre</td><td>${Nombre}</td></tr>
								<tr><td width="20%">Email</td><td>${Email}</td></tr>
								<tr><td width="20%">Teléfono</td><td>${Telefono}</td></tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			`;
			$(StringHTML).appendTo(`${accordion}`);
		}
	}

    function decode_utf8(s) { 
		return decodeURIComponent(escape(s)); 
	}

	let AjustarAltura = () => {
        $(".Subtitulo").height("auto");
        let MaximaAltura = 0;
        $(".Subtitulo").each(function(index) {
            let AlturaActual = $(this).height();
            MaximaAltura = (AlturaActual > MaximaAltura) ? AlturaActual : MaximaAltura;
        });
        $(".Subtitulo").height(MaximaAltura);
    }

</script>

</body>
</html>
