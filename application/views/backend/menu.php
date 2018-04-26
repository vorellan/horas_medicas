<div  style="width:120px;">
	<table border="0" cellpadding="0" cellspacing="0" style="width:120px;height:400px">
		<tr>
			<td valign="top">
				<div class="accordion" >
						<h3>Modulos Principales</h3>
						<div id="menu">
							<p><a href="#" c="index.php?/paciente_controller/cargaModulo">Paciente</a></p>
							<?php if($permiso=="all"){?>
							<p><a href="#" c="index.php?/usuario_controller/cargaModulo">Usuario</a></p>
							<p><a href="#" c="index.php?/examen_controller/cargaModulo">Examen</a></p>
							<p><a href="#" c="index.php?/prevision_controller/cargaModulo">Prevision</a></p>
							<?php } ?>
							<p><a href="#" c="index.php?/atencion_controller/cargaModulo">Atencion</a></p>
							<p><a href="#" c="index.php?/ficha_clinica_controller/cargaModulo">Ficha Clinica</a></p>
						</div>
						
						
				</div>
				<!-- FIN MENU CASCADA -->
			</td>
		</tr>
	</table>
</div>

