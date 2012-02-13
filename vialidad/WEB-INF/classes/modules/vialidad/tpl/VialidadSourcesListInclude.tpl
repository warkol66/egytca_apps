		|-if $sources|@count eq 0-|
		<tr>
			<td colspan="3">|-if isset($filter)-|No hay Fuentes de Financiamiento que concuerden con la búsqueda|-else-|No hay Fuentes de Financiamiento disponibles|-/if-|</td>
		</tr>
		|-else-|
		|-foreach from=$sources item=source name=for_sources-|
		<tr> 
			<td>
				|-if "vialidadSourcesEdit"|security_has_access-|
				<span id="code_|-$source->getId()-|" class="in_place_editable">|-$source->getCode()-|</span>
				|-else-|
				|-$source->getCode()-|
				|-/if-|
			</td>
			<td>
				|-if "vialidadSourcesEdit"|security_has_access-|
				<span id="name_|-$source->getId()-|" class="in_place_editable">|-$source->getName()-|</span>
				|-else-|
				|-$source->getName()-|
				|-/if-|
			</td>
			<td nowrap>
				|-if "vialidadSourcesEdit"|security_has_access-|
					<input type="hidden" name="do" value="vialidadSourcesEdit" />
					|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
					|-if isset($pager) && ($pager->getPage() gt 1)-|
					<input type="hidden" name="page" id="page" value="|-$pager->getPage()-|" />
					|-/if-|
					<input type="hidden" name="id" value="|-$source->getid()-|" />
					<input type="submit" id="source_edit_|-$source->getId()-|" name="submit_go_edit_vialidad_source" value="Editar" title="Editar" class="icon iconEdit" />
				|-/if-|
				|-if "vialidadSourcesDoDelete"|security_has_access-|
				<form action="Main.php" method="post" style="display:inline;">
					<input type="hidden" name="do" value="vialidadSourcesDoDelete" />
					|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
					|-if isset($pager) && ($pager->getPage() gt 1)-|
					<input type="hidden" name="page" id="page" value="|-$pager->getPage()-|" />
					|-/if-|
					<input type="hidden" name="id" value="|-$source->getid()-|" />
					<input type="submit" name="submit_go_delete_vialidad_source" value="Borrar" title="Eliminar" onclick="return confirm('Seguro que desea eliminar la Fuente de Financiamiento?')" class="icon iconDelete" />
				</form>
				|-/if-|
			</td>
		</tr> 
		|-/foreach-|
		|-/if-|
		
		|-if isset($pager) && $pager->haveToPaginate()-|
		<tr> 
			<td colspan="3" class="pages">|-include file="PaginateInclude.tpl"-|</td> 
		</tr>
		|-/if-|
<script type="text/javascript">
	|-foreach from=$sources item=source name=for_sources_ajax-|
	new Ajax.InPlaceEditor(
		'name_|-$source->getId()-|',
		'Main.php?do=vialidadSourcesEditFieldX',
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
			externalControl: 'source_edit_|-$source->getId()-|',
			clickToEditText: 'Haga click para editar',
			callback: function(form, value) {
				return 'id=|-$source->getId()-|&paramName=name&paramValue=' + encodeURIComponent(value);
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
	new Ajax.InPlaceEditor(
		'code_|-$source->getId()-|',
		'Main.php?do=vialidadSourcesEditFieldX',
		{
			rows: 1,
			size: 6,
			okText: 'Guardar',
			cancelText: 'Cancelar',
			savingText: 'Guardando...',
			hoverClassName: 'in_place_hover',
			highlightColor: '#b7e0ff',
			cancelControl: 'button',
			savingClassName: 'inProgress',
			externalControl: 'code_edit_|-$source->getId()-|',
			clickToEditText: 'Haga click para editar',
			callback: function(form, value) {
				return 'id=|-$source->getId()-|&paramName=code&paramValue=' + encodeURIComponent(value);
			},
			onFormReady: function(obj,form) {
				form.insert({ top: new Element('label').update('Código: ') });
			}
		}
	);
|-/foreach-|
</script>