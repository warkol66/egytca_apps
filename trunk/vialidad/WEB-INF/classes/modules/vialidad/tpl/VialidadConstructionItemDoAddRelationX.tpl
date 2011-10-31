<tr>
	<td>|-$component->getSupply()-|</td>
	<td><span id="proportion|-$component->getSupplyid()-|">|-$component->getProportion()-|</span>&nbsp;%</td>
	<td align="center">
		|-if "vialidadConstructionItemDoRemoveRelationX"|security_has_access-|<form action="Main.php" method="post" style="display:inline;">
			<input type="hidden" name="do" value="vialidadConstructionItemDoRemoveRelationX" />
			<input type="hidden" name="itemId" value="|-$item->getId()-|" />
			<input type="hidden" name="supplyId" value="|-$component->getSupplyid()-|" />
			<input type="submit" name="submit_go_remove_item_relation" value="Borrar" onclick="return confirm('Seguro que desea eliminar el Insumo')" class="icon iconDelete" /> 
		</form>|-/if-|
	</td>
</tr>

<script type="text/javascript">

attachInPlaceEditor('|-$component->getSupplyid()-|', 'proportion|-$component->getSupplyid()-|');

if ($('empty_table_message'))
	$('empty_table_message').parentNode.removeChild($('empty_table_message'));

</script>