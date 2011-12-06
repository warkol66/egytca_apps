<div>
	<p><form id="params">
		<label for="date[min]">desde</label>
		<input name="date[min]" type='text' value='' size="12" /> <img src="images/calendar.png" width="16" height="15" border="0" onclick="displayDatePicker('date[min]', false, '|-$parameters.dateFormat.value|lower|replace:'-':''-|', '-');" title="Seleccione la fecha">
		<label for="date[max]">hasta</label>
		<input name="date[max]" type='text' value='' size="12" /> <img src="images/calendar.png" width="16" height="15" border="0" onclick="displayDatePicker('date[max]', false, '|-$parameters.dateFormat.value|lower|replace:'-':''-|', '-');" title="Seleccione la fecha">
		<button type="button" onclick="drawChart()">Graficar</button>
	</form></p>
	<div id="chartDiv" align="center"></div>
</div>

<script language="JavaScript" src="scripts/FusionCharts/FusionCharts.js"></script>
<script type="text/javascript">

function drawChart() {
	var chart = new FusionCharts("scripts/FusionCharts/MSLine.swf", "ChartId", "640", "420", "0", "0");
	var dataUrl = encodeURIComponent("Main.php?do=vialidadCertificatesViewGraphXml&constructionId=|-$constructionId-|");
	dataUrl += Form.serialize($("params"));
	console.log(dataUrl);
	chart.setDataURL(dataUrl);
	chart.render("chartDiv");
	
	new Ajax.Request(
		"Main.php?do=vialidadCertificatesViewGraphXml&constructionId=|-$constructionId-|",
		{
			method: 'get',
			parameters: Form.serialize($("params"))
		}
	);
}

</script>