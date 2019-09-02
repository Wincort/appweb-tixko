<?php
include_once('admin/classes/BO.php');
$oWEB = new PaginaWEB();
$Org=$oWEB->TraerOrganigrama();
$RutaImg=$Org[0]['imagen'];

include_once('admin/contadorweb.php');
$page_name="Organigrama";
visitante($page_name);

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Organigrama</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="lib/bootstrap/3.3.7/css/bootstrap.min.css">
  
  <script src="js/jquery/3.4.1/jquery.min.js"></script>
  <script src="lib/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  
  <link rel="stylesheet" href="css/Fuentes.css">
  <link rel="stylesheet" href="css/Navegador-Footer.css">
  
  <style>
    #Titulo {
        font-family: Soberana Sans Bold;
        text-align: center;
        margin-bottom: 1rem;
        margin-top: 1rem;
    }
	  
	#DivOrganigrama{
		  margin-bottom: 2rem;
	}  
   
    #DivOrganigrama img{
        border: 0.5rem solid #327522;
    }

    @media(min-width:435px) {
        #Titulo {
            font-size: 6rem;
        }
    }
  </style>

</head>
<body>

<?php include("Navegador.php");?>

<div class="container-fluid">
    <h1 id="Titulo"><b>ORGANIGRAMA</b></h1>
    <div id="DivOrganigrama" class="col-sm-12">
        <img src="admin/cat_organigrama/multimedia/imagen/<?=$RutaImg;?>" class="img-responsive" style="margin: auto;width: 100%;" alt="Organigrama" onerror="this.onerror=null;this.src='images/Logo.jpg';">
    </div>
</div>

<?php include("Footer.php"); ?>

</body>
</html>
