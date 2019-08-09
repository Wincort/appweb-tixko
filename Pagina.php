<?php
error_reporting(0);
include_once('admin/classes/BO.php');
$oWEB = new PaginaWEB();
$IdPagina=$_REQUEST['id'];
$Boletin = $oWEB->TraerPaginaBoletin($IdPagina);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>H. Ayuntamiento de Tixkokob</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="lib/bootstrap/3.3.7/css/bootstrap.min.css">
  
  <script src="js/jquery/3.4.1/jquery.min.js"></script>
  <script src="lib/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  
  <link rel="stylesheet" href="css/Fuentes.css">
  <link rel="stylesheet" href="css/Navegador-Footer.css">
  <link rel="stylesheet" href="css/Pagina.css">

</head>
<body>

<?php include("Navegador.php"); ?>

<div id="BodyPagina"></div>

<?php include("Footer.php"); ?>
<script type="text/javascript">
    const ar = <?php echo json_encode($Boletin) ?>;
	let ExisteResultado=true;
	let StringHTML="";

    if(ar[0]==undefined) ExisteResultado=false;

	if(ExisteResultado){
		let IdBoletin=ar[0].id;
		let Titulo=ar[0].titulo;
		let Contenido=ar[0].contenido;
		let RutaImg=ar[0].imagen;
		let FechaPub=ar[0].FechaPublicacion;
		let HoraPub=ar[0].HoraPublicacion;
		let URLArchivo=`admin/cat_boletines/${RutaImg}`;
	
		StringHTML=`
		<h1 id="Titulo">${Titulo}</h1>
		<div class="container">   
			<div class="row">
				<div class="col-sm-12">
					<div class="Subtitulo">
						<!--<h2>${Titulo}</h2>-->
						<h4><ul class="meta-search fechapub">
							<li><i class="glyphicon glyphicon-calendar"></i> <span>${FechaPub}</span></li>
							<li><i class="glyphicon glyphicon-time"></i> <span>${HoraPub}</span></li>
					</ul></h4>
					</div>
					<div class="Contenido">
					<h3>
					${Contenido}
					</h3>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-3"></div>
				<div class="col-sm-6"><div class="ImagenPagina"><img src="${URLArchivo}" class="img-responsive"></div></div>
				<div class="col-sm-3"></div>
			</div>
		</div>`;
	}
	else{
		StringHTML=`
		<div class="container errorContenido">   
			<div class="row">
				<div class="col-sm-12">
					<div class="Titulo">
						<h1>Página Inválida</h1> 
					</div>
				</div>
			</div>
		</div>`;
	}

    $(StringHTML).appendTo(`#BodyPagina`);

</script>
</body>
</html>
