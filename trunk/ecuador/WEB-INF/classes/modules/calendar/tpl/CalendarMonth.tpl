<script type="text/javascript" src="scripts/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
<link rel="stylesheet" href="scripts/fancybox/jquery.fancybox-1.3.4.css" type="text/css" media="screen" />
<script type="text/javascript">
$(document).ready(function() {
	$("a#single_image").fancybox();
});
</script>
<div id="titleAgenda"><div id="icoAgenda"><a href="javascript:switch_vis('calendarChart');" title="##calendar,10,Haga click sobre este ícono para ocultar/ver el calendario##"><img src="images/ico_calendar.gif" border="0" /></a></div>
##calendar,9,Agenda mensual de## |-$monthDisplayed|date_format:"%B %Y"|ucfirst-|&nbsp;&nbsp;<a href="Main.php?do=calendarMonth&month=|-$previousMonth-|&year=|-$previousYear-|">&lt;&lt;</a>&nbsp;&nbsp;
      <a href="Main.php?do=calendarMonth&month=|-$nextMonth-|&year=|-$nextYear-|">&gt;&gt;</a></div>
<div id="calendarChart" style="display: block;">
|-include file="CalendarEventsMonthChart.tpl"-|
</div>
<div id="calendarMonth" class="calendar">
	<h2>|-$monthDisplayed|date_format:"%B %Y"|ucfirst-|</h2>
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
			 <div class="eventsDay">|-$smarty.foreach.for_dayEvents.iteration-|</div>      
			 <div class="events"><ul>
			 |-assign var=divOpened value=true-|
			|-/if-|
		|-if $event->getEndDate() eq $event->getStartDate()-|
			|-assign var=eventDates value=""-|
		|-else if $startDateYear eq $endDateYear and $startDateMonth eq $endDateMonth-|
			|-assign var=eventDates value=$event->getStartDate()|date_format:"Desde el %d"-|
			|-assign var=eventDates2 value=$event->getEndDate()|date_format:" al %d de %B de %Y"-|
			|-assign var=eventDates value=$eventDates|cat:$eventDates2-|
		|-else if $startDateYear eq $endDateYear-|
			|-assign var=eventDates value=$event->getStartDate()|date_format:"Desde el %d de %B"-|
			|-assign var=eventDates2 value=$event->getEndDate()|date_format:" al %d de %B de %Y"-|
			|-assign var=eventDates value=$eventDates|cat:$eventDates2-|
		|-else-|
			|-assign var=eventDates value=$event->getStartDate()|date_format:"Desde el %d de %B de %Y"-|
			|-assign var=eventDates2 value=$event->getEndDate()|date_format:" al %d de %B de %Y"-|
			|-assign var=eventDates value=$eventDates|cat:$eventDates2-|
		|-/if-|
			|-if $calendarEventsConfig.bodyOnEventsShow.value eq "YES"-|
				<li>
					<h3>|-$event->getTitle()-|</h3>
						<br />|-if $eventDates ne ""-|<span class="eventDate">|-$eventDates-|</span>
						<br />|-/if-|
						|-$event->getBody()-|
						</li>
			|-else-|
				<li>
					<a href="Main.php?do=calendarView&id=|-$event->getId()-|" class="eventTitle">|-$event->getTitle()-|</a>
					<br />|-if $eventDates ne ""-|<span class="eventDate">|-$eventDates-|</span><br />|-/if-|
					|-if $calendarEventsConfig.useSummary.value eq "YES"-||-$event->getSummary()-|</li>
						<div class="masInfo"><a id="fancybox_|-$event->getId()-|" href="Main.php?do=calendarViewX&id=|-$event->getId()-|" class="iframe">Ver mas información</a></div>
						<script>
							$('a#fancybox_|-$event->getId()-|').fancybox({'width' : 800, 'height' : 600});
						</script>
					|-else-|</li>
					|-/if-|
			|-/if-|		
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

|-if $eventsBeforeMonth|@count gt 0-|
<div id="calendarProgress" class="calendar">
	<h1>##calendar,11,Eventos en curso##</h1>
|-include file="CalendarInProgressInclude.tpl" eventsInProgress=$eventsBeforeMonth-|
</div>
|-/if-|
