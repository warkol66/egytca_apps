<h2>Obras</h2>
<h1>Gráficos de ejecución - Certificados</h1>

<div>
<h3>|-$entity->getName()-|</h3>
	<p><form id="params">
		<label for="date[min]">desde</label>
		<input name="date[min]" type='text' value='' size="12" /> <img src="images/calendar.png" width="16" height="15" border="0" onclick="displayDatePicker('date[min]', false, '|-$parameters.dateFormat.value|lower|replace:'-':''-|', '-');" title="Seleccione la fecha">
		<label for="date[max]">hasta</label>
		<input name="date[max]" type='text' value='' size="12" /> <img src="images/calendar.png" width="16" height="15" border="0" onclick="displayDatePicker('date[max]', false, '|-$parameters.dateFormat.value|lower|replace:'-':''-|', '-');" title="Seleccione la fecha">
		<input type="button" onclick="drawChart()" value="Generar gráfico" />
	</form></p>
	<div id="chartDiv" align="center"></div>
</div>

<script language="JavaScript" src="scripts/FusionCharts/FusionCharts.js"></script>
<script type="text/javascript">

function drawChart() {
	var chart = new FusionCharts("scripts/FusionCharts/MSLine.swf", "ChartId", "640", "420", "0", "0");
	var dataUrl = encodeURIComponent("Main.php?do=vialidadCertificatesViewGraphXml&entityType=|-$entityType-|&entityId=|-$entity->getId()-|");
	dataUrl += '&'+Form.serialize($("params"));
	
	chart.setDataURL(dataUrl.replace(new RegExp( '&', 'g' ), '%26').replace(new RegExp( '=', 'g' ), '%3D'));
	chart.render("chartDiv");
}

</script>