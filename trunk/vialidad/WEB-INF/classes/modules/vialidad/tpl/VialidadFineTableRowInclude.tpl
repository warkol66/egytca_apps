<tr id="fine|-$fine->getId()-|">
	<td nowrap="nowrap"><span id="fine_description|-$fine->getId()-|">|-$fine->getDescription()-|</span></td>
	<td nowrap="nowrap" align="center"><span id="fine_date|-$fine->getId()-|">|-$fine->getDate()|date_format-|</span></td>
	<td nowrap="nowrap" align="center"><span id="fine_price|-$fine->getId()-|">|-$fine->getPrice()|system_numeric_format-|</span></td>
	<td nowrap="nowrap" align="center">
		|-if "vialidadFineDoEditFieldX"|security_has_access-|
			<input type="button" name="submit_go_delete_item" value="Borrar" onclick="confirm('Seguro que desea eliminar el Item de Construcción?') ? removeFine('|-$fine->getId()-|'): '';" class="icon iconDelete" /> 
		|-/if-|
	</td>
</tr>

<script type="text/javascript">
	attachInplaceEditor = function(paramName) {
		new Ajax.InPlaceEditor(
			$('fine_'+paramName+'|-$fine->getId()-|'),
			'Main.php?do=vialidadFineDoEditFieldX',
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
					return 'id=|-$fine->getId()-|&paramName='+paramName+'&paramValue=' + encodeURIComponent(value);
				},
				onComplete: function(transport, element) {
					element.innerHTML = element.innerHTML.replace(/(\n|\r)+$/, '');
					new Effect.Highlight(element, { startcolor: this.options.highlightColor });
				},
				onFormReady: function(obj,form) {
					console.log('a');
					form.insert({ top: new Element('label').update(paramName+': ') });
				}
			}
		);
	}
	
	attachInplaceEditor('description');
	attachInplaceEditor('date');
	attachInplaceEditor('price');
</script>