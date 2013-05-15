<div id="rightColumn">
<link rel="stylesheet" href="css/globalStyles.css" type="text/css">
<link rel="stylesheet" href="css/globalCustom.css" type="text/css">
<link rel="stylesheet" href="css/style.css" type="text/css">
<link rel="stylesheet" href="css/custom.css" type="text/css">
<div id="titleAgenda">Agenda</div>
<!-- begin EVENTO01 -->
<div class="article">
		<h5>Publicado el |-$calendarEvent->getCreationDate()|date_format:"%d de %B de %Y"-|</h5>
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
	<h2>|-$calendarEvent->gettitle()-|</h2>
		<!-- Begin  COMPLETE TEXT //  TEXTO EVENTO COMPLETA --------------------- -->
		|-if $calendarEvent->getImages()|@count gt 0-||-include file='CalendarMediasViewInclude.tpl'-||-/if-|
	<div id="completeText">	
		|-$calendarEvent->getBody()-|
		<p>Fecha: |-$calendarEvent->getCreationDate()|date_format:"%d-%m-%Y"-|<br />
		|-assign var=sourceContact value=$calendarEvent->getSourceContact()-||-if not empty($sourceContact)-|Para más información: |-$sourceContact-||-/if-|</p>
	</div>
<!-- End  COMPLETE TEXT // TEXTO EVENTO COMPLETA --------------------- -->
</div>
</div>

	   
		


