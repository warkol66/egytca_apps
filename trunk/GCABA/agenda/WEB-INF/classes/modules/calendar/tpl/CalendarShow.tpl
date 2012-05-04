|-assign var="defaultBgColor" value="grey"-|
<link rel='stylesheet' type='text/css' href='scripts/fullcalendar/fullcalendar.css' />
<script type="text/javascript" src="scripts/jquery/jquery-ui-1.8.19.custom.min.js"></script>
<script type='text/javascript' src='scripts/fullcalendar/fullcalendar.min.js'></script>
<div id="calendar"></div>

<script type="text/javascript">
	
	var calendar;
	
	$(document).ready(function() {
		var events = loadEvents();
		calendar = createCalendar(events);
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
			eventAfterRender: function(event, element, view) {
				var elem = $(element);
				var editButton = $("<span class='event_button event_delete_button'></span>").click(function(){doDeleteEvent(event)});
				var deleteButton = $("<span class='event_button event_edit_button'></span>").click(function(){editEvent(event)});
				var clearfix = $("<span class='clearfix'></span>");
				$(".fc-event-time", elem).append(editButton).append(deleteButton).append(clearfix);;
			},
			eventResize: function(event, dayDelta, minuteDelta, revertFunc, jsEvent, ui, view) {
				updateEventDatetime(event);
			},
			eventDrop: function( event, dayDelta, minuteDelta, allDay, revertFunc, jsEvent, ui, view ) {
				updateEventDatetime(event);
			}
		});
	}
	
	loadEvents = function() {
		
		var date = new Date();
		var d = date.getDate();
		var m = date.getMonth();
		var y = date.getFullYear();
		
		return [
			|-assign var="first" value=true-|
			|-foreach from=$events item="event"-|
				|-if !$event@first-|,|-/if-|
				{
					id: '|-$event->getId()-|',
					title: '|-$event->getTitle()-|',
					start: new Date('|-$event->getStartDate()|date_format:"%Y/%m/%d %H:%M"-|'),
					end: new Date('|-$event->getEndDate()|date_format:"%Y/%m/%d %H:%M"-|'),
					allDay: false,
//					color: 'yellow',   // esto anda?
//					textColor: 'white',
//					borderColor: 'clear',
//					backgroundColor: '|-assign var="axis" value=$event->getCalendarAxis()-||-if $axis-||-$axis->getColor()-||-else-||-$defaultBgColor-||-/if-|',
					className: '|-assign var="axis" value=$event->getCalendarAxis()-||-if $axis-||-$axis->getCssClass()-||-else-|gris|-/if-|', // aca van a venir los colores en lugar del backgroundColor
					editable: true // esto se modifica segun el permiso del usuario, si tien permiso para modificar se pone true
//					,updateDates
				}
			|-/foreach-|
//				más opciones
//				{
//					id: 999,
//					title: 'Bbicicleateadas',
//					start: new Date(y, m, d+4, 16, 0),
//					allDay: false
//				},
//				{
//					title: 'Salir Seguro\nIr al site',
//					start: new Date(y, m, 28),
//					end: new Date(y, m, 29),
//					url: 'http://www.saliseguro.gob.ar'
//				}
		]
	}
	
	newEvent = function(start, end, allDay) {
		$('#newEvent #calendarEvent_creationDate').val(new Date());
		$('#newEvent #calendarEvent_startDate').val(start);
		$('#newEvent #calendarEvent_endDate').val(end);
		$('#newEvent').show();
	}
	
	editEvent = function(event) {
		$('#editEvent #calendarEvent_startDate').val(event.start);
		$('#editEvent #calendarEvent_endDate').val(event.end);
		$('#editEvent').show();
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
		
		editRequest(data, function() {
			console.log('edit success');
		});
	}
	
	doDeleteEvent = function(event) {
		
		$.ajax({
			url: 'Main.php?do=calendarEventsDoDeleteX',
			type: 'post',
			data: { id: event.id }
		});
		
		calendar.fullCalendar('removeEvents', event.id);
	}
	
	editRequest = function(data, onSuccess) {
		
		$.ajax({
			url: 'Main.php?do=calendarEventsDoEditX',
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

<div id="newEvent" style="display:none; position:absolute; top:10em; z-index:999999; background-color:white; border-style:solid; border-width:2px">
	<form>
		<p>
			<label for="calendarEvent_title">Título</label>
			<input name="calendarEvent[title]" type="text" id="calendarEvent_title" title="title" value="" size="60" maxlength="255" />
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
			<input name="calendarEvent[creationDate]" type="hidden" id="calendarEvent_creationDate" title="creationDate" value="|-$smarty.now|dateTime_format|change_timezone|date_format:"%d-%m-%Y"-|" size="18" />
			<input name="calendarEvent[startDate]" type="hidden" id="calendarEvent_startDate" title="startDate" value="" size="18" />
			<input name="calendarEvent[endDate]" type="hidden" id="calendarEvent_endDate" title="endDate" value="" size="18" />
			
			<input type="button" id="acceptButton" value="Aceptar" onclick="doCreateEvent(this.form); $('#newEvent').hide();" />
			<input type='button' id="cancelButton" onClick='$("#newEvent").hide();' value='Cancelar' />
		</p>
	</form>
</div>

<div id="editEvent" style="display:none; position:absolute; top:10em; z-index:999999; background-color:white; border-style:solid; border-width:2px">
	|-include file="CalendarEventsEditFormInclude.tpl"
		onsubmit="return false;"
		onaccept="doEditEvent(this.form); $('#editEvent').hide();"
		oncancel="$('#editEvent').hide();"
		regions=$regions
		categories=$categories
		users=$users
		actors=$actors
		axes=$axes
		eventTypes=$eventTypes
		agendaTypes=$agendaTypes
		calendarEventStatus=$calendarEventStatus
	-|
</div>