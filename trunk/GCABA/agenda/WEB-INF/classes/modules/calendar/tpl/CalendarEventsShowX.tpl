<div id="showEvent">
<fieldset>
	<h1>Ver datos del evento</h1>
		<p>
			<label for="calendarEvent_title">Título</label>
			<input name="calendarEvent[title]" type="text" id="calendarEvent_title" title="title" value="|-$event->getTitle()|escape:"double_quotes"-|" size="55" readonly="readonly" />
		</p>
		<p>
			<label for="calendarEvent_body">Texto del Evento</label>
			<textarea name="calendarEvent[body]" cols="60" rows="3" wrap="VIRTUAL" id="calendarEvent_body" readonly="readonly">|-$event->getBody()|escape:"double_quotes"-|</textarea>
		</p>
					<label for="calendarEvent_startDate">Fecha de Inicio Actividad</label>
					<input name="calendarEvent[startDate]" type="text" id="calendarEvent_startDate" title="creationDate" value="|-$event->getstartDate()|dateTime_format-|" size="18"  readonly="readonly"/> 
				</p>
				<p>
					<label for="calendarEvent_endDate">Fecha de Fin Actividad</label>
					<input name="calendarEvent[endDate]" type="text" id="calendarEvent_endDate" title="endDate" value="|-$event->getendDate()|dateTime_format-|" size="18"  readonly="readonly"/> 
		<p>
			<label for="calendarEvent_street">Dirección</label>
			<input name="calendarEvent[street]" type="text" id="calendarEvent_street" title="calle" value="|-$event->getAddress()-|" size="40"  readonly="readonly"/>
		</p>
		<p>
			<label for="calendarEvent_allDay">Evento de todo el día</label>
			<input name="calendarEvent[allDay]" type="checkbox" |-$event->getAllDay()|checked_bool-| value="1"  readonly="readonly" onclick="return false" onkeydown="return false">
		</p>
		<p>
			<label for="calendarEvent_scheduleStatus">Estado</label>
			<input id="calendarEvent_scheduleStatus" type="text" name="calendarEvent[scheduleStatus]" title="Estado de fecha y hora" size="25" value="|-$scheduleStatuses[$event->getScheduleStatus()]-|" readonly="readonly">
		</p>
<p>		<input type='button' id="cancelButton" onClick="$.fancybox.close();" value="Cerrar" /></p>

</fieldset>
</div>