		<tr> 
			<td>
				|-if "commonMeasureUnitsDoEditX"|security_has_access-|
				<span id="name_|-$measureUnit->getId()-|" class="in_place_editable">|-$measureUnit->getName()-|</span>
				|-else-|
				|-$measureUnit->getName()-|
				|-/if-|
			</td>
			<td>
				|-if "commonMeasureUnitsDoEditX"|security_has_access-|
					<span id="code_|-$measureUnit->getId()-|" class="in_place_editable">|-$measureUnit->getCode()-|</span>
				|-else-|
				|-$measureUnit->getCode()-|
				|-/if-|
			</td>
			<td nowrap>
				|-if "commonMeasureUnitsDoEditX"|security_has_access-|
					<input type="hidden" name="do" value="commonMeasureUnitsDoEditX" />
					|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
					|-if isset($pager) && ($pager->getPage() gt 1)-|
					<input type="hidden" name="page" id="page" value="|-$pager->getPage()-|" />
					|-/if-|
					<input type="hidden" name="id" value="|-$measureUnit->getid()-|" />
					<input type="submit" id="name_edit_|-$measureUnit->getId()-|" name="submit_go_edit_measureUnit" value="Editar" title="Editar" class="icon iconEdit" />
				|-/if-|
				|-if "commonMeasureUnitsDoDeleteX"|security_has_access-|
				<form action="Main.php" method="post" style="display:inline;">
					<input type="hidden" name="do" value="commonMeasureUnitsDoDeleteX" />
					|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
					|-if isset($pager) && ($pager->getPage() gt 1)-|
					<input type="hidden" name="page" id="page" value="|-$pager->getPage()-|" />
					|-/if-|
					<input type="hidden" name="id" value="|-$measureUnit->getid()-|" />
					<input type="submit" name="submit_go_delete_vialidad_measureUnit" value="Borrar" title="Eliminar" onclick="return confirm('Seguro que desea eliminar el Unidad de Medida?')" class="icon iconDelete" />
				</form>
				|-/if-|
			</td>
		</tr> 
