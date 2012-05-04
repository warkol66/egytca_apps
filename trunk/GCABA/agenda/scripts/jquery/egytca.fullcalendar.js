Calendar = {
    eventAfterRender: function(event, element, view) {
        var elem = $(element);
        var template = $("#calendarTemplates .fc-event").html();
        elem.addClass("gris");
        var startDate = new Date(event.start);
        var start = startDate.toString().replace(/.* ([0-9][0-9]:[0-9][0-9]):00 .*/, "$1");
        template = template.replace("%start", start);
        template = template.replace("%title", event.title);
        template = template.replace("%body", event.body);
        elem.html(template);
    }
}
