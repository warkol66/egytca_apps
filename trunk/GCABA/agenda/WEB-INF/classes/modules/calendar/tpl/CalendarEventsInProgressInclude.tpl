	|-if $eventsInProgress|@count gt 0-|
	|-foreach from=$eventsInProgress item=event name=foreachEventsInProgress key=keyEvent-|
		|-if $event->getStartDate() ne '' && $event->getEndDate() ne ''-|
		|-assign var=startDateDay value=$event->getStartDate()|date_format:"%d"-|
		|-assign var=startDateMonth value=$event->getStartDate()|date_format:"%m"-|
		|-assign var=startDateYear  value=$event->getStartDate()|date_format:"%Y"-|
		|-assign var=endDateDay value=$event->getEndDate()|date_format:"%d"-|
		|-assign var=endDateMonth value=$event->getEndDate()|date_format:"%m"-|
		|-assign var=endDateYear  value=$event->getEndDate()|date_format:"%Y"-|
			 <div class="eventsDay">&nbsp;</div>      
			 <div class="events"><ul>
			|-if $event->getEndDate() eq $event->getStartDate()-|
				|-assign var=eventDates value=""-|
			|-elseif $startDateYear eq $endDateYear and $startDateMonth eq $endDateMonth-|
				|-assign var=eventDates value=$event->getStartDate()|date_format:"Desde el %d"-|
				|-assign var=eventDates2 value=$event->getEndDate()|date_format:" al %d de %B de %Y"-|
				|-assign var=eventDates value=$eventDates$eventDates2-|
			|-elseif $startDateYear eq $endDateYear-|
				|-assign var=eventDates value=$event->getStartDate()|date_format:"Desde el %d de %B"-|
				|-assign var=eventDates2 value=$event->getEndDate()|date_format:" al %d de %B de %Y"-|
				|-assign var=eventDates value=$eventDates$eventDates2-|
			|-else-|
				|-assign var=eventDates value=$event->getStartDate()|date_format:"Desde el %d de %B de %Y"-|
				|-assign var=eventDates2 value=$event->getEndDate()|date_format:" al %d de %B de %Y"-|
				|-assign var=eventDates value=$eventDates$eventDates2-|
			|-/if-|
			|-if $calendarEventsConfig.bodyOnEventsShow.value eq "YES"-|
			<li><h3>|-$event->getTitle()-|</h3><br />|-if $eventDates ne ""-|<span class="eventDate">|-$eventDates-|</span><br />|-/if-||-$event->getBody()-|</li>
			|-else-|
			<li><a href="Main.php?do=calendarEventsView&id=|-$event->getId()-|" class="eventTitle">|-$event->getTitle()-|</a><br />|-if $eventDates ne ""-|<span class="eventDate">|-$eventDates-|</span><br />|-/if-||-$event->getSummary()-|</li><div class="masInfo"><a href="Main.php?do=calendarEventsView&id=|-$event->getId()-|">Ver mas información</a></div>
			 </ul>
			</div>
		|-/if-|
		|-/foreach-|
	|-/if-|
