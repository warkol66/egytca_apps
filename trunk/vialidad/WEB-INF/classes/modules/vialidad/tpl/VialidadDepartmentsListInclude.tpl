|-if $departmentColl|@count eq 0-|
	<tr>
		<td colspan="2">|-if isset($filter)-|No hay Departamentos que concuerden con la búsqueda|-else-|No hay Departamentos disponibles|-/if-|</td>
	</tr>
|-else-|
	|-foreach from=$departmentColl item=department name=for_departments-|
	<tr> 
		<td>
			|-if "vialidadDepartmentsEdit"|security_has_access-|
			<span id="name_|-$department->getId()-|" class="in_place_editable">|-$department->getName()-|</span>
			|-else-|
			|-$department->getName()-|
			|-/if-|
		</td>
		<td nowrap>
			|-if "vialidadDepartmentsEdit"|security_has_access-|
				<input type="hidden" name="do" value="vialidadDepartmentsEdit" />
				|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
				|-if isset($pager) && ($pager->getPage() gt 1)-|
				<input type="hidden" name="page" id="page" value="|-$pager->getPage()-|" />
				|-/if-|
				<input type="hidden" name="id" value="|-$department->getid()-|" />
				<input type="submit" id="department_edit_|-$department->getId()-|" name="submit_go_edit_vialidad_department" value="Editar" title="Editar" class="icon iconEdit" />
			|-/if-|
			|-if "vialidadDepartmentsDoDelete"|security_has_access-|
			<form action="Main.php" method="post" style="display:inline;">
				<input type="hidden" name="do" value="vialidadDepartmentsDoDelete" />
				|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
				|-if isset($pager) && ($pager->getPage() gt 1)-|
				<input type="hidden" name="page" id="page" value="|-$pager->getPage()-|" />
				|-/if-|
				<input type="hidden" name="id" value="|-$department->getid()-|" />
				<input type="submit" name="submit_go_delete_vialidad_department" value="Borrar" title="Eliminar" onclick="return confirm('Seguro que desea eliminar del Departamento?')" class="icon iconDelete" />
			</form>
			|-/if-|
		</td>
	</tr> 
	|-/foreach-|
	|-if isset($pager) && $pager->haveToPaginate()-|
		<tr> 
			<td colspan="2" class="pages">|-include file="ModelPagerInclude.tpl"-|</td> 
		</tr>
		|-/if-|
|-/if-|

<script language="JavaScript" type="text/JavaScript">
function attachNameInPlaceEditors() {
	|-foreach from=$departmentColl item=department name=for_departments_ajax-|
	new Ajax.InPlaceEditor(
		'name_|-$department->getId()-|',
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
			externalControl: 'department_edit_|-$department->getId()-|',
			clickToEditText: 'Haga click para editar',
			callback: function(form, value) {
				return 'objectType=department&objectId=|-$department->getId()-|&paramName=name&paramValue=' 
						+ encodeURIComponent(value);
			},
			onComplete: function(transport, element) {
				clean_text_content_from(element);
				new Effect.Highlight(element, { startcolor: this.options.highlightColor });
				msgs = $$('.successMessage');
				for (var i=0; i<msgs.length; i++)
					msgs[i].hide();
			},
			onFormReady: function(obj,form) {
				form.insert({ top: new Element('label').update('Departamento: ') });
			}
		}
	);
|-/foreach-|
}
attachNameInPlaceEditors();
|-if isset($status)-|
setStatus('|-$status-|');
|-/if-|
</script>