|-popup_init src="scripts/overlib.js"-|
<link type="text/css" href="css/chosen.css" rel="stylesheet" />
<script language="JavaScript" type="text/javascript" src="scripts/jquery/chosen.js"></script>
<link type="text/css" href="css/smoothness/jquery-ui-1.8.19.custom.css" rel="Stylesheet" />
<script type="text/javascript" src="scripts/jquery/jquery-ui-1.8.19.custom.min.js"></script>
<link type="text/css" href="css/jquery-ui-timepicker-addon.css" rel="Stylesheet" />
<script type="text/javascript" src="scripts/jquery/jquery-ui-timepicker-addon.js"></script>
<script type="text/javascript" src="scripts/jquery/jquery.ui.datepicker-es.js"></script>
<script type="text/javascript" src="scripts/jquery/jquery.ui.timepicker-es.js"></script>
<script type="text/javascript" src="scripts/jquery/jquery-ui-sliderAccess.js"></script>
<script type="text/javascript" src="scripts/jquery/jquery.ui.touch-punch.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		
		$(".chzn-select").chosen();
		initializeDatePickers();
		
		$('#calendarEvent_street').change(updateLocateButton);
		$('#calendarEvent_number').change(updateLocateButton);
		$('#calendarEvent_latitude').change(updateLocateButton);
		$('#calendarEvent_longitude').change(updateLocateButton);
	});
	
	function updateLocateButton() {
		
		var text;
		
		if ( $('#calendarEvent_latitude').val() != '' && $('#calendarEvent_street').val() != '' )
			text = 'Ver en mapa';
		else
			text = 'Buscar en mapa';
		
		$('#button_locate').attr('value', text);
		$('#button_locate').attr('title', text);
	}
	
	function initializeDatePickers() {
		$.datepicker.setDefaults({
			dateFormat: 'dd-mm-yy',
			numberOfMonths: 3
//			minDate: 0	
		});
		$.timepicker.setDefaults({
			hourGrid: 3,
			minuteGrid: 5,
			addSliderAccess: true,
			sliderAccessArgs: { touchonly: false }
		});
		$('#calendarEvent_creationDate').datetimepicker();
		$('#calendarEvent_startDate').datetimepicker();
		$('#calendarEvent_endDate').datetimepicker();
	}
</script>
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
					<input name="calendarEvent[title]" type="text" id="calendarEvent_title" title="title" value="|-$calendarEvent->getTitle()|escape-|" class="emptyValidation" size="60" maxlength="255" |-js_char_counter object=$calendarEvent columnName="title" fieldName="calendarEvent_title" idRemaining="remaining" sizeRemaining="3" classRemaining="charCount" counterTitle="Cantidad de caracteres restantes" showHide=1 useSpan=0-||-$Counter.pre-| /> |-$Counter.pos-| |-validation_msg_box idField="calendarEvent_title"-|
				</p>
|-if $calendarEventsConfig.useSummary.value eq "YES"-|<p>
					<label for="calendarEvent_summary">Resumen</label>
					<textarea name="calendarEvent[summary]" cols="60" rows="4" wrap="VIRTUAL" id="calendarEvent_summary">|-$calendarEvent->getsummary()|escape-|</textarea>
				</p>|-/if-|
				<p>
					<label for="calendarEvent_body">Descripción</label>
					<textarea name="calendarEvent[body]" cols="60" rows="15" wrap="VIRTUAL"  id="calendarEvent_body">|-$calendarEvent->getbody()|escape-|</textarea>
			</p>
				<p>
|-if $calendarEventsConfig.useSource.value eq "YES"-|<label for="calendarEvent_sourceContact">Más información</label>
					<input name="calendarEvent[sourceContact]" type="text" id="calendarEvent_sourceContact" title="sourceContact" value="|-$calendarEvent->getsourceContact()|escape-|" size="60" maxlength="150" />
				</p>|-/if-|
				<p style="display: none">
					<label for="calendarEvent_creationDate">Fecha de Creación</label>
					<input name="calendarEvent[creationDate]" type="text" id="calendarEvent_creationDate" title="creationDate" value="|-if $calendarEvent->isNew()-||-$smarty.now|dateTime_format|change_timezone|date_format:"%d-%m-%Y"-||-else-||-$calendarEvent->getcreationDate()|dateTime_format-||-/if-|" size="18" />
					<a href="#" |-popup sticky=true caption="Fechas de la agenda" trigger="onMouseOver" text="Las fechas deben completarse para que el evento se registre correctamente.<br />La fecha de creación ubicará el evento por orden descendente en la página principal, las fechas de inicio y fin de la actividad le indican al sistema la vigencia del mismo." snapx=10 snapy=10-|><img src="images/clear.png" class="linkImageInfo"></a>
				</p>
				<p>
					<label for="calendarEvent_startDate">Fecha de Inicio Actividad</label>
					<input name="calendarEvent[startDate]" type="text" id="calendarEvent_startDate" title="creationDate" value="|-$calendarEvent->getstartDate()|dateTime_format-|" size="18" /> 
					<a href="#" |-popup sticky=true caption="Fechas de la agenda" trigger="onMouseOver" text="Las fechas deben completarse para que el evento se registre correctamente.<br />La fecha de creación ubicará el evento por orden descendente en la página principal, las fechas de inicio y fin de la actividad le indican al sistema la vigencia del mismo." snapx=10 snapy=10-|><img src="images/clear.png" class="linkImageInfo"></a>
				</p>
				<p>
					<label for="calendarEvent_endDate">Fecha de Fin Actividad</label>
					<input name="calendarEvent[endDate]" type="text" id="calendarEvent_endDate" title="endDate" value="|-$calendarEvent->getendDate()|dateTime_format-|" size="18" /> 
					<a href="#" |-popup sticky=true caption="Fechas de la agenda" trigger="onMouseOver" text="Las fechas deben completarse para que el evento se registre correctamente.<br />La fecha de creación ubicará el evento por orden descendente en la página principal, las fechas de inicio y fin de la actividad le indican al sistema la vigencia del mismo." snapx=10 snapy=10-|><img src="images/clear.png" class="linkImageInfo"></a>
				</p>							
				<p>
					<label for="calendarEvent_allDay">Evento de todo el día</label>
					<input name="calendarEvent[allDay]" type="hidden" value="0">
					<input name="calendarEvent[allDay]" type="checkbox" |-$calendarEvent->getAllDay()|checked_bool-| value="1">
				</p>
		<p>
			<label for="calendarEvent_scheduleStatus">Estado</label>
			<select id="calendarEvent_scheduleStatus" name="calendarEvent[scheduleStatus]" title="Estado de fecha y hora">
				<option value="">Seleccione estado</option>
				|-foreach from=$scheduleStatuses key=key item=name-|
							<option value="|-$key-|" |-$calendarEvent->getScheduleStatus()|selected:$key-|>|-$name-|</option>
				|-/foreach-|
			</select>
		</p>
				<p>
					<label for="calendarEvent_street">Calle</label>
					<input name="calendarEvent[street]" type="text" id="calendarEvent_street" title="calle" value="|-$calendarEvent->getStreet()-|" size="30" />
				</p>
				<p>
					<label for="calendarEvent_number">Número</label>
					<input name="calendarEvent[number]" type="text" id="calendarEvent_number" title="número" value="|-$calendarEvent->getNumber()-|" size="8" />
				</p>
|-include file="CalendarEventsMapInclude.tpl" locateButtonId="button_locate" disableId="button_edit_calendarEvent" streetId="calendarEvent_street" numberId="calendarEvent_number" latitudeId="calendarEvent_latitude" longitudeId="calendarEvent_longitude"-|
				<p>
					|-if !($calendarEvent->getLatitude() eq '') && !($calendarEvent->getStreet() eq '')-|
						|-assign var=locateButtonText value="Ver en mapa"-|
					|-else-|
						|-assign var=locateButtonText value="Buscar en mapa"-|
					|-/if-|
					<input type="button" id="button_locate" value="|-$locateButtonText-|" title="|-$locateButtonText-|" />
				</p>
				<p style="display: none">
					<label for="calendarEvent_latitude">Latitud</label>
					<input name="calendarEvent[latitude]" type="text" id="calendarEvent_latitude" title="latitud" value="|-$calendarEvent->getLatitude()-|" size="20" readonly="readonly" />
				</p>
				<p style="display: none">
					<label for="calendarEvent_longitude">Longitud</label>
					<input name="calendarEvent[longitude]" type="text" id="calendarEvent_longitude" title="longitud" value="|-$calendarEvent->getLongitude()-|" size="20" readonly="readonly"/>
				</p>
				<p>
					<label for="calendarEvent_status">Confirmación</label>
					<select name="calendarEvent[status]" id="calendarEvent_status">
						|-foreach from=$eventStatuses key=key item=name-|
							<option value="|-$key-|" |-$calendarEvent->getStatus()|selected:$key-|>|-$name-|</option>
						|-/foreach-|
					</select>
				</p>
				<p>
					<label for="calendarEvent_agendaType">Agenda</label>
					<select name="calendarEvent[agendaType]" id="calendarEvent_agendaType">
							<option>Seleccione una Agenda</option>
						|-foreach from=$agendaTypes key=key item=name-|
							<option value="|-$key-|" |-$calendarEvent->getAgendaType()|selected:$key-|>|-$name-|</option>
						|-/foreach-|
					</select>
				</p>
			<p><label for="calendarEvent_kind">Tipo de evento</label>
				<select name="calendarEvent[kind]" id="calendarEvent_kind">
					<option value="0">Seleccione Tipo de evento</option>
				|-foreach from=$kinds item=kind name=foreach_kinds-|
					<option value="|-$kind@key-|" |-$calendarEvent->getKind()|selected:$kind@key-|>|-$kind-|</option>
				|-/foreach-|
				</select>
		</p>
				<p>
					<input type="hidden" name="setRegions" value="1" />
					<label for="calendarEvent_regions">Comunas/Barrios</label>
					<select class="chzn-select markets-chz-select" data-placeholder="Seleccione una o varias comunas/barrios..." multiple="multiple" id="calendarEvent_regions" name="calendarEvent[regionsIds][]" size="5" title="comunas">
					|-foreach from=$regions item=object-|
						<option value="|-$object->getid()-|" |-$calendarEvent->hasRegion($object)|selected:true-|>|-$object->getname()-|</option>
					|-/foreach-|
					</select>
				</p>
				<p>
					<input type="hidden" name="setCategories" value="1" />
					<label for="calendarEvent_categories">Dependencias</label>
					<select class="chzn-select markets-chz-select" data-placeholder="Seleccione una o varias dependencias..." multiple="multiple" id="calendarEvent_categories" name="calendarEvent[categoriesIds][]" size="5" title="dependencias">
					|-foreach from=$categories item=object-|
						<option value="|-$object->getid()-|" |-$calendarEvent->hasCategory($object)|selected:true-|>|-$object->getname()-|</option>
					|-/foreach-|
					</select>
				</p>
				<p>
					<input type="hidden" name="setActors" value="1" />
					<label for="calendarEvent_actors">Funcionarios</label>
					<select class="chzn-select markets-chz-select" data-placeholder="Seleccione uno o varios funcionarios..." multiple="multiple" id="calendarEvent_actors" name="calendarEvent[actorsIds][]" size="5" title="actores">
					|-foreach from=$actors item=object-|
						<option value="|-$object->getid()-|" |-$calendarEvent->hasActor($object)|selected:true-|>|-$object->getname()-|</option>
					|-/foreach-|
					</select>
				</p>
				<p>
					<label for="calendarEvent_axisId">Eje</label>
					<select id="calendarEvent_axis" name="calendarEvent[axisId]" title="Eje de gestión">
						<option value="">Seleccione el eje</option>
					|-foreach from=$axes item=object-|
						<option value="|-$object->getId()-|" |-$calendarEvent->getAxisId()|selected:$object->getId()-|>|-$object->getName()-|</option>
					|-/foreach-|
					</select>
				</p>
		<p>
			<label for="calendarEvent_agenda">Agenda</label>
			<select id="calendarEvent_agenda" name="calendarEvent[agenda]" title="Agenda">
				<option value="0" selected="selected">Todas</option>
				|-foreach from=$agendas item=agenda name=foreach_agendas-|
					<option value="|-$agenda@key-|" |-$calendarEvent->getAgenda()|selected:$agenda@key-|>|-$agenda-|</option>
				|-/foreach-|
				</select>
		</p>
				<p>
					<label for="calendarEvent_typeId">Formato</label>
					<select id="calendarEvent_typeId" name="calendarEvent[typeId]" title="tipo de evento">
						<option value="">Seleccione un formato</option>
					|-foreach from=$eventTypes item=object-|
						<option value="|-$object->getid()-|" |-$calendarEvent->getTypeId()|selected:$object->getId()-|>|-$object->getName()-|</option>
					|-/foreach-|
					</select>
				</p>
				<p>
					<label for="calendarEvent_campaignCommitment">CC</label>
					<input name="calendarEvent[campaignCommitment]" type="hidden" value="0">
					<input name="calendarEvent[campaignCommitment]" type="checkbox" |-$calendarEvent->getCampaignCommitment()|checked_bool-| value="1">
				</p>
				<p>
					<label for="calendarEvent_comments">Comentarios</label>
					<textarea name="calendarEvent[comments]" cols="60" rows="3" wrap="VIRTUAL" id="calendarEvent_comments">|-$calendarEvent->getComments()-|</textarea>
				</p>
				<p>
					<label for="calendarEvent_nonpublic">Privado</label>
					<input name="calendarEvent[nonpublic]" type="hidden" value="0">
					<input name="calendarEvent[nonpublic]" type="checkbox" |-$calendarEvent->getNonpublic()|checked_bool-| value="1">
				</p>
<!--				<p>
					<label for="calendarEvent_userId">Usuario</label>
					<select id="calendarEvent_userId" name="calendarEvent[userId]" title="userId">
						<option value="">Seleccione un Usuario</option>
					|-foreach from=$users item=object-|
						<option value="|-$object->getid()-|" |-$calendarEvent->getuserId()|selected:$object->getid()-|>|-$object->getusername()-|</option>
					|-/foreach-|
					</select>
				</p>-->
				<p>
					|-if !$calendarEvent->isNew()-|
					<input type="hidden" name="id" id="calendarEvent_id" value="|-$calendarEvent->getid()-|" />
					|-/if-|
					<!--pasaje de parametros de filtros -->
					|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
					<input type="hidden" name="do" id="doEdit" value="calendarEventsDoEdit" />
					|-javascript_form_validation_button id="button_edit_calendarEvent" value='Aceptar' title='Aceptar'-|
	<input type='button' onClick='location.href="Main.php?do=calendarEventsList|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($page)-|&page=|-$page-||-/if-|"' value='##104,Regresar##' title="Regresar al listado de Eventos"/>
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
