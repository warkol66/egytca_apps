|-foreach from=$planningMeasureUnitColl item=measureUnit name=for_measureUnits-|
	|-include file="PlanningMeasureUnitsListRowInclude.tpl"-|
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
	|-foreach from=$planningMeasureUnitColl item=measureUnit name=for_measureUnits_ajax-|
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
				return 'objectType=planningMeasureUnit&objectId=|-$measureUnit->getId()-|&paramName=name&paramValue='
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
	|-foreach from=$planningMeasureUnitColl item=measureUnit-|
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
				return 'objectType=planningMeasureUnit&objectId=|-$measureUnit->getId()-|&paramName=code&paramValue='
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