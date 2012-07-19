{
	"id": "|-$holiday->getId()-|",
	"title": "|-$holiday->getTitle()-|",
	"start": "|-$holiday->getStartDate("%Y/%m/%d %H:%M")-|",
	"end": "|-$holiday->getEndDate("%Y/%m/%d %H:%M")-|",
	"allDay": true,
	"holiday": |-if $holiday->getHoliday() gt 0-|true|-else-|false|-/if-|,
	"className": "|-if $holiday->getHoliday() gt 0-||-if $holiday->getStartDate() lt $smarty.now|date_format:'%Y-%m-%d'-| evFeriadoPast|-else-| evFeriado|-/if-||-else-||-if $holiday->getStartDate() lt $smarty.now|date_format:'%Y-%m-%d'-| evEfemeridePast|-else-| evEfemeride|-/if-||-/if-|",
	"editable": false, |-* esto se modifica segun el permiso del usuario, si tien permiso para modificar se pone true *-|
	
	|-* estos no los usa el fullCalendar pero según la documentación se pueden agregar que no los toca *-|
	"body": "|-$holiday->getBody()-|",
	"creationDate": "|-$holiday->getCreationDate("%Y/%m/%d %H:%M")-|"
}
