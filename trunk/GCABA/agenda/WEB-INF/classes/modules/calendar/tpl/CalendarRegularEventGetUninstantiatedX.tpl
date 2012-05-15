|-foreach $uninstantiatedRegEvents as $regEvent-|
	<tr>
		<td>|-$regEvent->getName()-|</td>
		<td>|-$regEvent->getDate('%d/%m')-|</td>
		<td id="createHolidayButton_|-$regEvent->getId()-|">
			<input title="crear feriado" class="icon iconAdd" onclick="createHolidayFromRegEvent('|-$regEvent->getId()-|', '|-$year-|')" />
		</td>
	</tr>
|-/foreach-|