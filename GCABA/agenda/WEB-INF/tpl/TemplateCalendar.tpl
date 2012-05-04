<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<title>|-if isset($module)-||-$module|multilang_get_translation:"common"-| - |-/if-||-$parameters.siteName-|</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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

<link rel="stylesheet" type="text/css" href="scripts/fullcalendar/fullcalendar.css" />
<link rel="stylesheet" type="text/css" href="scripts/fullcalendar/fullcalendar.print.css" media="print" />
<link type="text/css" href="css/ui-lightness/jquery-ui-1.8.20.custom.css" rel="stylesheet" />       
<link rel="shortcut icon" href="images/favicon.ico" />
<script language="JavaScript" type="text/JavaScript">
	var url="|-$systemUrl-|";
</script>
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

		</script></head>
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
            <div class="boxNav1"><!-- boxNav1 -->
                <ul>
                    <!-- <li class="botSmall"><a href="#" class="menuIcon_01"></a></li>
                    <li class="botSmall"><a href="#" class="menuIcon_02"></a></li>
                    <li class="botSmall"><a href="#" class="menuIcon_03"></a></li> -->
                    <li class="botSmall"><a href="#" class="menuIcon_04"></a></li>
                    <li class="botSmall"><a href="#" class="menuIcon_05"></a></li>
                    <li class="botSmall"><a href="#" class="menuIcon_06"></a></li>
                    <li>Tipo de evento:
                        <label>
                        <select name="select" id="select" style="width: 70px">
                          <option value="0">Todos</option>
                          <option value="1">AAA</option>
                          <option value="2">Otros eventos</option>
	                        <option value="3">Agenda cultural</option>
                        </select>
                        </label>
                    </li>
                    <li>Agenda:
                        <label>
                        <select name="select" id="select" style="width: 80px">
                            <option value="0" selected="selected">Todas</option>
                            <option value="1">Agenda del Jefe de Gobierno</option>
                            <option value="2">Agenda de la Vicejefa / Ministros</option>
                            <option value="3">Agendas de Otros funcionarios</option>
                        </select>
                        </label>
                    </li>
                     <li>Funcionarios:
                        <label>
                        <select name="select" id="select" style="width: 80px">
                            <option value="0" selected="selected">Todos</option>
                            <option value="1">Mauricio Macri</option>
                            <option value="2">Ma. Eugenia Vidal</option>
                            <option value="3">Horacio Rodriguez Larreta</option>
                        </select>
                        </label>
                    </li>
                     <li>Dependencias:
                        <label>
                        <select name="select" id="select" style="width: 80px">
                            <option value="1" selected="selected">Todas</option>
                            <option value="2">Jefatura de Gabinete</option>
                            <option value="3">Ministerio de Ambiente y Espacio Público</option>
                            <option value="4">Ministerio de Cultura</option>
                        </select>
                        </label>
                    </li>
                     <li>Comunas:
                        <label>
                        <select name="select" id="select" style="width: 80px">
                            <option value="0" selected="selected">Todas</option>
												|-foreach from=$regions item=region name=foreach_regions-|
                            <option value="|-$region->getId()-|">|-$region->getName()-||-assign var=subregions value=$region->getChildren()-| (|-foreach from=$subregions item=subregion name=foreach_subregion-||-$subregion->getName()-||-if !$subregion@last-|, |-/if-||-/foreach-|)</option>
												|-/foreach-|
                        </select>
                        </label>
                    </li>
                    
                    <li>* <a href="#">CC</a></li>
                    <li>07/02/2012 *** <a href="#">Ir</a></li>
                </ul>                                                            
              	</div><!-- /boxNav1 -->
			
        <div class="clear"></div>
			<div class="grid_13 colummAgenda">
				<div class="boxNavSolapas">
					<ul>
						<li class="solTurismo"><a href="#">Turismo</a></li>
						<li class="solVida"><a href="#">Vida Sana / Plan Verde</a></li>
						<li class="solTransformando"><a href="#">Transformando la ciudad</a></li>
						<li class="solCiudad"><a href="#">Ciudad Segura</a></li>
						<li class="solAgenda"><a href="#">Agenda Cultural</a></li>
						<li class="solSocial"><a href="#">R.Social/Crec. Personal</a></li>
						<li class="solOtros"><a href="#">Otros</a></li>                  
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
                            <!-- <a href="javascript:void(0);"  id="toggle-paragraphs">-->
                            <a href="javascript:void(0);" onclick="MM_showHideLayers('paragraphs','','show')">Pendientes</a></div>
                       	<div class="pendientesContainer" id="paragraphs">
			                        <div class="pendientesArrowLeft"><a href="#"><</a></div>
		                        	<div class="pendientesContent">
                                    	<ul>
	                                        <li>
                                                <div class="solapitaVerde"></div>
                                                <div class="pendienteDato"><span>1Rock en Parque Roca</span> Villa Saavedra</div>
                                                <div class="pendienteBotones"><a href="#" class="pendienteEditar"></a><a href="#" class="pendienteBorrar"></a></div>
                                            </li>
	                                        <li>
                                                <div class="solapitaVerde"></div>
                                                <div class="pendienteDato"><span>2Rock en Parque Roca</span> Villa Saavedra</div>
                                                <div class="pendienteBotones"><a href="#" class="pendienteEditar"></a><a href="#" class="pendienteBorrar"></a></div>
                                            </li>
	                                        <li>
                                                <div class="solapitaVerde"></div>
                                                <div class="pendienteDato"><span>3Rock en Parque Roca</span> Villa Saavedra</div>
                                                <div class="pendienteBotones"><a href="#" class="pendienteEditar"></a><a href="#" class="pendienteBorrar"></a></div>
                                            </li>
                                        <li>
                                                <div class="solapitaVerde"></div>
                                                <div class="pendienteDato"><span>Rock en Parque Roca</span> Villa Saavedra</div>
                                                <div class="pendienteBotones"><a href="#" class="pendienteEditar"></a><a href="#" class="pendienteBorrar"></a></div>
                                        </li>
	                                        <li>
                                                <div class="solapitaVerde"></div>
                                                <div class="pendienteDato"><span>Rock en Parque Roca</span> Villa Saavedra</div>
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