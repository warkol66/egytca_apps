|-foreach $years as $year-|
	<tr><td>|-$year-|</td></tr>
	|-foreach $uninstantiatedRegEvents.$year as $regEvent-|
		<tr>
			<td>|-$regEvent->getName()-|</td>
			<td>|-$regEvent->getDate('%d/%m')-|</td>
			<td id="createHolidayButton_|-$regEvent->getId()-|_|-$year-|">
				<input title="crear feriado" class="icon iconAdd" onclick="createHolidayFromRegEvent('|-$regEvent->getId()-|', '|-$year-|')" />
			</td>
		</tr>
	|-/foreach-|
|-/foreach-|

<script>
|-foreach $years as $year-|
	|-if $uninstantiatedRegEvents.$year|count gt 0-|
		$('#uninstantiatedRegEventsFancyboxDummy').click();
	|-/if-|
|-/foreach-|
</script>