<h3>|-$title-|</h3>
|-if $entities ne '' && !$entities->isEmpty()-|
	<table style="border-collapse: collapse;">
		<thead>
			<tr>
				<th style="border: solid;"></th><th style="border: solid;">Depende de:</th>
			</tr>
		</thead>
		<tbody>
		|-foreach from=$entities item=entity-|
			|-assign var=position value=$entity->getPosition()-|
			<tr>
				<td style="border: solid;">|-$entity->getName()-|</td>
				<td style="border: solid;">|-$position->getName()-|</td>
			</tr>
		|-/foreach-|
		</tbody>
	</table>
|-else-|
	Ninguno
|-/if-|

