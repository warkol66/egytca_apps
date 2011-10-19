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
				<input id="params[bulletinDate]" name="params[bulletinDate]" type='text' value='|-$bulletin->getBulletinDate()|date_format-|' size="12" /> <img src="images/calendar.png" width="16" height="15" border="0" onclick="displayDatePicker('params[bulletinDate]', false, '|-$parameters.dateFormat.value|lower|replace:'-':''-|', '-');" title="Seleccione la fecha">
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
	
	|-if $prices neq ''-|
	<div id=div_supplies>
	<table id="table_supplies" class='tableTdBorders' cellpadding='5' cellspacing='0' width='100%'> 
		<thead>
		<tr class="thFillTitle"> 
			<th width="50%">Insumo</th> 
			<th width="35%">Precio</th> 
			<th width="10%">Definitivo</th>
			<th width="5%">&nbsp;</th>
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
			<td align="right">
				|-if $price->getAveragePrice() neq ''-|
				|-$price->getAveragePrice()|system_numeric_format-|
				|-else-|
				-
				|-/if-|
			</td>
			<td align="center">
				|-if $price->getDefinitive() eq 'true'-|
				si
				|-else-|
				no
				|-/if-|
			</td>
			<td align="center" >
				<a href='Main.php?do=vialidadSupplyPriceEdit&amp;bulletinId=|-$bulletin->getId()-|&amp;supplyId=|-$supply->getId()-|'>Editar</a>
			</td>
		</tr>
		|-/foreach-|
		|-/if-|
		</tbody>
	</table>
	</div>
	|-/if-|
</div>
