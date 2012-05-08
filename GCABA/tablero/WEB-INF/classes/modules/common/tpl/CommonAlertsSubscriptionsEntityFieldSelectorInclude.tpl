|-if $entityNameFields ne '' and count($entityNameFields) > 0 -|
<p>
	<label for="alertSubscription[entityNameFieldUniqueName]">Campo a mostrar como nombre</label>
	<select name="alertSubscription[entityNameFieldUniqueName]">
		|-foreach from=$entityNameFields item=entityField-|
			<option value="|-$entityField->getUniqueName()-|" |-if $entityField->getUniqueName() eq $alertSubscription->getEntityNameFieldUniqueName()-|selected|-/if-|>|-$entityField->getName()-|</option>
		|-/foreach-|
	</select>
</p>
|-/if-|

|-if $entityFields ne '' and count($entityFields) > 0 -|
<p>
	<label for="alertSubscription[entityFieldUniqueName]">Campo a inspeccionar</label>
	<select name="alertSubscription[entityFieldUniqueName]">
		|-foreach from=$entityFields item=entityField-|
			<option value="|-$entityField->getUniqueName()-|" |-if $entityField->getUniqueName() eq $alertSubscription->getEntityFieldUniqueName()-|selected|-/if-|>|-$entityField->getName()-|</option>
		|-/foreach-|
	</select>
</p>
<p>
	<label for="alertSubscription[anticipationDays]">Días de anticipación</label>
	<input type="text" id="alertSubscription[anticipationDays]" name="alertSubscription[anticipationDays]" class="numericValidation" value="|-$alertSubscription->getAnticipationDays()-|" |-$action|readonly-| |-javascript_onchange_validation_attribute idField="alertSubscription[anticipationDays]"-| />
</p>
|-/if-|