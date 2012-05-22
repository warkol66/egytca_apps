<link type="text/css" href="css/chosen.css" rel="stylesheet" />
<script language="JavaScript" type="text/javascript" src="scripts/jquery/chosen.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
//		$(".chzn-select").chosen(); fancybox lo rompe
	});
</script>
<fieldset>
<form action="|-$action-|" method="|-$method-|" onsubmit="|-$onsubmit|escape-|">
	<h1>Editar evento</h1>

		<p>
			<label for="calendarEvent_title">Título</label>
			<input name="calendarEvent[title]" type="text" id="calendarEvent_title" title="title" value="" size="60" maxlength="255" />
		</p>
		<p>
			<label for="calendarEvent_body">Texto del Evento</label>
			<textarea name="calendarEvent[body]" cols="60" rows="3" wrap="VIRTUAL" id="calendarEvent_body"></textarea>
		</p>
		<input name="calendarEvent[creationDate]" type="hidden" id="calendarEvent_creationDate" title="creationDate" value="" size="18" />
		<input name="calendarEvent[startDate]" type="hidden" id="calendarEvent_startDate" title="startDate" value="" size="18" /> 
		<input name="calendarEvent[endDate]" type="hidden" id="calendarEvent_endDate" title="endDate" value="" size="18" /> 
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
				|-foreach from=$eventStatuses key=key item=name-|
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
			<p><label for="calendarEvent_kind">Tipo de evento</label>
				<select name="calendarEvent[kind]" id="calendarEvent_kind">
					<option value="0">Seleccione Tipo de evento</option>
				|-foreach from=$kinds item=kind name=foreach_kinds-|
					<option value="|-$kind@key-|">|-$kind-|</option>
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
				|-foreach from=$actors item=object-|
					<option value="|-$object->getid()-|">|-$object-|</option>
				|-/foreach-|
			</select>
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
		<p>
			<label for="calendarEvent_typeId">Formato</label>
			<select id="calendarEvent_typeId" name="calendarEvent[typeId]" title="tipo de evento">
				<option value="">Seleccione un formato</option>
				|-foreach from=$eventTypes item=object-|
					<option value="|-$object->getid()-|">|-$object->getName()-|</option>
				|-/foreach-|
			</select>
		</p>
		<p>
			<label for="calendarEvent_campaignCommitment">C. Campaña</label>
			<input name="calendarEvent[campaignCommitment]" type="hidden" value="0">
			<input name="calendarEvent[campaignCommitment]" type="checkbox" value="1">
		</p>
		<p>
			<label for="calendarEvent_comments">Comentarios</label>
			<textarea name="calendarEvent[comments]" cols="60" rows="3" wrap="VIRTUAL" id="calendarEvent_comments"></textarea>
		</p>
		<p>
			<label for="calendarEvent_nonpublic">Privado</label>
			<input name="calendarEvent[nonpublic]" type="hidden" value="0">
			<input name="calendarEvent[nonpublic]" type="checkbox" value="1">
		</p>
<!--		<p>
			<label for="calendarEvent_userId">Usuario</label>
			<select id="calendarEvent_userId" name="calendarEvent[userId]" title="userId">
				<option value="">Seleccione un Usuario</option>
				|-foreach from=$users item=object-|
					<option value="|-$object->getid()-|">|-$object->getusername()-|</option>
				|-/foreach-|
			</select>
		</p> -->
		<input type="hidden" id="calendarEvent_id" name="id" value="" />
		<p class="arrangeButtons">
			<input type="button" id="acceptButton" value="Aceptar" onclick="|-$onaccept|escape-|" />
			<input type='button' id="cancelButton" onClick='|-$oncancel|escape-|' value='Cancelar' />
		</p>
	</form>
</fieldset>
