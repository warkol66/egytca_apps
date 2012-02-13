		|-if $constructionTypes|@count eq 0-|
		<tr>
			<td colspan="2">|-if isset($filter)-|No hay Obras que concuerden con la búsqueda|-else-|No hay Obras disponibles|-/if-|</td>
		</tr>
		|-else-|
		|-foreach from=$constructionTypes item=type name=for_types-|
		<tr> 
			<td>
				|-if "vialidadConstructionTypesEdit"|security_has_access-|
				<span id="name_|-$type->getId()-|" class="in_place_editable">|-$type->getName()-|</span>
				|-else-|
				|-$type->getName()-|
				|-/if-|
			</td>
			<td nowrap>
				|-if "vialidadConstructionTypesEdit"|security_has_access-|
					<input type="hidden" name="do" value="vialidadConstructionTypesEdit" />
					|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
					|-if isset($pager) && ($pager->getPage() gt 1)-|
					<input type="hidden" name="page" id="page" value="|-$pager->getPage()-|" />
					|-/if-|
					<input type="hidden" name="id" value="|-$type->getid()-|" />
					<input type="submit" id="type_edit_|-$type->getId()-|" name="submit_go_edit_vialidad_type" value="Editar" title="Editar" class="icon iconEdit" />
				|-/if-|
				|-if "vialidadSourcesDoDelete"|security_has_access-|
				<form action="Main.php" method="post" style="display:inline;">
					<input type="hidden" name="do" value="vialidadSourcesDoDelete" />
					|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
					|-if isset($pager) && ($pager->getPage() gt 1)-|
					<input type="hidden" name="page" id="page" value="|-$pager->getPage()-|" />
					|-/if-|
					<input type="hidden" name="id" value="|-$type->getid()-|" />
					<input type="submit" name="submit_go_delete_vialidad_type" value="Borrar" title="Eliminar" onclick="return confirm('Seguro que desea eliminar del Departamento?')" class="icon iconDelete" />
				</form>
				|-/if-|
			</td>
		</tr> 
		|-/foreach-|
		|-/if-|
		
		|-if isset($pager) && $pager->haveToPaginate()-|
		<tr> 
			<td colspan="2" class="pages">|-include file="PaginateInclude.tpl"-|</td> 
		</tr>
		|-/if-|
<script type="text/javascript">
	|-foreach from=$constructionTypes item=type name=for_types_ajax-|
	new Ajax.InPlaceEditor(
		'name_|-$type->getId()-|',
		'Main.php?do=commonDoEditFieldX',
		{
			rows: 1,
			size: 35,
			okText: 'Guardar',
			cancelText: 'Cancelar',
			savingText: 'Guardando...',
			hoverClassName: 'in_place_hover',
			highlightColor: '#b7e0ff',
			cancelControl: 'button',
			savingClassName: 'inProgress',
			externalControl: 'type_edit_|-$type->getId()-|',
			clickToEditText: 'Haga click para editar',
			callback: function(form, value) {
				return 'objectType=constructionType&objectId=|-$type->getId()-|&paramName=name&paramValue=' + encodeURIComponent(value);
			},
			onComplete: function(transport, element) {
				clean_text_content_from(element);
				new Effect.Highlight(element, { startcolor: this.options.highlightColor });
			},
			onFormReady: function(obj,form) {
				form.insert({ top: new Element('label').update('Departamento: ') });
			}
		}
	);
|-/foreach-|
</script>