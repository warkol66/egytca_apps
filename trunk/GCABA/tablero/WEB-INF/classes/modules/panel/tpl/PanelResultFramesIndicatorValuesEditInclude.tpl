|-if $indicatorValues ne '' and count($indicatorValues) > 0 -|
	<table>
		<thead>
			<tr>
				<th style="width: 10%; padding-left: 0px;">Año</th>
				<th style="width: 45%; padding-left: 0px;">Meta</th>
				<th style="width: 45%; padding-left: 0px;">Resultado</th>
			</tr>
		</thead>
		<tbody>
		|-foreach from=$indicatorValues key=year item=indicatorValue name=foreach_indicators-|
			<tr>
				<input type="hidden" name="indicatorValuesParams[|-$year-|][year]" value="|-$indicatorValue->getYear()-|"/>
				<td><label for="indicatorValuesParams[|-$year-|][value]" style="width: auto;">|-$indicatorValue->getYear()-|</label></td>
				<td><input type="text" id="indicator_value_|-$year-|" class="indicatorValue" name="indicatorValuesParams[|-$year-|][goal]" value="|-$indicatorValue->getGoal()-|" size="35" title="Valor meta para |-$year-|"|-javascript_onchange_validation_attribute idField="indicator_value_$year"-| /></td>
				<td><input type="text" id="indicator_goal_|-$year-|" class="indicatorValue" name="indicatorValuesParams[|-$year-|][value]" value="|-$indicatorValue->getValue()-|" size="35" title="Valor resultado para |-$year-|"|-javascript_onchange_validation_attribute idField="indicator_goal_$year"-| /></td>
			</tr>
		|-/foreach-|
		</tbody>
	</table>
|-/if-|