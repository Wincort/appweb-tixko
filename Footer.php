<footer class="container-fluid">
	<div style="padding:3rem;">
		<div class="row">
			<div class="col-sm-3">
				<img id="Escudo" src="images/ESCUDO TIXKOKOB.png" class="img-responsive EscudoTikokokb"  alt="Image">
			</div>
			<div class="col-sm-3">
				<h4><b>SERVICIOS</b></h4>
				<ul>
					<?php
						$TramitesFooter = $oWEB->TraerTramitesFooter();
						foreach($TramitesFooter as $elemento){
							$IdTramite=$elemento['id'];
							$nombreTramite= $elemento['nombre'];
							$URLTramite= "Tramite.php?id=".$IdTramite;
							echo html_entity_decode("<li><a href=".$URLTramite.">".$nombreTramite."</a></li>");
						}
					?>	
				</ul>
			</div>
			<div class="col-sm-3" style="text-align:center;"> 
				<h4></h4>
				<img id="Logo-911" src="images/911.png" alt="Image">	
			</div>
			<div class="col-sm-3 contacto">
				<h4><b>CONTACTO</b></h4>
				<?php
						$Direcciones = $oWEB->TraerDirecciones('SI');
						$Correo = $oWEB->TraerCorreo('SI');
						$Telefono = $oWEB->TraerTelefono('SI');
						$RedesSociales = $oWEB->TraerRedesSociales('SI');

						foreach($Direcciones as $elemento){
							$nombreDireccion= $elemento['registro'];
							$direccion= $elemento['descripcion'];
							echo html_entity_decode('<b>'.$nombreDireccion.'</b>');
							echo html_entity_decode($direccion);
							
						}
						foreach($Correo as $elemento){
							$RutaImg= 'admin/cat_contacto/'.$elemento['archivo'];
							$email= $elemento['descripcion'];
							echo html_entity_decode('<img width="30rem" height="30rem" src="'.$RutaImg.'" /><b> '.$email.'</b><br>');		
						}
						foreach($Telefono as $elemento){
							$RutaImg= 'admin/cat_contacto/'.$elemento['archivo'];
							$tel= $elemento['descripcion'];
							echo html_entity_decode('<img width="30rem" height="30rem" src="'.$RutaImg.'" /><b> '.$tel.'</b><br>');		
						}
						foreach($RedesSociales as $elemento){
							$RRSS= $elemento['descripcion'];
							$RutaImg= 'admin/cat_contacto/'.$elemento['archivo'];
							echo html_entity_decode('<a href="'.$RRSS.'" target="_blank"><img width="30rem" height="30rem" src="'.$RutaImg.'" /></a>');
							
						}
				?> 
				<br>
						
			</div>
		</div>
	</div>
</footer>
