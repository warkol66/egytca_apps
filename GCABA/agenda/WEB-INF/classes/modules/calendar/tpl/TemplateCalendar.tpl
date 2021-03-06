<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<title>|-if isset($module)-||-$module|multilang_get_translation:"common"-| - |-/if-||-$parameters.siteName-|</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="css/main.css" type="text/css" />
<link rel="stylesheet" type="text/css" href="css/basics.css" media="screen" />
<link rel="stylesheet" type="text/css" href="css/960.css" media="screen" />
<link rel="stylesheet" type="text/css" href="css/agenda.css" media="screen" />
<link rel="stylesheet" type="text/css" href="css/fisheye.css" media="screen" />
<link rel="stylesheet" type="text/css" href="css/print.css" media="print" />
<!-- Condicionales para todos los ie-->
		<!--[if IE 6]><link rel="stylesheet" type="text/css" href="css/ie6.css" media="screen" /><![endif]-->
		<!--[if IE 7]><link rel="stylesheet" type="text/css" href="css/ie7.css" media="screen" /><![endif]-->
		<!--[if IE 8]><link rel="stylesheet" type="text/css" href="css/ie8.css" media="screen" /><![endif]-->
		<!--[if IE 9]><link rel="stylesheet" type="text/css" href="css/ie9.css" media="screen" /><![endif]-->
		<!--[if IE]><link rel="stylesheet" type="text/css" href="css/ie.css" media="screen" /><![endif]-->   

<link type="text/css" href="css/ui-lightness/jquery-ui-1.8.20.custom.css" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="scripts/fullcalendar/fullcalendar.css" media="screen" />
<!--<link rel="stylesheet" type="text/css" href="scripts/fullcalendar/fullcalendar.print.css" media="print" /> -->
<link rel="shortcut icon" href="images/favicon.ico" />
<script language="JavaScript" type="text/JavaScript">
	var url="|-$systemUrl-|";
</script>

|-block name=jsIncludes-|
	|-include file='TemplateJsIncludes.jquery.tpl'-|
|-/block-|
<script type="text/javascript" src="scripts/jquery/jquery-ui-1.8.19.custom.min.js"></script>
<!-- multiselect -->
<link rel='stylesheet' type='text/css' href='css/jquery.multiselect.css' />
<script type="text/javascript" src="scripts/jquery/jquery.multiselect.min.js"></script>
<!-- end multiselect -->
<script type="text/javascript" src="scripts/jquery/jquery.ui.datepicker-es.js"></script>
<script src="scripts/fisheye.js"></script>
<script type="text/javascript">
	$(function(){
		// Accordion
		$("#accordion").accordion({ 		
				/*active: false,*/
				header: 'h3',
				alwaysOpen: false,
				animated: true,
				showSpeed: 400,
				hideSpeed: 800,
				autoHeight: false
		});
		// Accordion
		$("#accordion2").accordion({ 		
				active: false,
				header: 'h3',
				alwaysOpen: false,
				animated: true,
				showSpeed: 400,
				hideSpeed: 800,
				autoHeight: false
		});
		$("#accordion2").accordion({ collapsible: true });
	//hover states on the static widgets
		$('#dialog_link, ul#icons li').hover(
			function() { $(this).addClass('ui-state-hover'); },
			function() { $(this).removeClass('ui-state-hover'); }
		);
	});
	function MM_showHideLayers() { //v9.0
  var i,p,v,obj,args=MM_showHideLayers.arguments;
  for (i=0; i<(args.length-2); i+=3) 
  with (document) if (getElementById && ((obj=getElementById(args[i]))!=null)) { v=args[i+2];
    if (obj.style) { obj=obj.style; v=(v=='show')?'visible':(v=='hide')?'hidden':v; }
    obj.visibility=v; }
	}
	$(document).ready(function() {
		$(".boxNav1 .multiselect").multiselect({
			noneSelectedText: "Seleccione",
			selectedText: "# seleccionados",
			checkAllText: "Todos",
			uncheckAllText: "Ninguno",
			minWidth: 125,
			classes: "shadowedBox"
		});
		$("#kind").multiselect({
			noneSelectedText: "Tipo de evento",
			selectedText: "# tipos seleccionados"
		});
		$("#agenda").multiselect({
			noneSelectedText: "Agenda",
			selectedText: "# agendas seleccionadas"
		});
		$("#searchActor").multiselect({
			noneSelectedText: "Funcionarios",
			selectedText: "# funcionarios seleccionados"
		});
		$("#searchCategory").multiselect({
			noneSelectedText: "Dependencias",
			selectedText: "# dependencias seleccionadas"
		});
		$("#searchRegion").multiselect({
			noneSelectedText: "Comunas",
			selectedText: "# comunas seleccionadas"
		});
	});
</script>
	<link type="text/css" href="css/chosen.css" rel="stylesheet" />
	<script language="JavaScript" type="text/javascript" src="scripts/jquery/chosen.js"></script>
<style type="text/css">
<!--
/* PENDING*/
.printTodayDate {
	display: none;
}

-->
</style>
</head>
<body>
	<div class="container_16">
		<div class="grid_16 header1">
			<a href="Main.php?do=calendarShow"><h1 id="branding"></h1></a>
			<span class="eyefishContainer">
				<ul id="fisheye_menu">
					<li><a href="Main.php?do=calendarShow" class="fisheye"><img src="images/agenda.png" alt=""><span style="display: none;">Agenda</span></a></li>
					<li><a href="javascript:void(null)" class="fisheye" onclick="$('#filters').toggle();"><img src="images/eyeIcon_00.png" alt=""><span style="display: none;">Filtrar</span></a></li>
					<li><a href="Main.php?do=calendarPendingShow" class="fisheye"><img src="images/pendientes.png" alt=""><span style="display: none;">Pendientes</span></a></li>
					<li><a href="Main.php?do=calendarToBeConfirmedShow" class="fisheye"><img src="images/aconfirmar.png" alt=""><span style="display: none;">A Confirmar</span></a></li>
					<li><a href="Main.php?do=calendarStatisticsShow" class="fisheye"><img src="images/eyeIcon_07.png" alt=""><span style="display: none;">Estadísticas</span></a></li>
					<li><a href="Main.php?do=calendarEventsMapShow&filters[minDate]=|-$smarty.now|date_format:'%Y-%m-01'-|&filters[maxDate]=|-date("Y-m-t")-|" class="fisheye"><img src="images/eyeIcon_06.png" alt=""><span style="display: none;">Ver en mapa</span></a></li>
	<!--				<li><a href="#3" class="fisheye"><img src="images/eyeIcon_03.png" alt=""><span style="display: none;">Exportar</span></a></li> -->
					<li><a href="javascript:window.print()" class="fisheye"><img src="images/eyeIcon_04.png" alt=""><span style="display: none;">Imprimir</span></a></li>
					<li><a href="#5" class="fisheye"><img src="images/eyeIcon_05.png" alt=""><span style="display: none;">Salir</span></a></li>
				</ul>
			</span><!-- end fisheye Container -->
			<span class="slogan"></span>
		</div><!-- /grid_16 header1 -->
		
		
		
		<div id="filters" style="display:|-if $filters|@count ne 0-|block|-else-|none|-/if-|"><!-- filters -->
			<div id="textFilters">|-if $filters|@count ne 0-|
				<a href="javascript:void(null)" class="butResultsFilter" onClick="$('.boxNav1').toggle()">Resultados filtrados</a>|-/if-|
				<a href="javascript:void(null)" class="butShowHideFilter" onclick="$('.boxNav1').toggle()">Ver/Ocultar filtros</a>
				|-if $filters|@count ne 0-||-block name="removefiltersLink"-|<a href="Main.php?do=calendarShow" class="butDeleteFilter">Quitar Filtros</a>|-/block-||-/if-|
			</div>
			<div class="boxNav1" style="display:|-if $filters|@count eq 0-|block|-else-|none|-/if-|"><!-- boxNav1 -->
				<form action='Main.php' method='get' style="display:inline;" name="filters">
					<input id="input_do" type="hidden" name="do" value="calendarShow" />
		<ul>
			<!-- <li class="botSmall"><a href="#" class="menuIcon_01"></a></li>
			<li class="botSmall"><a href="#" class="menuIcon_02"></a></li>
			<li class="botSmall"><a href="#" class="menuIcon_03"></a></li> -->
			<li class="botSmall"><a href="#" class="menuIcon_04" title="Seguimiento de obras"></a></li>
			<li class="botSmall"><a href="#" class="menuIcon_05" title="Reuniones de gabinete"></a></li>
			<li class="botSmall"><a href="#" class="menuIcon_06" title="Georreferenciación de eventos"></a></li>
			<li><select name="filters[kind][]" id="kind" class="multiselect" multiple="multiple" style="display: none;">
				|-foreach from=$kinds item=kind name=foreach_kinds-|
					<option value="|-$kind@key-|" |-if in_array($kind@key, $filters.kind)-|selected="selected"|-/if-|>|-$kind-|</option>
				|-/foreach-|
                            </select>
			</li>
			<li><select name="filters[agenda][]" id="agenda" class="multiselect" multiple="multiple" style="display: none;">
				|-foreach from=$agendas item=agenda name=foreach_agendas-|
					<option value="|-$agenda@key-|" |-if in_array($agenda@key, $filters.agenda)-|selected="selected"|-/if-|>|-$agenda-|</option>
				|-/foreach-|
                            </select>
			</li>
			<li><select name="filters[searchActorId][]" id="searchActor" class="multiselect" multiple="multiple" style="display: none;">
				|-foreach from=$actors item=actor name=from_actor-|
					<option value="|-$actor->getId()-|" |-if in_array($actor->getId(), $filters.searchActorId)-|selected="selected"|-/if-|>|-$actor-|</option>
				|-/foreach-|
			    </select>
			</li>
			<li><select name="filters[searchCategoryId][]" id="searchCategory" class="multiselect" multiple="multiple" style="display: none;">
				|-foreach from=$categories item=category name=from_categories-|
					<option value="|-$category->getId()-|" |-if in_array($category->getId(), $filters.searchCategoryId)-|selected="selected"|-/if-|>|-$category->getName()-|</option>
				|-/foreach-|
			    </select>
			</li>
			<li><select name="filters[searchRegionId][]" id="searchRegion" class="multiselect" multiple="multiple" style="display: none;">
				|-foreach from=$comunes item=comune name=foreach_comunes-|
					<option value="|-$comune->getId()-|" |-if in_array($comune->getId(), $filters.searchRegionId)-|selected="selected"|-/if-|>|-$comune->getName()-||-assign var=subregions value=$comune->getChildren()-| (|-foreach from=$subregions item=subregion name=foreach_subregion-||-$subregion->getName()-||-if !$subregion@last-|, |-/if-||-/foreach-|)</option>
				|-/foreach-|
			    </select>
			</li>
			
			<li class="buttonCC"><input name="filters[campaigncommitment]" type="checkbox" value="1" |-$filters.campaigncommitment|checked_bool-|/><a href="#"></a></li>
			
			|-block name="dateFilter"-|
				<li class="pickDate">
					<input type="text" name="filters[selectedDate]" id="datepicker" value="|-$filters.selectedDate-|" size="10" maxlength="10" style="position:relative;z-index: 1050;" />
					<a href="javascript:document.filters.submit();" class="dateGo">Ir</a>
				</li>
				<script type="text/javascript">
					$(function() {
						// Datepicker
						$('#datepicker').datepicker({
							dateFormat: 'dd-mm-yy',
							changeYear: true,
							changeMonth: true,
							inline: true
						});
					});
				</script>
			|-/block-| |-* dateFilter *-|
			<li><a href="javascript:document.filters.submit();" alt="Buscar" class="botFiltrar"> </a></li>
			|-block name="removefiltersButton"-|<li> <a href="Main.php?do=calendarShow" alt="Quitar filtros" class="botResetFiltros"> </a></li>|-/block-| |-* quitarFiltros *-|
		</ul>
	</form>                                                           
	</div><!-- /boxNav1 -->
</div><!-- /filters -->
<div class="clear"></div>
|-block name="centralContent"-|
	<div class="grid_13 colummAgenda">
		|-block name="solapas"-|
			<div class="boxNavSolapas">
				<ul>
					|-foreach from=$axes item=axis-|
						<li class="|-$axis->getTabClass()-|" hide="|-$axis->getName()-|"><a href="#">|-$axis->getName()-|</a></li> 
					|-/foreach-|
				</ul>                                                                                    
			</div>
		|-/block-| |-* solapas *-|
		<div class="clear"></div>
		<div class="boxAgendaContainer">
			<!--centerHTML start-->
			|-$centerHTML-|
			<!--centerHTML end -->
		</div><!--end of boxAgendaContainer  -->
	</div><!--end of grid_13 colummAgenda  -->
	|-/block-| |-* centralContent *-|
	|-block name="sidebar"-|

		<div class="grid_3 colummSidebar">
			<div class="box boxBuscador">
				<label>
				<input name="textfield" type="text" class="textBuscador" id="textfield" value="Buscar"/><a href="#" class="botBuscador"></a>
				</label>
			</div>
		<div class="clear"></div>

		<div class="titleGraph"><span>% Ejes</span></div>
		<div class="eventsGraph"></div><!-- // GRAFICO -->
		<div class="clear"></div>


	 <div id="subColumns">
    <div class="subColumnsTriggerA"><a href="#" class="current" onClick="MM_showHideLayers('subColumnA','','show','subColumnB','','hide')">Pendientes</a></div>
    <div class="subColumnsTriggerB"><a href="#" onClick="MM_showHideLayers('subColumnA','','hide','subColumnB','','show')">Contexto</a></div>
    <div class="clear"></div>

    <div id="subColumnA">
		 <div class="box solapas1">
			<div role="tablist" class="ui-accordion ui-widget ui-helper-reset ui-accordion-icons" id="accordion">
			</div>
		</div>

	<div class="pendientesContainer" id="paragraphs">
		<div class="pendientesContent">
				<ul>
				 </ul>                                                                                        
		</div>	 
	</div> <!-- end of PENDIENTESCONTAINER -->

</div><!-- end id=subColumnA -->

<div id="subColumnB" style="visibility:hidden;"> 
	<div class="box solapas2">
	<div role="tablist" class="ui-accordion ui-widget ui-helper-reset ui-accordion-icons" id="accordion2">
		<h3 tabindex="-1" aria-selected="false" aria-expanded="false" role="tab" class="ui-accordion-header ui-helper-reset ui-state-default ui-corner-all"><a tabindex="-1" href="#">Crisis</a></h3>
			<div role="tabpanel" style="height: 129px; display: none;" class="ui-accordion-content ui-helper-reset ui-widget-content ui-corner-bottom">
				<ul>|-foreach from=$contextCrisis item=context name=foreach_crisis-|
								<li><a href="#" onclick="javascript:$('#context_|-$context->getId()-|').toggle()">|-$context->getTitle()-|</a><ul><li style="display:none;" id="context_|-$context->getId()-|">|-$context->getBody()-| __ |-$context->getStartDate()|date_format-| - |-$context->getEndDate()|date_format-|</li></ul></li>
							|-/foreach-|</ul>
			</div>
	<h3 tabindex="-1" aria-selected="false" aria-expanded="false" role="tab" class="ui-accordion-header ui-helper-reset ui-state-default ui-corner-all"><a tabindex="-1" href="#">Coyuntura</a></h3>
		<div role="tabpanel" style="height: 129px; display: none;" class="ui-accordion-content ui-helper-reset ui-widget-content ui-corner-bottom">
			<ul>|-foreach from=$contextJuncture item=context name=foreach_juncture-|
							<li><a href="#" onclick="javascript:$('#context_|-$context->getId()-|').toggle()">|-$context->getTitle()-|</a><ul><li style="display:none;" id="context_|-$context->getId()-|">|-$context->getBody()-| __ |-$context->getStartDate()|date_format-| - |-$context->getEndDate()|date_format-|</li></ul></li>
						|-/foreach-|</ul>
		</div>
	<h3 tabindex="-1" aria-selected="false" aria-expanded="false" role="tab" class="ui-accordion-header ui-helper-reset ui-state-default ui-corner-all"><a tabindex="-1" href="#">Campaña Nacional</a></h3>
		<div role="tabpanel" style="height: 129px; display: none;" class="ui-accordion-content ui-helper-reset ui-widget-content ui-corner-bottom">
			<ul>
					|-foreach from=$contextNational item=context name=foreach_national-|
					<li><a href="#" onclick="javascript:$('#context_|-$context->getId()-|').toggle()">|-$context->getTitle()-|</a> 
												<ul> 
													<li style="display:none;" id="context_|-$context->getId()-|">|-$context->getBody()-| __ |-$context->getStartDate()|date_format-| - |-$context->getEndDate()|date_format-|</li> 
												</ul> 
											</li>
					|-/foreach-|
			</ul>
		</div>
		<h3 tabindex="-1" aria-selected="false" aria-expanded="false" role="tab" class="ui-accordion-header ui-helper-reset ui-state-default ui-corner-all"><a tabindex="-1" href="#">Campaña Publicitaria</a></h3>
		<div role="tabpanel" style="height: 129px; display: none;" class="ui-accordion-content ui-helper-reset ui-widget-content ui-corner-bottom"> 
          <ul>
             |-foreach from=$contextCampaign item=context name=foreach_campaign-|
            <li><a href="#" onclick="javascript:$('#context_|-$context->getId()-|').toggle()">|-$context->getTitle()-|</a> 
              <ul> 
                <li style="display:none;" id="context_|-$context->getId()-|">|-$context->getBody()-| __ |-$context->getStartDate()|date_format-| - |-$context->getEndDate()|date_format-|</li> 
                </ul> 
              </li> 
            |-/foreach-| 
          </ul>
				</div>
			</div>
		</div>


		 </div><!-- end id=subColumnB -->
	 </div><!-- id=subColumns-->
	
		</div>
	|-/block-| |-* sidebar *-|
	<div class="clear"></div>  
</div>  
<div class="printTodayDate">Al día |-$smarty.now|date_format:"%A %e de %B de %Y"-|</div>
</body>
</html>
