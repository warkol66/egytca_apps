|-if $supplies|@count eq 0-|
<tr>
	<td colspan="2">|-if isset($filter)-|No hay Insumos que concuerden con la b&uacute;squeda|-else-|No hay Insumos disponibles|-/if-|</td>
</tr>
|-else-|
|-foreach from=$supplies item=supply name=for_supples-|
<tr> 
	<td>
		|-if "vialidadSupplyEdit"|security_has_access-|
		<span id="supply_|-$supply->getId()-|" class="in_place_editable">|-$supply->getName()|escape-|</span>
		|-else-|
		|-$supply->getName()|escape-|
		|-/if-|
	</td>
	<td nowrap>
		|-if "vialidadSupplyEdit"|security_has_access-|
			<input type="hidden" name="do" value="vialidadSupplyEdit" />
			|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
			|-if isset($pager) && ($pager->getPage() ne 1)-|
			<input type="hidden" name="page" id="page" value="|-$pager->getPage()-|" />
			|-/if-|
			<input type="hidden" name="id" value="|-$supply->getid()-|" />
			<input type="submit" id="supply_edit_|-$supply->getId()-|" name="submit_go_edit_vialidad_supply" value="Editar" title="Editar" class="icon iconEdit" />
		|-/if-|
		|-if "vialidadSupplyDoDelete"|security_has_access-|
		<form action="Main.php" method="post" style="display:inline;">
			<input type="hidden" name="do" value="vialidadSupplyDoDelete" />
			|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
			|-if isset($pager) && ($pager->getPage() ne 1)-|
			<input type="hidden" name="page" id="page" value="|-$pager->getPage()-|" />
			|-/if-|
			<input type="hidden" name="id" value="|-$supply->getid()-|" />
			<input type="submit" name="submit_go_delete_vialidad_supply" value="Borrar" title="Eliminar" onclick="return confirm('Seguro que desea eliminar el Insumo?')" class="icon iconDelete" />
		</form>
			
		|-if isset($loginUser) && $loginUser->isSupervisor()-|
		<form action="Main.php" method="post" style="display:inline;">
			<input type="hidden" name="do" value="vialidadSupplyDoDelete" />
			|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
			|-if isset($pager) && ($pager->getPage() ne 1)-|
			<input type="hidden" name="page" id="page" value="|-$pager->getPage()-|" />
			|-/if-|
			<input type="hidden" name="id" value="|-$supply->getid()-|" />
			<input type="hidden" name="doHardDelete" value="true" /> 
			<input type="submit" name="submit_go_delete_vialidad_supply" value="Borrar" title="Eliminar completamente" onclick="return confirm('Seguro que desea eliminar el Insumo definitivamente?')" class="icon iconHardDelete" /> 
		</form>
		|-/if-|
		|-/if-|
	</td>
</tr> 
|-/foreach-|
|-/if-|

|-if isset($pager) && ($pager->getTotalPages() gt 1)-|
<tr> 
	<td colspan="2" class="pages">|-include file="PaginateInclude.tpl"-|</td> 
</tr>
|-/if-|



<script type="text/javascript">
|-foreach from=$supplies item=supply name=for_supplies_ajax-|
new Ajax.InPlaceEditor(
	'supply_|-$supply->getId()-|',
	'Main.php?do=vialidadSupplyEditFieldX',
	{
		rows: 1,
		okText: 'Guardar',
		cancelText: 'Cancelar',
		savingText: 'Guardando...',
		hoverClassName: 'in_place_hover',
		highlightColor: '#b7e0ff',
		cancelControl: 'button',
		savingClassName: 'inProgress',
		externalControl: 'supply_edit_|-$supply->getId()-|',
		clickToEditText: 'Haga click para editar',
		callback: function(form, value) {
			return 'id=|-$supply->getId()-|&paramName=name&paramValue=' + encodeURIComponent(value);
		},
		onComplete: function(transport, element) {
			clean_text_content_from(element);
			new Effect.Highlight(element, { startcolor: this.options.highlightColor });
		},
		onFormReady: function(obj,form) {
			form.insert({ top: new Element('label').update('Nombre: ') });
		}
	}
);
|-/foreach-|
</script>
