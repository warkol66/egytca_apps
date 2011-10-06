<script type="text/javascript">
	
	var preliminaryPrice;
	var definitivePrice;
	
	function editPrice(changedCell, supplyId) {
		new Ajax.Updater(
			changedCell.parentNode,
			'Main.php?do=vialidadBulletinDoEditPriceX',
			{
				method: 'post',
				parameters: {
					bulletinId: '|-$bulletin->getId()-|',
					supplyId: supplyId,
					preliminaryPrice: preliminaryPrice,
					definitivePrice: definitivePrice
				}
			}
		);
	}
	
	function editDefinitivePrice(supplyId) {
	
		definitivePrice = $('input_nuevo_valor').value;
		preliminaryPrice = $('td_preliminary_'+supplyId).innerHTML;
		changedCell = $('td_definitive_'+supplyId);
		
		editPrice(changedCell, supplyId);
	}
	
	function editPreliminaryPrice(supplyId) {
		
		preliminaryPrice = $('input_nuevo_valor').value;
		definitivePrice = $('td_definitive_'+supplyId).innerHTML;
		changedCell = $('td_preliminary_'+supplyId);
		
		editPrice(changedCell, supplyId);
	}
	
</script>

<h2>Boletines</h2>
<h1>|-if $action eq 'edit'-|Editar|-else-|Crear|-/if-| Bolet&iacute;n</h1>
<div id="div_bulletin">
	<p>Ingrese los datos del Bolet&iacute;n</p>
	|-if $message eq "error"-|<span class="message_error">Ha ocurrido un error al intentar guardar el Bolet&iacute;n</span>|-/if-|
	<form name="form_edit_bulletin" id="form_edit_bulletin" action="Main.php" method="post">
		<fieldset title="Formulario de edici&oacute;n de datos de un Bolet&iacute;n">
			<legend>Formulario de Administraci&oacute;n de Boletines</legend>
			<p>
				<label for="params[number]">N&uacute;mero</label>
				<input type="text" id="params[number]" name="params[number]" size="10" value="|-$bulletin->getNumber()|escape-|" title="N&uacute;mero" /><img src="images/clear.png" class="mandatoryField" title="Campo obligatorio" />
			</p>
			<p>     
				<label for="params[bulletinDate]">Fecha del Bolet&iacute;n</label>
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
	
	<div_supplies>
	<table id="table_supplies" class='tableTdBorders' cellpadding='5' cellspacing='0' width='100%'> 
		<thead>
		<tr class="thFillTitle"> 
			<th width="40%">Insumo</th> 
			<th width="30%">Precio Preliminar</th> 
			<th width="30%">Precio Definitivo</th> 
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
			
			<td id="td_preliminary_|-$supply->getId()-|" onclick="editPreliminaryPrice('|-$supply->getId()-|');">
			|-if $price->getPreliminaryPrice() neq -1-||-$price->getPreliminaryPrice()-||-else-|-|-/if-|
			</td>
			
			<td id="td_definitive_|-$supply->getId()-|" onclick="editDefinitivePrice('|-$supply->getId()-|');">
			|-if $price->getDefinitivePrice() neq -1-||-$price->getDefinitivePrice()-||-else-|-|-/if-|
			</td>
		</tr>
		|-/foreach-|
		|-/if-|
		</tbody>
	</table>
	</div_supplies>
	
	<label for="input_nuevo_valor">Click sobre un precio para reemplazar valor por</label>
	<input type="text" id="input_nuevo_valor"/>
</div>
