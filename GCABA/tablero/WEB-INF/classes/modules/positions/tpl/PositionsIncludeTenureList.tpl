<fieldset title="Listado de Funcionarios a Cargo de la posición">
<legend>Funcionarios a Cargo</legend>
	<table border="0" cellpadding="5" cellspacing="0"  class='tableTdBorders' id="tabla-positions">
		<thead>
			<tr>
				 <th colspan="4" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=positionsEdit&id=|-$position->getId()-|&addTenure=1" class="addLink">Agregar Funcionario a Cargo</a></div></th>
			</tr>
			<tr class="thFillTitle">
				<th width="75%">Nombre</th>
				<th width="10%">Desde</th>
				<th width="10%">Hasta</th>
				<th width="5%">&nbsp;</th>
			</tr>
		</thead>
		<tbody>|-if $positionTenures|@count eq 0-|
			<tr>
				 <td colspan="5">No hay funcionarios a cargo para esta posición</td>
			</tr>
		|-else-|
		|-foreach from=$positionTenures item=tenure name=for_tenures-|
			<tr>
				<td>|-if $tenure->getObject() != NULL-||-assign var=tenureObject value=$tenure->getObject()-||-$tenureObject->getName()-| |-$tenureObject->getSurname()-| &#8212; |-$tenure->getOwnerName()-||-/if-|</td>
				<td>|-$tenure->getDateFrom()|date_format:"%d-%m-%Y"-|</td>
				<td>|-if $tenure->getDateTo() ne ''-||-$tenure->getDateTo()|date_format:"%d-%m-%Y"-||-else-|Vigente|-/if-|</td>
				<td nowrap>
					<form action="Main.php" method="get" style="display:inline;">
						<input type="hidden" name="do" value="positionsEdit" />
						<input type="hidden" name="id" value="|-$position->getId()-|" />
						<input type="hidden" name="tenureId" value="|-$tenure->getId()-|" />
						<input type="submit" name="submit_go_edit_position" value="Editar" class="icon iconEdit" />
					</form>
					<form action="Main.php" method="post" style="display:inline;">
						<input type="hidden" name="do" value="positionsTenuresDoDelete" />
						<input type="hidden" name="positionId" value="|-$position->getId()-|" />
						<input type="hidden" name="id" value="|-$tenure->getId()-|" />
						<input type="submit" name="submit_go_delete_position" value="Borrar" onclick="return confirm('¿Seguro que desea eliminar el cargo?')" class="icon iconDelete" />
					</form>
				</td>
			</tr>
		|-/foreach-|
							
		|-/if-|
			<tr>
				 <th colspan="5" class="thFillTitle">|-if $positionTenures|@count gt 5-|<div class="rightLink"><a href="Main.php?do=positionsEdit&id=|-$position->getId()-|&addTenure=1" class="addLink">Agregar Funcionario a Cargo</a></div>|-/if-|</th>
			</tr>
		</tbody>
	</table>
</fieldset>