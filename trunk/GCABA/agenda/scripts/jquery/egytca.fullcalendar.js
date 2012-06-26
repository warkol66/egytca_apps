Calendar = {
	options: {
		/* name => cssClass */
		axisMap: {},
		minTime: 8,
		maxTime: 22,
		firstHour: 9,
		eventDefaultDuration: 1 // in hours
	},
	draggedEvent: null,
	initialize: function(opts) {
		this.options = $.extend({}, this.options, opts);
		this.registerNavbarClick();
	},
	/**
	 * TODO: Usar
	 *
	 *  $.fullCalendar.formatDate( date, formatString [, options ] ) -> String
	 *  http://arshaw.com/fullcalendar/docs/utilities/formatDate/
	 *
	 */
	eventAfterRender: function(event, element, view) {
		var elem = $(element);
		var template = event.allDay ? $("#calendarAllDayTemplates .fc-event").html() : $("#calendarTemplates .fc-event").html();
		elem.addClass(event.className);
		var startDate = new Date(event.start);
		var start = startDate.toString().replace(/.* ([0-9][0-9]:[0-9][0-9]):00 .*/, "$1");
		var endDate = new Date(event.end);
		var end = endDate.toString().replace(/.* ([0-9][0-9]:[0-9][0-9]):00 .*/, "$1");
		if (event.scheduleStatus != 2) {
			template = template.replace("%start", start);
			template = template.replace("%end", end);
			template = template.replace("%timeConfirmed", '');
		}
		else {
			template = template.replace("%start", '');
			template = template.replace("%end", '');
			template = template.replace("%timeConfirmed", 'A confirmar');
		}
		template = template.replace("%title", event.title);
		template = template.replace("%body", event.body);
		template = template.replace("%address", event.address);
		template = template.replace("%CC_image", event.campaignCommitment ? '<img src="images/icon_CC.png" />' : '');
		template = template.replace("%photo", event.photo);
		elem.html(template);

		if (!event.allDay) {
			elem.click(function(e) {
				$('#fancyboxDiv').load(
					'Main.php?do=calendarEventsShowX&id='+event.id,
					{  },
					function() {$('#fancyboxDummy').click()}
				);
			})
		}

		/* al eliminar la botonera esto hay que volarlo tambien */
		$('.eventoBot01', elem).click(function(e){
			e.stopPropagation(),
			e.preventDefault();
			if (confirm('¿Desea borrar el evento?')) {
				doDeleteEvent(event);
			}
		});
		$('.eventoBot02', elem).click(function(e){
			e.stopPropagation(),
			e.preventDefault();
			editEvent(event);
		});
		/* ------------------- */

	},
	registerNavbarClick: function() {
		$(".boxNavSolapas li").click(function(e) {
			e.preventDefault();
			var $this = $(this);
			var selector = Calendar.options.axisMap[$this.attr('hide')];
			$(".fc-event").hide();
			$("." + selector).show();
		});
	},
	showAllEvents: function() {
		$(".fc-event").show();
	},
	updateEvent: function(event) {

		var pendingExists = false;

		if (event.scheduleStatus == 3) { // evento pendiente
			// si ya existe como pendiente quiero reemplazarlo en el lugar
			$('.pendientesContainer .pendientesContent li').each(function(i, e) {
				if ($(e).data('eventObject').id == event.id) {
					var newPending = Calendar.newPendingEvent(event);
					$(e).replaceWith(newPending);
					pendingExists = true;
				}
			});
		}
		if (event.scheduleStatus != 3 || !pendingExists) {
			Calendar.removeEvent(event);
			Calendar.renderEvent(event);
		}
	},
	renderEvent: function(event) {
		if (event.scheduleStatus == 3) { // evento pendiente
			var pendingEventsList = $('.pendientesContainer .pendientesContent ul');
			var newPending = Calendar.newPendingEvent(event);
			newPending.appendTo(pendingEventsList);
		} else {
			calendar.fullCalendar('renderEvent', event, true);
		}
	},
	removeEvent: function(event) {
		Calendar.removeEventById(event.id);
	},
	removeEventById: function(id) {
		Calendar.removePendingEvent(id);
		calendar.fullCalendar('removeEvents', id);
	},
	removePendingEvent: function(eventId) {
		$('.pendientesContainer .pendientesContent li').each(function(i, e) {
			if ($(e).data('eventObject').id == eventId)
				$(e).remove();
		});
	},
	newPendingEvent: function(event) {

		event.start = new Date(event.start);
		event.end = new Date(event.end);

		var template = $('#calendarPendingEventTemplate').html();
		template = template.replace("%title", event.title);
		template = template.replace("%body", event.body);
		var newPending = $(template);
		if (event.className instanceof Array) {
			for (var i=0; i<event.className.length; i++) {
				newPending.addClass(event.className[i]);
			}
		} else {
			newPending.addClass(event.className);
		}
		newPending.draggable({revert: true, revertDuration: 0});
		newPending.data('eventObject', event);

		$('.pendienteBorrar', newPending).click(function(e){
			e.stopPropagation(),
			e.preventDefault();
			if (confirm('¿Desea borrar el evento?')) {
				doDeleteEvent(event);
			}
		});
		$('.pendienteEditar', newPending).click(function(e) {
			e.stopPropagation(),
			e.preventDefault();
			editEvent(event);
		});

		return newPending;
	},
	
	dropOut: function(jsEvent, ui, q) {
		if (Calendar.draggedEvent == null)
			return;
		
		var event = Calendar.draggedEvent;
		Calendar.draggedEvent = null;
		var data = {
			id: event.id,
			calendarEvent: {
				scheduleStatus: 3
			}
		}
		editRequest(data, function(event) {
			Calendar.updateEvent(event);
		});
	}
}
