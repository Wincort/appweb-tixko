<?php
include_once("../classes/database.php");
include_once("../classes/login.php");
$membership = new Login();
$membership->confirm_Member(); 
$db = new Database();
$db -> connect();
$opc=$_REQUEST['t'];
$IdRegistro=intval($_REQUEST['n']);
$LigaTipoArchivo='';

$sql="SELECT * FROM cat_lista_transparencia where id = '$IdRegistro' limit 1";
$resReg = mysql_query ($sql);
if($resReg){
	$rowReg=mysql_fetch_array($resReg);
	$LigaTipoArchivo=$rowReg['dirRegistroPagina'];
}


switch ($opc){
	case 'tb': ?>
		<table cellspacing="0" cellpadding="0" border="0" id="tblImagenes">
			<col width="25%">
			<col width="25%">
			<col width="25%">
			<col width="25%">
			
			<?php
			$SQL="SELECT * FROM cat_lista_transparencia_detalles where IdRegistro = '$IdRegistro'";
			$res = mysql_query ($SQL);
			$cont = 0;
			if($res){
				if(mysql_num_rows($res) > 0){
					while($row=mysql_fetch_array($res)){
						$tipo=$row['tipo'];
						$archivo=$row['archivo'];
						if($tipo=="IMAGEN"){
							$ruta_imagen='multimedia/imagen/'.$archivo; 
							$URLVisual=$LigaTipoArchivo.'imagen/';
						}
						if($tipo=="AUDIO"){
							$ruta_imagen='../imagen/mp3.png'; 
							$URLVisual=$LigaTipoArchivo.'audio/';	
						}				
						if($tipo=="VIDEO"){ 
							$ruta_imagen='../imagen/mp4.png'; 
							$URLVisual=$LigaTipoArchivo.'video/';
						}
						if($tipo=="DOCTO"){
							$ruta_imagen='../imagen/pdf.png';
							 $URLVisual=$LigaTipoArchivo.'documentos/';
						}					
						$titulo=$row['titulo'];
						$id=$row['IdRegistroDetalle'];
						
						if($tipo=="IMAGEN"){
							$clase="photo_layout_no_pub";
							if($row['publicar']=='SI') $clase="photo_layout";							
						}
						else{
							$clase="icon_no_pub";
							if($row['publicar']=='SI') $clase="icon_pub";							
						}
						
						$LigaArchivo=$URLVisual.$archivo;

						
						if($cont == 0) { ?>
						<tr>
							<td>
								<div class="<?=$clase?>">
                                	<table width="100%" height="100%">
                                    <tr>
                                    	<td width="100%" height="100%" valign="middle">
											<?=$archivo?><br />
                                            <img title="<?=$titulo?>" src="<?=$ruta_imagen?>">
	                                    </td>
                                    </tr>
                                    </table>
								</div>
								<div class="aciones">
									<a onclick="return GB_showCenter('Editar Archivo', this.href, 350, 650);" href="pagina.subir.archivo.php?opc=UPD&id=<?=$id?>&not=<?=$IdRegistro?>&tipo=<?=$tipo?>">Editar</a>&nbsp;
									<a href="javascript:deleteImage(<?=$id?>);">Eliminar</a>
									<a href="<?=$LigaArchivo?>" target="_blank">Ver</a>&nbsp;

								</div>
							</td>
						
						<?php
							$cont++;
						}
						else if($cont == 3){ ?>
							<td>
								<div class="<?=$clase?>">
                                	<table width="100%" height="100%">
                                    <tr>
                                    	<td width="100%" height="100%" valign="middle">
											<?=$archivo?><br />
                                            <img title="<?=$titulo?>" src="<?=$ruta_imagen?>">
	                                    </td>
                                    </tr>
                                    </table>
								</div>
								<div class="aciones">
									<a onclick="return GB_showCenter('Editar Archivo', this.href, 350, 650);" href="pagina.subir.archivo.php?opc=UPD&id=<?=$id?>&not=<?=$IdRegistro?>&tipo=<?=$tipo?>">Editar</a>&nbsp;
									<a href="javascript:deleteImage(<?=$id?>);">Eliminar</a>
									<a href="<?=$LigaArchivo?>" target="_blank">Ver</a>&nbsp;
                                    
								</div>
							</td>
						</tr>
						<?php
							$cont=0;
						}
						else { ?>
							<td>
								<div class="<?=$clase?>">
                                	<table width="100%" height="100%">
                                    <tr>
                                    	<td width="100%" height="100%" valign="middle">
											<?=$archivo?><br />
                                            <img title="<?=$titulo?>" src="<?=$ruta_imagen?>">
	                                    </td>
                                    </tr>
                                    </table>
								</div>
								<div class="aciones">
									<a onclick="return GB_showCenter('Editar Archivo', this.href, 350, 650);" href="pagina.subir.archivo.php?opc=UPD&id=<?=$id?>&not=<?=$IdRegistro?>&tipo=<?=$tipo?>">Editar</a>&nbsp;
									<a href="javascript:deleteImage(<?=$id?>);">Eliminar</a>
									<a href="<?=$LigaArchivo?>" target="_blank">Ver</a>&nbsp;
								</div>                                
							</td>
						<?php
							$cont++;
						}
					}
					if($cont < 4){
						for($i=0;$i<(4-$cont);$i++){ 
							if($i != (4-$cont)){ ?>
								<td>&nbsp;</td>
					   <?php }
							else{ ?>				
								<td>&nbsp;</td>
							</tr>
						<?php	}
						}
					}
				}
			}
			?>
		 </table>	
	<?php
		break;
	case 'del':
		$id=$_POST['id'];
		$Sql="delete from cat_lista_transparencia_detalles where IdRegistroDetalle=$id";
		$db -> begin();
		$res = $db -> openTransaction($Sql);
		if(!$res) 
		{	
			$db -> rollback();
			echo "ERROR|";
		}
		else{
			$db -> commit();
			echo "OK|";
		}
		break;
}
?>