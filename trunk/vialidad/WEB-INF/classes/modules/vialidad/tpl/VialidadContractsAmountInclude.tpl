<script language="JavaScript" type="text/JavaScript">
function addAmount(a) {
	var div = $$("#amountEdit div:first")[0];
	$(a).insert({
		before: "<div>"+div.innerHTML+"</div>"
	});
	return false;
}
function addAmountRow() {
	var row = document.createElement('tr');
	html =   '      <tr> ' 
  + '         <td><input type="hidden" name="amount[][id]" value="" />' 
  + '          <select id="amount[][currencyId]" name="amount[][currencyId]" title="Seleccione la moneda correspondiente al monto" > ' 
  + '             <option value="">Seleccione</option> ' 
  + '						|-foreach from=$currencies item=currency name=for_currency-|' 
  + '             <option value="|-$currency->getId()-|">|-$currency-|</option> ' 
  + '						|-/foreach-|' 
  + '           </select> ' 
  + '        </td> ' 
  + '         <td><input name="amount[][amount]" type="Text" title="Ingrese el monto" value="" size="15" /></td> ' 
  + '         <td><input name="amount[][paripassu]" type="Text" title="Ingrese el monto del Pari Passu" value="" size="15" /></td> ' 
  + '         <td><input name="amount[][date]" type="Text" title="Ingrese la fecha de la modificación (mm-dd-aaaa)"  value="" size="12" /></td> ' 
  + '         <td><select id="amount[][amountType]" name="amount[][amountType]" title="Seleccione si es monto original o modificatorio" > ' 
  + '             <option value="0">Modificatorio</option> ' 
  + '             <option value="1">Original</option> ' 
  + '           </select>' 
  + '         <td><input type="button" class="icon iconDelete" title="Eliminar monto del contrato"  /></td>'
  + ' </tr>';
	row.innerHTML= html;
	document.getElementById("amountsTbody").appendChild(row);
	return false;
}
</script>
  |-assign var=contractAmounts value=$contract->getContractAmounts()-|
  <div style="margin-left:130px;"> 
     <table class="tableTdBorders"> 
      <thead> 
         <tr> 
          <th colspan="6"><div class="rightLink"><a href="#" onclick="return addAmountRow()" class="addLink" title="Agregar nuevo Monto">Agregar nuevo Monto</a></div></th> 
        </tr> 
         <tr> 
          <th>Moneda</th> 
          <th>Monto</th> 
          <th>Pari Passu</th> 
          <th>Fecha</th> 
          <th>Original</th> 
          <th>&nbsp;</th> 
        </tr> 
       </thead> 
      <tbody id="amountsTbody">  |-foreach from=$contractAmounts item=contractAmount name=for_contractAmounts-|
      <tr> 
         <td><input type="hidden" name="amount[][id]" value="|-$contractAmount->getId()-|" /> 
          <select id="amount[][currencyId]" name="amount[][currencyId]" title="Seleccione la moneda correspondiente al monto" > 
             <option value="">Seleccione</option> 
						|-foreach from=$currencies item=currency name=for_currency-|
             <option value="|-$currency->getId()-|" |-$contractAmount->getCurrencyId()|selected:$currency->getId()-|>|-$currency-|</option> 
						|-/foreach-|
           </select> 
        </td> 
         <td><input name="amount[][amount]" type="Text" title="Ingrese el monto" value="|-$contractAmount->getAmount()|system_numeric_format-|" size="15" /></td> 
         <td><input name="amount[][paripassu]" type="Text" title="Ingrese el monto del Pari Passu" value="|-$contractAmount->getParipassu()|system_numeric_format-|" size="15" /></td> 
         <td><input name="amount[][date]" type="Text" title="Ingrese la fecha de la modificación (mm-dd-aaaa)"  value="|-$contractAmount->getDate()|date_format-|" size="12" /></td> 
         <td><select name="amount[][amountType]" title="Seleccione si es monto original o modificatorio" > 
             <option value="0" |-$contractAmount->getAmountType()|selected:"0"-|>Modificatorio</option> 
             <option value="1" |-$contractAmount->getAmountType()|selected:"1"-|>Original</option> 
           </select>
         <td> 
          <input type="button" class="icon iconDelete" title="Eliminar monto del contrato" /> 
        </td> 
       </tr> 
      |-/foreach-|
      </tbody> 
     </table> 
   </div> 
<p>&nbsp;</p>