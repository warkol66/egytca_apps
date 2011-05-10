<h2>Importación de Direcciones</h2>

<h3>|-$addressesFound-| Direcciones Procesadas - |-$addressesNew-| Direcciones Nuevas Encontradas</h3>

<h3>Listado de Direcciones Nuevas</h3>

<form action="Main.php" method="post">
	<table width="100%" cellpadding="4" cellspacing="0" class="tableTdBorders">
		<tr class="thFillTitle">
			<th>Calle</th>
			<th>Altura o Intersección </th>
			<th>Circuito</th>
			<th>Barrio</th>
			<th>Latitud</th>
			<th>Longitud</th>
			<th>Total de Carteleras</th>
			<th>Dobles</th>
			<th>Sextuples</th>
			<th>Coincide Suma?</th>
		</tr>
   
		|-foreach from=$addresses item=address-|
		<tr>
			<td>|-$address.street-|<input type="hidden" name="addresses[street][]" value="|-$address.street-|" /></td>
			<td>|-$address.number-|<input type="hidden" name="addresses[number][]" value="|-$address.number-|" />
			|-$address.intersection-|<input type="hidden" name="addresses[intersection][]" value="|-$address.intersection-|" /></td>
			<td>|-$address.circuit-|<input type="hidden" name="addresses[circuit][]" value="|-$address.circuit-|" /></td>
			<td>|-$address.region-|<input type="hidden" name="addresses[regionId][]" value="|-$address.regionId-|" /></td>
			<td>|-$address.latitude-|<input type="hidden" name="addresses[latitude][]" value="|-$address.latitude-|" /></td>
			<td>|-$address.longitude-|<input type="hidden" name="addresses[longitude][]" value="|-$address.longitude-|" /></td>
			<td>|-$address.totalBillboardsCount-|</td>
			<td>|-$address.totalBillboardsDobles-|<input type="hidden" name="addresses[totalBillboardsDobles][]" value="|-$address.totalBillboardsDobles-|" /></td>
			<td>|-$address.totalBillboardsSextuples-|<input type="hidden" name="addresses[totalBillboardsSextuples][]" value="|-$address.totalBillboardsSextuples-|" /></td>
			<td>|-$address.rightBillboardsCount|si_no-|</td>
		</tr>	
		|-/foreach-|
   
	</table>
	
	<div>
		<input type="hidden" name="do" value="lausiAddressesDoImport" />
		<input type="submit" name="submit_import" value="Cargar" id="submit_import" />
	</div>
	
</form>