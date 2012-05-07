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
<style type="text/css">
<!--
#newEvent, #editEvent {
	padding: 15px !Important;

}
#fancybox-outer, #fancybox-content {
background-color: #333 !Important;
border: none !Important;
}
#newEvent *, #editEvent * {
	margin-top: 0.3em !Important;
}
#newEvent fieldset, #editEvent fieldset {
	border:0 !Important;
}
-->
</style>
|-block name=jsIncludes-|
	|-include file='TemplateJsIncludes.jquery.tpl'-|
|-/block-|
	<script src="scripts/fisheye.js"></script>
		<script type="text/javascript">
			$(function(){

				// Accordion
				$("#accordion").accordion({ header: "h3" });

				// Datepicker
				$('#datepicker').datepicker({
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
                            <li><a href="#1" class="fisheye"><img src="images/icon_calendar.png" alt="" /><span>Calendar +</span></a></li> 
                            <li><a href="#2" class="fisheye"><img src="images/icon_calendarDay.png" alt="" /><span>Calendar Day</span></a></li> 
                            <li><a href="#3" class="fisheye"><img src="images/icon_print.png" alt="" /><span>Imprimir</span></a></li> 
                            <li><a href="#4" class="fisheye"><img src="images/icon_logout.png" alt="" /><span>Salir</span></a></li> 
                    </ul>                
                
                </span><!-- end fisheye Container -->
				<span class="slogan"></span>

			</div><!-- /grid_16 header1 -->
            <div class="boxNav1"><!-- boxNav1 --><form action='Main.php' method='get' style="display:inline;" name="filters">
					<input type="hidden" name="do" value="calendarShow" />
                <ul>
                    <!-- <li class="botSmall"><a href="#" class="menuIcon_01"></a></li>
                    <li class="botSmall"><a href="#" class="menuIcon_02"></a></li>
                    <li class="botSmall"><a href="#" class="menuIcon_03"></a></li> -->
                    <li class="botSmall"><a href="#" class="menuIcon_04"></a></li>
                    <li class="botSmall"><a href="#" class="menuIcon_05"></a></li>
                    <li class="botSmall"><a href="#" class="menuIcon_06"></a></li>
                    <li class="botSmall"><a href="Main.php?do=calendarShow" class="menuIcon_06">Quitar</a></li>
                    <li><span>Tipo de evento:</span><br />
                        <select name="filters[kind]" id="kind" style="width: 70px" onChange="this.form.submit();">
                          <option value="">Todos</option>
												|-foreach from=$kinds item=kind name=foreach_kinds-|
	                        <option value="|-$kind@key-|" |-$filters.kind|selected:$kind@key-|>|-$kind-|</option>
												|-/foreach-|
                        </select>
                    </li>
                    <li><span>Agenda:</span><br />
                        <select name="filters[agenda]" id="agenda" style="width: 80px" onChange="this.form.submit();">
                            <option value="" selected="selected">Todas</option>
												|-foreach from=$agendas item=agenda name=foreach_agendas-|
	                        <option value="|-$agenda@key-|" |-$filters.agenda|selected:$agenda@key-|>|-$agenda-|</option>
												|-/foreach-|
                        </select>
                    </li>
                     <li><span>Funcionarios:</span><br />
                        <select name="filters[searchActor]" id="searchActor" style="width: 80px" onChange="this.form.submit();">
                            <option value="" selected="selected">Todos</option>
                            <option value="1">Mauricio Macri</option>
                            <option value="2">Ma. Eugenia Vidal</option>
                            <option value="3">Horacio Rodriguez Larreta</option>
                        </select>
                        </label>
                    </li>
                     <li>
                       <span>Dependencias:</span><br />
                        <select name="filters[searchCategory]" id="searchCategory" style="width: 80px" onChange="this.form.submit();">
                            <option value="" selected="selected">Todas</option>
                            <option value="1">Jefatura de Gabinete</option>
                            <option value="2">Ministerio de Ambiente y Espacio Público</option>
                            <option value="3">Ministerio de Cultura</option>
                        </select>
                    </li>
                     <li><span>Comunas:</span><br />
                        <select name="filters[searchRegionId]" id="searchRegion" style="width: 80px" onChange="this.form.submit();">
                            <option value="" selected="selected">Todas</option>
												|-foreach from=$comunes item=comune name=foreach_comunes-|
                            <option value="|-$comune->getId()-|" |-$filters.searchRegionId|selected:$comune->getId()-|>|-$comune->getName()-||-assign var=subregions value=$comune->getChildren()-| (|-foreach from=$subregions item=subregion name=foreach_subregion-||-$subregion->getName()-||-if !$subregion@last-|, |-/if-||-/foreach-|)</option>
												|-/foreach-|
                        </select>
                    </li>

                    <li class="buttonCC"><input name="filters[campaigncommitment]" type="checkbox" value="1"  onClick="this.form.submit();" |-$filters.campaigncommitment|checked_bool-|/><a href="#"></a></li>
                    <li class="pickDate"><span>Fecha:</span><br /><input type="text" name="filters[selectedDate]" id="datepicker" size="10" maxlength="10" ><a href="javascript:document.filters.submit();" class="dateGo">Ir</a>
                    
                </ul> </form>                                                           
     	</div><!-- /boxNav1 -->
			
        <div class="clear"></div>
			<div class="grid_13 colummAgenda">
				<div class="boxNavSolapas">
					<ul>
						<li class="solTurismo" hide="Turismo"><a href="#">Turismo</a></li>
						<li class="solVida" hide="Vida Sana / Plan Verde"><a href="#">Vida Sana / Plan Verde</a></li>
						<li class="solTransformando" hide="Transformando la ciudad"><a href="#">Transformando la ciudad</a></li>
						<li class="solCiudad" hide="Ciudad Segura"><a href="#">Ciudad Segura</a></li>
						<li class="solAgenda" hide="Agenda Cultural"><a href="#">Agenda Cultural</a></li>
						<li class="solSocial" hide="R.Social/Crec. Personal"><a href="#">R.Social/Crec. Personal</a></li>
						<li class="solOtros" hide="Otros"><a href="#">Otros</a></li>                  
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
			                        <div class="pendientesArrowLeft"><a href="#"><</a></div>
                                    
		                        	<div class="pendientesContent">
                                    	<ul>
	                                        <li class="verde1">
                                                <div class="solapita"></div>
                                                <div class="pendienteDato"><span>1Rock en Parque Roca</span> Villa Saavedra</div>
                                                <div class="pendienteBotones"><a href="#" class="pendienteEditar"></a><a href="#" class="pendienteBorrar"></a></div>
                                            </li>
											<li class="verde2">
                                                <div class="solapita"></div>
                                                <div class="pendienteDato"><span>1Rock en Parque Roca</span> Villa Saavedra</div>
                                                <div class="pendienteBotones"><a href="#" class="pendienteEditar"></a><a href="#" class="pendienteBorrar"></a></div>
                                            </li> 
											<li class="amarillo">
                                                <div class="solapita"></div>
                                                <div class="pendienteDato"><span>1Rock en Parque Roca</span> Villa Saavedra</div>
                                                <div class="pendienteBotones"><a href="#" class="pendienteEditar"></a><a href="#" class="pendienteBorrar"></a></div>
                                            </li> 
											<li class="cyan">
                                                <div class="solapita"></div>
                                                <div class="pendienteDato"><span>1Rock en Parque Roca</span> Villa Saavedra</div>
                                                <div class="pendienteBotones"><a href="#" class="pendienteEditar"></a><a href="#" class="pendienteBorrar"></a></div>
                                            </li> 

											<li class="rojo">
                                                <div class="solapita"></div>
                                                <div class="pendienteDato"><span>1Rock en Parque Roca</span> Villa Saavedra</div>
                                                <div class="pendienteBotones"><a href="#" class="pendienteEditar"></a><a href="#" class="pendienteBorrar"></a></div>
                                            </li>                                                                                                                                    
                                       </ul>                                                                                        
        		                    </div>
           		           <div class="pendientesArrowRight"><a href="#">></a></div>
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
   					<div class="box">
                    <div id="accordion">
	<h3 class="color1"><a href="#">% Ejes</a></h3>
	<div>
		<img src="images/grafico.png" alt="" width="115" height="123" />
	</div>
	<h3 class="color2"><a href="#">% Ministerios</a></h3>
	<div>
		<img src="images/grafico02.png" alt="" width="115" height="123" />
	</div>
	<h3><a href="#">Crisis</a></h3>
    <div>
    	<ul>
	    	<li><a href="#">Dengue</a></li>
	    	<li><a href="#">Inundaciones</a></li>
	    	<li><a href="#">Subte</a></li>
	    	<li><a href="#">Roger Waters</a></li>                                    
        </ul>
	</div>
	<h3><a href="#">Coyuntura</a></h3>
    <div>
    	<ul>
	    	<li><a href="#">Lanzamiento control de autos oficiales</a></li>
	    	<li><a href="#">Link</a></li>
	    	<li><a href="#">Link</a></li>
	    	<li><a href="#">Link</a></li>                                    
        </ul>    
	</div>
	<h3><a href="#">Campaña Nacional</a></h3>
    <div>
    	<ul>
	    	<li><a href="#">Link</a></li>
	    	<li><a href="#">Link</a></li>
	    	<li><a href="#">Link</a></li>
	    	<li><a href="#">Link</a></li>                                    
        </ul>    
	</div>
	<h3><a href="#">Campaña Publicitaria</a></h3>
    <div>
    	<ul>
	    	<li><a href="#">Link</a></li>
	    	<li><a href="#">Link</a></li>
	    	<li><a href="#">Link</a></li>
	    	<li><a href="#">Link</a></li>                                    
        </ul>    
	</div>
                    
	
</div>
                    
                    
                    
                    
					</div>
		</div>
				<div class="clear"></div>  
		</div>
  
</body>
</html>