<div id="calendar" class="calendar">
	<h1>|-$month-|-|-$year-|</h1>
|-foreach from=$daysEvents item=dayEvent name=for_dayEvents key=day-|
	 |-if $dayEvent|@count gt 0-|
	 <div class="eventsDay">|-$smarty.foreach.for_dayEvents.iteration-|</div>      
	 <div class="events"><ul>
	 |-foreach from=$dayEvent item=event name=for_events-|
	 |-assign var=eventSummary value=$event->getSummary()-|      
			<li><a href="Main.php?do=calendarEventsView&id=|-$event->getId()-|">|-$event->getTitle()-|</a></li>
	 |-/foreach-|  
	 </ul>
	 </div>
<br clear="all" />|-/if-|
|-/foreach-|
</div>
