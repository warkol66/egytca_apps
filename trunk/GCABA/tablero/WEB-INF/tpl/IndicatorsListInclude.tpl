
	<table border="0" cellpadding="5" cellspacing="0"  class='tableTdBorders' id="tabla-indicators">
		<thead>
			<tr>
<!--				<th width="5%" class="thFillTitle">Id</th>   -->
				<th width="80%" class="thFillTitle">Nombre</th>
				<th width="10%" class="thFillTitle">Tipo</th>
				<th width="5%" class="thFillTitle">&nbsp;</th>
			</tr>
		</thead>
		<tbody>
		|-if $result|@count eq 0-|
		<tr>
			<td colspan="3">|-if isset($filters)-|No hay indicadores que concuerden con la búsqueda|-else-|No hay Indicadores disponibles|-/if-|</td>
		</tr>
		|-else-|
		|-foreach from=$result item=indicator name=for_indicators-|
		<tr>
<!--			<td>|-$indicator->getid()-|</td>-->
			<td>|-$indicator->getname()-|</td>
			<td>|-$indicator->getIndicatorTypeTranslated()-|</td>
			<td nowrap><form action="Main.php" method="get" style="display:inline;">
					<input type="hidden" name="do" value="indicatorsView" />
					<input type="hidden" name="id" value="|-$indicator->getid()-|" />
					<input type="submit" name="submit_go_edit_indicator" value="Ver Gráfico" class="iconGraph" title="Ver Gráfico" />
				</form>
				<form action="Main.php" method="get" style="display:inline;">
					<input type="hidden" name="do" value="indicatorsEdit" />
					<input type="hidden" name="id" value="|-$indicator->getid()-|" />
					<input type="submit" name="submit_go_edit_indicator" value="Editar" class="iconEdit" title="Editar" />
				</form>
				<form action="Main.php" method="post" style="display:inline;">
					<input type="hidden" name="do" value="indicatorsDoDelete" />
					<input type="hidden" name="id" value="|-$indicator->getid()-|" />
					<input type="submit" name="submit_go_delete_indicator" value="Borrar" title="Borrar" onclick="return confirm('¿Seguro que desea eliminar el indicador?')" class="iconDelete" />
				</form>
			</td>
		</tr>
		|-/foreach-|						
		|-/if-|
		</tbody>
		
	</table>
