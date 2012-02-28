<tr id="|-$extraType-||-$extra->getId()-|">
	<td nowrap="nowrap"><span id="|-$extraType-|_description|-$extra->getId()-|">|-$extra->getDescription()-|</span></td>
	<td nowrap="nowrap" align="center"><span id="|-$extraType-|_date|-$extra->getId()-|">|-$extra->getDate()|date_format-|</span></td>
	<td nowrap="nowrap" align="right"><span id="|-$extraType-|_price|-$extra->getId()-|">|-$extra->getPrice()|system_numeric_format-|</span></td>
	<td nowrap="nowrap" align="center">
		|-if $editAction|security_has_access-|
			<input type="button" name="submit_go_delete_item" value="Borrar" onclick="confirm('|-$deleteText-|') ? remove_|-$extraType-|('|-$extra->getId()-|'): '';" class="icon iconDelete" /> 
		|-/if-|
	</td>
</tr>

<script type="text/javascript">
	attachInplaceEditor = function(paramName) {
		
		var isDate = '0';
		var isNumeric = '0';
		
		if (paramName == 'date')
			isDate = '1';
		else if (paramName == 'price')
			isNumeric = '1';
		
		new Ajax.InPlaceEditor(
			$('|-$extraType-|_'+paramName+'|-$extra->getId()-|'),
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
				clickToEditText: 'Haga click para editar',
				callback: function(form, value) {
					return 'objectType=|-$extraType-|&objectId=|-$extra->getId()-|&paramName='+paramName+'&paramValue='+encodeURIComponent(value)+'&isDate='+isDate+'&isNumeric='+isNumeric;
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
	
	function remove_|-$extraType-|(id) {
		new Ajax.Request(
			'Main.php?do=|-$deleteAction-|',
			{
				method: 'post',
				parameters: {
					id: id
				},
				evalScripts: true,
				onSuccess: function() {
					$('|-$extraType-|'+id).parentNode.removeChild($('|-$extraType-|'+id));
				}
			}
		);
	}
	
	attachInplaceEditor('description');
	attachInplaceEditor('date');
	attachInplaceEditor('price');
</script>