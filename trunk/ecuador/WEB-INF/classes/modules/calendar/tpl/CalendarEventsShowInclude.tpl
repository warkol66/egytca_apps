<!-- TITULO AGENDA -->
<div id="titleAgenda"><div id="icoAgenda"><a href="Main.php?do=calendarEventsMonth" title="Haga click sobre este ícono para ver el calendario"><img src="images/ico_calendar.gif" border="0" /></a></div>Agenda</div>
<!-- **************************************** --> 		   
<!--  AGENDA NOTICIA  **************************************** -->
<div id="div_calendarEvents">
		|-foreach from=$result item=calendarEvent name=for_calendarEvents-|
			<div id="event|-$calendarEvent->getId()-|" class="news02">|-if $calendarEvent->hasImages()-|<img src="Main.php?do=calendarEventsGetThumbnail&id=|-$calendarEvent->getId()-|" width="85" height="86" align="left" class="agendaImage"/>|-/if-|
		<!--	 	<h4>Publicado el |-$calendarEvent->getCreationDate()|date_format:"%d de %B, %Y"-|</h4> -->

					<h4>|-assign var=region value=$calendarEvent->getRegion()-|
					|-if not empty($region)-||-$region->getName()-||-/if-|
					|-assign var=category value=$calendarEvent->getCategory()-|
					|-if not empty($category)-||-if not empty($region)-|&gt;&gt;|-/if-||-$category->getName()-||-/if-|</h4>

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
				<h1><a href="Main.php?do=calendarEventsView&id=|-$calendarEvent->getId()-|">|-$calendarEvent->gettitle()-|</a></h1>
				<p>|-$calendarEvent->getSummary()-|</p>
				<div class="masInfo"><a href="Main.php?do=calendarEventsView&id=|-$calendarEvent->getId()-|">Ver más información</a></div>
			</div><!-- end EVENTS01  -->
			
         <div class="actionBox">
           <ul>
             <li><!--<a href="*" class="enviar">Enviar</a>--></li>
			 |-if $calendarEvent->hasImages()-|<li><a href="Main.php?do=calendarEventsView&id=|-$calendarEvent->getId()-|" class="fotos">Fotos</a></li>	|-/if-|	  			 			 
           </ul>
         </div>
         <!-- end ACTIONBOX -->  		 		   
		|-/foreach-|			
	</div>
	<div>
		<p class="pages">
				<a href="Main.php?do=calendarEventsMonth">Ver Agenda del mes</a>
		</p>
<!--		<p class="pages">
			|-if not isset($archive)-|
				<a href="Main.php?do=calendarEventsShow&archive=1">Mostrar Archivo de Eventos</a>
			|-else-|
				<a href="Main.php?do=calendarEventsShow">Mostrar Eventos Publicados</a>
			|-/if-|
		</p>-->
	</div>	
<!-- END AGENDA  **************************************** -->
<!-- **************************************** --> 
