<script type="text/javascript" src="scripts/lightbox.js"></script> 	
<script language="JavaScript" src="scripts/FusionCharts/FusionCharts.js"></script>		
<script language="JavaScript" type="text/JavaScript">
function showImpactObjectives(id){
	var pars = 'do=panelImpactObjectivesListX';

	new Ajax.Request(
			'Main.php?do=panelImpactObjectivesListX',
			{
				method: 'post',
				parameters: {
					id: id,
				},
				evalScripts: true,
				onSuccess: function(response){
					$("impactObjectives_" + id).insert({after:response.responseText});
				}
			}
		);
	$('position_' + id).onclick = function(){
		objectivesShow(id);
		return false;
	};
	$('expandP_' + id).hide();
	$('collapseP_' + id).show();
}

function objectivesShow(id){
	 $$('.position_' + id).each(function(b){Element.toggle(b)});
	 $('expandP_' + id).hide();
	 $('collapseP_' + id).show();
	 return false;
}

function objectivesHide(id){
	 $$('.position_' + id).each(function(b){Element.toggle(b)});
	 $('collapseP_' + id).hide();
	 $('expandP_' + id).show();
	 return false;
}

function indicatorsShow(id){
	 $$('.indicator_' +  id).each(function(b){Element.toggle(b)});
	 $('expand_' + id).hide();
	 $('collapse_' + id).show();
	 return false;
}

function indicatorsHide(id){
	 $$('.indicator_' +  id).each(function(b){Element.toggle(b)});
	 $('collapse_' + id).hide();
	 $('expand_' + id).show();
	 return false;
}

function viewObjective(id){
	new Ajax.Updater(
		"planningImpactObjectivesShowDiv", 
		"Main.php?do=planningImpactObjectivesViewX", 
			{ method: "post", 
			parameters: { id: id}, 
			evalScripts: true}
			);
	$("planningImpactObjectivesShowWorking").innerHTML = "<span class=\"inProgress\">buscando Objetivo de Impacto...</span>";
	
}
</script>

<div id="lightbox2" class="leightbox">
	<p align="right">				
		<a href="#" class="lbAction blackNoDecoration" rel="deactivate">Cerrar <input type="button" class="icon iconClose" /></a> 
	</p> 
	<div id="planningIndicatorsShowWorking"></div>
	<div class="innerLighbox">
		<div id="planningIndicatorsShowDiv"></div>
	</div>
</div>
<div id="lightbox1" class="leightbox">
	<p align="right">				
		<a href="#" class="lbAction blackNoDecoration" rel="deactivate">Cerrar formulario <input type="button" class="icon iconClose" /></a> 
	</p> 
	<div id="planningImpactObjectivesShowWorking"></div>
	<div class="innerLighbox">
		<div id="planningImpactObjectivesShowDiv"></div>
	</div>
</div> 
<div id="lightbox3" class="leightbox">
	<p align="right">				
		<a href="#" class="lbAction blackNoDecoration" rel="deactivate">Cerrar <input type="button" class="icon iconClose" /></a> 
	</p> 
	<div id="planningGraphShowWorking"></div>
	<div class="innerLighbox">
		<div id="planningGraphShowDiv"></div>
	</div>
</div>
<h2>Tablero de Gestión</h2>
|-if $position-|
<h1>|-$position->getName()-|</h1>
<p>Responsable : |-$position->getOwnerName()-|
|-if get_class($position->getActiveTenureName()) eq "PositionTenure"-|
|-assign var=tenure value=$position->getActiveTenureName()-|
|-if $tenure->getObject() != NULL-|
&#8212;  |-assign var=tenureObject value=$tenure->getObject()-||-$tenureObject->getName()-| |-$tenureObject->getSurname()-||-/if-|
|-else-|
|-assign var=userInfo value=$position->getActiveTenureName()-|
|-if $userInfo->getName() ne '' || $userInfo->getSurname() ne ''-|
 &#8212; |-/if-|
|-$userInfo->getName()-|
 |-$userInfo->getSurname()-|
|-/if-|
</p>
<!--Aca comienzan los cambios -->
<script type="text/javascript" src="scripts/FusionCharts.js"></script>
<script type="text/javascript" src="scripts/FusionChartsExportComponent.js"></script>
<link rel="stylesheet" href="css/extrastyles.css" type="text/css" />
<script type="text/javascript" src="scripts/raphael.js"></script>
<script type="text/javascript" src="scripts/mapa.js"></script>
<!-- fin de los cambios -->

    <div class="clearfix">
        <div class="floatleft">
            <div class="clearfix">
                <div class="floatleft">
|-assign var=graphParent value=$position->getGraphParent()-|
                <object title="|-$graphParent-|" height="250" width="250">
                    <param name="wmode" value="transparent" />
                    <param name="movie" value="images/speedometer.swf" />
                    <param name="flashvars" value="var3=|-$graphParent->getSpeed()-|" />
                    <embed src="images/speedometer.swf" wmode="transparent" quality="high" pluginspage="http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash" type="application/x-shockwave-flash" flashvars="var3=|-$graphParent->getSpeed()-|" height="250" width="250" /></object>
                </div>

                <div class="floatleft" id="chartContainer"></div>
                <script type="text/javascript">
                    var myChart = new FusionCharts( "images/Pie3D.swf?ChartNoDataText=No se encontraron datos para mostrar&PBarLoadingText=Cargando datos&ChartNoDataText=No se encontraron datos para mostrar&LoadDataErrorText=Error cargando los datos&InvalidXMLText=Datos inválidos&XMLLoadingText=Obteniendo datos", "myChartId", "300", "225", "0", "1" );
                    myChart.setDataURL(escape("Main.php?do=planningCakeByStatusColorXml&type=projects"));
										myChart.setTransparent(true);
                    myChart.render("chartContainer");
                </script>
            </div>
            <div class="clearfix">

                <div class="floatleft">
                    <object title="Jefatura de Gabinete de Ministros" height="200" width="150">
                        <param name="wmode" value="transparent" />
                        <param name="movie" value="images/speedometer.swf" />
                        <param name="flashvars" value="var3=20&amp;var4=Main.php?do=positionsShow&amp;positionId=3" />
                        <embed src="images/speedometer.swf" wmode="transparent" quality="high" pluginspage="http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash" type="application/x-shockwave-flash" flashvars="var3=97&amp;var4=Main.php?do=positionsShow&amp;positionId=3" height="170" width="170" /></object>
                </div>

                <div class="floatleft" id="chartContainer2"></div>
                <script type="text/javascript">
                    var myChart2 = new FusionCharts( "images/Pie3D.swf?ChartNoDataText=No se encontraron datos para mostrar&PBarLoadingText=Cargando datos&ChartNoDataText=No se encontraron datos para mostrar&LoadDataErrorText=Error cargando los datos&InvalidXMLText=Datos inválidos&XMLLoadingText=Obteniendo datos", "myChartId2", "300", "225", "0", "1" );
                    myChart2.setDataURL(escape("Main.php?do=planningCakeByStatusColorXml&type=constructions"));
                    myChart2.render("chartContainer2");
                </script>
            </div>

        </div>

        <div class="floatleft" width="400px" height="600px">
            <div id="mapaChart" style="margin-top: -40px" width="500px" height="500px"></div>
            <script type="text/javascript">
                dibujarMapa('mapaChart','xml/mapa.xml?filters[prioridadproyecto]=a');
            </script>

        </div>
    </div>

    <div id="chartContainer4">Cargando...</div>
    <br/>
    <script type="text/javascript">
        var myChart4 = new FusionCharts("images/Column2D.swf?ChartNoDataText=No se encontraron datos para mostrar&PBarLoadingText=Cargando datos&ChartNoDataText=No se encontraron datos para mostrar&LoadDataErrorText=Error cargando los datos&InvalidXMLText=Datos inválidos&XMLLoadingText=Obteniendo datos", "myChartId4", "1000", "300", "0", "1" );
		myChart4.setDataURL(escape("Main.php?do=planningBarsQXml"));
        myChart4.render("chartContainer4");
    </script>

    <div id="chartContainer5">Cargando...</div>
    <script type="text/javascript">
        var myChart5 = new FusionCharts("images/Column2D.swf?ChartNoDataText=No se encontraron datos para mostrar&PBarLoadingText=Cargando datos&ChartNoDataText=No se encontraron datos para mostrar&LoadDataErrorText=Error cargando los datos&InvalidXMLText=Datos inválidos&XMLLoadingText=Obteniendo datos", "myChartId5", "1000", "300", "0", "1" );
		myChart5.setDataURL(escape("Main.php?do=planningConstructionsToBeInauguratedByMonthXml"));
        myChart5.render("chartContainer5");
    </script>
<div id="fcexpDiv" align="center">FusionCharts Export</div>
<script type="text/javascript">
  var myExportComponent = new FusionChartsExportObject("fcExporter1", "images/FCExporter.swf");
		//Render the exporter SWF in our DIV fcexpDiv
		myExportComponent.Render("fcexpDiv");
</script>


|-elseif $objective-|
	<h1>|-$objective->getName()-|</h1>
|-elseif $positions-|
	<h1>Visión Estratégica</h1>
	<table id="tabla-projectss" class='tableTdBorders' cellpadding='5' cellspacing='0' width='100%'>
		<thead>
			<tr class="thFillTitle">
				<th width="1%"></th>
				<th width="89%"><!-- Orden Ranking -- Organigrama -- Ministerio --></th>
				<th>Proyectos</th>
				<th>Obras</th>
			</tr>
		</thead>
		<tbody>
		|-foreach from=$positions item=position name=for_positions-|
		|-assign var="colorsCount" value=$position->getPlanningProjectsByStatusColorCountAssoc()-|
		|-assign var="constColorsCount" value=$position->getPlanningConstructionsByStatusColorCountAssoc()-|
			<tr>
				<td id="expandP_|-$position->getId()-|"><a href="#" id="position_|-$position->getId()-|" onClick="showImpactObjectives(|-$position->getId()-|); return false;"><img src="images/icon_expand.png" /></a></td>
				<td id="collapseP_|-$position->getId()-|" style="display: none;"><a href="#" onClick="objectivesHide(|-$position->getId()-|); return false;"><img src="images/icon_collapse.png" /></a></td>
				<td><strong>|-$position->getName()-|</strong></td>
				<td align="center" nowrap="nowrap">
					<div style="width:108px;"><!--<a href="" class="flagWhite">
						|-$colorsCount.white-|
					</a>--><a href="Main.php?do=panelProjectsShow&positionId=|-$position->getId()-|&color=green" class="flagGreen">
						|-$colorsCount.green-|
					</a><a href="Main.php?do=panelProjectsShow&positionId=|-$position->getId()-|&color=yellow" class="flagYellow">					
						|-$colorsCount.yellow-|
					</a><a href="Main.php?do=panelProjectsShow&positionId=|-$position->getId()-|&color=red" class="flagRed">
						|-$colorsCount.red-|
					</a><!--<a href="" class="flagBlue">
						|-$colorsCount.blue-|
					</a>--></div>
				</td>
				<td align="center" nowrap="nowrap" >
					<div  style="width:108px;"><!--<a href="" class="flagWhite">
						|-$constColorsCount.white-|
					</a>--><a href="Main.php?do=panelConstructionsShow&positionId=|-$position->getId()-|&color=green" class="flagGreen">
						|-$constColorsCount.green-|
					</a><a href="Main.php?do=panelConstructionsShow&positionId=|-$position->getId()-|&color=yellow" class="flagYellow">
						|-$constColorsCount.yellow-|
					</a><a href="Main.php?do=panelConstructionsShow&positionId=|-$position->getId()-|&color=red" class="flagRed">
						|-$constColorsCount.red-|
					</a><!--<a href="" class="flagBlue">
						|-$constColorsCount.blue-|
					</a>--></div>
				</td>
			</tr>
			<tr id="impactObjectives_|-$position->getId()-|" ></tr>
		|-/foreach-|
		</tbody>
	</table>
|-/if-|        
