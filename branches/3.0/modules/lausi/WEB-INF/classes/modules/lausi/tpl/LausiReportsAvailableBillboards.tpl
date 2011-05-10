<h2>Reportes</h2>
<h1>Carteleras Disponibles los proximos dias.</h1>
<div id="billboardsAvailable">
	
	<table class="tableTdBorders">
		<tbody>

		|- math equation="x * 2" x=$result.total.dates|@count assign=colspan-|
		|-foreach from=$result.total item=item name=for_result-|					
		<tr>
			<td colspan="|-$colspan-|"><h4>Totales</h4></td>
		<tr>
		<tr>
			|-foreach from=$result.total.dates item=dateHolder key=date name=for_dates-|
			<th colspan="2" align="center">|-$date|date_format:"%d-%m-%Y"-|			</th>
		|-/foreach-|
		</tr>	
		<tr>
			|-foreach from=$result.total.dates item=dateHolder key=date name=for_dates-|
			<th>
				Dobl.</th>				
			<th>
				Séxt.</th>
		|-/foreach-|		</tr>
		<tr>		
		<tr>
			|-foreach from=$result.total.dates item=dateHolder key=date name=for_dates-|
			<td align="center">
				|-$dateHolder.numberDoble-|			</td>				
			<td align="center">
				|-$dateHolder.numberSextuple-|			</td>
			|-/foreach-|		
		</tr>		
		|-/foreach-|
		|-foreach from=$result.circuit item=itemCircuit-|
			|-assign var=circuitName value=$itemCircuit.name-|
			|-assign var=dates value=$itemCircuit.dates-|
			|- math equation="x * 2" x=$itemCircuit.dates|@count assign=colspan-|			
			<tr>
				<td colspan="|-$colspan-|"><h4>|-$circuitName-|</h4></td>
			<tr>
			<tr>
				|-foreach from=$dates item=dateHolder key=date name=for_dates-|
				<th colspan="2" align="center">|-$date|date_format:"%d-%m-%Y"-|			</th>
			|-/foreach-|
			</tr>			
			<tr>
				|-foreach from=$dates item=dateHolder key=date name=for_dates-|
				<th>
					Dobl.</th>				
				<th>
					Séxt.</th>
			|-/foreach-|		</tr>
			<tr>
				|-foreach from=$dates item=dateHolder key=date name=for_dates-|
				<td align="center">|-$dateHolder.numberDoble-|</td>				
				<td align="center">|-$dateHolder.numberSextuple-|</td>
				|-/foreach-|		
			</tr>
		|-/foreach-|

		</tbody>
	</table>
