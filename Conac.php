<?php
include_once('admin/classes/BO.php');
$oWEB = new PaginaWEB();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>CONAC</title>
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

<div class="conac container-fluid ">
	<table class="">
		<tbody>
		  <tr>
			<td class="ColConacImg"><img src="images/CONAC BCO.png" class="img-responsive" style="margin:auto;" alt="Image"></td>
			<td class="ColConacTitulo"><p>MUNICIPIOS CON SISTEMA SIMPLIFICADO GENERAL (SSG) CON POBLACIÓN ENTRE CINCO MIL A VEINTICINCO MIL HABITANTES</p>
			<b>GUÍA DE CUMPLIMIENTO DE LA LGCG Y LOS DOCUMENTOS EMITIDOS POR EL CONAC</b></td>
		  </tr>
		</tbody>
	</table>
</div>
<div class="inner-content">
	<div class="container">
		<h1 id="Titulo"><b>CONAC</b></h1>
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
						$GrupoPeriodo = $oWEB->TraerListaCONAC_ConPeriodo($elemento['id']);
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

<div class="container-fluid ListaDoc">
	<div class="row">
		<?php
			$ListaConac = $oWEB->TraerListaCONAC_SinPeriodo();
			$conteo=0;$i=0;
			$TotalRegistros=count($ListaConac);
			if($TotalRegistros>0){
				$MaximoColumna=ceil($TotalRegistros/3);
				foreach($ListaConac as $elemento){
					$conteo++;$i++;
					echo $elemento['Id'];			
					if($conteo==1){echo '<div class="col-sm-4"><ul>';}		
					if($conteo<=$MaximoColumna){	
		?>				           
		<li><a onclick="PintarModal('modalListaPeriodos'); UpdateModalUrl(<?=$elemento['id'];?>,'<?=$elemento['registro'];?>');return false;"><?=$elemento['registro'];?></a></li>			
		<?php
					}
					
					if($conteo==$MaximoColumna || $i==$TotalRegistros){echo '</ul></div>'; $conteo=0;}
				}
			}
		?>
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
