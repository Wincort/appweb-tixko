<?php
include_once('admin/classes/BO.php');
$ListaFiles = new PaginaWEB();

$id=$_REQUEST['Id'];

$Lista = $ListaFiles->TraerEnlacesCONAC($id);
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Bootstrap Example</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="lib/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="js/jquery/3.4.1/jquery.min.js"></script>
	<script src="lib/bootstrap/3.3.7/js/bootstrap.min.js"></script>

	<link rel="stylesheet" href="css/Fuentes.css">

	<style>
		.Subtitulo,#MensajeEmpty,#MensajeInicio{
			font-family: Soberana Sans Bold;
    		text-align: center;
		}
		#MensajeEmpty,#MensajeInicio{
			transform: translateY(20vh);
		}
		#MensajeEmpty{
			color:red;
		}
		#MensajeInicio{
			color:#327522;
		}
		.list-group{
			font-family: CA Geheimagent;
    		letter-spacing: 0.05rem;
			font-size: x-large;
			padding-top: 3rem;
		}
		.list-group a{
			color: black;
		}
		.list-group a:hover{
			color: white;
			text-decoration:none;
			background-color:#327522;
		}
		.nav-tabs{
			font-family: Tahoma;
		}
		.nav-tabs a{
			color: #327522;
		}
		.nav-tabs a:hover{
			color: black;
		}
		li .active{
			background:blue;
		}

		.nav-tabs li.active a, .nav-tabs li.active a:focus .nav-tabs li.active a:hover{
			color:white !important;
			background-color:#327522 !important;
		}
		.nav-tabs li {
			float:none;
			display:inline-block;
			zoom:1;
		}

		.nav-tabs {
			text-align:center;
		}
	
		
	</style>

</head>

<body>

<div class="container">
  <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#Tab0">Inicio</a></li>
    <li><a data-toggle="tab" href="#Tab1">Enero</a></li>
    <li><a data-toggle="tab" href="#Tab2">Febrero</a></li>
    <li><a data-toggle="tab" href="#Tab3">Marzo</a></li>
    <li><a data-toggle="tab" href="#Tab4">Abril</a></li>
    <li><a data-toggle="tab" href="#Tab5">Mayo</a></li>
    <li><a data-toggle="tab" href="#Tab6">Junio</a></li>
    <li><a data-toggle="tab" href="#Tab7">Julio</a></li>
    <li><a data-toggle="tab" href="#Tab8">Agosto</a></li>
    <li><a data-toggle="tab" href="#Tab9">Septiembre</a></li>
    <li><a data-toggle="tab" href="#Tab10">Octubre</a></li>
    <li><a data-toggle="tab" href="#Tab11">Noviembre</a></li>
    <li><a data-toggle="tab" href="#Tab12">Diciembre</a></li>
  </ul>
 
  <div class="tab-content">
	<div id="Tab1" class="tab-pane fade in"><h1 class="Subtitulo">Enero</h1><div id="Ul1" class="list-group"></div></div>
	<div id="Tab2" class="tab-pane fade in"><h1 class="Subtitulo">Febrero</h1><div id="Ul2" class="list-group"></div></div>
	<div id="Tab3" class="tab-pane fade in"><h1 class="Subtitulo">Marzo</h1><div id="Ul3" class="list-group"></div></div>
	<div id="Tab4" class="tab-pane fade in"><h1 class="Subtitulo">Abril</h1><div id="Ul4" class="list-group"></div></div>
	<div id="Tab5" class="tab-pane fade in"><h1 class="Subtitulo">Mayo</h1><div id="Ul5" class="list-group"></div></div>
	<div id="Tab6" class="tab-pane fade in"><h1 class="Subtitulo">Junio</h1><div id="Ul6" class="list-group"></div></div>
	<div id="Tab7" class="tab-pane fade in"><h1 class="Subtitulo">Julio</h1><div id="Ul7"class="list-group"></div></div>
	<div id="Tab8" class="tab-pane fade in"><h1 class="Subtitulo">Agosto</h1><div id="Ul8"class="list-group"></div></div>
	<div id="Tab9" class="tab-pane fade in"><h1 class="Subtitulo">Septiembre</h1><div id="Ul9" class="list-group"></div></div>
	<div id="Tab10" class="tab-pane fade in"><h1 class="Subtitulo">Octubre</h1><div id="Ul10" class="list-group"></div></div>
	<div id="Tab11" class="tab-pane fade in"><h1 class="Subtitulo">Noviembre</h1><div id="Ul11" class="list-group"></div></div>
	<div id="Tab12" class="tab-pane fade in"><h1 class="Subtitulo">Diciembre</h1><div id="Ul12"class="list-group"></div></div>
	
	<div id="Tab0" class="tab-pane fade in active">
		<h2 id="MensajeInicio">¡Bienvenido(a)!<br><br>Seleccione un mes para acceder al contenido</h2>
		<div id="Ul0" class="list-group"></div>
	</div>
	
  </div>
</div>
<script type="text/javascript">

var ar = <?php echo json_encode($Lista) ?>;
var ArrayIdMeses=[];
console.table(ar);

for(let i in ar){
	
	let UlTagId=`Ul${ar[i].mes}`;
	let TipoArchivo=ar[i].tipo;
	let Directorio=ar[i].dirRegistroPagina;
	let URLVisual='';
	
	switch(TipoArchivo){
		case 'IMAGEN': URLVisual=`admin/cat_lista_transparencia/${Directorio}/imagen/`; break;
		case 'AUDIO': URLVisual=`admin/cat_lista_transparencia/${Directorio}/audio/`; break;
		case 'DOCTO': URLVisual=`admin/ViewerJS/?zoom=page-width#../cat_lista_transparencia/${Directorio}/documentos/`; break;
		default: break;
	}
	
	let URLArchivo=`${URLVisual}/${ar[i].archivo}`;
	let LinkHTML=`<a class="list-group-item" href="${URLArchivo}">${ar[i].titulo}</a>`;
	
	$(LinkHTML).appendTo(`#${UlTagId}`);
	
	ArrayIdMeses.push(ar[i].mes);
	
}

console.table(ArrayIdMeses);

let TabActual=1;
let MensajeVacio='<h2 id="MensajeEmpty">Sin documentos disponibles</2>';
let resultado=ArrayIdMeses.find(FindZero);

if(resultado!=undefined || ArrayIdMeses.length==0){
	$('.nav-tabs').css('display','none');
	$('#MensajeInicio').css('display','none');
	TabActual=0;
}

while(TabActual<=12){
	let indice=`#Ul${TabActual}`;
	if (isEmpty($(indice))) {		
		$(MensajeVacio).appendTo(indice);		
	}
	TabActual++;
}

function FindZero(x) {
  return x == 0;
}

function isEmpty(elemento){
	return !$.trim(elemento.html());
}

</script>
</body>
</html>
