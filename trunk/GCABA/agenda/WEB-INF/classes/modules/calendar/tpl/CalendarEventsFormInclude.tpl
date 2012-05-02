<form action="|-$action-|" method="|-$method-|" onsubmit="|-$onsubmit|escape-|">
		<p>
			<label for="calendarEvent_title">Título</label>
			<input name="calendarEvent[title]" type="text" id="calendarEvent_title" title="title" value="" size="60" maxlength="255" />
		</p>
		<p>
			<label for="calendarEvent_body">Texto del Evento</label>
			<textarea name="calendarEvent[body]" cols="60" rows="15" wrap="VIRTUAL"  id="calendarEvent_body"></textarea>
		</p>
		<p>
			<label for="calendarEvent_creationDate">Fecha de Creación</label>
			<input name="calendarEvent[creationDate]" type="text" id="calendarEvent_creationDate" title="creationDate" value="|-$smarty.now|dateTime_format|change_timezone|date_format:"%d-%m-%Y"-|" size="18" />
		</p>
		<p>
			<label for="calendarEvent_startDate">Fecha de Inicio Actividad</label>
			<input name="calendarEvent[startDate]" type="text" id="calendarEvent_startDate" title="startDate" value="" size="18" /> 
		</p>
		<p>
			<label for="calendarEvent_endDate">Fecha de Fin Actividad</label>
			<input name="calendarEvent[endDate]" type="text" id="calendarEvent_endDate" title="endDate" value="" size="18" /> 
		</p>
		<p>
			<label for="calendarEvent_street">Calle</label>
			<input name="calendarEvent[street]" type="text" id="calendarEvent_street" title="calle" value="" size="30" />
		</p>
		<p>
			<label for="calendarEvent_number">Número</label>
			<input name="calendarEvent[number]" type="text" id="calendarEvent_number" title="número" value="" size="8" />
		</p>
|-*
|-include file="CalendarEventsMapInclude.tpl" locateButtonId="button_locate" disableId="button_edit_calendarEvent" streetId="calendarEvent_street" numberId="calendarEvent_number" latitudeId="calendarEvent_latitude" longitudeId="calendarEvent_longitude"-|
		<p>
			|-if !($calendarEvent->getLatitude() eq '') && !($calendarEvent->getStreet() eq '')-|
				|-assign var=locateButtonText value="Ver en mapa"-|
			|-else-|
				|-assign var=locateButtonText value="Buscar en mapa"-|
			|-/if-|
			<input type="button" id="button_locate" value="|-$locateButtonText-|" title="|-$locateButtonText-|" />
		</p>
*-|
		<p style="display: none">
			<label for="calendarEvent_latitude">Latitud</label>
			<input name="calendarEvent[latitude]" type="text" id="calendarEvent_latitude" title="latitud" value="" size="20" readonly="readonly" />
		</p>
		<p style="display: none">
			<label for="calendarEvent_longitude">Longitud</label>
			<input name="calendarEvent[longitude]" type="text" id="calendarEvent_longitude" title="longitud" value="" size="20" readonly="readonly"/>
		</p>
		<p>
			<label for="calendarEvent_status">Estado</label>
			<select name="calendarEvent[status]" id="calendarEvent_status">
				|-foreach from=$calendarEventStatus key=key item=name-|
					<option value="|-$key-|">|-$name-|</option>
				|-/foreach-|
			</select>
		</p>
		<p>
			<label for="calendarEvent_agendaType">Agenda</label>
			<select name="calendarEvent[agendaType]" id="calendarEvent_agendaType">
				<option>Seleccione una Agenda</option>
				|-foreach from=$agendaTypes key=key item=name-|
					<option value="|-$key-|">|-$name-|</option>
				|-/foreach-|
			</select>
		</p>
|-if $calendarEventsConfig.useRegions.value eq "YES"-|<p>
			<label for="calendarEvent_regions">Comunas</label>
			<select class="chzn-select markets-chz-select" data-placeholder="Seleccione una o varias comunas..." multiple="multiple" id="calendarEvent_regions" name="calendarEvent[regionsIds][]" size="5" title="comunas">
				|-foreach from=$regions item=object-|
					<option value="|-$object->getid()-|">|-$object->getname()-|</option>
				|-/foreach-|
			</select>
		</p>|-/if-|
|-if $calendarEventsConfig.useCategories.value eq "YES"-|<p>
			<label for="calendarEvent_categories">Dependencias</label>
			<select class="chzn-select markets-chz-select" data-placeholder="Seleccione una o varias dependencias..." multiple="multiple" id="calendarEvent_categories" name="calendarEvent[categoriesIds][]" size="5" title="dependencias">
				|-foreach from=$categories item=object-|
					<option value="|-$object->getid()-|">|-$object->getname()-|</option>
				|-/foreach-|
			</select>
		</p>|-/if-|
		<p>
			<label for="calendarEvent_actors">Actores</label>
			<select class="chzn-select markets-chz-select" data-placeholder="Seleccione uno o varios actores..." multiple="multiple" id="calendarEvent_actors" name="calendarEvent[actorsIds][]" size="5" title="actores">
				|-foreach from=$categories item=object-|
					<option value="|-$object->getid()-|">|-$object->getname()-|</option>
				|-/foreach-|
			</select>
		</p>
		<p>
			<label for="calendarEvent_axisId">Eje de gestión</label>
			<select id="calendarEvent_axis" name="calendarEvent[axisId]" title="Eje de gestión">
				<option value="">Seleccione el eje</option>
				|-foreach from=$axes item=object-|
					<option value="|-$object->getId()-|">|-$object->getName()-|</option>
				|-/foreach-|
			</select>
		</p>
		<p>
			<label for="calendarEvent_typeId">Tipo de evento</label>
			<select id="calendarEvent_typeId" name="calendarEvent[typeId]" title="tipo de evento">
				<option value="">Seleccione un Tipo</option>
				|-foreach from=$eventTypes item=object-|
					<option value="|-$object->getid()-|">|-$object->getName()-|</option>
				|-/foreach-|
			</select>
		</p>
		<p>
			<label for="calendarEvent_campaignCommitment">Compromiso de campaña</label>
			<input name="calendarEvent[campaignCommitment]" type="hidden" value="0">
			<input name="calendarEvent[campaignCommitment]" type="checkbox" value="1">
		</p>
		<p>
			<label for="calendarEvent_userId">Usuario</label>
			<select id="calendarEvent_userId" name="calendarEvent[userId]" title="userId">
				<option value="">Seleccione un Usuario</option>
				|-foreach from=$users item=object-|
					<option value="|-$object->getid()-|">|-$object->getusername()-|</option>
				|-/foreach-|
			</select>
		</p>
		<p>
			<input type="button" id="acceptButton" value="Aceptar" onclick="|-$onaccept|escape-|" />
			|-*|-javascript_form_validation_button id="button_edit_calendarEvent" value='Aceptar' title='Aceptar'-|*-|
			<input type='button' id="cancelButton" onClick='|-$oncancel|escape-|' value='Cancelar' />
		</p>
	</form>