<?php
include_once('admin/classes/BO.php');
$oWEB = new PaginaWEB();

include_once('admin/contadorweb.php');
$page_name="SEVAC";
visitante($page_name);

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>SEVAC</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="lib/bootstrap/3.3.7/css/bootstrap.min.css">

	<script src="js/jquery/3.4.1/jquery.min.js"></script>
	<script src="lib/bootstrap/3.3.7/js/bootstrap.min.js"></script>

	<link rel="stylesheet" href="css/Fuentes.css">
	<link rel="stylesheet" href="css/modal.css">
	<link rel="stylesheet" href="css/Navegador-Footer.css">
	<link rel="stylesheet" href="css/Transparencia.css">
	<script src="js/modal.js"></script>
</head>
<body>

<?php include("Navegador.php"); ?>

<div class="inner-content">
	<div class="container">
		<h1 id="Titulo"><b>SEVAC</b></h1>
		<div id="modalListaPeriodos" class="modal">
			<div class="modal-content">
				<span class="close">&times;</span>		
				<span id="BackButton" onclick="goBack();"><img style="float:left;cursor:pointer" src="admin/imagen/regresar.png" alt="Regresar" width="28" height="28" title="Regresar"><h5 style="float:left;margin:0.2rem;" id="TituloModal"></h5></span>
				<iframe class="" id='ListaURL' src='' onLoad="AddImgCSS();" ></iframe>
			</div>
		</div>
	
		<div class="row">	
			<?php
				$ListaPeriodos = $oWEB->TraerPeriodos();
				$TotalRegistros=count($ListaPeriodos);
				if($TotalRegistros>0){
					foreach($ListaPeriodos as $elemento){
						$GrupoPeriodo = $oWEB->TraerListaSEVAC($elemento['id']);
						$Total=count($GrupoPeriodo);
							if($Total>0){

			?>				           
				<div class="col-sm-6">	
					<div class="containertest">
						<img src="images/CARPETA.png" class="img-responsive" style="margin:auto;" alt="Image">
						<h2><b class="centered-subtitulo"><?=$elemento['nombre'];?></b></h2>
						<div class="text-block centered"> 
						<ul>
						<?php
								foreach($GrupoPeriodo as $el){	
						?>				           
								<li><a onclick="PintarModal('modalListaPeriodos'); UpdateModalUrl(<?=$el['id'];?>,'<?=$el['registro'];?>');return false;"><?=$el['registro'];?></a></li>			
						<?php
								}
							}
						?>
						</ul>
						</div>
					</div>
				</div>
			<?php
					}				
				}
			?>
		</div>
	</div>
</div>

<?php include("Footer.php"); ?>

<script>

function UpdateModalUrl(Id,NombreRegistro){
	console.log(Id,NombreRegistro);
	var link='ExploradorConac.php?Id='+Id;
	$('#ListaURL').attr('src',link);
	$('#TituloModal').html(NombreRegistro);	
	var instruccion=`goBack("${link}")`;
	$('#BackButton').attr('onclick',instruccion);
}

function goBack(location) {
	$('#ListaURL').attr('src',location);
}

function AddImgCSS(){
    $('iframe').contents().find("head").append($("<style type='text/css'>img {max-width: 100%;max-height: 100%;margin: auto;display: block;}</style>"));
}

</script>

</body>
</html>
