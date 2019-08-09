<?php
	include_once('admin/classes/Paginacion.php');
	include_once('admin/classes/BO.php');
	$oWEB = new PaginaWEB();
	
	$CantidadFilas = 5;
    $Pagina = new Paginacion($CantidadFilas);
	$Boletines = new PaginaWEB();
    $CantidadResultados = $Boletines->TraerCuentaBoletines();
    $Pagina->set_CantidadFilas($CantidadResultados);
    $FilaInicial = $Pagina->get_FilaInicial();
    $ListaBoletines= $Boletines->TraerBoletines($FilaInicial,$CantidadFilas);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Boletines</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="lib/bootstrap/3.3.7/css/bootstrap.min.css">
  
  <script src="js/jquery/3.4.1/jquery.min.js"></script>
  <script src="lib/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  
  <link rel="stylesheet" href="css/Fuentes.css">
  <link rel="stylesheet" href="css/Navegador-Footer.css">
  <link rel="stylesheet" href="css/Boletines.css">

</head>
<body>

<?php include("Navegador.php"); ?>
<h1 id="Titulo"><b>BOLETINES</b></h1>
<div class="container">
	<section id="Resultados" class="col-xs-12 col-sm-12 col-md-12"></section>
	<ul class="pagination pagination-lg"><?php $Pagina->MostrarLinksPaginas(); ?></ul>
</div>

<?php include("Footer.php"); ?>

<script type="text/javascript">

var ar = <?php echo json_encode($ListaBoletines) ?>;

for(let i in ar){
	let IdBoletin=ar[i].id;
	let Titulo=ar[i].titulo;
	let Contenido=ar[i].contenido;
	let RutaImg=ar[i].imagen;
	let FechaPub=ar[i].FechaPublicacion;
	let HoraPub=ar[i].HoraPublicacion;
	let URLArchivo=`admin/cat_boletines/${RutaImg}`;
	let StringHTML=`
	<article class="search-result row">
		<div class="col-xs-12 col-sm-12 col-md-3"><a href="Pagina.php?id=${IdBoletin}" class="thumbnail"><img src="${URLArchivo}"/></a></div>
			<div class="col-xs-12 col-sm-12 col-md-9 excerpet">
                <h3><a href="Pagina.php?id=${IdBoletin}">${Titulo}</a></h3>
                <ul class="meta-search">
					<li><i class="glyphicon glyphicon-calendar"></i> <span>${FechaPub}</span></li>
					<li><i class="glyphicon glyphicon-time"></i> <span>${HoraPub}</span></li>
				</ul>
				${Contenido}...
		</div>
	</article>
	`
	$(StringHTML).appendTo(`#Resultados`);
}

</script>

</body>
</html>
