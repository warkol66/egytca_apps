<script language="JavaScript" type="text/JavaScript">
function addAmount(a) {
	var div = $$("#amountEdit div:first")[0];
	$(a).insert({
		before: "<div>"+div.innerHTML+"</div>"
	});
	return false;
}
</script>


    <div id="amountEdit">
 	    <div style="display:none;">
		    <p style="float:left;width:|-$labelsWidth-|%;clear:none;">
				<select id="params[currencyId]" name="params[typeId]" >
        		<option value="">Seleccione</option>
				|-foreach from=$currencies item=currency name=for_currency-|
        		<option value="|-$currency->getId()-|">|-$currency-|</option>
				|-/foreach-|
				</select>
		      <label for="params[amount]" class="inlineLabel">Monto</label>
		      <input type="Text" name="params[amount]" />
		      <label for="params[paripassu]" class="inlineLabel">Paripassu</label>
		      <input type="Text" name="params[paripassu]" />
		      <label for="params[date]" class="inlineLabel">Fecha</label>
		      <input id="params[][date]" name="params[][date]" type='text' value='' size="12" title="Ingrese la fecha" /> 
			  <img src="images/calendar.png" width="16" height="15" border="0" 
			  onclick="displayDatePicker('params[][date]', false, '|-$parameters.dateFormat.value|lower|replace:'-':''-|', '-');" title="Seleccione la fecha">

		      <label for="params[amountType]" class="inlineLabel">Original</label>
		      <input type="checkbox" name="params[amountType]" />
		    </p>
	    </div>
	    
	   	<div>
		    |-foreach from=$contractAmounts item=contractAmount name=for_contractAmounts-|
		    
		    <p style="float:left;width:|-$labelsWidth-|%;clear:none;">
				
				<select id="params[currencyId]" name="params[typeId]" >
        		<option value="">Seleccione</option>
				|-foreach from=$currencies item=currency name=for_currency-|
        		<option value="|-$currency->getId()-|"|-*$construction->getTypeId()|selected:$type->getId()*-|>|-$currency-|</option>
				|-/foreach-|
				</select>
				
		      <label for="params[amount]">Monto</label>
		      <input type="Text" name="params[amount]" value="|-$contractAmount->getAmount()-|" />
		      <label for="params[paripassu]" class="inlineLabel">Paripasu</label>
		      <input type="Text" name="params[paripassu]" value="|-$contractAmount->getParipassu()-| />
		      <label for="params[date]" class="inlineLabel">Fecha</label>
		      <input type="Text" name="params[date]"  value="|-$contractAmount->getDate()-|/>
		      <label for="params[amountType]" class="inlineLabel">Original</label>
		      <input type="checkbox" name="params[amountType]"  value="|-$contractAmount->getamountType()-|/>
		    </p> 
		    |-/foreach-|
	    </div>

		<a href="#" onclick="return addAmount(this)" class="addLink" title="Agregar nuevo Monto">Agregar nuevo Monto</a>

	</div>