<h2>Boletines</h2>
<h1>|-if $action eq 'edit'-|Editar|-else-|Crear|-/if-| Boletín</h1>
<div id="div_bulletin">
	<p>Ingrese los datos del Boletín</p>
	|-if $message eq "error"-|<span class="message_error">Ha ocurrido un error al intentar guardar el Boletín</span>|-/if-|
	<form name="form_edit_bulletin" id="form_edit_bulletin" action="Main.php" method="post">
		<fieldset title="Formulario de edici&oacute;n de datos de un Bolet&iacute;n">
			<legend>Formulario de Administración de Boletines</legend>
			<p>
				<label for="params[number]">Número</label>
				<input type="text" id="params[number]" name="params[number]" size="10" value="|-$bulletin->getNumber()|escape-|" title="N&uacute;mero" /><img src="images/clear.png" class="mandatoryField" title="Campo obligatorio" />
			</p>
			<p>     
				<label for="params[bulletinDate]">Fecha del Boletín</label>
				<input id="params[bulletinDate]" name="params[bulletinDate]" type='text' value='|-$bulletin->getBulletinDate()-|' size="12" /> <img src="images/calendar.png" width="16" height="15" border="0" onclick="displayDatePicker('params[bulletinDate]', false, '|-$parameters.dateFormat.value|lower|replace:'-':''-|', '-');" title="Seleccione la fecha">
			</p>
			<p>
				|-if $action eq 'edit'-|
				<input type="hidden" name="id" id="id" value="|-$bulletin->getid()-|" />
				|-/if-|
				<input type="hidden" name="action" id="action" value="|-$action-|" />
				<input type="hidden" name="do" id="do" value="vialidadBulletinDoEdit" />
				<input type="submit" id="button_edit_bulletin" name="button_edit_bulletin" title="Aceptar" value="Guardar" />
				<input type="button" id="cancel" name="cancel" title="Cancelar" value="Cancelar" onClick="location.href='Main.php?do=vialidadBulletinList'"/>
			</p>
		</fieldset>
	</form>
	
	<div id=div_supplies>
	<table id="table_supplies" class='tableTdBorders' cellpadding='5' cellspacing='0' width='100%'> 
		<thead>
		<tr class="thFillTitle"> 
			<th width="30%">Insumo</th> 
			<th width="35%">Precio Preliminar</th> 
			<th width="35%">Precio Definitivo</th> 
		</tr>
		</thead>
		<tbody>
		|-if $prices|@count eq 0-|
		<tr>
			<td colspan="3">No hay Insumos que mostrar</td>
		</tr>
		|-else-|
		|-foreach from=$prices item=price-|
		<tr>
			|-assign var=supply value=$price->getSupply()-|
			<td>|-$supply->getName()-|</td>
			<td align="right">|-if "vialidadSupplyEdit"|security_has_access-|
			<span id="price_preliminary_|-$supply->getId()-|" class="in_place_editable">|-if $price->getPreliminaryPrice() neq ''-||-$price->getPreliminaryPrice()|system_numeric_format-||-else-|-|-/if-|</span>|-else-||-if $price->getPreliminaryPrice() neq ''-||-$price->getPreliminaryPrice()|system_numeric_format-||-else-|-|-/if-||-/if-|
			</td>
			<td align="right">
				|-if "vialidadSupplyEdit"|security_has_access-|
				<span id="price_definitive_|-$supply->getId()-|" class="in_place_editable">|-if $price->getDefinitivePrice() neq ''-||-$price->getDefinitivePrice()|system_numeric_format-||-else-|-|-/if-|</span>|-else-||-if $price->getDefinitivePrice() neq ''-||-$price->getDefinitivePrice()|system_numeric_format-||-else-|-|-/if-||-/if-|
			</td>
		</tr>
		|-/foreach-|
		|-/if-|
		</tbody>
	</table>
	</div>
</div>

<script type="text/javascript">
Ajax.InPlaceEditor.prototype.__enterEditMode = Ajax.InPlaceEditor.prototype.enterEditMode;
Object.extend(Ajax.InPlaceEditor.prototype, {
	enterEditMode:function(e) {
		this.__enterEditMode(e);
		this.triggerCallback('onFormReady',this._form);
	}
});

function attachInPlaceEditors(priceType) {
|-foreach from=$prices item=price name=for_prices_ajax-|
	|-assign var=supply value=$price->getSupply()-|
	new Ajax.InPlaceEditor(
		'price_'+priceType+'_|-$supply->getId()-|',
		'Main.php?do=vialidadPriceDoEditFieldX',
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
				return 'bulletinId=|-$bulletin->getId()-|&supplyId=|-$supply->getId()-|&paramName='+priceType+'Price&paramValue=' + encodeURIComponent(value);
			},
			onComplete: function(transport, element) {
				clean_text_content_from(element);
				new Effect.Highlight(element, { startcolor: this.options.highlightColor });
			},
			onFormReady: function(obj,form) {
				form.insert({ top: new Element('label').update('Precio: ') });
			}
		}
	);
|-/foreach-|
}

window.onload = function() {
	attachInPlaceEditors('preliminary');
	attachInPlaceEditors('definitive');
}

function showInput(to_show, to_hide) {
	$(to_show).show();
	$(to_hide).hide();
}

function chomp(raw_text) {
	return raw_text.replace(/(\n|\r)+$/, '');
}

function clean_text_content_from(element) {
	element.innerHTML = chomp(element.innerHTML);
}
</script>