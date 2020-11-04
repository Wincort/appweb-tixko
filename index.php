<?php
include_once('admin/classes/BO.php');

$oWEB = new PaginaWEB();
$ListaBoletines = $oWEB->TraerTop5Boletines();
$ListaBannerInicio = $oWEB->TraerBannerInicio();

include_once('admin/contadorweb.php');
$page_name="Inicio";
visitante($page_name);

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>H. Ayuntamiento de Tixkokob</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/Loader.css">
  <link rel="stylesheet" href="css/Fuentes.css">
  <link rel="stylesheet" href="lib/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/Navegador-Footer.css">
  <link rel="stylesheet" href="css/Inicio.css">
  <link rel="stylesheet" href="lib/swiper/dist/css/swiper.min.css">
</head>
<body>

<div class="loader-wrapper">
    <div class="lds-spinner"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
</div>

<?php include("Navegador.php"); ?>

<div id="menu" class="container-fluid">
    <ul class="nav nav-tabs nav-justified">
        <li id="LiTab1" class="Inicio active"><a class="menu"data-toggle="tab" href="#Inicio"><span>INICIO</span></a></li>
        <li id="LiTab2"><a class="menu" data-toggle="tab" href="#Municipio"><span>NUESTRO MUNICIPIO</span></span></a></li>
        <li id="LiTab3"><a class="menu" data-toggle="tab" href="#Ayuntamiento"><span>AYUNTAMIENTO</span></a></li>
        <li id="LiTab4"><a class="menu" data-toggle="tab" href="#Transparencia"><span>TRANSPARENCIA</span></a></li>
        <li id="LiTab5"><a class="menu" data-toggle="tab" href="#Contacto"><span>CONTACTO</span></a></li>
    </ul>
    <div class="tab-content container" style="padding: 1rem 0 0;">
        <div id="Inicio" class="tab-pane fade in active"></div>
        <div id="Municipio" class="tab-pane fade in">
            <div id="" class="list-group list-group-horizontal nav-justified">
                <a class="list-group-item IconoMenu" href="Historia.php">HISTORIA</a>
                <a class="list-group-item IconoMenu" href="Atractivos.php">ATRACTIVOS CULTURALES Y TURÍSTICOS</a>
            </div>
        </div>
        <div id="Ayuntamiento" class="tab-pane fade in">
            <div id="" class="list-group list-group-horizontal nav-justified">
                <a class="list-group-item IconoMenu" href="Mision-Vision-Valores.php">MISIÓN-VISIÓN-VALORES</a>
                <a class="list-group-item IconoMenu" href="Cabildo.php">CABILDO</a>
                <a class="list-group-item IconoMenu" href="Directorio.php">DIRECTORIO</a>
                <a class="list-group-item IconoMenu" href="Boletines.php">BOLETINES</a>
                <a class="list-group-item IconoMenu" href="Servicios.php">SERVICIOS</a>
                <a class="list-group-item IconoMenu" href="Organigrama.php">ORGANIGRAMA</a>
            </div>
        </div>
        <div id="Transparencia" class="tab-pane fade in"> 
            <div id="Link-Conac" class="list-group list-group-horizontal nav-justified">
                <a class="list-group-item IconoMenu" href="Conac.php">CONAC</a>
                <a class="list-group-item IconoMenu" href="INAIP.php">ARTÍCULO 70 Y 71</a>
                <a class="list-group-item IconoMenu" href="FAIS.php">FAIS</a>
                <a class="list-group-item IconoMenu" href="Gaceta.php">GACETA</a>
                <a class="list-group-item IconoMenu" href="SEVAC.php">SEVAC</a>
            </div>
        </div>
        <div id="Contacto" class="tab-pane fade in">
            <div id="" class="list-group list-group-horizontal nav-justified">
                <a class="list-group-item IconoMenu" href="Contacto.php">¡ENVÍANOS UN MENSAJE!</a>
            </div>
        </div>
    </div>
</div>
<div id="SeccionInicio" style="background: linear-gradient(0deg, #c7c7c7, transparent);">
    <div class="container" style="padding:2rem 0 2rem 0;">
        <div class="row">
            <div class="col-sm-8" style="margin-bottom: 3rem;">
                <!-- Swiper Banner 1-->
                <div id="Swiper1" class="swiper-container">
                    <div id="swiper-wraper-1" class="swiper-wrapper">
                        <div id="LoadSwiper1" class="swiper-slide">
                            <div style="background-image: url('images/Logo.jpg');" class="img-slide-principal"></div>
                        </div> 
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <!-- Swiper Banner 2-->
                <div id="Swiper2" class="swiper-container">
                    <div id="AnunciosSecundarios" class="swiper-wrapper"></div>
                    <div id="Swiper2Pagination" class="swiper-pagination swiper-pagination-white">
                        <div id="LoadSwiper2" class="swiper-slide">
                            <div style="background-image: url('images/Logo.jpg');" class="img-slide-principal"></div>
                        </div>
                    </div>
                </div>
                <!--Buscador-->
                <form action="search.php"  autocomplete="off" style="padding:3rem;">
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
        </div>
        <div class="row" style="padding:1rem 10rem;text-align:center;">
            <div class="col-sm-2 TextoIconoLink">
                <a href="Boletines.php">
                    <img src="images/ICONO 01.png" class="img-responsive center" alt="Image">
                    <br>ACTIVIDADES RECIENTES<br><br>
                </a>
            </div>
            <div class="col-sm-2 TextoIconoLink">
                <a href="Iniciativas.php">
                    <img src="images/ICONO 02.png" class="img-responsive center" alt="Image">
                    <br>INICIATIVAS SOCIALES<br><br>
                </a>
            </div>
            <div class="col-sm-2 TextoIconoLink">
                <a target="_blank" href="https://www.facebook.com/H-Ayuntamiento-de-Tixkokob-2018-2021-2159661087651617/">
                    <img src="images/ICONO 03.png" class="img-responsive center" alt="Image">
                    <br> REDES SOCIALES<br><br>
                </a>
            </div>
            <div class="col-sm-2 TextoIconoLink">
                <a href="Contacto.php">
                    <img src="images/ICONO 04.png" class="img-responsive center" alt="Image">
                    <br>ATENCIÓN CIUDADANA<br><br>
                </a>
            </div>
            <div class="col-sm-2 TextoIconoLink">
                <a href="Preguntas.php">
                    <img src="images/ICONO 05.png" class="img-responsive center" alt="Image">
                    <br>PREGUNTAS FRECUENTES<br><br>
                </a>
            </div>
            <div class="col-sm-2 TextoIconoLink">
                <a href="Emergencias.php">
                    <img src="images/ICONO 06.png" class="img-responsive center" alt="Image">
                    <br>NÚMEROS DE EMERGENCIA<br><br>
                </a>
            </div>
        </div>
    </div>
</div>

<?php include("Footer.php"); ?>

<script src="js/jquery/3.4.1/jquery.min.js"></script>
<script src="lib/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="lib/swiper/dist/js/swiper.min.js"></script>

<script>
    $(window).on("load",function(){
        $(".loader-wrapper").fadeOut("slow");
    });
</script>

<script>
    $(document).ready(function() {
        GenerarBannerInicio();
        GenerarBannerBoletin();
        $(window).resize(function() {
            AjustarAltura();
        }).resize();

        $('#menu [data-toggle="tab"]').click(function() {
        var $targetTabContent = $($(this).attr('href'));
        if ($targetTabContent.hasClass('active')) {
            $targetTabContent.removeClass('active');
        }
        else if (!$targetTabContent.hasClass('active')) {
            $targetTabContent.addClass('active');
        }       
        });
    });
</script>

<script>
    let ListaBanner = <?php echo json_encode($ListaBannerInicio) ?>;
    let ListaBoletin = <?php echo json_encode($ListaBoletines) ?>;

    let AjustarAltura = () => {
        $(".menu").height("auto");
        let MaximaAltura = 0;
        $(".menu").each(function(index) {
            let AlturaActual = $(this).height();
            MaximaAltura = (AlturaActual > MaximaAltura) ? AlturaActual : MaximaAltura;
        });
        $(".menu").height(MaximaAltura);
    }

    let GenerarBannerBoletin =() =>{
        for(let i in ListaBoletin){
            let IdBoletin=ListaBoletin[i].id;
            let URLPagina=`Pagina.php?id=${IdBoletin}`;
            let RutaImg=ListaBoletin[i].imagen;
            let URLArchivo=`admin/cat_boletines/${RutaImg}`;
            let StringHTML=`
            <div class="swiper-slide">
                <a href="${URLPagina}"><div style="background-image: url('${URLArchivo}');" class="img-slide-secundario"></div></a>
            </div>
            `
            $(StringHTML).appendTo(`#AnunciosSecundarios`);
            let swiper2 = new Swiper('#Swiper2', {
                zoom: false,loop: true,
                autoplay: {delay: 2500,disableOnInteraction: false,},
                keyboard: {enabled: true,},
                pagination: {el: '#Swiper2Pagination',},
            });
            $("#LoadSwiper2").remove();
        }
    }

    let GenerarBannerInicio = () =>{
        for(let i in ListaBanner){
            let InfoBanner= decode_utf8(ListaBanner[i].contenido);
            let ImgBanner=ListaBanner[i].imagen;
            let URLArchivo=`admin/cat_banner_inicio/multimedia/imagen/${ImgBanner}`;
            let StringHTML=`
            <div class="swiper-slide">
                <div class="carousel-caption bottom" >
                    <p>${InfoBanner}</p>
                </div>
                <div style="background-image: url('${URLArchivo}');" class="img-slide-principal"></div>
            </div>
             `
            $(StringHTML).appendTo(`#swiper-wraper-1`);
            let swiper1 = new Swiper('#Swiper1', {
                zoom: false,loop: true,
                autoplay: {delay: 5000,disableOnInteraction: false,},
                keyboard: {enabled: true,},
                effect: 'fade',
            });
            $("#LoadSwiper1").remove();
        }
    }

    function decode_utf8(s) { 
		return decodeURIComponent(escape(s)); 
	}
</script>

</body>
</html>
