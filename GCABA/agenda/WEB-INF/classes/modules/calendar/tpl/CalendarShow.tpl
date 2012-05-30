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
<a id="fancyboxDummy" style="display:none" href="#fancyboxDiv"></a>
<div style="display:none;"><div id="fancyboxDiv"></div></div>

<script type="text/javascript">
	
	var calendar;
	
	$(document).ready(function() {
		var day, month, year;
		var events = loadEvents();
		var pendingEvents = loadPendingEvents();
		calendar = createCalendar(events);
		Calendar.initialize({ axisMap: |-json_encode($axisMap)-| });
		|-if isset($filters.selectedDate) && $filters.selectedDate neq ''-|
			var date = '|-$filters.selectedDate-|'.split('-');
			year = date[2];
			month = date[1];
			day = date[0];
			calendar.fullCalendar( 'gotoDate', year, (month-1), day);
		|-else-|
			year = (new Date()).getFullYear();
		|-/if-|
		$('#newEventFancyboxDummy').fancybox();
		$('#fancyboxDummy').fancybox();
		|-if !empty($loginUser) && $loginUser->isSupervisor()-|
		$('#fancyboxDiv').load(
			'Main.php?do=calendarRegularEventGetUninstantiatedX',
			{ years:  [year, parseInt(year)+1] }
		);|-/if-|
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
			allDayText: 'Efemér/<br />feriados',
			firstHour: Calendar.options.firstHour,
			minTime: Calendar.options.minTime,
			maxTime: Calendar.options.maxTime,
			monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
			monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
			dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
			dayNamesShort: ['Dom', 'Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sáb'],
			columnFormat: {
				month: 'dddd',    // Monday, Wednesday, etc
				week: 'ddd dd/MM', // Monday 9/7
				day: ''  // Monday 9/7
			},
			axisFormat: 'h(:mm) tt',
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
					week: "'Semana:' d MMM[ yyyy]{ 'al' d[ MMM] yyyy}", // Sep 7 - 13 2009
					day: "dddd, dd 'de' MMMM 'de' yyyy"                  // Tuesday, Sep 8, 2009
			},
			selectable: |-if "calendarEventsDoEditX"|security_has_access-|true|-else-|false|-/if-|,
			selectHelper: true,
			select: newEvent,
			editable: |-if "calendarEventsDoEditX"|security_has_access-|true|-else-|false|-/if-|, // esto se modifica segun el permiso del usuario, si tien permiso para modificar se pone true
			events: events,
			eventAfterRender: Calendar.eventAfterRender,
			eventResize: function(event, dayDelta, minuteDelta, revertFunc, jsEvent, ui, view) {
				updateEventDatetime(event);
			},
			eventDrop: function( event, dayDelta, minuteDelta, allDay, revertFunc, jsEvent, ui, view ) {
				updateEventDatetime(event);
			},
			droppable: true,
			drop: function(date, allDay, jsEvent, ui) {
				var defaultDuration = Calendar.options.eventDefaultDuration; // in hours
				var start = ensureMinHour(date);
				var end = new Date(start.getTime());
				end.setTime(end.getTime() + (defaultDuration*60*60*1000));
				var originalEventObject = $(this).data('eventObject');
				var copiedEventObject = $.extend({}, originalEventObject);
				
				copiedEventObject.start = start;
				copiedEventObject.end = end;
				copiedEventObject.allDay = allDay;
				copiedEventObject.scheduleStatus = 2;
				createEventFromJs(copiedEventObject, function(event) {
					calendar.fullCalendar('renderEvent', event, true);
					removePendingEvent(event.id);
				});
			}
		});
	}
	
	removePendingEvent = function(eventId) {
		$('.pendientesContainer .pendientesContent li').each(function(i, e) {
			if ($(e).data('eventObject').id == eventId)
				$(e).remove();
		});
	}
	
	createEventFromJs = function(event, onSuccess) {
		editEvent(event);
		editRequest($('#editEvent form').serialize(), onSuccess);
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
	
	loadPendingEvents = function() {
		var pendingEventsList = $('.pendientesContainer .pendientesContent ul');
		|-foreach $pendingEvents as $pending-|
			var eventObject = |-include file="CalendarPhpEventToJson.tpl" event=$pending-|;
			var newPending = newPendingEventHtml(eventObject);
			newPending.appendTo(pendingEventsList);
			newPending.draggable({ revert: true, revertDuration: 0 });
			newPending.data('eventObject', eventObject);
		|-/foreach-|
	}
	
	newPendingEventHtml = function(event) {
		var pending = $('<li class="fc-event"></li>');
		pending.addClass(event.className);
		$('<div class="solapita"></div>').appendTo(pending);
		$('<div class="pendienteDato"><span>'+event.title+'</span>'+event.body+'</div>').appendTo(pending);
		$('<div class="pendienteBotones"><a href="#" class="pendienteEditar"></a><a href="#" class="pendienteBorrar"></a></div>').appendTo(pending);
		return pending;
	}
	
	newEvent = function(start, end, allDay) {
		
		start = ensureMinHour(start);
		if (end.getHours() == 0) {
			var end = new Date(start.getTime());
			end.setTime(end.getTime() + (Calendar.options.eventDefaultDuration*60*60*1000));
		}
		
		$('#newEvent #calendarEvent_creationDate').val(getFormattedDatetime(new Date()));
		$('#newEvent #calendarEvent_startDate').val(getFormattedDatetime(start));
		$('#newEvent #calendarEvent_endDate').val(getFormattedDatetime(end));
		
		$('#newEventFancyboxDummy').click();
	}
	
	editEvent = function(event) {
		$('#fancyboxDiv').load(
			'Main.php?do=calendarEventsEdit&id='+event.id,
			{  },
			function() {
				$('#calendarEventsEditX_acceptButton').click(function(e) {
					doEditEvent($('#calendarEventsEditX_form'));
					$.fancybox.close();
				});
				$('#calendarEventsEditX_cancelButton').click(function(e) {
					$.fancybox.close();
				});
				
				$('#calendarEventsEditX_form #calendarEvent_creationDate').val(getFormattedDatetime(new Date(event.creationDate)));
				$('#calendarEventsEditX_form #calendarEvent_startDate').val(getFormattedDatetime(event.start));
				$('#calendarEventsEditX_form #calendarEvent_endDate').val(getFormattedDatetime(event.end));
				
				$('#fancyboxDummy').click()
				$(".chzn-select").chosen(); // chosen/fancybox hack
			}
		);
	}
	
	doCreateEvent = function(form) {
		
		var data = $(form).serialize();
		
		editRequest(data, function(event) {
			calendar.fullCalendar(
				'renderEvent',
				event,
				true // make the event "stick"
			);
			form.reset()
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
		
		editRequest(data, function(event) {
			// bug fix resize deja de andar
			calendar.fullCalendar('removeEvents', event.id);
			calendar.fullCalendar(
				'renderEvent',
				event,
				true // make the event "stick"
			);
		});
	}
	
	getFormattedDatetime = function(date) {
		return date.getDate()+"-"+(date.getMonth()+1)+"-"+date.getFullYear()+" "+date.getHours()+":"+date.getMinutes()+":"+date.getSeconds();
	}
	
	createHolidayFromRegEvent = function(regEventId, year) {
		$.ajax({
			url: 'Main.php?do=calendarHolidayEventCreateFromRegularEventX',
			type: 'post',
			data: { regularEventId: regEventId, year: year },
			dataType: 'json',
			success: function(event) {
				$('#uninstantiatedRegEvents #createHolidayButton_'+regEventId+'_'+year).remove();
				calendar.fullCalendar(
					'renderEvent',
					event,
					true // make the event "stick"
				);
			}
		});
	}
	
	ensureMinHour = function(date) {
		if (date.getHours() < Calendar.options.minTime) {
			var newDate = new Date(date.getTime());
			newDate.setHours(parseInt(Calendar.options.minTime));
			newDate.setMinutes(0);
			newDate.setSeconds(0);
			return newDate;
		} else {
			return date;
		}
	}
</script>

<div style="display:none;">|-include file="CalendarEventsNewInclude.tpl" axes=$axes-|</div>

<div id="calendarTemplates" style="display: none;">
    <div class="fc-event fc-event-skin fc-event-hori fc-event-draggable fc-corner-left fc-corner-right">
		<div class="fc-event-inner fc-event-skin eventoContainer">
            <span class="fc-event-time">
                |-if "calendarEventsDoEditX"|security_has_access-|<ul class="botoneraSmallEvento">
                    <li class="eventoBot01"><a href="#"></a></li> 
                    <li class="eventoBot02"><a href="#"></a></li> 
                </ul>|-/if-|
                %start-%end&nbsp;%timeConfirmed
		%CC_image
            </span>
            <div class="eventoContent">
                <span class="fc-event-title"><img src="images/imagen_foto.png" class="foto" align="right" />%title</span>
                <span class="fc-event-text">%address</span>
            </div>
            <div class="eventoFooter"></div>
						|-if "calendarEventsDoEditX"|security_has_access-|<div class="ui-resizable-handle ui-resizable-s">=</div>|-else-|<div class="ui-resizable-handle ui-resizable-e">&nbsp;&nbsp;&nbsp;</div>|-/if-| 
    	</div>
  	</div>   
</div>

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
