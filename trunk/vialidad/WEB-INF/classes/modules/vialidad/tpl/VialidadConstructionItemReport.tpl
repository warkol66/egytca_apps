<table>
	<thead>
		<tr>
			<th><!-- empty (top left field) --></th>
		|-foreach from=$supplies item=supply-|
			<th>|-$supply->getName()-|</th>
		|-/foreach-|
		</tr>
	</thead>
	<tbody>
	|-foreach from=$items item=item-|
		<tr>
			<td>|-$item->getName()-|</td>
		|-foreach from=$supplies item=supply-|
			<td>|-$item->getProportionForSupply($supply)-|</td>
		|-/foreach-|
		</tr>
	|-/foreach-|
	</tbody>
</table>