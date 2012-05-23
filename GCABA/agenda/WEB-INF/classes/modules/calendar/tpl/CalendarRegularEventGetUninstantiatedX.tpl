<fieldset><form>
<h1>Crear Efemérides</h1>
<p>Agregue las efemérides al calendario</p>
<table>
	<thead>
		<th width="80%">Feriado</th>
		<th width="15%">Fecha</th>
		<th width="5%">&nbsp;</th>
	</thead>
	<tbody>
		|-foreach $years as $year-|
			<tr><th colspan="3">|-$year-|</th></tr>
		|-foreach $uninstantiatedRegEvents.$year as $regEvent-|
			<tr>
				<td>|-$regEvent->getName()-|</td>
				<td>|-$regEvent->getDate('%d/%m')-|</td>
				<td id="createHolidayButton_|-$regEvent->getId()-|_|-$year-|"><input title="crear feriado" class="icon iconAdd" onclick="createHolidayFromRegEvent('|-$regEvent->getId()-|', '|-$year-|')" />
				</td>
			</tr>
		|-/foreach-|
	|-/foreach-|
	</tbody>
</table></form></fieldset>

<script>
|-foreach $years as $year-|
	|-if $uninstantiatedRegEvents.$year|count gt 0-|
		$('#uninstantiatedRegEventsFancyboxDummy').click();
	|-/if-|
|-/foreach-|
</script>