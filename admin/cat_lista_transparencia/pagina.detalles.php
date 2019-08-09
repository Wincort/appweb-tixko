<?php
	include_once("../classes/database.php");
	include_once("../classes/login.php");
	$membership = new Login();
	$membership->confirm_Member(); 
	$id=$_REQUEST['n'];

	$db = new Database();
	$db -> connect();

	$sql="SELECT * FROM cat_lista_transparencia where id = '$id' limit 1";
	$resReg = mysql_query ($sql);
	if($resReg){
		$rowReg=mysql_fetch_array($resReg);
		$registro=$rowReg['registro'];
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<link rel="stylesheet" type="text/css" href="../css/noticias.css" />
<script type="text/javascript" src="../script/jquery/jquery-2.1.3.min.js"></script> 

<script type="text/javascript">var GB_ROOT_DIR = "../script/greybox/";</script>
<script type="text/javascript" src="../script/greybox/AJS.js"></script>
<script type="text/javascript" src="../script/greybox/AJS_fx.js"></script>
<script type="text/javascript" src="../script/greybox/gb_scripts.js"></script>
<link href="../script/greybox/gb_styles.css" rel="stylesheet" type="text/css" />

<script type="text/javascript">
	$(document).ready(function() {
		cargaGaleria();
	});

	function deleteImage(id){
		if(confirm("Esta seguro de eliminar este archivo?")){
			$.ajax({
				url: "pagina.admin.detalles.php",
				type:'POST',
				data:'t=del&id='+String(id),
				dataType:'text',
				success: function (data, textStatus) {
					 var res = data.split("|");
					 if(res[0] == 'ERROR'){
						alert("Ocurrio un error al eliminar el achivo.\nPor favor intenta de nuevo.");
						return false;
					 }
					 else{
						cargaGaleria();
					 }
				 }
			});
		}
	}
	function cargaGaleria(){
		$('#lygaleria').load("pagina.admin.detalles.php?n=<?=$id?>&t=tb&rnd="+Math.random());
	}
	function actualizaGaleria(){
		cargaGaleria();
		GB_hide();
	}
</script>
</head>
<body>
	<div id="contenido">
		<div class="box">
		  <div class="left"></div>
		  <div class="right"></div>
		  <div class="heading">
          	<table style="margin-top:-6px;">
            	<tr>
                	<td>
                        <a href="index.php?pg=<?=$id?>">
                            <img src="../imagen/regresar.png" alt="Regresar" width="37" height="37" title="Regresar" border="0" />
                        </a>          
                    </td>
                    <td valign="middle">
                    	<h3>Publicar Archivo:: <?=$registro?></h3>
                    </td>
                </tr>
            </table>
          </div>
		  <div class="content">
			<style>
				table#tblImagenes{
					border:none;width:800px;
				}		
				table#tblImagenes td{
					vertical-align:middle;
				}	
				.photo_layout{
					margin:4px;padding:4px;border:2px solid #009900;background:#FFFFFF;text-align:center;
				}				
				.photo_layout img{
					width:140px;height:90px;
				}
				.photo_layout_no_pub{
					margin:4px;padding:4px;border:2px solid #FF0000;background:#FFFFFF;text-align:center;
				}				
				.photo_layout_no_pub img{
					width:140px;height:90px;
				}
				.icon_pub{
					margin:4px;padding:4px;border:2px solid #009900;background:#FFFFFF;text-align:center;height:100px;
				}
				.icon_no_pub{
					margin:4px;padding:4px;border:2px solid #FF0000;background:#FFFFFF;text-align:center;height:100px;
				}
				.aciones{
					margin-left:4px;margin-right:4px;
				}
            </style>	
            <div>
                <table style="width: 100%;">
                	<col width="150px" />
                	<col width="40px" />
                    <col width="40px" />
                    <col width="40px" />
                    <col width="40px" />
                    <tr> 
                    	<td valign="middle"><strong>Agregar Archivo:</strong></td>                       
                        <td align="center">
                            <a onclick="return GB_showCenter('Nuevo Documento', this.href, 450, 650);" href="pagina.subir.archivo.php?opc=ADD&not=<?=$id?>&tipo=DOCTO">
                            <img src="../imagen/pdf.png" border="0" title="Agregar Documento" alt="Agregar Documento" />
                            </a>
                        </td>
						<td align="center">
                            <a onclick="return GB_showCenter('Nuevo Archivo de Imagen', this.href, 450, 650);" href="pagina.subir.archivo.php?opc=ADD&not=<?=$id?>&tipo=IMAGEN">
                            <img src="../imagen/jpg.png" border="0" title="Agregar Archivo de Imagen" alt="Agregar Archivo de Imagen" />
                            </a>
                        </td>
						<td align="center">
                            <a onclick="return GB_showCenter('Nuevo Archivo de Audio', this.href, 450, 650);" href="pagina.subir.archivo.php?opc=ADD&not=<?=$id?>&tipo=AUDIO">
                            <img src="../imagen/mp3.png" border="0" title="Agregar Archivo MP3" alt="Agregar Archivo MP3"/>
                            </a>
                        </td>
                        <td align="center">
                            <!--<a onclick="return GB_showCenter('Nuevo Archivo de Video', this.href, 450, 650);" href="pagina.subir.archivo.php?opc=ADD&not=<?=$id?>&tipo=VIDEO">
                            <img src="../imagen/mp4.png" border="0" title="Agregar Archivo de Video" alt="Agregar Archivo de Video" />
                            </a>-->
                        </td>
                        <td>&nbsp;</td> 
                    </tr>
                </table>
            </div>           
            <div align="center" id="lygaleria"></div>            	          
          </div>
		</div>
	</div>
</body>
</html>
