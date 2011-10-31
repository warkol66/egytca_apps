|-if $components->count() eq 0-|
	<tr id="empty_table_message"><td colspan="2">No hay componentes que mostrar.</td></tr>
|-else-|

|-foreach from=$components item=component-|
<tr>
	<td>|-$component->getSupply()-|</td>
	<td><span id="proportion|-$component->getSupplyid()-|">|-$component->getProportion()-|</span>&nbsp;%</td>
	<td align="center">
		|-if "vialidadConstructionItemDoRemoveRelationX"|security_has_access-|<form action="Main.php" method="post" onsubmit="removeRelationX(this);return false;" style="display:inline;">
			<input type="hidden" name="itemId" value="|-$item->getId()-|" />
			<input type="hidden" name="supplyId" value="|-$component->getSupplyid()-|" />
			<input type="submit" name="submit_go_remove_item_relation" value="Borrar" onclick="return confirm('Seguro que desea eliminar el Insumo')" class="icon iconDelete" /> 
		</form>|-/if-|
	</td>
</tr>
|-/foreach-|

|-/if-|