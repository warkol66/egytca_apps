|-popup_init src="scripts/overlib.js"-|
<table cellpadding="0" cellspacing="0" class="eventsMonth" width="100%">
	<col width="14.28%" />
	<col width="14.28%" />
	<col width="14.28%" />
	<col width="14.28%" />
	<col width="14.28%" />
	<col width="14.28%" />
	<col width="14.28%" />
<thead>
<tr>|-if $beginOnSunday eq "YES"-|
	<th>##calendar,8,Domingo##</th>
|-/if-|
	<th>##calendar,2,Lunes##</th>
	<th>##calendar,3,Martes##</th>
	<th>##calendar,4,Miércoles##</th>
	<th>##calendar,5,Jueves##</th>
	<th>##calendar,6,Viernes##</th>
	<th>##calendar,7,Sábado##</th>
|-if $beginOnSunday ne "YES"-|
	<th>##calendar,8,Domingo##</th>
|-/if-|</tr>
</thead>
<tbody>
|-counter name=cellCounter assign=cellCounter start=0 skip=1-| 
|-counter name=completeCols assign=completeCols start=7 skip=-1-| 
|-section name=init loop=$firstDay-|
	|-if $smarty.section.init.first-|<tr>|-/if-|
	<td class="empty"></td>|-counter name=cellCounter print=false-||-counter name=completeCols print=false-|
|-/section-|
|-foreach from=$daysEvents item=dayEvent name=for_dayEvents-|
	|-if $daysEvents eq 0-|
	 <tr>
	|-/if-|
	 <td>
		|-if $dayEvent|@count gt 0-|
		|-foreach from=$dayEvent item=event name=for_events-|
			|-assign var=startDateDay value=$event->getStartDate()|date_format:"%d"-|
			|-assign var=startDateMonth value=$event->getStartDate()|date_format:"%m"-|
			|-assign var=startDateYear  value=$event->getStartDate()|date_format:"%Y"-|
			|-if $startDateDay eq $smarty.foreach.for_dayEvents.iteration and $startDateMonth eq $month and $startDateYear eq $year-|
				|-assign var=endDateDay value=$event->getEndDate()|date_format:"%d"-|
				|-assign var=endDateMonth value=$event->getEndDate()|date_format:"%m"-|
				|-assign var=endDateYear  value=$event->getEndDate()|date_format:"%Y"-|
				|-if $event->getEndDate() eq $event->getStartDate()-|
					|-assign var=eventDates value=$event->getStartDate()|date_format:"%d de %B de %Y"-|
				|-elseif $startDateYear eq $endDateYear and $startDateMonth eq $endDateMonth-|
					|-assign var=eventDates value=$event->getStartDate()|date_format:"Desde el %d"-|
					|-assign var=eventDates2 value=$event->getEndDate()|date_format:" al %d de %B de %Y"-|
					|-assign var=$eventDates value=$eventDates|cat:$eventDates2-|
				|-elseif $startDateYear eq $endDateYear-|
					|-assign var=eventDates value=$event->getStartDate()|date_format:"Desde el %d de %B"-|
					|-assign var=eventDates2 value=$event->getEndDate()|date_format:" al %d de %B de %Y"-|
					|-assign var=$eventDates value=$eventDates|cat:$eventDates2-|
				|-else-|
					|-assign var=eventDates value=$event->getStartDate()|date_format:"Desde el %d de %B de %Y"-|
					|-assign var=eventDates2 value=$event->getEndDate()|date_format:" al %d de %B de %Y"-|
					|-assign var=$eventDates value=$eventDates|cat:$eventDates2-|
				|-/if-|
				|-assign var=eventSummary value=$event->getSummary()|escape:'html'-|
				|-assign var=eventTitle value=$event->getTitle()|escape:'html'-|
				|-assign var=eventText value="<h3>"|cat:$eventText|cat:$eventTitle|cat:"</h3><h4>"|cat:$eventDates|cat:"</h4>"|cat:$eventSummary-|
				|-assign var=allThisDayEvents value=$allThisDayEvents|cat:$eventText-|
			|-/if-|
	 |-/foreach-|
	 |-/if-|
		|-if $allThisDayEvents ne ''-|
			|-assign var=closeText value="Cerrar"|multilang_get_translation:"common"-|
			|-assign var=caption value="Información del Evento"|multilang_get_translation:"calendar"-|
				<a href="javascript:void(null);" |-popup sticky=true fgcolor="#ffffff" bgcolor="#ffffff" closecolor="#cdcdcd" closetext="$closeText" closetitle="$closeText" capcolor='#ffffff' bgcolor='#006699' snapx=10 snapy=10 width=350 caption="$caption" trigger="onMouseOver" text="$allThisDayEvents"-| class="dayEventNumber">|-$smarty.foreach.for_dayEvents.iteration-|</a>
				|-assign var=allThisDayEvents value=''-|
		|-else-|
	<span class="dayNumber">|-$smarty.foreach.for_dayEvents.iteration-|</span>      
		|-/if-|
    		</td>
      |-counter name=cellCounter print=false-|
      |-counter name=completeCols print=false-|
        |-if ($cellCounter mod 7) eq 0-|
				</tr>
				|-if $cellCounter lte ($daysEvents|@count+$firstDay-1)-|
			 <tr>
				 |-counter name=completeCols assign=completeCols start=7 skip=-1-| 
        |-/if-|
        |-/if-|
      |-/foreach-|      
				|-if $cellCounter lte ($daysEvents|@count+$firstDay-1)-|
				 <tr>
				 |-counter name=completeCols assign=completeCols start=7 skip=-1-| 
        |-/if-|
      |-section name=complete loop=$completeCols-|
      <td class="empty"></td>
      |-/section-|
</tr>
</tbody>
</table> 
