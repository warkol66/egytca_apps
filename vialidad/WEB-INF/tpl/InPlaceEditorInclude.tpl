<script type="text/javascript">
Ajax.InPlaceEditor.prototype.__enterEditMode = Ajax.InPlaceEditor.prototype.enterEditMode;
Object.extend(Ajax.InPlaceEditor.prototype, {
	enterEditMode:function(e) {
		this.__enterEditMode(e);
		this.triggerCallback('onFormReady',this._form);
	}
});

/**
 * 
 * @param   hash options, opciones del editor
 *  - string action, [obligatorio]
 *  - string selector, id del elemento al que se le acopla el editor [obligatorio]
 *  - string paramName, nombre del campo a editar [obligatorio]
 *  - string params, parametros adicionales necesarios para efecutar la edicion 
 *  - function onComplete, handler a ser ejecutado cuando se completa
 */
function attachInPlaceEditor(options) {
	new Ajax.InPlaceEditor(
		options.selector,
		'Main.php?do=' + options.action,
		{
			rows: 1,
			okText: 'Guardar',
			cancelText: 'Cancelar',
			savingText: 'Guardando...',
			hoverClassName: 'in_place_hover',
			highlightColor: '#b7e0ff',
			cancelControl: 'button',
			savingClassName: 'inProgress',
			clickToEditText: 'Haga click para editar',
			callback: function(form, value) {
				return options.params + '&paramName=' + options.paramName + '&paramValue=' + encodeURIComponent(value);
			},
			onComplete:  function(transport, element) {
                clean_text_content_from(element);
                new Effect.Highlight(element, { startcolor: this.options.highlightColor });
                
                if (typeof options.onComplete != null)
                    options.onComplete(transport, element);
                
            },
			onFormReady: function(obj,form) {}
		}
	);
}

function onCompleteDefaultHandler(transport, element) {
    console.log(element);
    clean_text_content_from(element);
    new Effect.Highlight(element, { startcolor: this.options.highlightColor });
}

function chomp(raw_text) {
	return raw_text.replace(/(\n|\r)+$/, '');
}

function clean_text_content_from(element) {
	element.innerHTML = chomp(element.innerHTML);
}

</script>