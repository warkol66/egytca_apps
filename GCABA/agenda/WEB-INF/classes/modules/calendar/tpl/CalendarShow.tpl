<link rel='stylesheet' type='text/css' href='scripts/fullcalendar/fullcalendar.css' />
<script type="text/javascript" src="scripts/jquery/jquery-ui-1.8.19.custom.min.js"></script>
<script type='text/javascript' src='scripts/fullcalendar/fullcalendar.min.js'></script>
<script type='text/javascript' src='scripts/jquery/egytca.fullcalendar.js'></script>
<link rel="stylesheet" href="scripts/fancybox/jquery.fancybox-1.3.4.css" type="text/css" media="screen" />
<script type='text/javascript' src='scripts/fancybox/jquery.fancybox-1.3.4.pack.js'></script>
<script type="text/javascript" src="scripts/fancybox/jquery.easing-1.3.pack.js"></script>
<script type="text/javascript" src="scripts/fancybox/jquery.mousewheel-3.0.4.pack.js"></script>

<!-- CakeGraph -->
<script type="text/javascript" src="scripts/jquery/d3.v2.min.js"></script>
<script type="text/javascript" src="scripts/jquery/egytca.cakegraph.js"></script>
<!-- end CakeGraph -->

<!-- Map -->
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
<script type="text/javascript" src="scripts/keydragzoom_packed.js"></script>
<script type="text/javascript" src="scripts/jquery/map-base.js"></script>
<script type="text/javascript" src="scripts/jquery/calendar-map.js"></script>
<!-- end Map -->
<script type="text/javascript" src="scripts/jquery/events-map.js"></script>

<div id="calendar"></div>
<a id="newEventFancyboxDummy" style="display:none" href="#newEvent"></a>
<a id="fancyboxDummy" style="display:none" href="#fancyboxDiv"></a>
<div style="display:none;"><div id="fancyboxDiv"></div></div>
<a id="mapFancyboxDummy" style="display:none" href="#mapFancybox"></a>
<div style="display:none;"><div id="mapFancybox">
	<div id="map-outer" style="width:700px; height: 400px;"><div id="map_container" style="display:none;">
		<div><ul id="directions_results" style="display:none"></ul></div>
		<div id="map_canvas"></div>
		<br />
		<p>
			<input id="hide_map" type="button" value="Ocultar mapa" title="Ocultar mapa" onClick="$('#fancyboxDummy').click();"/>
		</p>
	</div></div>
</div></div>

<script type="text/javascript">

	var calendar;
	var eventsCakegraph;
	var graphInfo;
	var calendarMap;
	var thematicWeeks;

	$(document).ready(function() {
		var day, month, year;
		var events = loadEvents();
		var pendingEvents = loadPendingEvents();
		renderPendingEvents(pendingEvents);
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

		// grafico de porcentaje de eventos
		graphInfo = makeGraphInfo(events.concat(pendingEvents));
		eventsCakegraph = new CakeGraph({
			selector: '.eventsGraph',
			data: graphInfo.data,
			colors: graphInfo.colors
		});
		$('.eventsGraph').click(function() {
			$('#fancybox-outer').addClass("fancyboxCakeGraph");
			$('#fancyboxDiv').html('<h5>Cantidad de eventos distribuidos por ejes</h5><div id="fancyboxCakeGraph" style="width: 400px; height: 400px"></div>')
			new CakeGraph({
				selector: '#fancyboxCakeGraph',
				data: graphInfo.data,
				colors: graphInfo.colors,
				legends: graphInfo.axes,
				showPercents: true
			});
			$('#fancyboxDummy').click();
		});
		
		$('#newEventFancyboxDummy').fancybox();
		$('#fancyboxDummy').fancybox({
			onClosed: function() {
				$('#fancybox-outer').removeClass("fancyboxCakeGraph");
			}
		});
		|-if !empty($loginUser) && $loginUser->isSupervisor() && $firstView-|
		$('#fancyboxDiv').load(
			'Main.php?do=calendarRegularEventGetUninstantiatedX',
			{ years:  [year, parseInt(year)+1] }
		);|-/if-|
			
		$('.pendientesContent').droppable({
                        drop: Calendar.dropOut
                });
		
		thematicWeeks = JSON.parse(|-json_encode($thematicWeeks)-|);
		updateThematicWeeks(thematicWeeks);
		filterPendingEvents();
		// cada vez que cambio la fecha desde el calendario chequeo filtros de fechas
		$('.fc-button-prev').click(function() { checkCalendarDateRange(); filterPendingEvents(); updateThematicWeeks(thematicWeeks); });
		$('.fc-button-next').click(function() { checkCalendarDateRange(); filterPendingEvents(); updateThematicWeeks(thematicWeeks); });
		$('.fc-button-today').click(function() { checkCalendarDateRange(); filterPendingEvents(); updateThematicWeeks(thematicWeeks); });
		
		$('.fc-button-month').click(function() { updateThematicWeeks(thematicWeeks); });
		$('.fc-button-agendaWeek').click(function() { updateThematicWeeks(thematicWeeks); });
		$('.fc-button-agendaDay').click(function() { updateThematicWeeks(thematicWeeks); });
	});
	
	updateThematicWeeks = function(thematicWeeks) {
		var view = calendar.fullCalendar('getView');
		switch(view.name) {
			
			case 'month':
				
				var monthStartDate = view.visStart;
				var nextMonthStartDate = view.visEnd;
				var incOneWeek = function(date) {
					var oneWeekMsecs = 7 * 24 * 60 * 60 * 1000;
					date.setTime(date.getTime()+oneWeekMsecs);
				}
				
				var weekNumber = 0;
				for (var date = monthStartDate; date.getTime() < nextMonthStartDate.getTime(); incOneWeek(date)) {
					
					var found = false;
					for (i in thematicWeeks) {
						twStart = new Date(thematicWeeks[i].Monday);
						if (date.getTime() == twStart.getTime()) {
							$('.fc-week'+weekNumber).css('background-color', thematicWeeks[i]['AxisColor']);
							found = true;
							break;
						}
					}
					
					if (!found)
						$('.fc-week'+weekNumber).css('background-color', '');
					
					weekNumber++;
				}
				
				break;
				
			case 'agendaWeek':
				
				var found = false;
				for (i in thematicWeeks) {
					twStart = new Date(thematicWeeks[i].Monday);
					if (view.visStart.getTime() == twStart.getTime()) {
						$('#calendarTitle').css('color', thematicWeeks[i]['AxisColor']);
						$('#inTitleAxis').html(thematicWeeks[i]['AxisName']);
						$('.fc-agenda-slots').css('background-color', thematicWeeks[i]['AxisColor']);
						found = true;
						break;
					}
				}
				
				if (!found) {
					$('#calendarTitle').css('color', '');
					$('#inTitleAxis').html('');
					$('.fc-agenda-slots').css('background-color', '');
				}
				
				break;
				
			default:
				$('.fc-agenda-slots').css('background-color', '');
				break;
		}
	}

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
			allDayText: 'Feriados<br />Efemér.',
			firstHour: Calendar.options.firstHour,
			minTime: Calendar.options.minTime,
			maxTime: Calendar.options.maxTime,
			monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
			monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
			dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
			dayNamesShort: ['Dom', 'Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sáb'],
			columnFormat: {
				month: 'dddd',    // Monday, Wednesday, etc
				week: 'dddd dd', // Monday 9/7
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
					week: "'<span id=\"calendarTitle\"><span id=\"inTitleAxis\"></span>&nbsp;'MMMM yyyy': Semana del ' d/MM { 'al' d/MM}'</span>'", // Sep 7 - 13 2009
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
			eventDragStart: function(event) {
				Calendar.draggedEvent = event;
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

				var data = {
					id: copiedEventObject.id,
					calendarEvent: {
						startDate: getFormattedDatetime(copiedEventObject.start),
						endDate: getFormattedDatetime(copiedEventObject.end),
						allDay: copiedEventObject.allDay,
						scheduleStatus: 2
					}
				}

				editRequest(data, function(event) {
					Calendar.removePendingEvent(event.id);
					calendar.fullCalendar('renderEvent', event, true);
				});
			}
		});
	}

	makeGraphInfo = function(events) {

		var colorClassName = function(classes) {
			var colors = [
			|-foreach from=$axes item="axis"-|'|-$axis->getCssClass()-|'|-if !$axis@last-|, |-/if-||-/foreach-|
			];
			for (var i=0; i<colors.length; i++) {
				if (classes instanceof Array) {
					if ($.inArray(colors[i], classes) != -1)
						return colors[i];
				} else {
					if (classes.search(colors[i]) != -1)
						return colors[i];
				}
			}
		}

		var cant = {
			|-foreach from=$axes item="axis"-||-$axis->getCssClass()-|: 0|-if !$axis@last-|, |-/if-||-/foreach-|}

		for (var i=0; i<events.length; i++) {
			cant[colorClassName(events[i].className)]++
		}
		var data = [
			|-foreach from=$axes item="axis"-|cant.|-$axis->getCssClass()-||-if !$axis@last-|, |-/if-||-/foreach-|
			]

		var colors = [
			|-foreach from=$axes item="axis"-|
				'|-$axis->getColor()-|'|-if !$axis@last-|, |-/if-| // |-$axis->getCssClass()-|
			|-/foreach-|
		]

		var axes = [
			|-foreach from=$axes item="axis"-|
			'|-$axis->getName()-|'|-if !$axis@last-|, |-/if-|
			|-/foreach-|
		]

		return { data: data, colors: colors, axes: axes }
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
		var eventObjects = [];
			|-foreach $pendingEvents as $pending-|
			eventObjects.push(|-include file="CalendarPhpEventToJson.tpl" event=$pending-|);
			|-/foreach-|
		return eventObjects;
	}
	
	filterPendingEvents = function() {
		
		var mustHide = function(date) {
			
			var toMsecs = function(days) {
				return days * 24 * 60 * 60 * 1000;
			}
				
			
			if (date == undefined)
				return false;
			
			// calculo cuán lejos estoy del tiempo actual
			var timeDiff = calendar.fullCalendar('getDate').getTime() - date.getTime();
			
			// quiero dejar los eventos que entren en este margen y ocultar los demás
			var acceptedTimeDiff = toMsecs(7); //toMsecs(days)
			
			// si estoy dentro del margen -> mustHide == true, sino -> mustHide = false;
			// margen = fecha del calendario +/- acceptedTimeDiff
			return !(Math.abs(timeDiff) < acceptedTimeDiff);
		}
		
		// e: elemento de la lista / $(e).data('eventObject'): evento asociado al elemento e
		$('.pendientesContainer .pendientesContent li').each(function(i, e) {
			// muestro/oculto eventos usando como criterio la funcion mustHide
			if (mustHide($(e).data('eventObject').start))
				$(e).hide();
			else
				$(e).show();
		});
	}

	renderPendingEvents = function(events) {
		for (var i=0; i < events.length; i++) {
			Calendar.renderEvent(events[i]);
		}
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
//		$('#fancybox-outer').removeClass("fancyboxCakeGraph");
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
			Calendar.updateEvent(event);
		});
	}

	doDeleteEvent = function(event) {
		doDeleteEventById(event.id);
	}

	doDeleteEventById = function(id) {

		$.ajax({
			url: 'Main.php?do=calendarEventsDoDeleteX',
			type: 'post',
			data: { id: id },
			success: function() {
				Calendar.removeEventById(id);
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
	
	/*
	 * Chequea si se está dentro del rango válido de fechas indicado por $minTimestamp y $maxTimestamp.
	 * En caso de estar por fuera del rango, recarga el calendario con los eventos correspondientes.
	 */
	checkCalendarDateRange = function() {
		
		// convierto el timestamp de PHP a JavaScript (secs -> msecs)
		var minDate = new Date(|-$minTimestamp-| * 1000);
		var maxDate = new Date(|-$maxTimestamp-| * 1000);
		
		var calendarDate = calendar.fullCalendar('getDate');
		if (calendarDate.getTime() < minDate.getTime() || calendarDate.getTime() > maxDate.getTime()) {
			var params = '|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-|';
			
			// elimino el filtro de fecha anterios en caso de que exista
			params = params.replace(/\&filters\[selectedDate\]=(\d{2}-\d{2}-\d{4})?/, '');
			
			// agrego nuevo filtro de fecha con formato dd-mm-yyyy (hay que anteponer un 0 a los números de 1 cifra)
			params += '&filters[selectedDate]=';
			params += calendarDate.getDate() < 10 ? '0'+calendarDate.getDate() : calendarDate.getDate();
			params += '-' + ( calendarDate.getMonth()+1 < 10 ? '0'+(calendarDate.getMonth()+1) : calendarDate.getMonth()+1 );
			params += '-' + calendarDate.getFullYear();
			window.location='Main.php?do=calendarShow'+params;
		}
	}
</script>

<div style="display:none;">|-include file="CalendarEventsNewInclude.tpl" axes=$axes-|</div>

<div id="calendarTemplates" style="display: none;">
    <div class="fc-event fc-event-skin fc-event-hori fc-event-draggable fc-corner-left fc-corner-right">
		<div class="fc-event-inner fc-event-skin eventoContainer">
            <span class="fc-event-time">
              <!--|-if "calendarEventsDoEditX"|security_has_access-|<ul class="botoneraSmallEvento">
                    <li class="eventoBot01"><a href="#"></a></li>
                    <li class="eventoBot02"><a href="#"></a></li>
                </ul>|-/if-|-->
                %start-%end&nbsp;%timeConfirmed
		%CC_image
            </span>
            <div class="eventoContent">
                <span class="fc-event-title"><!--<img src="images/imagen_foto.png" class="foto" align="right" /><img src="%photo" class="foto" align="right" />-->%title</span>
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

<!--template para eventos pendientes-->
<div id="calendarPendingEventTemplate" style="display: none;">
	<li class="fc-event">
		<div class="solapita"></div>
		<div class="pendienteDato"><span>%title</span>%body</div>
		<div class="pendienteBotones"><a href="#" class="pendienteEditar"></a><a href="#" class="pendienteBorrar"></a></div>
	</li>
</div>
