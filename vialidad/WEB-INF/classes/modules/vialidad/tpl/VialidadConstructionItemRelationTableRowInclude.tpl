<tr>
	<td>|-$component->getSupply()-|</td>
	<td align="right"><span id="proportion|-$component->getSupplyid()-|" name="span_proportion">|-$component->getProportion()|system_numeric_format-|</span>&nbsp;%</td>
|-if !$view-|	<td align="center">
		|-if "vialidadConstructionItemDoRemoveRelationX"|security_has_access-|<form action="Main.php" method="post" onsubmit="removeRelationX(this);return false;" style="display:inline;">
			<input type="hidden" name="itemId" value="|-$item->getId()-|" />
			<input type="hidden" name="supplyId" value="|-$component->getSupplyid()-|" />
			<input type="submit" name="submit_go_remove_item_relation" value="Borrar" onclick="return confirm('Seguro que desea eliminar el Insumo')" class="icon iconDelete" /> 
		</form>|-/if-|
	</td>|-/if-|
</tr>