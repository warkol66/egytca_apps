<form method="get" name="sel">
	<table border="0" cellpadding="0" cellspacing="0" width="100%">
		<tr>
			<td class="titulo">##197,Caracterización de Actores##</td>
		</tr>
		<tr>
			<td class="subrayatitulo"><img src="index.php_files/clear.gif" height="3" width="1"></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td class="fondotitulo">##198,Edición de Perfiles##</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td class="texto">##199,En este módulo podrá definir el perfil de los Actores completando un cuestionario de caracterización para cada uno. Seleccione una categoría y se mostrarán los Actores correspondientes a la misma, luego seleccione un Actor para realizar la caracterización del mismo.##</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
		</tr>
	</table>
	<table class="tablaborde" border="0" cellpadding="3" cellspacing="1" width="100%">
		<tr>
			<th colspan="2">##200,Actores Clave de## &quot;|-$category->getName()-|&quot;</th>
		</tr>
		|-foreach from=$category->getActors() item=actor-|
		<tr>
			<td class="celldato"><div class="titulo2"> <a href="Main.php?do=profilesFormFill&actor=|-$actor->getId()-|">|-$actor->getName()-|</a></div></td>
			<td class="cellopciones" nowrap="nowrap" width="10%"> [ <a href="Main.php?do=actorsEdit&actor=|-$actor->getId()-|" class="edit">##114,Editar##</a> ]</td>
		</tr>
		|-/foreach-|
		<tr>
			<td class="cellboton" colspan="2"><input name="button" type="button" class="boton" onclick="history.go(-1)" value="##104,Regresar##" /></td>
		</tr>
	</table>
</form>
