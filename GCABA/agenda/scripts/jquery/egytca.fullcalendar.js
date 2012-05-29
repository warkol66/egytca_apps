Calendar = {
    options: {
        /* name => cssClass */
        axisMap: {},
	minTime: 8,
	maxTime: 22,
	firstHour: 9,
	eventDefaultDuration: 1 // in hours
    },
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
        template = template.replace("%start", start);
        template = template.replace("%end", end);
				template = template.replace("%timeConfirmed", event.scheduleStatus == 2 ? '¿?' : '');
        template = template.replace("%title", event.title);
        template = template.replace("%body", event.body);
        template = template.replace("%address", event.address);
				template = template.replace("%CC_image", event.campaignCommitment ? '<img src="images/icon_CC.png" />' : '');
        elem.html(template);
	
	elem.click(function(e) {
		$('#fancyboxDiv').load(
			'Main.php?do=calendarEventsShowX&id='+event.id,
			{  },
			function() {$('#fancyboxDummy').click()}
		);
	})
	
	$(".eventoBot02 a").fancybox();
	
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
    }
}
