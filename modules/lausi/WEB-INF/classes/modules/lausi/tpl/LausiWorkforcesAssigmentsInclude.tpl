<div id="workforcesAssigments">
<h3>Total Séxtuples por contratista de todos los motivos (|-if $filters.searchFromDate neq ''-||-$filters.searchFromDate-||-else-||-$smarty.now|date_format:"%d-%m-%Y"-||-/if-|)</h3>
	<table id="table-advertisement-not-assigned" border="0" cellpadding='5' cellspacing='0' class='tableTdBorders'>
		<thead>
			<tr>
				<th>Contratista</th>
				<th>Sextuples Asignados</th>
			</tr>
		</thead>
		<tbody>
			|-foreach from=$workforces item=workforce name=for_workforces-|
			<tr>
				<td>|-$workforce->getName()-|</td>
				<td align="right">|-$workforce->getAssignedAdvertisementsCount($date)-|</td>
			</tr>
			|-/foreach-|
		</tbody>
	</table>
</div>