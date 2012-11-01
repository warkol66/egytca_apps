|-if $entityNameFields ne '' and count($entityNameFields) > 0 -|
<p>
	<label for="scheduleSubscription[entityNameFieldUniqueName]">Campo a mostrar como nombre</label>
	<select name="scheduleSubscription[entityNameFieldUniqueName]">
		|-foreach from=$entityNameFields item=entityField-|
			<option value="|-$entityField->getUniqueName()-|" |-if $entityField->getUniqueName() eq $scheduleSubscription->getEntityNameFieldUniqueName()-|selected|-/if-|>|-$entityField->getName()-|</option>
		|-/foreach-|
	</select>
</p>
|-/if-|

|-if $entityDateFields ne '' and count($entityDateFields) > 0 -|
<p>
	<label for="scheduleSubscription[entityDateFieldUniqueName]">Campo a inspeccionar</label>
	<select name="scheduleSubscription[entityDateFieldUniqueName]">
		|-foreach from=$entityDateFields item=entityField-|
			<option value="|-$entityField->getUniqueName()-|" |-if $entityField->getUniqueName() eq $scheduleSubscription->getEntityDateFieldUniqueName()-|selected|-/if-|>|-$entityField->getName()-|</option>
		|-/foreach-|
	</select>
</p>
<p>
	<label for="scheduleSubscription[anticipationDays]">Días de anticipación</label>
	<input type="text" id="scheduleSubscription[anticipationDays]" name="scheduleSubscription[anticipationDays]" class="numericValidation" value="|-$scheduleSubscription->getAnticipationDays()-|" |-$action|readonly-| |-javascript_onchange_validation_attribute idField="scheduleSubscription[anticipationDays]"-| />
</p>
<p>
	<label for="scheduleSubscription[entityBooleanFieldUniqueName]">Campo a evaluar como falso para realizar el envío.</label>
	<select name="scheduleSubscription[entityBooleanFieldUniqueName]">
		<option value="">--Ninguno--</option>
		|-foreach from=$entityBooleanFields item=entityField-|
			<option value="|-$entityField->getUniqueName()-|" |-if $entityField->getUniqueName() eq $scheduleSubscription->getEntityBooleanFieldUniqueName()-|selected|-/if-|>|-$entityField->getName()-|</option>
		|-/foreach-|
	</select>
</p>
|-/if-|