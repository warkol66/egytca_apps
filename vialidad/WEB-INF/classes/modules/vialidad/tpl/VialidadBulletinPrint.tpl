<h3>APLICABLE A CERTIFICADOS DEL MES DE |-$bulletin->getBulletindate()|date_format:"%B DE %Y"|upper-| - BOLETÍN Nº |-$bulletin->getNumber()-|</h3>
<h3>VALORES BASE PARA LA APLICACIÓN DE LA FORMULA PARAMETRICA - DIVISIÓN DE ESTUDIOS ESPECIALES</h3>

	
	|-if $prices neq ''-|
	<div id=div_supplies>
	<table id="table_supplies" class='tableTdBorders' cellpadding='5' cellspacing='0' width='100%'> 
		<thead>
		<tr class="thFillTitle"> 
			<th width="30%" colspan="2">Insumo</th> 
			<th width="5%">Unidad</th> 
			<th width="5%">Moneda</th> 
			<th width="10%">Valor</th> 
			|-if $bulletin->getPublished()-|
			<th width="10%" nowrap="nowrap">Definitivo en</th>
			<th width="10%" nowrap="nowrap">Modificado</th>
			|-/if-|
		</tr>
		</thead>
		<tbody>
		|-if $prices|@count eq 0-|
		<tr>
			<td colspan="|-if $bulletin->getPublished()-|4|-else-|3|-/if-|">No hay Insumos que mostrar</td>
		</tr>
		|-else-|
		|-foreach from=$prices key=idx item=price name=for_items-|
		|-if $price->getPublish()-|
		<tr id="priceRow|-$idx-|">
			|-assign var=priceInformation value=$price->getPrice()-|
			|-assign var=supply value=$price->getSupply()-|
			<td>|-$supply->getId()-|</td>
			<td>|-$supply->getName()-| |-if !$price->getDefinitive()-|(P)|-/if-|</td>
			<td align="center">|-$supply->getUnit()-|</td>
			<td align="center">Gs</td>
			<td align="right">
				|-if $price->getAveragePrice() neq ''-|
				|-$price->getAveragePrice()|system_numeric_format:0-|
				|-else-|
				-
				|-/if-|
			</td>
			|-if $bulletin->getPublished()-|
			<td align="center">|-$price->getDefinitiveOn()|date_format:"%B / %Y"|@ucfirst-|</td>
			<td align="right">|-if $price->getModifiedOn() ne ''-||-$priceInformation.price|system_numeric_format:0-| -> |-$price->getModifiedOn()|date_format:"%B / %Y"|@ucfirst-||-/if-|</td>
			|-else-|
			|-/if-|
		</tr>
		|-/if-|
		|-/foreach-|
		|-/if-|
		</tbody>
	</table>
	</div>
	|-/if-|
</div>
<div id="buletinComments">
|-$bulletin->getComments()|nl2br-|</div>

