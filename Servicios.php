<?php
	include_once('admin/classes/Paginacion.php');
	include_once('admin/classes/BO.php');
	$oWEB = new PaginaWEB();

	$query = $_REQUEST['s'];
	$query = htmlspecialchars($query); 
	
	$CantidadFilas = 10;
    $Pagina = new Paginacion($CantidadFilas);
	$Tramites = new PaginaWEB();
    $CantidadResultados = $Tramites->TraerCuentaTramitesBusqueda($query);
    $Pagina->set_CantidadFilas($CantidadResultados);
    $FilaInicial = $Pagina->get_FilaInicial();
	$ListaTramites= $Tramites->TraerTramitesBusqueda($query,$FilaInicial,$CantidadFilas);
	
	include_once('admin/contadorweb.php');
	$page_name="Trámites y Servicios";
	visitante($page_name);

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Servicios</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="lib/bootstrap/3.3.7/css/bootstrap.min.css">
  
  <script src="js/jquery/3.4.1/jquery.min.js"></script>
  <script src="lib/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  
  <link rel="stylesheet" href="css/Fuentes.css">
  <link rel="stylesheet" href="css/Navegador-Footer.css">
  <link rel="stylesheet" href="css/Servicios.css">

</head>
<body>

<?php include("Navegador.php"); ?>
<h1 id="Titulo"><b>SERVICIOS</b></h1>
<div class="container">
	
	<form action="Servicios.php" autocomplete="off" class="search-form">
		<div class="input-group">         
			<input id="BuscadorTramites" type="text" class="form-control" placeholder="Buscar" name="s">
			<div class="input-group-btn">
				<button class="btn" type="submit" id="BotonIconoBuscadorTramites">
					<i class="IconoBuscadorTramites"></i>
				</button>
			</div>			                 
		</div>
	</form>
	<h3 class="lead"><strong>Hay <?=$CantidadResultados?> trámites/servicios</strong></h3>
	<section id="Resultados" class="col-xs-12 col-sm-12 col-md-12"></section>
	<ul class="pagination pagination-lg"><?php $Pagina->MostrarLinksPaginasBuscador("s=".$query); ?></ul>
</div>

<?php include("Footer.php"); ?>

<script type="text/javascript">

	const ListaTramites = <?php echo json_encode($ListaTramites) ?>;
    let ExisteResultado=true;
    let StringHTML="";

    if(ListaTramites.length==0) ExisteResultado=false;

    $(document).ready(function() {
		GenerarContenido(ExisteResultado);
    });

    let GenerarContenido = (ExisteResultado) => {
        if(ExisteResultado){
            for(let i in ListaTramites){
            	let {id:IdTramite, nombre, responsable:resp,descripcion:des, requisitos:req, presentacion:pres, tiempo, horario, costo, fundamento:fund, contacto, modulo}=ListaTramites[i];
	    
	            nombre=nombre!=""?nombre:"N/A";
	            resp=resp!=""?resp:"N/A";
	            des=des!=""?des:"N/A";
	            req=req!=""?req:"N/A";
	            pres=pres!=""?pres:"N/A";
	            tiempo=tiempo!=""?tiempo:"N/A";
	            horario=horario!=""?horario:"N/A";
	            costo=costo!=""?costo:"N/A";
	            fund=fund!=""?fund:"N/A";
	            contacto=contacto!=""?contacto:"N/A";
	            modulo=modulo!=""?modulo:"N/A";
	    
	            StringHTML=`
				<article class="search-result row">
					<div class="col-xs-12 col-sm-12 col-md-12 excerpet">
						<h3><a href="Tramite.php?id=${IdTramite}">${nombre}</a></h3>
						<ul class="meta-search">
							<li><i class="glyphicon glyphicon-bookmark"></i><b>Área responsable: </b><span>${resp}</span></li>
							<li><i class="glyphicon glyphicon-file"></i><b>Presentación: </b><span>${pres}</span></li>
						</ul>
					</div>
				</article>
	           `;
			   $(StringHTML).appendTo(`#Resultados`);
            }
        }
        else{
            StringHTML=`
            <div class="errorContenido">   
                <div class="row">
                    <div class="col-sm-12">
                        <div class="Titulo">
                            <h1>No hay trámites o servicios con los criterios de búsqueda ingresados</h1>
                        </div>
                    </div>
                </div>
            </div>`;
			$(StringHTML).appendTo(`#Resultados`);
        }
        
    }
	
</script>

</body>
</html>
