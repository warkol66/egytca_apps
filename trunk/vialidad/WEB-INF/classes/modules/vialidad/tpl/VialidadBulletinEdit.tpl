<h2>Boletines</h2>
<h1>|-if $action eq 'edit'-|Editar|-else-|Crear|-/if-| Boletín Formula Paramétrica</h1>
<div id="div_bulletin">
	<p>Ingrese los datos del Boletín</p>
	|-if $message eq "error"-|
		<div class="failureMessage">Ha ocurrido un error al intentar guardar el Boletín Formula Paramétrica</div>
	|-elseif $message eq "ok"-|
		<div class="successMessage">Cambios guardados correctamente</div>
	|-/if-|
	<form name="form_edit_bulletin" id="form_edit_bulletin" action="Main.php" method="post">
		<fieldset title="Formulario de edición de datos de un Boletín">
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
				<label for="params[comments]">Observaciones</label>
				<textarea name="params[comments]" cols="60" wrap="VIRTUAL" id="params[comments]" title="Observaciones">|-$bulletin->getComments()|escape-|</textarea>
			</p>
		<p>     
				<label for="params[published]">Publicado</label>
				<input name="params[published]" type="hidden" value="0">
				<input name="params[published]" type="checkbox" value="1" |-$bulletin->getPublished()|checked_bool-| title="Indica si el boletín acepta modificaciones o no">
			</p>
			<p>
				|-if $action eq 'edit'-|
				<input type="hidden" name="id" id="id" value="|-$bulletin->getid()-|" />
				|-/if-|
				<input type="hidden" name="action" id="action" value="|-$action-|" />
				<input type="hidden" name="do" id="do" value="vialidadBulletinDoEdit" />
				<input type="submit" id="button_edit_bulletin" name="button_edit_bulletin" title="Aceptar" value="Guardar" />
				<input type="button" id="cancel" name="cancel" title="Regresar" value="Regresar" onClick="location.href='Main.php?do=vialidadBulletinList'"/>
			</p>
		</fieldset>
	</form>
	
	|-if $prices neq ''-|
	<div id=div_supplies>
	<table id="table_supplies" class='tableTdBorders' cellpadding='5' cellspacing='0' width='100%'> 
		<thead>
		<tr class="thFillTitle"> 
			<th width="25%">Insumo</th> 
			<th width="10%">Precio</th> 
			<th width="6%">Publicar</th>
			<th width="5%">Definitivo</th>
			|-if $bulletin->getPublished()-|
			<th width="15%">Definitivo en</th>
			<th width="10%">Modificado</th>
            <th width="15%">Modificado en</th>
			|-else-|
			<th width="10%">&nbsp;</th>|-/if-|
		</tr>
		</thead>
		<tbody>
		|-if $prices|@count eq 0-|
		<tr>
			<td colspan="|-if $bulletin->getPublished()-|4|-else-|3|-/if-|">No hay Insumos que mostrar</td>
		</tr>
		|-else-|
		|-foreach from=$prices key=idx item=price name=for_items-|
		<tr id="priceRow|-$idx-|">
            |-assign var=priceInformation value=$price->getPrice()-|
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
				<input onchange="updatePublish('|-$supply->getId()-|', this.checked);" name="publish[]" type="checkbox" value="1" |-$price->getPublish()|checked_bool-| |-if $bulletin->getPublished()-|disabled="disabled"|-/if-|>
			</td>
			<td align="center">|-$price->getDefinitive()|si_no-|</td>
			|-if $bulletin->getPublished()-|
			<td align="center">
                |-if !$price->getDefinitive()-|
                <span id="definitiveOn|-$idx-|" |-if "vialidadSupplyPriceEdit"|security_has_access-|class="in_place_editable"|-/if-|>|-$price->getDefinitiveOn()|date_format:"%B / %Y"|@ucfirst-|</span>
                |-else-|
                <span>|-$price->getDefinitiveOn()|date_format:"%B / %Y"|@ucfirst-|</span>
                |-/if-|
            </td>
			<td align="right">
                |-if !$price->getDefinitive()-|
                <span id="price|-$idx-|" |-if "vialidadSupplyPriceEdit"|security_has_access-|class="in_place_editable"|-/if-|>|-$priceInformation.price|system_numeric_format-|</span>
                |-else-|
                <span>|-$priceInformation.price|system_numeric_format-|</span>
                |-/if-|
            </td>
            <td align="center">
                |-if !$price->getDefinitive()-|
                <span id="modifiedOn|-$idx-|" |-if "vialidadSupplyPriceEdit"|security_has_access-|class="in_place_editable"|-/if-|>|-$price->getModifiedOn()|date_format:"%B / %Y"|@ucfirst-|</span>
                |-else-|
                <span>|-$price->getModifiedOn()|date_format:"%B / %Y"|@ucfirst-|</span>
                |-/if-|
            </td>
			|-else-|
			<td align="center"><a href='Main.php?do=vialidadSupplyPriceEdit&amp;bulletinId=|-$bulletin->getId()-|&amp;supplyId=|-$supply->getId()-|'><img src="images/clear.png" class="icon iconEdit"></a></td>
			|-/if-|
		</tr>
		|-/foreach-|
		|-/if-|
		</tbody>
	</table>
	</div>
	|-/if-|
</div>

|-include file="InPlaceEditorInclude.tpl"-|

<script type="text/javascript">
function updatePublish(supplyId, value) {
	new Ajax.Request(
		'Main.php?do=vialidadSupplyPriceEditFieldX',
		{
			method: 'post',
			parameters: {
				bulletinId: "|-$bulletin->getId()-|",
				supplyId: supplyId,
				paramName: 'publish',
				paramValue: value
			}
		}
	);
}

|-foreach from=$prices key=idx item=price name=for_items-|
    |-if !$price->getDefinitive()-|
    // Definitive On
    attachInPlaceEditor({
        action   : 'vialidadSupplyPriceEditFieldX',
        selector : 'definitiveOn|-$idx-|',
        params   : 'bulletinId=|-$price->getBulletinId()-|&supplyId=|-$price->getSupplyId()-|',
        paramName: 'definitiveOn'
    });
    // Modified On
    attachInPlaceEditor({
        action   : 'vialidadSupplyPriceEditFieldX',
        selector : 'modifiedOn|-$idx-|',
        params   : 'bulletinId=|-$price->getBulletinId()-|&supplyId=|-$price->getSupplyId()-|',
        paramName: 'modifiedOn'
    });
    // Modified Price
    attachInPlaceEditor({
        action   : 'vialidadSupplyPriceEditModifiedPriceX',
        selector : 'price|-$idx-|',
        params   : 'bulletinId=|-$price->getBulletinId()-|&supplyId=|-$price->getSupplyId()-|&index=|-$idx-|',
        paramName: 'modifiedPrice',
        onComplete: function(transport, element) {
            $('priceRow|-$idx-|').innerHTML = transport.responseText;
        }
    });
    |-/if-|
|-/foreach-|

</script>

