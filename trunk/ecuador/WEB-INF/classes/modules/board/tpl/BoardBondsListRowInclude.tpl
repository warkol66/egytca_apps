	<tr> 
		<td>
			|-if "boardBondsDoEditX"|security_has_access-|
			<span id="name_|-$boardBond->getId()-|" name="params[name]" class="in_place_editable">|-$boardBond->getName()-|</span>
			|-else-|
			|-$boardBond->getName()-|
			|-/if-|
		</td>
		<td nowrap>
			|-if "boardBondsDoEditX"|security_has_access-|
				<input type="hidden" name="do" value="boardBondsDoEditX" />
				|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
				|-if isset($pager) && ($pager->getPage() gt 1)-|
				<input type="hidden" name="page" id="page" value="|-$pager->getPage()-|" />
				|-/if-|
				<input type="hidden" name="id" value="|-$boardBond->getid()-|" />
			|-/if-|
			|-if "boardBondsDoDeleteX"|security_has_access-|
			<form action="Main.php" method="post" style="display:inline;">
				<input type="hidden" name="do" value="boardBondsDoDelete" />
				|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
				|-if isset($pager) && ($pager->getPage() gt 1)-|
				<input type="hidden" name="page" id="page" value="|-$pager->getPage()-|" />
				|-/if-|
				<input type="hidden" name="id" value="|-$boardBond->getid()-|" />
				<input type="submit" name="submit_go_delete_boardBond" value="Borrar" title="Eliminar" onclick="return confirm('¿Seguro que desea eliminar el compromiso?')" class="icon iconDelete" />
			</form>
			|-/if-|
		</td>
	</tr>
