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
<link rel="stylesheet" type="text/css" href="scripts/fullcalendar/fullcalendar.css" />
<link rel="stylesheet" type="text/css" href="scripts/fullcalendar/fullcalendar.print.css" media="print" />
<link rel="shortcut icon" href="images/favicon.ico" />
<script language="JavaScript" type="text/JavaScript">
	var url="|-$systemUrl-|";
</script>

|-block name=jsIncludes-|
	|-include file='TemplateJsIncludes.jquery.tpl'-|
|-/block-|
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
				// Datepicker
				$('#datepicker').datepicker({
						dateFormat: 'dd-mm-yy',
						inline: true
				});

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


		</script>
<link type="text/css" href="css/chosen.css" rel="stylesheet" />
<script language="JavaScript" type="text/javascript" src="scripts/jquery/chosen.js"></script>
		
		</head>
<body>
		<div class="container_16">
			<div class="grid_16 header1">
				<h1 id="branding"></h1>
                <span class="eyefishContainer">
                    <ul id="fisheye_menu">
                            <li><a href="#1" class="fisheye"><img src="images/icon_reunion.png" alt="" /><span>Reunion de Gabinete</span></a></li> 
                            <li><a href="#2" class="fisheye"><img src="images/icon_georef.png" alt="" /><span>Georeferenciación</span></a></li> 
                            <li><a href="#3" class="fisheye"><img src="images/icon_exportar.png" alt="" /><span>Exportar</span></a></li> 
                            <li><a href="#4" class="fisheye"><img src="images/icon_print.png" alt="" /><span>Imprimir</span></a></li> 
                            <li><a href="#5" class="fisheye"><img src="images/icon_logout.png" alt="" /><span>Salir</span></a></li> 

                    </ul>                
                
                </span><!-- end fisheye Container -->
				<span class="slogan"></span>

			</div><!-- /grid_16 header1 -->
            <div class="boxNav1"><!-- boxNav1 -->
					<form action='Main.php' method='get' style="display:inline;" name="filters">
					<input type="hidden" name="do" value="calendarShow" />
                <ul>
                    <!-- <li class="botSmall"><a href="#" class="menuIcon_01"></a></li>
                    <li class="botSmall"><a href="#" class="menuIcon_02"></a></li>
                    <li class="botSmall"><a href="#" class="menuIcon_03"></a></li> -->
                    <li class="botSmall"><a href="#" class="menuIcon_04" title="Seguimiento de obras"></a></li>
                    <li class="botSmall"><a href="#" class="menuIcon_05" title="Reuniones de gabinete"></a></li>
                    <li class="botSmall"><a href="#" class="menuIcon_06" title="Georreferenciación de eventos"></a></li>
                    <li><span>Tipo de evento:</span><br />
                        <select name="filters[kind]" id="kind" style="width: 90px" onChange="this.form.submit();">
                          <option value="">Todos</option>
												|-foreach from=$kinds item=kind name=foreach_kinds-|
	                        <option value="|-$kind@key-|" |-$filters.kind|selected:$kind@key-|>|-$kind-|</option>
												|-/foreach-|
                        </select>
                    </li>
                    <li><span>Agenda:</span><br />
                        <select name="filters[agenda]" id="agenda" style="width: 100px" onChange="this.form.submit();">
                            <option value="" selected="selected">Todas</option>
												|-foreach from=$agendas item=agenda name=foreach_agendas-|
	                        <option value="|-$agenda@key-|" |-$filters.agenda|selected:$agenda@key-|>|-$agenda-|</option>
												|-/foreach-|
                        </select>
                    </li>
                     <li><span>Funcionarios:</span><br />
                        <select name="filters[searchActor]" id="searchActor" style="width: 100px" onChange="this.form.submit();">
                            <option value="" selected="selected">Todos</option>
														|-foreach from=$actors item=actor name=from_actor-|
															<option value="|-$actor->getId()-|" |-$filters.searchActor|selected:$actor->getId()-|>|-$actor-|</option>
														|-/foreach-|
                        </select>
                        </label>
                    </li>
                     <li>
                       <span>Dependencias:</span><br />
                        <select name="filters[searchCategory]" id="searchCategory" style="width: 100px" onChange="this.form.submit();">
                            <option value="" selected="selected">Todas</option>
														|-foreach from=$categories item=category name=from_categories-|
															<option value="|-$category->getId()-|" |-$filters.searchCategory|selected:$category->getId()-|>|-$category->getName()-|</option>
														|-/foreach-|
                        </select>
                    </li>
                     <li><span>Comunas:</span><br />
                        <select name="filters[searchRegionId]" id="searchRegion" style="width: 100px" onChange="this.form.submit();">
                            <option value="" selected="selected">Todas</option>
												|-foreach from=$comunes item=comune name=foreach_comunes-|
                            <option value="|-$comune->getId()-|" |-$filters.searchRegionId|selected:$comune->getId()-|>|-$comune->getName()-||-assign var=subregions value=$comune->getChildren()-| (|-foreach from=$subregions item=subregion name=foreach_subregion-||-$subregion->getName()-||-if !$subregion@last-|, |-/if-||-/foreach-|)</option>
												|-/foreach-|
                        </select>
                    </li>

                    <li class="buttonCC"><input name="filters[campaigncommitment]" type="checkbox" value="1"  onClick="this.form.submit();" |-$filters.campaigncommitment|checked_bool-|/><a href="#"></a></li>
                    <li class="pickDate"><span>Fecha:</span><br /><input type="text" name="filters[selectedDate]" id="datepicker" value="|-$filters.selectedDate-|" size="10" maxlength="10" style="position:relative;z-index: 1050;" ><a href="javascript:document.filters.submit();" class="dateGo">Ir</a>
<li class="resetFilter" ><a href="Main.php?do=calendarShow"alt="Quitar filtros"></a></li>                </ul> </form>                                                           
     	</div><!-- /boxNav1 -->
			
        <div class="clear"></div>
			<div class="grid_13 colummAgenda">
				<div class="boxNavSolapas">
					<ul>
						|-foreach from=$axes item=axis-|
							<li class="|-$axis->getTabClass()-|" hide="|-$axis->getName()-|"><a href="#">|-$axis->getName()-|</a></li> 
						|-/foreach-|
				 </ul>                                                                                    
				</div>
		<div class="clear"></div>
      <div class="boxAgendaContainer">
					<!--centerHTML start-->
					|-$centerHTML-|
					<!--centerHTML end -->
        </div><!--end of boxAgendaContainer  -->
                        <div id="pendientes">
	                        <div id="solapaPendientes">
                            <a href="javascript:void(0);" onclick="MM_showHideLayers('paragraphs','','show')">Pendientes</a></div>
                       	<div class="pendientesContainer" id="paragraphs">
			                        
                                    
		                        	<div class="pendientesContent">
                                    	<ul>
                                       </ul>                                                                                        
        		                    </div>
           		           
		                        </div> <!-- end of PENDIENTESCONTAINER -->
                        </div> <!-- end of PENDIENTES -->
		</div>
				<div class="grid_3 colummSidebar">
					<div class="box boxBuscador">
                    <label>
                    <input name="textfield" type="text" class="textBuscador" id="textfield" value="Buscar"/>
<a href="#" class="botBuscador"></a>
                    </label>
          </div>
                    <div class="clear"></div>
 
 <div class="box solapas1">
<div role="tablist" class="ui-accordion ui-widget ui-helper-reset ui-accordion-icons" id="accordion">

<h3 tabindex="0" aria-selected="true" aria-expanded="true" role="tab" class="color1 ui-accordion-header ui-helper-reset ui-state-default ui-state-active ui-corner-top"><a tabindex="-1" href="#">% Ejes</a></h3>

<div role="tabpanel" style="height: 129px;" class="ui-accordion-content ui-helper-reset ui-widget-content ui-corner-bottom ui-accordion-content-active"><div class="eventsGraph" style="width: 100px; height: 100px"></div></div>
<!--<h3 tabindex="-1" aria-selected="false" aria-expanded="false" role="tab" class="color2 ui-accordion-header ui-helper-reset ui-state-default ui-corner-all"><a tabindex="-1" href="#">% Ministerios</a></h3>
<div role="tabpanel" style="height: 129px; display: none;" class="ui-accordion-content ui-helper-reset ui-widget-content ui-corner-bottom"> <img src="images/grafico02.png" alt="" height="123" width="115"> </div>-->
</div>
</div>

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
		</div>
		<div class="clear"></div>  
</div>  
</body>
</html>