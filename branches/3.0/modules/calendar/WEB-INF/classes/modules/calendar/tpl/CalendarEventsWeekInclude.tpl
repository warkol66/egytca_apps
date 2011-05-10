<div id="calendar" class="calendar">
|-foreach from=$daysEvents item=dayEvent name=for_dayEvents key=day-|
	 |-if $dayEvent|@count gt 0-|<span class="dayNumber">|-$day-|-|-$month-|-|-$year-|</span>      
	 <ul>
	 |-foreach from=$dayEvent item=event name=for_events-|
	 |-assign var=eventSummary value=$event->getSummary()-|      
			<li><a href="Main.php?do=calendarEventsView&id=|-$event->getId()-|">|-$event->getTitle()-|</a></li>
	 |-/foreach-|  
	 </ul>|-/if-|
		 |-/foreach-|  
</div>
