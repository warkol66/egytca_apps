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
<!-- fin de los cambios -->

<div class="clearfix">
<div class="floatleft" id="chartContainer">Cargando...</div>
    <div class="floatleft">
|-assign var=graphParent value=$position->getGraphParent()-|
        <object title="|-$graphParent-|" height="250" width="250">
            <param name="wmode" value="transparent" />
            <param name="movie" value="images/speedometer.swf" />
            <param name="flashvars" value="var3=|-$graphParent->getSpeed()-|" />
            <embed src="images/speedometer.swf" wmode="transparent" quality="high" pluginspage="http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash" type="application/x-shockwave-flash" flashvars="var3=|-$graphParent->getSpeed()-|&amp;" height="250" width="250" /></object>
    </div>
<div class="floatleft" id="chartContainer2">Cargando...</div>
<script type="text/javascript">

var myChart = new FusionCharts( "images/Pie3D.swf?ChartNoDataText=No se encontraron datos para mostrar&PBarLoadingText=Cargando datos&ChartNoDataText=No se encontraron datos para mostrar&LoadDataErrorText=Error cargando los datos&InvalidXMLText=Datos inválidos&XMLLoadingText=Obteniendo datos", "myChartId", "400", "300", "0", "1" );
myChart.setDataURL(escape("Main.php?do=planningCakeByStatusColorXml&type=projects&positionId=|-$position->getId()-|"));
myChart.setTransparent(true);
myChart.render("chartContainer");

var myChart2 = new FusionCharts( "images/Pie3D.swf?ChartNoDataText=No se encontraron datos para mostrar&PBarLoadingText=Cargando datos&ChartNoDataText=No se encontraron datos para mostrar&LoadDataErrorText=Error cargando los datos&InvalidXMLText=Datos inválidos&XMLLoadingText=Obteniendo datos", "myChartId2", "400", "300", "0", "1" );
myChart2.setDataURL(escape("Main.php?do=planningCakeByStatusColorXml&type=constructions&positionId=|-$position->getId()-|"));
myChart2.setTransparent(true);
myChart2.render("chartContainer2");
</script>
</div>


|-elseif $objective-|
	<h1>|-$objective->getName()-|</h1>
|-/if-|
</form></h3>
		<table id="table-projects" class='tableTdBorders' cellpadding='5' cellspacing='0' width='100%'>
		<thead>
			<tr class="thFillTitle">
				<th width="20%">Proyecto</th>
				<th width="2%">&nbsp;</th>
				<th width="73%">Nombre</th>
				<th width="5%"><div style="width:175px;">Actividades</div></th>
			</tr>
		</thead>
		<tbody>
		|-foreach from=$constructions item=construction name=for_constructions-|
			|-assign var=colorsCount value=$construction->getActivitiesByStatusColorCountAssoc()-|
			<tr>
				<td>|-$construction->getPlanningProject()-|</td>
				<td><a href="javascript:void(null);" class="flag|-$construction->statusColor()|capitalize-|"></a></td>
				<td><a href="Main.php?do=planningActivitiesList&filters[constructionId]=|-$construction->getid()-|" title="Ver actividades de la obra" class="follow">|-$construction->getname()-|</a></td>
				<td align="center" nowrap >
					<a href="Main.php?do=planningActivitiesList&filters[constructionId]=|-$construction->getId()-|&filters[color]=white" class="flagWhite">
						|-$colorsCount.white-|
					</a>
					<a href="Main.php?do=planningActivitiesList&filters[constructionId]=|-$construction->getId()-|&filters[color]=green" class="flagGreen">
						|-$colorsCount.green-|
					</a>
					<a href="Main.php?do=planningActivitiesList&filters[constructionId]=|-$construction->getId()-|&filters[color]=yellow" class="flagYellow">					
						|-$colorsCount.yellow-|
					</a>
					<a href="Main.php?do=planningActivitiesList&filters[constructionId]=|-$construction->getId()-|&filters[color]=red" class="flagRed">
						|-$colorsCount.red-|
					</a>
					<a href="Main.php?do=planningActivitiesList&filters[constructionId]=|-$construction->getId()-|&filters[color]=blue" class="flagBlue">
						|-$colorsCount.blue-|
					</a>
				</td>
			</tr>
		|-/foreach-|						
		</tbody>
	</table>
