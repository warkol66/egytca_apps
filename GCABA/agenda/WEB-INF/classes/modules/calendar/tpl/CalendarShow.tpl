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
			events: events
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
					title: '|-$event->getTitle()-|',
					start: new Date('|-$event->getStartDate()|date_format:"%Y/%m/%d %H:%M"-|'),
					end: new Date('|-$event->getEndDate()|date_format:"%Y/%m/%d %H:%M"-|'),
					allDay: false,
//					color: 'yellow',   // esto anda?
//					textColor: 'white',
//					borderColor: 'clear',
//					backgroundColor: '|-assign var="axis" value=$event->getCalendarAxis()-||-if $axis-||-$axis->getColor()-||-else-||-$defaultBgColor-||-/if-|',
					className: 'amarillo', // aca van a venir los colores en lugar del backgroundColor
					editable: true // esto se modifica segun el permiso del usuario, si tien permiso para modificar se pone true
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
		$('#newEvent #calendarEvent_startDate').val(start);
		$('#newEvent #calendarEvent_endDate').val(end);
		$('#newEvent').show();
	}
	
	doCreateEvent = function(form) {
		
		$.ajax({
			url: 'Main.php?do=calendarEventsDoEditX',
			type: 'post',
			dataType: 'json',
			data: $(form).serialize(),
			success: function(data) {
				console.log(data);
				calendar.fullCalendar(
					'renderEvent',
					{
						title: data.title,
						start: data.start,
						end: data.end,
						allDay: false
					},
					true // make the event "stick"
				);
			}
		});
		
		calendar.fullCalendar('unselect');
	}
	
</script>

<div id="newEvent" style="display:none; position:absolute; top:10em; z-index:999999; background-color:white; border-style:solid; border-width:2px">
	|-include file="CalendarEventsFormInclude.tpl"
		onsubmit="return false;"
		onaccept="doCreateEvent(this.form); $('#newEvent').hide();"
		oncancel="$('#newEvent').hide();"
	-|
</div>