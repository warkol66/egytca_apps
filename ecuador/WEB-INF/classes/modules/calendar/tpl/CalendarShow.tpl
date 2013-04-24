<!-- TITULO AGENDA -->
<div id="titleAgenda"><div id="icoAgenda"><a href="Main.php?do=calendarMonth">&nbsp;</a></div>Agenda</div>
<!-- **************************************** --> 		   
<!--  AGENDA NOTICIA  **************************************** -->
<div id="div_calendarEvents">
		|-foreach from=$calendarEventColl item=calendarEvent name=for_calendarEvents-|
			<div id="event|-$calendarEvent->getId()-|" class="article">|-if $calendarEvent->hasImages()-|<img src="Main.php?do=calendarGetThumbnail&id=|-$calendarEvent->getId()-|" width="85" height="86" align="left" class="agendaImage"/>|-/if-|
			 	<h5>Publicado el |-$calendarEvent->getCreationDate()|date_format:"%d de %B, %Y"-|</h5>
				<h2><a href="Main.php?do=calendarView&id=|-$calendarEvent->getId()-|">|-$calendarEvent->gettitle()-|</a></h2>
				<h4>
				|-assign var=category value=$calendarEvent->getCategory()-|
				|-if not empty($category)-||-$category->getName()-||-/if-|</h4>


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
				<!--h1><a href="Main.php?do=calendarView&id=|-$calendarEvent->getId()-|">|-$calendarEvent->gettitle()-|</a></h1-->
				<div id="summary">
					<p>|-$calendarEvent->getSummary()-|</p>
				</div>
				<div class="masInfo"><a class="commentsBut" href="Main.php?do=calendarView&id=|-$calendarEvent->getId()-|">Ver más información</a></div>
				
			</div><!-- end EVENTS01  -->
         <!--div class="actionBox">
           <ul>
             <li><a href="*" class="enviar">Enviar</a></li>
			 |-if $calendarEvent->hasImages()-|<li><a href="Main.php?do=calendarView&id=|-$calendarEvent->getId()-|" class="fotos">Fotos</a></li>	|-/if-|	  			 			 
           </ul>
         </div-->
         <!-- end ACTIONBOX -->  		 		   
<!-- END EVENTO  **************************************** -->
<!-- **************************************** --> 

		|-/foreach-|			
		|-if isset($pager) && ($pager->getLastPage() gt 1)-|
			<div class="pages">|-include file="PaginateInclude.tpl"-|</div>
		|-/if-|
	</div>
	<div>
		<p class="pages">
			|-if not isset($archive)-|
				<a href="Main.php?do=calendarShow&archive=1">Mostrar Archivo de Eventos</a>
			|-else-|
				<a href="Main.php?do=calendarShow">Mostrar Eventos Publicados</a>
			|-/if-|
		</p>
	</div>
