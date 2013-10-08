<script language="JavaScript" src="scripts/FusionCharts/FusionCharts.js"></script>
	|-capture name=xml-|
	|-if isset($user)-|
		<chart caption='|-$user->getName()-|' subCaption='' showSlackAsFill='0' showPercentLabel='1'>
	|-elseif isset($from)-|
		<chart caption='|-$from-| al |-$to-|' subCaption='' showSlackAsFill='0' showPercentLabel='1'>
	|-else-|
		<chart caption='Estadísticas de uso' subCaption='' showSlackAsFill='0' showPercentLabel='1'>
	|-/if-|
	
	<set label='Experiencias' value='|-$blogEntries-|' />
	<set label='Comentarios en Esperiencias' value='|-$blogComments-|' />
	<set label='Desafios' value='|-$boardChallenges-|' />
	<set label='Comentarios sobre Desafios' value='|-$boardComments-|' />
	|-if isset($id)-|<set label='Compromisos sobre Desafios' value='|-$boardBonds-|' />|-/if-|
	<set label='Documentos creados' value='|-$documents-|' />
	
	</chart>|-/capture-| 

<div id="chartdiv" align="center">Estadísticas de uso</div>
<script type="text/javascript">|-assign var=height value="250"-||-assign var=calculatedHeight value="250"-|
	var myChart = new FusionCharts("scripts/FusionCharts/Column2D.swf?ChartNoDataText=No se encontraron datos para mostrar&PBarLoadingText=Cargando datos&ChartNoDataText=No se encontraron datos para mostrar&LoadDataErrorText=Error cargando los datos&InvalidXMLText=Datos inválidos&XMLLoadingText=Obteniendo datos", "myChartId", "700", "|-if $calculatedHeight gt $height-||-$calculatedHeight-||-else-||-$height-||-/if-|", "0", "0");
	myChart.setDataXML("|-$smarty.capture.xml|strip-||-$smarty.capture.process|strip-||-$smarty.capture.task|strip-|");
	myChart.render("chartdiv");
 </script>
