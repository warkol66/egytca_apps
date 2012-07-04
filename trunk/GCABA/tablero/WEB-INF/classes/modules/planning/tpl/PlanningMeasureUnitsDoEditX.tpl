|-include file="PlanningMeasureUnitsListRowInclude.tpl"-|
<script type="text/javascript">
function attachNameInPlaceEditors|-$measureUnit->getId()-|() {
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
}

function attachCodeInPlaceEditors|-$measureUnit->getId()-|() {
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
}
attachCodeInPlaceEditors|-$measureUnit->getId()-|();
attachNameInPlaceEditors|-$measureUnit->getId()-|();
</script>
