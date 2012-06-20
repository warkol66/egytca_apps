	|-foreach from=$measureUnitColl item=measureUnit name=for_measureUnits-|
		<tr> 
			<td>
				|-if "vialidadMeasureUnitsEdit"|security_has_access-|
				<span id="name_|-$measureUnit->getId()-|" class="in_place_editable">|-$measureUnit->getName()-|</span>
				|-else-|
				|-$measureUnit->getName()-|
				|-/if-|
			</td>
			<td>
				|-if "vialidadMeasureUnitsEdit"|security_has_access-|
					<span id="code_|-$measureUnit->getId()-|" class="in_place_editable">|-$measureUnit->getCode()-|</span>
				|-else-|
				|-$measureUnit->getCode()-|
				|-/if-|
			</td>
			<td nowrap>
				|-if "vialidadMeasureUnitsEdit"|security_has_access-|
					<input type="hidden" name="do" value="vialidadMeasureUnitsEdit" />
					|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
					|-if isset($pager) && ($pager->getPage() gt 1)-|
					<input type="hidden" name="page" id="page" value="|-$pager->getPage()-|" />
					|-/if-|
					<input type="hidden" name="id" value="|-$measureUnit->getid()-|" />
					<input type="submit" id="name_edit_|-$measureUnit->getId()-|" name="submit_go_edit_vialidad_measureUnit" value="Editar" title="Editar" class="icon iconEdit" />
				|-/if-|
				|-if "vialidadMeasureUnitsDoDelete"|security_has_access-|
				<form action="Main.php" method="post" style="display:inline;">
					<input type="hidden" name="do" value="vialidadMeasureUnitsDoDelete" />
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
		|-/foreach-|

<script type="text/javascript">

function updateCode(id, value) {
	new Ajax.Updater(
		'span_code_'+id,
		'Main.php?do=commonDoEditFieldX',
		{
			method: 'post',
			parameters: {
				id: id,
				paramName: 'code',
				paramValue: value
			}
		}
	);
}
function updateName(id, value) {
	new Ajax.Updater(
		'span_name_'+id,
		'Main.php?do=commonDoEditFieldX',
		{
			method: 'post',
			parameters: {
				id: id,
				paramName: 'name',
				paramValue: value
			}
		}
	);
}

Ajax.InPlaceEditor.prototype.__enterEditMode = Ajax.InPlaceEditor.prototype.enterEditMode;
Object.extend(Ajax.InPlaceEditor.prototype, {
	enterEditMode:function(e) {
		this.__enterEditMode(e);
		this.triggerCallback('onFormReady',this._form);
	}
});

function attachNameInPlaceEditors() {
	|-foreach from=$measureUnitColl item=measureUnit name=for_measureUnits_ajax-|
	new Ajax.InPlaceEditor(
		'name_|-$measureUnit->getId()-|',
		'Main.php?do=commonDoEditFieldX',
		{
			rows: 1,
			okText: 'Guardar',
			cancelText: 'Cancelar',
			savingText: 'Guardando...',
			hoverClassName: 'in_place_hover',
			highlightColor: '#b7e0ff',
			cancelControl: 'button',
			savingClassName: 'inProgress',
			externalControl: 'name_edit_|-$measureUnit->getId()-|',
			clickToEditText: 'Haga click para editar',
			callback: function(form, value) {
				return 'objectType=measureUnit&objectId=|-$measureUnit->getId()-|&paramName=name&paramValue='
						+ encodeURIComponent(value);
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
}

function attachCodeInPlaceEditors() {
	|-foreach from=$measureUnitColl item=measureUnit-|
	new Ajax.InPlaceEditor(
		'code_|-$measureUnit->getId()-|',
		'Main.php?do=commonDoEditFieldX',
		{
			rows: 1,
			okText: 'Guardar',
			cancelText: 'Cancelar',
			savingText: 'Guardando...',
			hoverClassName: 'in_place_hover',
			highlightColor: '#b7e0ff',
			cancelControl: 'button',
			savingClassName: 'inProgress',
			callback: function(form, value) {
				return 'objectType=measureUnit&objectId=|-$measureUnit->getId()-|&paramName=code&paramValue='
					+ encodeURIComponent(clean(value));
			},
			onFormReady: function(obj,form) {
				form.insert({ top: new Element('label').update('Código: ') });
			}
		}
	);
	|-/foreach-|
}
window.onload = function() {
	attachCodeInPlaceEditors();
	attachNameInPlaceEditors();
}
</script>