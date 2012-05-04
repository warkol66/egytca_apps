{
	"id": "|-$event->getId()-|",
	"title": "|-$event->getTitle()-|",
	"start": "|-$event->getStartDate("%Y/%m/%d %H:%M")-|",
	"end": "|-$event->getEndDate("%Y/%m/%d %H:%M")-|",
	"allDay": false,
	"className": "|-assign var="axis" value=$event->getCalendarAxis()-||-if $axis-||-$axis->getCssClass()-||-else-|gris|-/if-|",
	"editable": true, |-* esto se modifica segun el permiso del usuario, si tien permiso para modificar se pone true *-|
	
	|-* estos no los usa el fullCalendar pero según la documentación se pueden agregar que no los toca *-|
	"body": "|-$event->getBody()-|",
	"creationDate": "|-$event->getCreationDate("%Y/%m/%d %H:%M")-|",
	"street": "|-$event->getStreet()-|",
	"number": "|-$event->getNumber()-|"
}
