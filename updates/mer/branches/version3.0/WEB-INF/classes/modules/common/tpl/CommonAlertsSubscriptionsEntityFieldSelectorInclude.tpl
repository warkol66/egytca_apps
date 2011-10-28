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

|-if $entityDateFields ne '' and count($entityDateFields) > 0 -|
<p>
	<label for="alertSubscription[entityDateFieldUniqueName]">Campo a inspeccionar</label>
	<select name="alertSubscription[entityDateFieldUniqueName]">
		|-foreach from=$entityDateFields item=entityField-|
			<option value="|-$entityField->getUniqueName()-|" |-if $entityField->getUniqueName() eq $alertSubscription->getEntityDateFieldUniqueName()-|selected|-/if-|>|-$entityField->getName()-|</option>
		|-/foreach-|
	</select>
</p>
<p>
	<label for="alertSubscription[anticipationDays]">Días de anticipación</label>
	<input type="text" id="alertSubscription[anticipationDays]" name="alertSubscription[anticipationDays]" class="numericValidation" value="|-$alertSubscription->getAnticipationDays()-|" |-$action|readonly-| |-javascript_onchange_validation_attribute idField="alertSubscription[anticipationDays]"-| />
</p>
<p>
	<label for="alertSubscription[entityBooleanFieldUniqueName]">Campo a evaluar como falso para realizar el envío.</label>
	<select name="alertSubscription[entityBooleanFieldUniqueName]">
		<option value="">--Ninguno--</option>
		|-foreach from=$entityBooleanFields item=entityField-|
			<option value="|-$entityField->getUniqueName()-|" |-if $entityField->getUniqueName() eq $alertSubscription->getEntityBooleanFieldUniqueName()-|selected|-/if-|>|-$entityField->getName()-|</option>
		|-/foreach-|
	</select>
</p>
|-/if-|