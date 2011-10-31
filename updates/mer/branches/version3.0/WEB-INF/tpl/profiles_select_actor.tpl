<form method="get" name="sel">
	<h2>Caracterización de Actores</h2>
		<h1>Edición de Perfiles</h1>
		<p>En este módulo podrá definir el perfil de los Actores completando un cuestionario de caracterización para cada uno. Seleccione una categoría y se mostrarán los Actores correspondientes a la misma, luego seleccione un Actor para realizar la caracterización del mismo.</p>
		</tr>
		<tr>
			<td>&nbsp;</td>
		</tr>
	</table>
	<table class="tableTdBorders" border="0" cellpadding="3" cellspacing="1" width="100%">
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
			<td class="cellboton" colspan="2"><input name="button" type="button" onclick="history.go(-1)" value="##104,Regresar##" /></td>
		</tr>
	</table>
</form>
