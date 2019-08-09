<?php
    include_once('admin/classes/BO.php');
    $oWEB = new PaginaWEB();
    $Atractivos= new PaginaWeb();
    $ListaAtractivos=$Atractivos->TraerAtractivos();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Atractivos</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/Fuentes.css">
  <link rel="stylesheet" href="lib/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/Navegador-Footer.css">
  <link rel="stylesheet" href="css/Atractivos.css">

</head>
<body>

<?php include("Navegador.php"); ?>

    <div class="Header-Bkg"></div>
    <h1 id="Titulo">ATRACTIVOS CULTURALES Y TURÍSTICOS</h1>
    <div id="Atractivos" class="container"></div>

<?php include("Footer.php"); ?>

<script src="js/jquery/3.4.1/jquery.min.js"></script>
<script src="lib/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<script>

    let ListaAtractivos = <?php echo json_encode($ListaAtractivos) ?>;

    $(document).ready(function() {
		GenerarContenido();
    });
    let GenerarContenido = () => {
		for(let i in ListaAtractivos){
            let Nombre= decode_utf8(ListaAtractivos[i].nombre);
			let Contenido= decode_utf8(ListaAtractivos[i].contenido);
            let Img=ListaAtractivos[i].imagen;
            let URLArchivo=`admin/cat_atractivos/multimedia/imagen/${Img}`;
            let StringHTML=`
            <div class="Subtitulo">
                <h2>${Nombre}</h2>
            </div>   
            <div class="row seccion-atractivo">
                <div class="img-contenido col-sm-3 col-xs-12"><img src="${URLArchivo}" class="img-responsive" alt="Image"></div>
                <div class="Contenido col-sm-9 col-xs-12">
                    <h3>${Contenido}</h3>
                </div>
            </div>
             `
            $(StringHTML).appendTo(`#Atractivos`);
            
		}
	}

    function decode_utf8(s) { 
		return decodeURIComponent(escape(s)); 
	}

</script>

</body>
</html>
