<?php
error_reporting(0);
date_default_timezone_set('America/Mexico_City');
include_once("../classes/login.php");
include_once("../classes/database.php");
$membership = new Login();
$membership->confirm_Member();
$db = new Database();
$db -> connect();

$sql="SELECT * FROM cat_transparencia order by id asc";
$res = mysql_query ($sql);
if($res){ 
	$icont=0; ?>
	
    <table width="100%" border="0" cellspacing="1" cellpadding="1" id="tblistado" style="border:1px solid #CCCCCC; background:#FFFFFF">
        <tr style="height:30px;">
            <td width="20%" align="center" class="tabla_encabezado">Registro</td>
            <td width="50%" align="center" class="tabla_encabezado">Descripci&oacute;n</td>
            <td width="10%" align="center" class="tabla_encabezado">Publicado</td>
            <td width="10%" align="center" class="tabla_encabezado">+Archivo</td>         
            <td width="10%" align="center" class="tabla_encabezado">Editar</td>
        </tr>
        <?php while($row=mysql_fetch_array($res)){ 
		   	  $icont++; 
              $laclase=($icont%2==0?"fila_par":"fila_impar"); ?>
              <tr>
                <td class="<?=$laclase?>" valign="middle" align="left"><?=utf8_decode($row['registro'])?></td>
                <td class="<?=$laclase?>" valign="middle" align="left"><?=$db->getSubString(html_entity_decode($row['descripcion']),100);?></td>
				<td class="<?=$laclase?>" valign="middle" align="center"><?=$row['publicar']?></td>
                <td class="<?=$laclase?>" valign="middle" align="center">
                	<a href="pagina.detalles.php?n=<?=$row['id']?>"><img src="../imagen/insert-image.png" alt="Agregar Archivo" title="Agregar Archivo" border="" width="24" /></a></td>
                <td class="<?=$laclase?>" valign="middle" align="center"><a href="pagina.formulario.php?id=<?=$row['id']?>" onclick="return GB_showCenter('Editar', this.href, 450, 850);" title=""><img src="../images/captura.png" /></a></td>
              </tr>
        <?php } ?>
        </table>   
<?php } ?>