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
			select: function(start, end, allDay) {
				var title = prompt('Evento');
				if (title) {
					calendar.fullCalendar('renderEvent',
						{
							title: title,
							start: start,
							end: end,
							allDay: allDay
						},
						true // make the event "stick"
					);
				}
				calendar.fullCalendar('unselect');
				console.log('crear evento por ajax');
			},
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
				|-if $first-|
					|-assign var="first" value=false-|
				|-else-|
					,
				|-/if-|
				{
					title: '|-$event->getTitle()-|',
					start: new Date('|-$event->getStartDate()|date_format:"%Y/%m/%d %H:%M"-|'),
					end: new Date('|-$event->getEndDate()|date_format:"%Y/%m/%d %H:%M"-|'),
					allDay: false,
//					start: new Date('2012/04/14'),
//					start: new Date(y, m, 1),
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
	
</script>