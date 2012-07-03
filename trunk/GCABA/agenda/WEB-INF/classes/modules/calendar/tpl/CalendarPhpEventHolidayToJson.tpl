{
	"id": "|-$holiday->getId()-|",
	"title": "|-$holiday->getTitle()-|",
	"start": "|-$holiday->getStartDate("%Y/%m/%d %H:%M")-|",
	"end": "|-$holiday->getEndDate("%Y/%m/%d %H:%M")-|",
	"allDay": true,
	"holiday": |-if $holiday->getHoliday() gt 0-|true|-else-|false|-/if-|,
	"className": "|-if $holiday->getHoliday() gt 0-|evFeriado|-else-|evEfemeride|-/if-|",
	"editable": false, |-* esto se modifica segun el permiso del usuario, si tien permiso para modificar se pone true *-|
	
	|-* estos no los usa el fullCalendar pero según la documentación se pueden agregar que no los toca *-|
	"body": "|-$holiday->getBody()-|",
	"creationDate": "|-$holiday->getCreationDate("%Y/%m/%d %H:%M")-|"
}
