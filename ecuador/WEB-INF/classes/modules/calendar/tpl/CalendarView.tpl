<div id="titleAgenda">Agenda</div>
<!-- begin EVENTO01 -->
<div class="news02">
		<h4>Publicado el |-$calendarEvent->getCreationDate()|date_format:"%d de %B de %Y"-|</h4>
<h2>|-assign var=region value=$calendarEvent->getRegion()-|
	|-if not empty($region)-||-$region->getName()-||-/if-|
		|-assign var=category value=$calendarEvent->getCategory()-|
	|-if not empty($category)-||-if not empty($region)-| &gt;&gt;|-/if-||-$category->getName()-||-/if-|
</h2>
		|-assign var=startDateMonth value=$calendarEvent->getStartDate()|date_format:"%m"-|
		|-assign var=startDateYear  value=$calendarEvent->getStartDate()|date_format:"%Y"-|
		|-assign var=endDateMonth value=$calendarEvent->getEndDate()|date_format:"%m"-|
		|-assign var=endDateYear  value=$calendarEvent->getEndDate()|date_format:"%Y"-|
		|-if $calendarEvent->getEndDate() eq $calendarEvent->getStartDate()-|
			 	<h4>El |-$calendarEvent->getStartDate()|date_format:"%d de %B de %Y"-|</h4>
		|-elseif $startDateYear eq $endDateYear and $startDateMonth eq $endDateMonth-|
			 	<h4>Desde el |-$calendarEvent->getStartDate()|date_format:"%d"-| al |-$calendarEvent->getEndDate()|date_format:"%d de %B de %Y"-|</h4>
		|-elseif $startDateYear eq $endDateYear-|
			 	<h4>Desde el |-$calendarEvent->getStartDate()|date_format:"%d de %B"-| al |-$calendarEvent->getEndDate()|date_format:"%d de %B de %Y"-|</h4>
		|-else-|
				<h4>Desde el |-$calendarEvent->getStartDate()|date_format:"%d de %B de %Y"-| al |-$calendarEvent->getEndDate()|date_format:"%d de %B de %Y"-|</h4>
		|-/if-|
<h1>|-$calendarEvent->gettitle()-|</h1>
	<!-- Begin  COMPLETE TEXT //  TEXTO EVENTO COMPLETA --------------------- -->
	|-if $calendarEvent->getImages()|@count gt 0-||-include file='CalendarMediasViewInclude.tpl'-||-/if-|
<div id="completeText">	
	|-$calendarEvent->getBody()-|
	<p>Fecha: |-$calendarEvent->getCreationDate()|date_format:"%d-%m-%Y"-|<br />
	|-assign var=sourceContact value=$calendarEvent->getSourceContact()-||-if not empty($sourceContact)-|Para más información: |-$sourceContact-||-/if-|</p>
</div>
<!-- End  COMPLETE TEXT // TEXTO EVENTO COMPLETA --------------------- -->
		<p><input type="button" name="Volver" value="Volver" id="Volver" onClick="javascript:history.go(-1);"></p>
	</div>
</p>
<!-- END EVENTO  **************************************** -->
<!-- **************************************** --> 

	   
		


