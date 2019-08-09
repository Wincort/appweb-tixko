<?php
    include_once('admin/classes/BO.php');
    $oWEB = new PaginaWEB();
    $Cabildo= new PaginaWeb();
    $ListaCabildo=$Cabildo->TraerCabildo();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Cabildo</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="lib/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="css/Fuentes.css">
	<link rel="stylesheet" href="css/Navegador-Footer.css">
	<link rel="stylesheet" href="css/Cabildo.css">

	<script src="js/jquery/3.4.1/jquery.min.js"></script>
	<script src="lib/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</head>
<body>

<?php include("Navegador.php"); ?>
<h1 id="Titulo"><b>CABILDO</b></h1>
<div class="container">
<div class="container">
        <div class="row">
            <div id="divCabildo"></div>
        </div>
    </div>
</div>
<?php include("Footer.php"); ?>

<script>

    var ar = <?php echo json_encode($ListaCabildo) ?>;

    $(document).ready(function() {

        GenerarContenido();

        $(window).resize(function() {
            //CambiarClaseColumnas();
            AjustarAlturaDeFichas();
        }).resize();
    });

    let GenerarContenido = () => {
		for(let i in ar){
            let IdCabildo=ar[i].Id;
            let Nombre=decode_utf8(ar[i].nombre);
			let Puesto=decode_utf8(ar[i].puesto);
            let DirectorioImg=`admin/cat_cabildo/multimedia/imagen/${ar[i].archivo}`;
            let Email=ar[i].email!=""?ar[i].email:"---";
            let Orden=ar[i].orden;
            let ClaseFicha=Orden!=1?"Ficha-Cabildo":"FichaPrincipal";
            let ColFicha=Orden!=1?"col-sm-6":"col-sm-12";

            let StringHTML=`
            <div class="${ClaseFicha} ${ColFicha} col-xs-12">
                <div class="half-circle"><img src="${DirectorioImg}" class="img-cirlce centrado" onerror="this.onerror=null;this.src='images/img_avatar2.png';"></div>
                <div class="cuadrogris"></div>
                <div class="Info-Cabildo">
                    <h4><b>Nombre: </b>${Nombre}</h4>
                    <h4><b>Cargo: </b>${Puesto}</h4>
                    <h4><b>Email: </b>${Email}</h4>
                </div>
            </div>
			`;
			$(StringHTML).appendTo(`#divCabildo`);
		}
	}

    function decode_utf8(s) { 
		return decodeURIComponent(escape(s)); 
	}

    function AjustarAlturaDeFichas() {
        $(".cuadrogris").height("auto");
        let MaximaAltura = 0;
        $(".Info-Cabildo").each(function(index) {
            if (index >= 0) {
                let AlturaFichaCabildo = $(this).height();
                MaximaAltura = (AlturaFichaCabildo > MaximaAltura) ? AlturaFichaCabildo : MaximaAltura;
            }
        });
        $(".cuadrogris").height(MaximaAltura + 20);
    }

    function CambiarClaseColumnas(){
        let BrowserWidth = $(window).width();
        let FichaCabildo=$(".Ficha-Cabildo");

        if(BrowserWidth<992){
            FichaCabildo.removeClass("col-sm-6");
            FichaCabildo.addClass("col-sm-12");
        }
        else{
            FichaCabildo.removeClass("col-sm-12");
            FichaCabildo.addClass("col-sm-6");
        }
    }

    
</script>

</body>
</html>
