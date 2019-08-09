<?php 
    error_reporting(0);
    include_once('admin/classes/Paginacion.php');
	include_once('admin/classes/BO.php');
	
	$query = $_REQUEST['s'];
	
	$query = htmlspecialchars($query); 
	// changes characters used in html to their equivalents, for example: < to &gt; 
	
	//$query = mysql_real_escape_string($query);
	// makes sure nobody uses SQL injection

	$CantidadFilas = 10;
	$oWEB = new PaginaWEB();
	
	if (!empty($query)){
		$Pagina = new Paginacion($CantidadFilas);
		$Buscador = new PaginaWEB();
		$CantidadResultados = $Buscador->TraerCuentaResultados($query);
		if ($CantidadResultados>0){
			$Pagina->set_CantidadFilas($CantidadResultados);
			$FilaInicial = $Pagina->get_FilaInicial();
			$ResultadosQuery= $Buscador->TraerResultados($query,$FilaInicial,$CantidadFilas);
		}
	}
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Resultados</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="lib/bootstrap/3.3.7/css/bootstrap.min.css">
  
  <script src="js/jquery/3.4.1/jquery.min.js"></script>
  <script src="lib/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  
  <link rel="stylesheet" href="css/Fuentes.css">
  <link rel="stylesheet" href="css/Navegador-Footer.css">
  <link rel="stylesheet" href="css/search.css">

</head>
<body>

<?php include("Navegador.php"); ?>

<div class="container">
    <div class="Cabecera">
	<?php if (!empty($query)){?>
		<h1>Resultados de Búsqueda</h1>
		<h2 class="lead"><strong class="text-danger"><?=$CantidadResultados?></strong> resultados fueron encontrados para <strong class="text-danger"><?=$query?></strong></h2>								
	<?php }else{ ?>	
		<h1>Buscador</h1>
		<h2 class="lead">Ingrese en el buscador el término que desea encontrar.</h2>
	<?php }?>
		<form action="search.php" autocomplete="off" class="search-form">
			<div class="input-group">         
				<input id="BuscadorInicio" type="text" class="form-control" placeholder="Buscar" name="s">
				<div class="input-group-btn">
					<button class="btn" type="submit" id="BotonIconoBuscadorInicio">
						<i class="IconoBuscadorInicio"></i>
					</button>
				</div>			                 
			</div>
		</form>
	</div>
	<?php if (!empty($query)){
		if ($CantidadResultados>0){ ?>
    <section id="Resultados" class="col-xs-12 col-sm-12 col-md-12"></section>
	<ul class="pagination pagination-lg"><?php $Pagina->MostrarLinksPaginasBuscador("s=".$query); ?></ul>
	<?php } } ?>	
</div>
</div>


<?php include("Footer.php"); ?>

<?php if (!empty($query)){
		if ($CantidadResultados>0){ ?>
<script type="text/javascript">

	let ar = <?php echo json_encode($ResultadosQuery) ?>;
	let query= "<?php echo $query;?>";

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
<?php } } ?>	
</body>
</html>
