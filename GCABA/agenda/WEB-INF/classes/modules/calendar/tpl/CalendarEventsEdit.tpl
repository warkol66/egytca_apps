|-include file='CalendarEventsEditTinyMceInclude.tpl' elements="calendarEvent_body" plugins="safari,style,table,advlink,inlinepopups,media,contextmenu,paste,nonbreaking"-|
|-popup_init src="scripts/overlib.js"-|
<h2>Administración de Eventos</h2>
<h1>|-if $action eq "edit"-|Editar|-else-|Crear|-/if-| Evento</h1>
|-if $message eq "error"-|
	<div class="failureMessage">Ha ocurrido un error al intentar guardar el evento</div>
|-/if-|
<div id="div_calendarEvents">
		<form name="form_edit_calendarEvent" id="form_edit_calendarEvent" action="Main.php" method="post">
			<p>Ingrese los datos del evento</p>
			<fieldset title="Formulario de edición de datos de un evento">
			<legend>Formulario de Calendario de Eventos</legend>
				<p>
					<label for="calendarEvent_title">Título</label>
					<input name="calendarEvent[title]" type="text" id="calendarEvent_title" title="title" value="|-$calendarEvent->getTitle()|escape-|" size="60" maxlength="255" />
				</p>
|-if $calendarEventsConfig.useSummary.value eq "YES"-|<p>
					<label for="calendarEvent_summary">Resumen</label>
					<textarea name="calendarEvent[summary]" cols="60" rows="4" wrap="VIRTUAL" id="calendarEvent_summary">|-$calendarEvent->getsummary()|escape-|</textarea>
				</p>|-/if-|
				<p>
					<label for="calendarEvent_body">Texto del Evento</label>
					<textarea name="calendarEvent[body]" cols="60" rows="15" wrap="VIRTUAL"  id="calendarEvent_body">|-$calendarEvent->getbody()|htmlentities-|</textarea>
			</p>
				<p>
|-if $calendarEventsConfig.useSource.value eq "YES"-|<label for="calendarEvent_sourceContact">Más información</label>
					<input name="calendarEvent[sourceContact]" type="text" id="calendarEvent_sourceContact" title="sourceContact" value="|-$calendarEvent->getsourceContact()|escape-|" size="60" maxlength="150" />
				</p>|-/if-|
				<p>
					<label for="calendarEvent_creationDate">Fecha de Creación</label>
					<input name="calendarEvent[creationDate]" type="text" id="calendarEvent_creationDate" title="creationDate" value="|-if $action eq 'edit'-||-$calendarEvent->getcreationDate()|date_format:"%d-%m-%Y"-||-else-||-$smarty.now|date_format:"%Y-%m-%d %T"|change_timezone|date_format:"%d-%m-%Y"-||-/if-|" size="12" /> 
					<img src="images/calendar.png" width="16" height="15" border="0" onclick="displayDatePicker('calendarEvent[creationDate]', false, '|-$parameters.dateFormat.value|lower|replace:'-':''-|', '-');" title="Seleccione la fecha">
					<a href="#" |-popup sticky=true caption="Fechas de la agenda" trigger="onMouseOver" text="Las fechas deben completarse para que el evento se registre correctamente.<br />La fecha de creación ubicará el evento por orden descendente en la página principal, las fechas de inicio y fin de la actividad le indican al sistema la vigencia del mismo." snapx=10 snapy=10-|><img src="images/clear.png" class="linkImageInfo"></a>
				</p>
				<p>
					<label for="calendarEvent_startDate">Fecha de Inicio Actividad</label>
					<input name="calendarEvent[startDate]" type="text" id="calendarEvent_startDate" title="creationDate" value="|-$calendarEvent->getstartDate()|date_format:"%d-%m-%Y"-|" size="12" /> 
					<img src="images/calendar.png" width="16" height="15" border="0" onclick="displayDatePicker('calendarEvent[startDate]', false, '|-$parameters.dateFormat.value|lower|replace:'-':''-|', '-');" title="Seleccione la fecha">
					<a href="#" |-popup sticky=true caption="Fechas de la agenda" trigger="onMouseOver" text="Las fechas deben completarse para que el evento se registre correctamente.<br />La fecha de creación ubicará el evento por orden descendente en la página principal, las fechas de inicio y fin de la actividad le indican al sistema la vigencia del mismo." snapx=10 snapy=10-|><img src="images/clear.png" class="linkImageInfo"></a>
				</p>
				<p>
					<label for="calendarEvent_endDate">Fecha de Fin Actividad</label>
					<input name="calendarEvent[endDate]" type="text" id="calendarEvent_endDate" title="endDate" value="|-$calendarEvent->getendDate()|date_format:"%d-%m-%Y"-|" size="12" /> 
					<img src="images/calendar.png" width="16" height="15" border="0" onclick="displayDatePicker('calendarEvent[endDate]', false, '|-$parameters.dateFormat.value|lower|replace:'-':''-|', '-');" title="Seleccione la fecha">
					<a href="#" |-popup sticky=true caption="Fechas de la agenda" trigger="onMouseOver" text="Las fechas deben completarse para que el evento se registre correctamente.<br />La fecha de creación ubicará el evento por orden descendente en la página principal, las fechas de inicio y fin de la actividad le indican al sistema la vigencia del mismo." snapx=10 snapy=10-|><img src="images/clear.png" class="linkImageInfo"></a>
				</p>							
				<p>
					<label for="calendarEvent_street">Calle</label>
					<input name="calendarEvent[street]" type="text" id="calendarEvent_street" title="calle" value="|-$calendarEvent->getStreet()-|" size="30" />
				</p>
				<p>
					<label for="calendarEvent_number">Número</label>
					<input name="calendarEvent[number]" type="text" id="calendarEvent_number" title="número" value="|-$calendarEvent->getNumber()-|" size="8" />
				</p>
				<p>
					<label for="calendarEvent_latitude">Latitud</label>
					<input name="calendarEvent[latitude]" type="text" id="calendarEvent_latitude" title="latitud" value="|-$calendarEvent->getLatitude()-|" size="20" />
				</p>
				<p>
					<label for="calendarEvent_longitude">Longitud</label>
					<input name="calendarEvent[longitude]" type="text" id="calendarEvent_longitude" title="longitud" value="|-$calendarEvent->getLongitude()-|" size="20" />
				</p>
				|-assign var=eventid value=$calendarEvent->getId()-|
				|-if not empty($eventid)-|
				<p>
					<label for="calendarEvent_status">Estado</label>
					<select name="calendarEvent[status]" id="calendarEvent_status">
						|-foreach from=$calendarEventStatus key=key item=name-|
							<option value="|-$key-|" |-$calendarEvent->getStatus()|selected:$key-|>|-$name-|</option>
						|-/foreach-|
					</select>
				</p>|-/if-|
				<p>
					<label for="calendarEvent_agendaType">Agenda</label>
					<select name="calendarEvent[agendaType]" id="calendarEvent_agendaType">
							<option>Seleccione una Agenda</option>
						|-foreach from=$agendaTypes key=key item=name-|
							<option value="|-$key-|" |-$calendarEvent->getAgendaType()|selected:$key-|>|-$name-|</option>
						|-/foreach-|
					</select>
				</p>
|-if $calendarEventsConfig.useRegions.value eq "YES"-|<p>
					<label for="calendarEvent_regions">Comunas</label>
					<select multiple="multiple" id="calendarEvent_regions" name="calendarEvent[regionsIds][]" title="comunas">
					|-foreach from=$regions item=object-|
						<option value="|-$object->getid()-|" |-$calendarEvent->hasRegion($object)|selected:true-|>|-$object->getname()-|</option>
					|-/foreach-|
					</select>
				</p>|-/if-|
|-if $calendarEventsConfig.useCategories.value eq "YES"-|<p>
					<label for="calendarEvent_categories">Dependencias</label>
					<select multiple="multiple" id="calendarEvent_categories" name="calendarEvent[categoriesIds][]" title="dependencias">
					|-foreach from=$categories item=object-|
						<option value="|-$object->getid()-|" |-$calendarEvent->hasCategory($object)|selected:true-|>|-$object->getname()-|</option>
					|-/foreach-|
					</select>
				</p>|-/if-|
				<p>
					<label for="calendarEvent_actors">Actores</label>
					<select multiple="multiple" id="calendarEvent_actors" name="calendarEvent[actorsIds][]" title="actores">
					|-foreach from=$categories item=object-|
						<option value="|-$object->getid()-|" |-$calendarEvent->hasActor($object)|selected:true-|>|-$object->getname()-|</option>
					|-/foreach-|
					</select>
				</p>
				<p>
					<label for="calendarEvent_axes">Ejes</label>
					<select multiple="multiple" id="calendarEvent_axes" name="calendarEvent[axesIds][]" title="ejes">
					|-foreach from=$axes item=object-|
						<option value="|-$object->getid()-|" |-$calendarEvent->hasCalendarAxis($object)|selected:true-| style="color:|-$object->getColor()-|;">|-$object->getname()-|</option>
					|-/foreach-|
					</select>
				</p>
				<p>
					<label for="calendarEvent_typeId">Tipo de evento</label>
					<select id="calendarEvent_typeId" name="calendarEvent[typeId]" title="tipo de evento">
						<option value="">Seleccione un Tipo</option>
					|-foreach from=$eventTypes item=object-|
						<option value="|-$object->getid()-|" |-$calendarEvent->getTypeId()|selected:$object->getid()-|>|-$object->getname()-|</option>
					|-/foreach-|
					</select>
				</p>
				<p>
					<label for="calendarEvent_userId">Usuario</label>
					<select id="calendarEvent_userId" name="calendarEvent[userId]" title="userId">
						<option value="">Seleccione un Usuario</option>
					|-foreach from=$users item=object-|
						<option value="|-$object->getid()-|" |-$calendarEvent->getuserId()|selected:$object->getid()-|>|-$object->getusername()-|</option>
					|-/foreach-|
					</select>
				</p>
				<p>
					|-if $action eq "edit"-|
					<input type="hidden" name="calendarEvent[id]" id="calendarEvent_id" value="|-$calendarEvent->getid()-|" />
					|-/if-|
					
					<!--pasaje de parametros de filtros -->
					|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
					
					<input type="hidden" name="action" id="action" value="|-$action-|" />
					<input type="hidden" name="do" id="doEdit" value="calendarEventsDoEdit" />
					<input type="button" id="button_edit_calendarEvent" name="button_edit_calendarEvent" title="Aceptar" value="Aceptar" onClick="javascript:submitEventCreation(this.form)"  />
|-if $calendarEventsConfig.bodyOnEventsShow.value eq "YES"-|
					<input type="button" id="button_edit_calendarEvent" name="button_edit_calendarEvent" title="Aceptar" value="Vista previa del evento" onClick="javascript:submitEventsPreviewDetailed(this.form)"  />
|-else-|
<input type="button" id="button_edit_calendarEvent" name="button_edit_calendarEvent" title="Aceptar" value="Vista previa en Home" onClick="javascript:submitEventsPreviewOnHome(this.form)"/>
					<input type="button" id="button_edit_calendarEvent" name="button_edit_calendarEvent" title="Aceptar" value="Vista previa del Detalle" onClick="javascript:submitEventsPreviewDetailed(this.form)"  />
|-/if-|
				</p>
			</fieldset>
		</form>
	</div>
|-if $calendarEventsConfig.useImages.value eq "YES" || $calendarEventsConfig.useAudio.value eq "YES" || $calendarEventsConfig.useVideo.value eq "YES"-|
	<div id="mediasListHolder">
		|-include file='CalendarMediasListInclude.tpl'-|
	</div>
	|-if $action eq 'edit'-|
		|-include file='CalendarMediasAddInclude.tpl' calendarEvent=$calendarEvent-|
	|-/if-|
	|-/if-|
