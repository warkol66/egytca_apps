<table border="0" cellpadding="4" cellspacing="0" id="tabla-advertisements" class="tableTdBorders">
	<thead>
		<tr>
			<th>Motivo</th>
			<th>Cantidad</th>
			<th>Vencimiento</th>
		</tr>
	</thead>
	<tbody>
	|-foreach from=$results item=item name=for_themes-|
		<tr>
			<td>|-$item.name-|
			</td>
			<td align="right">|-$item.total-|
			</td>
			<td align="center">
				|-if $item.expired-|
					VENCIDO (|-$item.endDate|date_format:"%d-%m-%Y"-|)
				|-else-|
					|-$item.endDate|date_format:"%d-%m-%Y"-|
				|-/if-|			
			</td>
		</tr>
	|-/foreach-|						
	</tbody>
</table>
