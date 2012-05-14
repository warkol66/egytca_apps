<link rel='stylesheet' type='text/css' href='scripts/fullcalendar/fullcalendar.css' />
<script type="text/javascript" src="scripts/jquery/jquery-ui-1.8.19.custom.min.js"></script>
<script type='text/javascript' src='scripts/fullcalendar/fullcalendar.min.js'></script>
<script type='text/javascript' src='scripts/jquery/egytca.fullcalendar.js'></script>
<link rel="stylesheet" href="scripts/fancybox/jquery.fancybox-1.3.4.css" type="text/css" media="screen" />
<script type='text/javascript' src='scripts/fancybox/jquery.fancybox-1.3.4.pack.js'></script>
<script type="text/javascript" src="scripts/fancybox/jquery.easing-1.3.pack.js"></script>
<script type="text/javascript" src="scripts/fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
<div id="calendar"></div>
<a id="newEventFancyboxDummy" style="display:none" href="#newEvent"></a>

<script type="text/javascript">
	
	var calendar;
	
	$(document).ready(function() {
		var events = loadEvents();
		calendar = createCalendar(events);
		Calendar.initialize({ axisMap: |-json_encode($axisMap)-| });
		|-if isset($filters.selectedDate) && $filters.selectedDate neq ''-|
			var date = '|-$filters.selectedDate-|'.split('-');
			calendar.fullCalendar( 'gotoDate', date[2], (date[1]-1), date[0]);
		|-/if-|
		$('#newEventFancyboxDummy').fancybox();
	});
	
	createCalendar = function(events) {
		
		return $('#calendar').fullCalendar({
			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,agendaWeek,agendaDay'
			},
			firstDay: 1,
//			aspectRatio: 0.5,
			defaultView: 'agendaWeek',
			allDayText: 'T/día',
			firstHour: 9,
			minTime: 8,
			maxTime: 22,
			monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
			monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
			dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
			dayNamesShort: ['Dom', 'Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sáb'],
			columnFormat: {
				month: 'dddd',    // Monday, Wednesday, etc
				week: 'ddd dd/MM', // Monday 9/7
				day: ''  // Monday 9/7
			},
			buttonText:{
					prev:     '&nbsp;&#9668;&nbsp;',  // left triangle
					next:     '&nbsp;&#9658;&nbsp;',  // right triangle
					prevYear: '&nbsp;&lt;&lt;&nbsp;', // <<
					nextYear: '&nbsp;&gt;&gt;&nbsp;', // >>
					today:    'hoy',
					month:    'mes',
					week:     'semana',
					day:      'día'
			},
			titleFormat:{
					month: 'MMMM yyyy',                             // September 2009
					week: "MMM d[ yyyy]{ '&#8212;'[ MMM] d yyyy}", // Sep 7 - 13 2009
					day: "dddd, dd 'de' MMMM 'de' yyyy"                  // Tuesday, Sep 8, 2009
			},
			selectable: true,
			selectHelper: true,
			select: newEvent,
			editable: true, // esto se modifica segun el permiso del usuario, si tien permiso para modificar se pone true
			events: events,
			eventAfterRender: Calendar.eventAfterRender,
			eventResize: function(event, dayDelta, minuteDelta, revertFunc, jsEvent, ui, view) {
				updateEventDatetime(event);
			},
			eventDrop: function( event, dayDelta, minuteDelta, allDay, revertFunc, jsEvent, ui, view ) {
				updateEventDatetime(event);
			}
		});
	}
	
	loadEvents = function() {
		return [
			|-foreach from=$events item="event"-|
				|-if !$event@first-|,|-/if-|
				|-include file="CalendarPhpEventToJson.tpl" event=$event-|
			|-/foreach-|
			|-foreach from=$holydayEvents item="holiday"-|
				|-if ($holiday@first && $events|@count gt 0) || !$holiday@first-|,|-/if-|
				|-include file="CalendarPhpEventHolidayToJson.tpl" holiday=$holiday-|
			|-/foreach-|
		]
	}
	
	newEvent = function(start, end, allDay) {
		$('#newEvent #calendarEvent_creationDate').val(getFormattedDatetime(new Date()));
		$('#newEvent #calendarEvent_startDate').val(getFormattedDatetime(start));
		$('#newEvent #calendarEvent_endDate').val(getFormattedDatetime(end));
		
		$('#newEventFancyboxDummy').click();
	}
	
	editEvent = function(event) {
		
		$('#editEvent #calendarEvent_id').val(event.id);
		$('#editEvent #calendarEvent_title').val(event.title);
		$('#editEvent #calendarEvent_body').val(event.body);
		$('#editEvent #calendarEvent_creationDate').val(getFormattedDatetime(new Date(event.creationDate)));
		$('#editEvent #calendarEvent_startDate').val(getFormattedDatetime(event.start));
		$('#editEvent #calendarEvent_endDate').val(getFormattedDatetime(event.end));
		$('#editEvent #calendarEvent_street').val(event.street);
		$('#editEvent #calendarEvent_number').val(event.number);
		
		// deseleccionar todos los selects multiples
		$('#editEvent #calendarEvent_regions').attr('selectedIndex', '-1').children("option:selected").removeAttr("selected");
		$('#editEvent #calendarEvent_categories').attr('selectedIndex', '-1').children("option:selected").removeAttr("selected");
		$('#editEvent #calendarEvent_actors').attr('selectedIndex', '-1').children("option:selected").removeAttr("selected");
		
		// deseleccionar los selects simples
		$('#editEvent #calendarEvent_status option:selected').removeAttr("selected");
		$('#editEvent #calendarEvent_agendaType option:selected').removeAttr("selected");
		$('#editEvent #calendarEvent_axisId option:selected').removeAttr("selected");
		$('#editEvent #calendarEvent_typeId option:selected').removeAttr("selected");
		$('#editEvent #calendarEvent_userId option:selected').removeAttr("selected");

		
		// seleccionar options de selects simples
		$('#editEvent #calendarEvent_status option[value="'+event.status+'"]').attr('selected', 'selected');
		$('#editEvent #calendarEvent_agendaType option[value="'+event.agendaType+'"]').attr('selected', 'selected');
		$('#editEvent #calendarEvent_axisId option[value="'+event.axisId+'"]').attr('selected', 'selected');
		$('#editEvent #calendarEvent_typeId option[value="'+event.typeId+'"]').attr('selected', 'selected');
		$('#editEvent #calendarEvent_userId option[value="'+event.userId+'"]').attr('selected', 'selected');
		
		// seleccionar options de selects multiples
		for (var i = 0; i < event.regionsIds.length; i++) {
			$('#editEvent #calendarEvent_regions option[value="'+event.regionsIds[i]+'"]').attr('selected', 'selected');
		}
		for (var i = 0; i < event.categoriesIds.length; i++) {
			$('#editEvent #calendarEvent_categories option[value="'+event.categoriesIds[i]+'"]').attr('selected', 'selected');
		}
		for (var i = 0; i < event.regionsIds.length; i++) {
			$('#editEvent #calendarEvent_actors option[value="'+event.actorsIds[i]+'"]').attr('selected', 'selected');
		}
		
		$(".chzn-select").chosen(); // chosen/fancybox hack
		
		console.log('falta cargar datos del checkbox!!');
	}
	
	doCreateEvent = function(form) {
		
		var data = $(form).serialize();
		
		editRequest(data, function(event) {
			calendar.fullCalendar(
				'renderEvent',
				event,
				true // make the event "stick"
			);
		});
		
		calendar.fullCalendar('unselect');
	}
	
	doEditEvent = function(form) {
		
		var data = $(form).serialize();
		
		editRequest(data, function(event) {
			/* updateEvent no sirve porque el evento no es el original
			sino uno nuevo con los mismos datos */
			calendar.fullCalendar('removeEvents', event.id);
			calendar.fullCalendar(
				'renderEvent',
				event,
				true // make the event "stick"
			);
		});
	}
	
	doDeleteEvent = function(event) {
		
		$.ajax({
			url: 'Main.php?do=calendarEventsDoDeleteX',
			type: 'post',
			data: { id: event.id },
			success: function() {
				calendar.fullCalendar('removeEvents', event.id);
			}
		});
	}
	
	editRequest = function(data, onSuccess) {
		
		$.ajax({
			url: 'Main.php?do=calendarEventsDoEdit',
			type: 'post',
			dataType: 'json',
			data: data,
			success: onSuccess
		});
	}
	
	updateEventDatetime = function(event) {
		var data = 'id='+event.id;
		data += '&calendarEvent[startDate]='+getFormattedDatetime(event.start);
		data += '&calendarEvent[endDate]='+getFormattedDatetime(event.end);
		
		editRequest(data);
	}
	
	getFormattedDatetime = function(date) {
		return date.getDate()+"-"+(date.getMonth()+1)+"-"+date.getFullYear()+" "+date.getHours()+":"+date.getMinutes()+":"+date.getSeconds();
	}
</script>

<div style="display:none;"><div id="newEvent">
	<fieldset><form>
	<h1>Crear nuevo evento</h1>
		<p>
			<label for="calendarEvent_title">Título</label>
			<input name="calendarEvent[title]" type="text" id="calendarEvent_title" title="title" value="" size="60" maxlength="255" />
		</p>
		<p><label for="calendarEvent_kind">Tipo de evento</label>
				<select name="calendarEvent[kind]" id="calendarEvent_kind">
					<option value="0">Seleccione Tipo de evento</option>
				|-foreach from=$kinds item=kind name=foreach_kinds-|
					<option value="|-$kind@key-|">|-$kind-|</option>
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
			<label for="calendarEvent_agenda">Agenda</label>
			<select id="calendarEvent_agenda" name="calendarEvent[agenda]" title="Agenda">
				<option value="0" selected="selected">Seleccione la agenda</option>
				|-foreach from=$agendas item=agenda name=foreach_agendas-|
					<option value="|-$agenda@key-|">|-$agenda-|</option>
				|-/foreach-|
				</select>
		</p>
		<p class="arrangeButtons">
			<input name="calendarEvent[creationDate]" type="hidden" id="calendarEvent_creationDate" title="creationDate" value="|-$smarty.now|dateTime_format|change_timezone|date_format:"%d-%m-%Y"-|" size="18" />
			<input name="calendarEvent[startDate]" type="hidden" id="calendarEvent_startDate" title="startDate" value="" size="18" />
			<input name="calendarEvent[endDate]" type="hidden" id="calendarEvent_endDate" title="endDate" value="" size="18" />
			<input type="button" id="acceptButton" value="Aceptar" onclick="doCreateEvent(this.form); $.fancybox.close();" />
			<input type='button' id="cancelButton" onClick='$.fancybox.close();' value='Cancelar' />
		</p>
	</form></fieldset>
</div></div>

<div style="display:none;"><div id="editEvent">
	|-include file="CalendarEventsEditFormInclude.tpl"
		onsubmit="return false;"
		onaccept="doEditEvent(this.form); $.fancybox.close();"
		oncancel="$.fancybox.close();"
		regions=$regions
		categories=$categories
		users=$users
		actors=$actors
		axes=$axes
		eventTypes=$eventTypes
		agendaTypes=$agendaTypes
		calendarEventStatus=$calendarEventStatus
	-|
</div></div>

<div id="calendarTemplates" style="display: none;">
    <div class="fc-event fc-event-skin fc-event-hori fc-event-draggable fc-corner-left fc-corner-right">
		<div class="fc-event-inner fc-event-skin eventoContainer">
            <span class="fc-event-time">
                <ul class="botoneraSmallEvento">
                    <li class="eventoBot01"><a href="#"></a></li> 
                    <li class="eventoBot02"><a href="#editEvent"></a></li> 
                </ul>
                %start-%end
            </span>
            <div class="eventoContent">
                <span class="fc-event-title"><img src="images/imagen_foto.png" class="foto" align="right" />%title</span>
                <span class="fc-event-text">%body</span>
            </div>
            <div class="eventoFooter"></div>
						<div class="ui-resizable-handle ui-resizable-s">=</div> 
    	</div>
  	</div>   
</div>
<!--Para cuando no hay permisos de edicion!!!!!            <div class="ui-resizable-handle ui-resizable-e">&nbsp;&nbsp;&nbsp;</div>-->

<!--template para eventos de todo el día-->
<div id="calendarAllDayTemplates" style="display: none;">
    <div class="fc-event fc-event-skin fc-event-hori fc-event-draggable fc-corner-left fc-corner-right">
		<div class="fc-event-inner fc-event-skin eventoContainer">
            <div class="eventoContent">
                <span class="fc-event-title">%title</span>
                <span class="fc-event-text">%body</span>
            </div>
            <div class="eventoFooter"></div>
				<div class="ui-resizable-handle ui-resizable-e">&nbsp;&nbsp;&nbsp;</div>
    	</div>
  	</div>   
</div>


<div id="calendarAllDayTemplates" style="display: none;">
    <div class="fc-event fc-event-skin fc-event-hori fc-event-draggable fc-corner-left fc-corner-right">
		<div class="fc-event-inner fc-event-skin eventoContainer">
            <div class="eventoContent">
                <span class="fc-event-title"><img src="images/imagen_foto.png" class="foto" />%title</span>
                <span class="fc-event-text">%body</span>
            </div>
            <div class="eventoFooter"></div>
				<div class="ui-resizable-handle ui-resizable-e">&nbsp;&nbsp;&nbsp;</div>
    	</div>
  	</div>   
</div>
