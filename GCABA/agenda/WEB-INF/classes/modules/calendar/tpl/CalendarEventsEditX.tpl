<link type="text/css" href="css/chosen.css" rel="stylesheet" />
<script language="JavaScript" type="text/javascript" src="scripts/jquery/chosen.js"></script>
<script type="text/javascript">
//	$(document).ready(function() {
//		$(".chzn-select").chosen();
//	});
</script>
<div id="editEvent">
<fieldset>
<form id="calendarEventsEditX_form">
	<h1>Editar evento</h1>
	
	<p>
		<label for="calendarEvent_title">Título</label>
		<input name="calendarEvent[title]" type="text" id="calendarEvent_title" title="title" value="|-$calendarEvent->getTitle()|escape-|" size="60" maxlength="255" />
	</p>
	<p>
		<label for="calendarEvent_body">Descripción</label>
		<textarea name="calendarEvent[body]" cols="60" rows="3" wrap="VIRTUAL" id="calendarEvent_body">|-$calendarEvent->getBody()|escape-|</textarea>
	</p>
	<input name="calendarEvent[creationDate]" type="hidden" id="calendarEvent_creationDate" title="creationDate" value="|-if $calendarEvent->isNew()-||-$smarty.now|dateTime_format|change_timezone|date_format:"%d-%m-%Y"-||-else-||-$calendarEvent->getcreationDate()|dateTime_format-||-/if-|" size="18" />
	|-if $calendarEvent->getScheduleStatus() gt 2-|			<p>
					<label for="calendarEvent_startDateX">Fecha de Inicio Actividad</label>
					<input name="calendarEvent[startDate]" type="text" id="calendarEvent_startDateX" title="creationDate" value="|-$calendarEvent->getstartDate()|dateTime_format-|" size="18" />
				</p>
				<p>
					<label for="calendarEvent_endDateX">Fecha de Fin Actividad</label>
					<input name="calendarEvent[endDate]" type="text" id="calendarEvent_endDateX" title="endDate" value="|-$calendarEvent->getendDate()|dateTime_format-|" size="18" /> 
				</p>|-else-|
				<input name="calendarEvent[startDate]" type="hidden" id="calendarEvent_startDate" title="startDate" value="|-$calendarEvent->getstartDate()|dateTime_format-|" size="18" /> 
				<input name="calendarEvent[endDate]" type="hidden" id="calendarEvent_endDate" title="endDate" value="|-$calendarEvent->getendDate()|dateTime_format-|" size="18" /> 
				|-/if-|
	<p>
		<label for="calendarEvent_street">Calle</label>
		<input name="calendarEvent[street]" type="text" id="calendarEvent_street" title="calle" value="|-$calendarEvent->getStreet()-|" size="30" />
	</p>
	<p>
		<label for="calendarEvent_number">Número</label>
		<input name="calendarEvent[number]" type="text" id="calendarEvent_number" title="número" value="|-$calendarEvent->getNumber()-|" size="8" />
	</p>
	<p>
		|-if !($calendarEvent->getLatitude() eq '') && !($calendarEvent->getStreet() eq '')-|
			|-assign var=locateButtonText value="Ver en mapa"-|
		|-else-|
			|-assign var=locateButtonText value="Buscar en mapa"-|
		|-/if-|
		<input type="button" id="button_locate" onclick="showMap();" value="|-$locateButtonText-|" title="|-$locateButtonText-|" />
	</p>
	<input name="calendarEvent[latitude]" type="hidden" id="calendarEvent_latitude" title="latitud" value="|-$calendarEvent->getLatitude()-|" size="20" readonly="readonly" />
	<input name="calendarEvent[longitude]" type="hidden" id="calendarEvent_longitude" title="longitud" value="|-$calendarEvent->getLongitude()-|" size="20" readonly="readonly"/>
	<p>
		<label for="calendarEvent_scheduleStatus">Confirmación</label>
		<select name="calendarEvent[scheduleStatus]" id="calendarEvent_scheduleStatus" title="Estado de fecha y hora">
			<option value="0">Seleccione confirmación</option>
			|-foreach from=$scheduleStatuses key=key item=name-|
				<option value="|-$key-|" |-$calendarEvent->getScheduleStatus()|selected:$key-|>|-$name-|</option>
			|-/foreach-|
		</select>
	</p>
	<p>
		<label for="calendarEvent_status">Estado</label>
		<select name="calendarEvent[status]" id="calendarEvent_status">
			|-foreach from=$eventStatuses key=key item=name-|
				<option value="|-$key-|" |-$calendarEvent->getStatus()|selected:$key-|>|-$name-|</option>
			|-/foreach-|
		</select>
	</p>
	<p>
		<label for="calendarEvent_agenda">Agenda</label>
		<select name="calendarEvent[agenda]" id="calendarEvent_agendaType">
			<option>Seleccione una Agenda</option>
			|-foreach from=$agendas key=key item=name-|
				<option value="|-$key-|" |-$calendarEvent->getAgenda()|selected:$key-|>|-$name-|</option>
			|-/foreach-|
		</select>
	</p>
	<p>
		<label for="calendarEvent_kind">Tipo de evento</label>
		<select name="calendarEvent[kind]" id="calendarEvent_kind">
			<option value="0">Seleccione Tipo de evento</option>
			|-foreach from=$kinds item=kind name=foreach_kinds-|
				<option value="|-$kind@key-|" |-$calendarEvent->getKind()|selected:$kind@key-|>|-$kind-|</option>
			|-/foreach-|
		</select>
	</p>
	<p>
		<label for="calendarEvent_isConstruction">Obra</label>
		<input name="calendarEvent[isConstruction]" type="hidden" value="0">
		<input name="calendarEvent[isConstruction]" id="calendarEvent_isConstruction" type="checkbox" title="Indica si el evento corresponde a una obra" |-$calendarEvent->getIsConstruction()|checked_bool-| value="1" >
	</p>
	<p style="display:|-if $calendarEvent->getIsConstruction()-|block|-else-|none|-/if-|;" id="constructionId">
		<label for="calendarEvent_constructionId">Identificación de la obra</label>
		<input name="calendarEvent[constructionId]" type="text" id="calendarEvent_constructionId" title="Identificación de la obra" value="|-$calendarEvent->getConstructionId()-|" size="30" />
	</p>
<script language="JavaScript" type="text/JavaScript">
$(function () {
  $('#calendarEvent_isConstruction').change(function () {                
     $('#constructionId').toggle(this.checked);
  }).change(); //ensure visible state matches initially
});
</script>
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
				<option value="|-$object->getid()-|" |-$calendarEvent->hasActor($object)|selected:true-|>|-$object-|</option>
			|-/foreach-|
		</select>
	</p>
	<p>
		<label for="calendarEvent_axisId">Eje</label>
		<select id="calendarEvent_axisId" name="calendarEvent[axisId]" title="Eje de gestión">
			<option value="">Seleccione el eje</option>
			|-foreach from=$axes item=object-|
				<option value="|-$object->getId()-|" |-$calendarEvent->getAxisId()|selected:$object->getId()-|>|-$object->getName()-|</option>
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
		<input name="calendarEvent[campaignCommitment]" id="calendarEvent_campaignCommitment" type="checkbox" |-$calendarEvent->getCampaignCommitment()|checked_bool-| value="1">
	</p>
	<p>
		<label for="calendarEvent_comments">Comentarios</label>
		<textarea name="calendarEvent[comments]" cols="60" rows="3" wrap="VIRTUAL" id="calendarEvent_comments">|-$calendarEvent->getComments()-|</textarea>
	</p>
	<p>
		<label for="calendarEvent_nonpublic">Privado</label>
		<input name="calendarEvent[nonpublic]" type="hidden" value="0">
		<input name="calendarEvent[nonpublic]" id="calendarEvent_nonpublic" type="checkbox" |-$calendarEvent->getNonpublic()|checked_bool-| value="1">
	</p>
<!--	<p>
		<label for="calendarEvent_userId">Usuario</label>
		<select id="calendarEvent_userId" name="calendarEvent[userId]" title="userId">
			<option value="">Seleccione un Usuario</option>
			|-foreach from=$users item=object-|
				<option value="|-$object->getid()-|" |-$calendarEvent->getuserId()|selected:$object->getid()-|>|-$object->getusername()-|</option>
			|-/foreach-|
		</select>
	</p>-->
	|-if !$calendarEvent->isNew()-|
		<input type="hidden" name="id" id="calendarEvent_id" value="|-$calendarEvent->getid()-|" />
	|-/if-|
	<p class="arrangeButtons">
		<input type="button" id="calendarEventsEditX_acceptButton" value="Aceptar" />
		<input type='button' id="calendarEventsEditX_cancelButton" value='Cancelar' />
	</p>
</form>
</fieldset>
</div>

<script>
	var showMap = function() {
		$('#mapFancyboxDummy').fancybox({
			onComplete: function() {
				calendarMap = new CalendarMap({
					disableId: 'button_edit_calendarEvent',
					streetId: 'calendarEvent_street',
					numberId: 'calendarEvent_number',
					latitudeId: 'calendarEvent_latitude',
					longitudeId: 'calendarEvent_longitude'
				});
				var latlng = new google.maps.LatLng('-34.649', '-58.456');
				calendarMap.mapOptions.zoom = 12;
				calendarMap.mapOptions.center = latlng;

				calendarMap.drawRegions = function() {
					|-include file="RegionsDrawInclude.tpl" mapJsVarName="calendarMap"-|
				}

				calendarMap.locate();
			}
		});
		
		$('#mapFancyboxDummy').click();
	}
</script>
