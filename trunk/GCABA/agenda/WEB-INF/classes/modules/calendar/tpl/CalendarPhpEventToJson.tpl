{
	"id": "|-$event->getId()-|",
	"title": "|-$event->getTitle()|escape:"double_quotes"-|",
	"start": "|-$event->getStartDate("%Y/%m/%d %H:%M")-|",
	"end": "|-$event->getEndDate("%Y/%m/%d %H:%M")-|",
	"allDay": false,
	"className": "|-assign var="axis" value=$event->getCalendarAxis()-||-if $axis-||-$axis->getCssClass()-||-else-|gris|-/if-||-if $event->getEndDate() lte $smarty.now|date_format:'%Y-%m-%d'-| evAnterior|-else-| evReflex|-/if-|",
	"editable": true, |-* esto se modifica segun el permiso del usuario, si tien permiso para modificar se pone true *-|
	
	|-* esto no es parte del evento php, no hay que borrarlo cuando se reemplace lo de abajo por el toJSON() *-|
	"photo": |-json_encode($event->getActorThumbnail())-|,
	|-* --------------------------- *-|
	
	|-* estos no los usa el fullCalendar pero según la documentación se pueden agregar que no los toca *-|
	"body": "|-$event->getBody()|escape:'double_quotes'-|",
	"creationDate": "|-$event->getCreationDate("%Y/%m/%d %H:%M")-|",
	"street": "|-$event->getStreet()|escape:'double_quotes'-|",
	"number": "|-$event->getNumber()-|",
	"address": "|-$event->getAddress()|escape:'double_quotes'-|",
	"axisId": "|-$event->getAxisId()-|",
	"status": "|-$event->getStatus()-|",
	"agendaType": "|-$event->getAgendaType()-|",
	"typeId": "|-$event->getTypeId()-|",
	"userId": "|-$event->getUserId()-|",
	"scheduleStatus": "|-$event->getScheduleStatus()-|",
	"campaignCommitment": |-if $event->getCampaignCommitment()-|true|-else-|false|-/if-|,
	"nonpublic": |-json_encode($event->getNonPublic())-|,
	"comments": "|-$event->getComments()|escape:'double_quotes'-|",
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
