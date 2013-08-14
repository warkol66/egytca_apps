<script language="JavaScript" src="scripts/FusionCharts/FusionCharts.js"></script>
	|-capture name=xml-|<chart caption='|-$user->getName()-|' subCaption='' showSlackAsFill='0' showPercentLabel='1'>
	
	<set label='Entradas de Blog' value='|-$blogEntries-|' />
	<set label='Comentarios en Blog' value='|-$blogComments-|' />
	<set label='Desafios' value='|-$boardChallenges-|' />
	<set label='Comentarios sobre Desafios' value='|-$boardComments-|' />
	<set label='Compromisos sobre Desafios' value='|-$boardBonds-|' />
	<set label='Documentos creados' value='|-$documents-|' />
	
	</chart>|-/capture-| 

<div id="chartdiv" align="center">Estadísticas del Usuario</div>
<script type="text/javascript">|-assign var=height value="250"-||-assign var=calculatedHeight value="250"-|
	var myChart = new FusionCharts("scripts/FusionCharts/Column2D.swf?ChartNoDataText=No se encontraron datos para mostrar&PBarLoadingText=Cargando datos&ChartNoDataText=No se encontraron datos para mostrar&LoadDataErrorText=Error cargando los datos&InvalidXMLText=Datos inválidos&XMLLoadingText=Obteniendo datos", "myChartId", "700", "|-if $calculatedHeight gt $height-||-$calculatedHeight-||-else-||-$height-||-/if-|", "0", "0");
	myChart.setDataXML("|-$smarty.capture.xml|strip-||-$smarty.capture.process|strip-||-$smarty.capture.task|strip-|");
	myChart.render("chartdiv");
 </script>
