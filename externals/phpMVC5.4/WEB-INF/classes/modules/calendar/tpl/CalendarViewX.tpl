<link rel="stylesheet" href="css/main.css" type="text/css">

<style type="text/css">
<!--
body {
	background-image: url(images/bkg_bodyFancybox.png);
	background-color: #dad2ca;
	background-position: top left;
	background-repeat:repeat-x;
	color: #333;
	font-size:77%; /* this makes the text sized at 10px */
	padding: 0 0 40px;
}
#wrapper {
	width: 98%;
	background-color:#fdf8e9;
	-webkit-box-shadow: 0px 10px 20px 0px rgba(0, 0, 0, 0.5);
	box-shadow: 0px 10px 20px 0px rgba(0, 0, 0, 0.5);
	-webkit-border-radius: 0px 0px 10px 10px;
	border-radius: 0px 0px 10px 10px;
}
#rightColumn {
	background-color: #FDF8E9;
	margin-top: 50px;
	width: 90%;
}
#titleAgenda {
  width: 100% !Important;
	}
-->
</style>
<div id="wrapper">
<div id="rightColumn">
<div id="titleAgenda">Agenda</div>
<!-- begin EVENTO01 -->
<div class="event">
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
</div>
	 
	