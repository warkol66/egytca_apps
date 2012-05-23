{
	"id": "|-$event->getId()-|",
	"title": '|-$event->getTitle()|escape:'quotes'-|',
	"start": "|-$event->getStartDate("%Y/%m/%d %H:%M")-|",
	"end": "|-$event->getEndDate("%Y/%m/%d %H:%M")-|",
	"allDay": false,
	"className": "|-assign var="axis" value=$event->getCalendarAxis()-||-if $axis-||-$axis->getCssClass()-||-else-|gris|-/if-|",
	"editable": true, |-* esto se modifica segun el permiso del usuario, si tien permiso para modificar se pone true *-|
	
	|-* estos no los usa el fullCalendar pero según la documentación se pueden agregar que no los toca *-|
	"body": '|-$event->getBody()|escape:'quotes'-|',
	"creationDate": "|-$event->getCreationDate("%Y/%m/%d %H:%M")-|",
	"street": '|-$event->getStreet()|escape:'quotes'-|',
	"number": "|-$event->getNumber()-|",
	"axisId": "|-$event->getAxisId()-|",
	"status": "|-$event->getStatus()-|",
	"agendaType": "|-$event->getAgendaType()-|",
	"typeId": "|-$event->getTypeId()-|",
	"userId": "|-$event->getUserId()-|",
	"scheduleStatus": "|-$event->getScheduleStatus()-|",
	"regionsIds":
		[
			|-foreach from=$event->getRegions() item=region-|
				|-if !$region@first-|,|-/if-|
				"|-$region->getId()-|"
			|-/foreach-|
		],
	"categoriesIds":
		[
			|-foreach from=$event->getCategorys() item=category-|
				|-if !$category@first-|,|-/if-|
				"|-$category->getId()-|"
			|-/foreach-|
		],
	"actorsIds":
		[
			|-foreach from=$event->getActors() item=actor-|
				|-if !$actor@first-|,|-/if-|
				"|-$actor->getId()-|"
			|-/foreach-|
		]
}
