<tr id="item|-$item->getId()-|">
	<td nowrap="nowrap">|-$item->getCode()-|</td>
	<td>|-$item->getName()-|</td>
	<td nowrap="nowrap" align="center">|-$item->getQuantity()-|&nbsp;|-$item->getUnit()-|</td>
	<td nowrap="nowrap">
		|-if "vialidadConstructionItemEdit"|security_has_access-|<form action="Main.php" method="get" style="display:inline;"> 
		  <input type="hidden" name="do" value="vialidadConstructionItemEdit" /> 
		  <input type="hidden" name="id" value="|-$item->getId()-|" /> 
		  <input type="hidden" name="returnToConstruction" value="|-$constructionId-|" />
				|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
				|-if isset($pager) && ($pager->getPage() ne 1)-| <input type="hidden" name="page" id="page" value="|-$pager->getPage()-|" />|-/if-|
		  <input type="submit" name="submit_go_edit_item" value="Editar" class="icon iconEdit" /> 
		</form>|-/if-|
		|-if "vialidadConstructionItemDoDelete"|security_has_access-|
			<input type="button" name="submit_go_delete_item" value="Borrar" onclick="confirm('Seguro que desea eliminar el Item de Construcción?') ? removeItem('|-$item->getId()-|'): '';" class="icon iconDelete" /> 
		|-/if-|
	</td>
</tr>