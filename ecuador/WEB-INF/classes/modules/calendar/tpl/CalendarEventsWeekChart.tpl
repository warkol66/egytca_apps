<table cellpadding="0" cellspacing="0" class="eventsMonth">
	<col width="14.28%" />
	<col width="14.28%" />
	<col width="14.28%" />
	<col width="14.28%" />
	<col width="14.28%" />
	<col width="14.28%" />
	<col width="14.28%" />
<thead>
<tr>
	<th>Domingo</th>
	<th>Lunes</th>
	<th>Martes</th>
	<th>Miércoles</th>
	<th>Jueves</th>
	<th>Viernes</th>
	<th>Sábado</th>
</tr>
</thead>
<tbody>
<tr>
      |-counter assign=dayCounter start=0 skip=1-| 

      |-section name=init loop=$firstDay-|
      <td class="empty"></td>
      |-counter print=false-|
      |-/section-|
      
      |-foreach from=$daysEvents item=dayEvent name=for_dayEvents key=day-|
      <td>
      
         <span class="dayNumber">|-$day-|</span>      
         |-if $dayEvent|@count gt 0-|
				 |-assign var=ulOpened value=false-|
         |-foreach from=$dayEvent item=event name=for_events-|
						|-assign var=startDateDay value=$event->getStartDate()|date_format:"%d"-|
						|-assign var=startDateMonth value=$event->getStartDate()|date_format:"%m"-|
						|-assign var=startDateYear  value=$event->getStartDate()|date_format:"%Y"-|

						|-if $startDateDay eq $day and $startDateMonth eq $month and $startDateYear eq $year-|
				 |-if $ulOpened eq false-|<ul>|-assign var=ulOpened value=true-||-/if-|
						|-assign var=endDateDay value=$event->getEndDate()|date_format:"%d"-|
						|-assign var=endDateMonth value=$event->getEndDate()|date_format:"%m"-|
						|-assign var=endDateYear  value=$event->getEndDate()|date_format:"%Y"-|
						|-if $event->getEndDate() eq $event->getStartDate()-|
							|-assign var=eventDates value=$event->getStartDate()|date_format:"%d de %B de %Y"-|
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
						|-/if-|
						 |-assign var=eventSummary value=$event->getSummary()|escape:'html'-|
						 |-assign var=eventTitle value=$event->getTitle()|escape:'html'-|
						|-assign var=eventText value="<h3>"|cat:$eventTitle|cat:"</h3><h4>"|cat:$eventDates|cat:"</h4>"|cat:$eventSummary-|
            <li><a href="Main.php?do=calendarView&id=|-$event->getId()-|" |-popup sticky=true fgcolor="#ffffff" bgcolor="#ffffff" closecolor="#cdcdcd" closetext='Cerrar' closetitle='Cerrar' capcolor='#ffffff' bgcolor='#006699' snapx=10 snapy=10 width=350 caption="Información del Evento" trigger="onMouseOver" text="$eventText"-|>|-$eventTitle-|</a></li>
					|-/if-|
         |-/foreach-|  
         	|-if $ulOpened eq true-|
				 		</ul>
						|-assign var=divOpened value=false-|
					|-/if-|
				 |-/if-|			
			
			</td>
      |-counter print=false-|
         |-if ($dayCounter mod 7) eq 0-|
    </tr>
         <tr>
         |-/if-|
      |-/foreach-| 
           
      |-section name=end loop=$lastDays-|
      <td class="empty"></td>
      |-/section-|

</tr>
</tbody>
</table> 
