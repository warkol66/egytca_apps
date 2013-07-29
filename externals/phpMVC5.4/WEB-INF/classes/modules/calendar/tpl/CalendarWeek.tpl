<div id="titleAgenda"><div id="icoAgenda"><a href="javascript:switch_vis('calendarChart');" title="Haga click sobre este ícono para ver el calendario"><img src="images/ico_calendar.gif" border="0" /></a></div>
Agenda semanal del |-$days-|/|-$month-|/|-$year-|&nbsp;&nbsp;<a href="Main.php?do=calendarWeek&startWeek=|-$previousStartWeek-|">&lt;&lt;</a>&nbsp;&nbsp;
      <a href="Main.php?do=calendarWeek&startWeek=|-$nextStartWeek-|">&gt;&gt;</a>
</div>
<div id="calendarChart" style="display: none;">
|-include file="CalendarEventsWeekChart.tpl"-|
</div>
<div id="calendar" class="calendar">
	<h1>Semana del |-$days-|-|-$month-|-|-$year-|</h1>
|-foreach from=$daysEvents item=dayEvent name=for_dayEvents key=day-|
	|-if $dayEvent|@count gt 0-|
		|-assign var=divOpened value=false-|
		|-foreach from=$dayEvent item=event name=for_events-|
		|-assign var=startDateDay value=$event->getStartDate()|date_format:"%d"-|
		|-assign var=startDateMonth value=$event->getStartDate()|date_format:"%m"-|
		|-assign var=startDateYear  value=$event->getStartDate()|date_format:"%Y"-|
		|-assign var=endDateDay value=$event->getEndDate()|date_format:"%d"-|
		|-assign var=endDateMonth value=$event->getEndDate()|date_format:"%m"-|
		|-assign var=endDateYear  value=$event->getEndDate()|date_format:"%Y"-|
	  |-if $startDateDay eq $day and $startDateMonth eq $month and $startDateYear eq $year-|
			|-if $divOpened eq false-|
			 <div class="eventsDay">|-$startDateDay-|</div>      
			 <div class="events"><ul>
			 |-assign var=divOpened value=true-|
			|-/if-|
		|-if $event->getEndDate() eq $event->getStartDate()-|
			|-assign var=eventDates value=""-|
		|-elseif $startDateYear eq $endDateYear and $startDateMonth eq $endDateMonth-|
			|-assign var=eventDates value=$event->getStartDate()|date_format:"Desde el %d"-|
			|-assign var=eventDates2 value=$event->getEndDate()|date_format:" al %d de %B de %Y"-|
			|-$eventDates|cat:$eventDates2-|
		|-elseif $startDateYear eq $endDateYear-|
			|-assign var=eventDates value=$event->getStartDate()|date_format:"Desde el %d de %B"-|
			|-assign var=eventDates2 value=$event->getEndDate()|date_format:" al %d de %B de %Y"-|
			|-$eventDates|cat:$eventDates2-|
		|-else-|
			|-assign var=eventDates value=$event->getStartDate()|date_format:"Desde el %d de %B de %Y"-|
			|-assign var=eventDates2 value=$event->getEndDate()|date_format:" al %d de %B de %Y"-|
			|-$eventDates|cat:$eventDates2-|
		|-/if-|<li><a href="Main.php?do=calendarView&id=|-$event->getId()-|" class="eventTitle">|-$event->getTitle()-|</a><br />|-if $eventDates ne ""-|<span class="eventDate">|-$eventDates-|</span><br />|-/if-||-$event->getSummary()-|</li><div class="masInfo"><a href="Main.php?do=calendarView&id=|-$event->getId()-|">Ver mas información</a></div>
		|-else-|
		|-/if-|
	 |-/foreach-|  
	 |-if $divOpened eq true-|</ul>
			 </div>
			|-assign var=divOpened value=false-|
		|-/if-|
|-/if-|
|-/foreach-|
</div>

|-if $eventsBeforeWeek|@count gt 0-|
<div id="calendar" class="calendar">
	<h1>Eventos en curso</h1>
|-include file="CalendarInProgressInclude.tpl" eventsInProgress=$eventsBeforeWeek-|
</div>
|-/if-|
