			<table border="0" cellpadding="0" cellspacing="0" width="100%">
					<tbody><tr> 
						<td class="titulo">&nbsp;</td>
					</tr>
					<tr> 
						<td class="titulo">Caracterización de Actores</td>
					</tr>
					<tr> 
						<td class="subrayatitulo"><img src="index.php_files/clear.gif" height="3" width="1"></td>

					</tr>
					<tr> 
						<td>&nbsp;</td>
					</tr>
					<tr> 
						<td class="fondotitulo">Edición de Perfiles</td>
					</tr>
					<tr> 
						<td>&nbsp;</td>
					</tr>

					<tr> 
						<td class="texto">En este módulo podrá definir el perfil de los Actores Clave completando 
							un cuestionario de caracterización para cada uno. Seleccione una categoría 
							y se msotrarán los actores correspondientes a la misma, luego seleccione 
							un actor para realizar la caracterización del mismo.</td>
					</tr>
					<tr> 
						<td>&nbsp;</td>
					</tr>
				</tbody></table>
				<table class="tablaborde" border="0" cellpadding="3" cellspacing="1" width="100%">
						<tbody><tr><th colspan="2">Actores Principales de "|-$category->getName()-|"</th></tr>	
|-foreach from=$category->getActors() item=actor-|						
			<tr> 
			<td class="celldato"><div class="titulo2">

				<a href="Main.php?do=|-$smarty.get.successAction-|&actor=|-$actor->getId()-|">|-$actor->getName()-|</a></div></td>
			</tr>
|-/foreach-|			
					<tr> 
			<td class="cellboton" colspan="2"><input onclick="history.go(-1)" value="Regresar" class="boton" type="button"></td>
		</tr>
	</tbody></table>