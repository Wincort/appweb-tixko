<?php
include_once('admin/classes/BO.php');
$oWEB = new PaginaWEB();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>INAIP</title>
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
    @media(min-width:435px) {
        #Titulo {
            font-size: 6rem;
        }
    }
    #EnlaceINAIP{
        border: 0.5rem solid #327522;
        margin-bottom: 2rem;
    }
  </style>

</head>
<body>

<?php include("Navegador.php"); ?>

<div class="container">
    <h1 id="Titulo"><b>INAIP</b></h1>
    <div id="EnlaceINAIP" class="embed-responsive embed-responsive-4by3">
        <iframe class="embed-responsive-item" src="http://tixkokob.transparenciayucatan.org.mx/"></iframe>
    </div>
</div>

<?php include("Footer.php"); ?>

</body>
</html>
