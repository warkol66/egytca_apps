Calendar = {
    options: {
        /* name => cssClass */
        axisMap: {}
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
        var template = $("#calendarTemplates .fc-event").html();
        elem.addClass(event.className);
        var startDate = new Date(event.start);
        var start = startDate.toString().replace(/.* ([0-9][0-9]:[0-9][0-9]):00 .*/, "$1");
        var endDate = new Date(event.end);
        var end = endDate.toString().replace(/.* ([0-9][0-9]:[0-9][0-9]):00 .*/, "$1");
        template = template.replace("%start", start);
        template = template.replace("%end", end);
        template = template.replace("%title", event.title);
        template = template.replace("%body", event.body);
        elem.html(template);
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
