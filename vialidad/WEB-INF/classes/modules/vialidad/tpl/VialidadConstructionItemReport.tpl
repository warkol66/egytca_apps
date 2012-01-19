<h2>Paramétricas</h2>
<p>Contrato: |-$construction->getContract()-|</p>
<p>Obra: |-$construction-|</p>
<table class="tableTdBorders" cellpadding="5" cellspacing="0">
	<thead>
		<tr>
			<th>Código</th>
			<th>Item</th>
		|-foreach from=$supplies item=supply-|
			<th>|-$supply->getName()-|</th>
		|-/foreach-|
		</tr>
	</thead>
	<tbody>
	|-foreach from=$items item=item-|
		<tr>
			<td>|-$item->getCode()-|</td>
			<td>|-$item->getName()-|</td>
		|-foreach from=$supplies item=supply-|
			<td align="right" nowrap>|-if $item->getProportionForSupply($supply) gt 0-||-$item->getProportionForSupply($supply)-| %|-else-| - |-/if-|</td>
		|-/foreach-|
		</tr>
	|-/foreach-|
	</tbody>
</table>