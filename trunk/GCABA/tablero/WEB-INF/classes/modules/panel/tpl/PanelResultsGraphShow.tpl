<script type="text/javascript" src="scripts/lightbox.js"></script> 	
<script language="JavaScript" src="scripts/FusionCharts/FusionCharts.js"></script>
<h2>Tablero de Gestión</h2>
<h1>Visión Estratégica</h1>
<!--Aca comienzan los cambios -->
<script type="text/javascript" src="scripts/FusionCharts.js"></script>
<script type="text/javascript" src="scripts/FusionChartsExportComponent.js"></script>
<link rel="stylesheet" href="css/extrastyles.css" type="text/css" />
<script type="text/javascript" src="scripts/raphael.js"></script>
<script type="text/javascript" src="scripts/mapa.js"></script>
<!-- fin de los cambios -->
<br>
<br>
<br>
<div class="clearfix">
        <div class="floatleft">
            <div class="clearfix">
                |-*<div class="floatleft">
|-assign var=graphParent value=$position->getGraphParent()-|
                <object title="|-$graphParent-|" height="250" width="250">
                    <param name="wmode" value="transparent" />
                    <param name="movie" value="images/speedometer.swf" />
                    <param name="flashvars" value="var3=|-$graphParent->getSpeed()-|" />
                    <embed src="images/speedometer.swf" wmode="transparent" quality="high" pluginspage="http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash" type="application/x-shockwave-flash" flashvars="var3=|-$graphParent->getSpeed()-|" height="250" width="250" /></object>
                </div>*-|

                <div class="floatleft" id="chartContainer"></div>
                <script type="text/javascript">
                    var myChart = new FusionCharts( "images/Pie3D.swf?ChartNoDataText=No se encontraron datos para mostrar&PBarLoadingText=Cargando datos&ChartNoDataText=No se encontraron datos para mostrar&LoadDataErrorText=Error cargando los datos&InvalidXMLText=Datos inválidos&XMLLoadingText=Obteniendo datos", "myChartId", "350", "250", "0", "1" );
                    myChart.setDataURL(escape("Main.php?do=planningCakeByStatusColorXml&type=projects"));
										myChart.setTransparent(true);
                    myChart.render("chartContainer");
                </script>
            </div>
            <div class="clearfix">

                |-*<div class="floatleft">
                    <object title="Jefatura de Gabinete de Ministros" height="200" width="150">
                        <param name="wmode" value="transparent" />
                        <param name="movie" value="images/speedometer.swf" />
                        <param name="flashvars" value="var3=20&amp;var4=Main.php?do=positionsShow&amp;positionId=3" />
                        <embed src="images/speedometer.swf" wmode="transparent" quality="high" pluginspage="http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash" type="application/x-shockwave-flash" flashvars="var3=97&amp;var4=Main.php?do=positionsShow&amp;positionId=3" height="170" width="170" /></object>
                </div>*-|

                <div class="floatleft" id="chartContainer2"></div>
                <script type="text/javascript">
                    var myChart2 = new FusionCharts( "images/Pie3D.swf?ChartNoDataText=No se encontraron datos para mostrar&PBarLoadingText=Cargando datos&ChartNoDataText=No se encontraron datos para mostrar&LoadDataErrorText=Error cargando los datos&InvalidXMLText=Datos inválidos&XMLLoadingText=Obteniendo datos", "myChartId2", "350", "250", "0", "1" );
                    myChart2.setDataURL(escape("Main.php?do=planningCakeByStatusColorXml&type=constructions"));
                    myChart2.render("chartContainer2");
                </script>
            </div>

        </div>
        <div class="floatleft" width="400px" height="600px">
				<strong><center>Proyectos por comuna</center></strong><br>
<br>
<br>

            <div id="mapaChart" style="margin-top: -40px" width="500px" height="500px"></div>
            <script type="text/javascript">
                dibujarMapa('mapaChart','xmlMapa.php');
            </script>
        </div>
</div>

    <div id="chartContainer4">Cargando...</div>
    <br/>
    <script type="text/javascript">
        var myChart4 = new FusionCharts("images/Column2D.swf?ChartNoDataText=No se encontraron datos para mostrar&PBarLoadingText=Cargando datos&ChartNoDataText=No se encontraron datos para mostrar&LoadDataErrorText=Error cargando los datos&InvalidXMLText=Datos inválidos&XMLLoadingText=Obteniendo datos", "myChartId4", "1000", "300", "0", "1" );
		myChart4.setDataURL(escape("Main.php?do=planningConstructionsOnExecutionByMinistryXml"));
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

<h6>Gasto en Obras por comuna acumulado en pesos corrientes al |-$updatedSigaf|date_format-|</h6>
		<table class="tablaInfo small" id="gastoComuna">
				<tr><th width="28%">Gasto por Comuna</th><th width="8%">Sanción </th><th width="8%">Vigente </th><th width="8%">Restringido </th><th width="8%">Preventivo </th><th width="8%">Definitivo </th><th width="8%">Devengado  </th><th width="8%">Disponible </th><th width="8%">Pagado  </th></tr>
				<tr>
					<th>Total</th>
					<th>|-$regionsExpensesTotal.sanctioned|system_numeric_format:"0"-|</th>
					<th>|-$regionsExpensesTotal.active|system_numeric_format:"0"-|</th>
					<th width="8%">|-$regionsExpensesTotal.restricted|system_numeric_format:"0"-|</th>
					<th>|-$regionsExpensesTotal.preventive|system_numeric_format:"0"-|</th>
					<th>|-$regionsExpensesTotal.definitive|system_numeric_format:"0"-|</th>
					<th>|-$regionsExpensesTotal.accrued|system_numeric_format:"0"-|</th>
					<th>|-$regionsExpensesTotal.available|system_numeric_format:"0"-|</th>
					<th>|-$regionsExpensesTotal.paid|system_numeric_format:"0"-|</th>
				</tr>
				|-foreach $regionsExpenses as $regionExpenses-|
				<tr>
					<td class="left">|-$regionExpenses->getEntityname()-|</td>
					<td align="right">|-$regionExpenses->getsanctioned()|system_numeric_format:"0"-|</td>
					<td align="right">|-$regionExpenses->getactive()|system_numeric_format:"0"-|</td>
					<td align="right">|-$regionExpenses->getrestricted()|system_numeric_format:"0"-|</td>
					<td align="right">|-$regionExpenses->getpreventive()|system_numeric_format:"0"-|</td>
					<td align="right">|-$regionExpenses->getdefinitive()|system_numeric_format:"0"-|</td>
					<td align="right">|-$regionExpenses->getaccrued()|system_numeric_format:"0"-|</td>
					<td align="right">|-$regionExpenses->getavailable()|system_numeric_format:"0"-|</td>
					<td align="right">|-$regionExpenses->getpaid()|system_numeric_format:"0"-|</td>
				</tr>
				|-/foreach-|
</table>
    <button type="button" name="" value="" class="yellowButton" onclick="tableExport('gastoComuna', 'gasto_por_comuna.xls');">Exportar</button>
    <br/>