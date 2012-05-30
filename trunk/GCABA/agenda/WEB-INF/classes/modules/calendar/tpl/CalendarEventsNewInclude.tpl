<div id="newEvent"><fieldset><form>
<h1>Crear nuevo evento</h1>
	<p>
		<label for="calendarEvent_title">Título</label>
		<input name="calendarEvent[title]" type="text" id="calendarEvent_title" title="title" value="" size="60" maxlength="255" />
	</p>
	<p>
		<label for="calendarEvent_axisId">Eje de gestión</label>
		<select id="calendarEvent_axisId" name="calendarEvent[axisId]" title="Eje de gestión">
			<option value="">Seleccione el eje</option>
			|-foreach from=$axes item=object-|
				<option value="|-$object->getId()-|">|-$object->getName()-|</option>
			|-/foreach-|
		</select>
	</p>
		<input type="hidden" id="calendarEvent_agenda" name="calendarEvent[agenda]" value="1">
		<input type="hidden" id="calendarEvent_status" name="calendarEvent[status]" value="1">
		<input type="hidden" id="calendarEvent_scheduleStatus" name="calendarEvent[scheduleStatus]" value="2">
	<p>
		<label for="calendarEvent_street">Calle</label>
		<input name="calendarEvent[street]" type="text" id="calendarEvent_street" title="calle" value="" size="30" />
	</p>
	<p>
		<label for="calendarEvent_number">Número</label>
		<input name="calendarEvent[number]" type="text" id="calendarEvent_number" title="número" value="" size="8" />
	</p>
	<p>
		<label for="calendarEvent_nonpublic">Privado</label>
		<input name="calendarEvent[nonpublic]" type="checkbox" value="1">
	</p>
	<p class="arrangeButtons">
		<input name="calendarEvent[creationDate]" type="hidden" id="calendarEvent_creationDate" title="creationDate" value="|-$smarty.now|dateTime_format|change_timezone|date_format:"%d-%m-%Y"-|" size="18" />
		<input name="calendarEvent[startDate]" type="hidden" id="calendarEvent_startDate" title="startDate" value="" size="18" />
		<input name="calendarEvent[endDate]" type="hidden" id="calendarEvent_endDate" title="endDate" value="" size="18" />
		<input type="button" id="acceptButton" value="Aceptar" onclick="doCreateEvent(this.form); $.fancybox.close();" />
		<input type='button' id="cancelButton" onClick='$.fancybox.close();' value='Cancelar' />
	</p>
</form></fieldset></div>