{
	"id": "|-$event->getId()-|",
	"title": "|-$event->getTitle()-|",
    "body": "|-$event->getBody()-|",
	"start": "|-$event->getStartDate()-|",
	"end": "|-$event->getEndDate()-|",
	"allDay": false,
	"className": "|-assign var="axis" value=$event->getCalendarAxis()-||-if $axis-||-$axis->getCssClass()-||-else-|gris|-/if-|",
	"editable": true |-* esto se modifica segun el permiso del usuario, si tien permiso para modificar se pone true *-|
}