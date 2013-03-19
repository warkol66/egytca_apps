<h2>Visión Estratégica</h2>
<h1>Cuadros de Gasto Relativo</h1>
<!--Aca comienzan los cambios -->
<script type="text/javascript" src="scripts/FusionCharts.js"></script>
<script type="text/javascript" src="scripts/FusionChartsExportComponent.js"></script>
<link rel="stylesheet" href="css/extrastyles.css" type="text/css" />
<script type="text/javascript" src="scripts/raphael.js"></script>
<script type="text/javascript" src="scripts/mapa.js"></script>
<script type="text/javascript" src="scripts/tableExport.js"></script>
<!-- fin de los cambios -->
<form name="formTableExport" method="post" action="echo.php">
<input type="hidden" name="content" />
<input type="hidden" name="filename" />
</form>

<h6>Gasto en Obras por comuna mensual / acumulado en millones de pesos corrientes, año 2013 al 20/03/2013</h6>
	<table class="tablaInfo small" id="gastoComuna">
			<tr><th>Gasto por Comuna</th><th>Sanción </th><th>Vigente </th><th>Restringido </th><th>Preventivo </th><th>Definitivo </th><th>Devengado  </th><th>Disponible </th><th>Pagado  </th></tr>
			<tr>
				<th>Total</th>
				|-*<th>|-$regionsExpensesTotal.sanctioned-|</th>
				<th>|-$regionsExpensesTotal.active-|</th>
				<th>|-$regionsExpensesTotal.restricted-|</th>
				<th>|-$regionsExpensesTotal.preventive-|</th>
				<th>|-$regionsExpensesTotal.definitive-|</th>
				<th>|-$regionsExpensesTotal.accrued-|</th>
				<th>|-$regionsExpensesTotal.available-|</th>
				<th>|-$regionsExpensesTotal.paid-|</th>*-|
				<th>100</th>
				<th>100</th>
				<th>100</th>
				<th>100</th>
				<th>100</th>
				<th>100</th>
				<th>100</th>
				<th>100</th>
			</tr>
			|-foreach $regionsExpenses as $regionExpenses-|
			<tr>
				<td class="left">|-$regionExpenses->getEntityname()-|</td>
				<th>|-$regionExpenses->getsanctioned()-|</th>
				<td>|-$regionExpenses->getactive()-|</td>
				<td>|-$regionExpenses->getrestricted()-|</td>
				<td>|-$regionExpenses->getpreventive()-|</td>
				<td>|-$regionExpenses->getdefinitive()-|</td>
				<td>|-$regionExpenses->getaccrued()-|</td>
				<th>|-$regionExpenses->getavailable()-|</th>
				<td>|-$regionExpenses->getpaid()-|</td>
			</tr>
			|-/foreach-|
	</table>
    <button type="button" name="" value="" class="yellowButton" onclick="tableExport('gastoComuna', 'gasto_por_comuna.xls');">Exportar</button>
    <br/>

    <div class="clearfix">

        <div class="floatleft" width="400px" height="600px">
            <div id="mapaChart" width="500px" height="500px"></div>
            <script type="text/javascript">
                dibujarMapa('mapaChart','xml/mapa_gastos.xml?filters[prioridadproyecto]=a');
            </script>

        </div>

        <div class="floatleft" id="chartContainer2"></div>
        <script type="text/javascript">
            var myChart2 = new FusionCharts( "images/Pie3D.swf?ChartNoDataText=No se encontraron datos para mostrar&PBarLoadingText=Cargando datos&ChartNoDataText=No se encontraron datos para mostrar&LoadDataErrorText=Error cargando los datos&InvalidXMLText=Datos inválidos&XMLLoadingText=Obteniendo datos", "myChartId2", "600", "425", "0", "1" );
            myChart2.setDataURL("xml/gasto_por_comuna.xml");
            myChart2.render("chartContainer2");
        </script>
    </div>

<h6>Gasto por ministerio mensual / acumulado en millones de pesos corrientes, año 2013 al 20/03/2013</h6>
    <table class="tablaInfo small" id="gastoMinisterio">
        <tr><th>Jurisdicción </th><th>Sanción </th><th>Vigente </th><th>Restringido </th><th>Preventivo </th><th>Definitivo </th><th>Devengado  </th><th>Disponible </th><th>Pagado  </th></tr>
        <tr>
			<th>Total</th>
			|-*<th>|-$ministriesExpensesTotal.sanctioned-|</th>
			<th>|-$ministriesExpensesTotal.active-|</th>
			<th>|-$ministriesExpensesTotal.restricted-|</th>
			<th>|-$ministriesExpensesTotal.preventive-|</th>
			<th>|-$ministriesExpensesTotal.definitive-|</th>
			<th>|-$ministriesExpensesTotal.accrued-|</th>
			<th>|-$ministriesExpensesTotal.available-|</th>
			<th>|-$ministriesExpensesTotal.paid-|</th>*-|
			<th>100</th>
			<th>100</th>
			<th>100</th>
			<th>100</th>
			<th>100</th>
			<th>100</th>
			<th>100</th>
			<th>100</th>
		</tr>
		|-foreach $ministriesExpenses as $ministryExpenses-|
		<tr>
			<td class="left">|-$ministryExpenses->getEntityname()-|</td>
			<th>|-$ministryExpenses->getsanctioned()-|</th>
			<td>|-$ministryExpenses->getactive()-|</td>
			<td>|-$ministryExpenses->getrestricted()-|</td>
			<td>|-$ministryExpenses->getpreventive()-|</td>
			<td>|-$ministryExpenses->getdefinitive()-|</td>
			<td>|-$ministryExpenses->getaccrued()-|</td>
			<th>|-$ministryExpenses->getavailable()-|</th>
			<td>|-$ministryExpenses->getpaid()-|</td>
		</tr>
		|-/foreach-|
    </table>
    <button type="button" name="" value="" class="yellowButton" onclick="tableExport('gastoMinisterio', 'gasto_por_ministerio.xls');">Exportar</button>

    <br/><br/><br/><br/>

<h6>Gasto por objetivo operativo mensual / acumulado en millones de pesos corrientes, año 2013 al 20/03/2013</h6>
    <table class="tablaInfo small" id="objetivoOperativo">
        <tr><th>Objetivo Operativo  </th><th>Sanción </th><th>Vigente </th><th>Restringido </th><th>Preventivo </th><th>Definitivo </th><th>Devengado  </th><th>Disponible </th><th>Pagado </th></tr>
        <tr>
			<th>Total</th>
			|-*<th>|-$operativeObjectivesExpensesTotal.sanctioned-|</th>
			<th>|-$operativeObjectivesExpensesTotal.active-|</th>
			<th>|-$operativeObjectivesExpensesTotal.restricted-|</th>
			<th>|-$operativeObjectivesExpensesTotal.preventive-|</th>
			<th>|-$operativeObjectivesExpensesTotal.definitive-|</th>
			<th>|-$operativeObjectivesExpensesTotal.accrued-|</th>
			<th>|-$operativeObjectivesExpensesTotal.available-|</th>
			<th>|-$operativeObjectivesExpensesTotal.paid-|</th>*-|
			<th>100</th>
			<th>100</th>
			<th>100</th>
			<th>100</th>
			<th>100</th>
			<th>100</th>
			<th>100</th>
			<th>100</th>
		</tr>
		|-foreach $operativeObjectivesExpenses as $operativeObjectiveExpenses-|
		<tr>
			<td class="left">|-$operativeObjectiveExpenses->getEntityname()-|</td>
			<th>|-$operativeObjectiveExpenses->getsanctioned()-|</th>
			<td>|-$operativeObjectiveExpenses->getactive()-|</td>
			<td>|-$operativeObjectiveExpenses->getrestricted()-|</td>
			<td>|-$operativeObjectiveExpenses->getpreventive()-|</td>
			<td>|-$operativeObjectiveExpenses->getdefinitive()-|</td>
			<td>|-$operativeObjectiveExpenses->getaccrued()-|</td>
			<th>|-$operativeObjectiveExpenses->getavailable()-|</th>
			<td>|-$operativeObjectiveExpenses->getpaid()-|</td>
		</tr>
		|-/foreach-|
    </table>
    <button type="button" name="" value="" class="yellowButton" onclick="tableExport('objetivoOperativo', 'gasto_por_objetivo_operativo.xls');">Exportar</button>

    <br/><br/><br/><br/>
	<h6>Gasto por objetivo de impacto mensual / acumulado en millones de pesos corrientes, año 2013 al 20/03/2013</h6>
    <table  class="tablaInfo small" id="objetivoImpacto">
        <tr><th>Objetivo de Impacto</th><th>Sanción </th><th>Vigente </th><th>Restringido </th><th>Preventivo </th><th>Definitivo </th><th>Devengado  </th><th>Disponible </th><th>Pagado </th></tr>
        <tr>
			<th>Total</th>
			|-*<th>|-$impactObjectivesExpensesTotal.sanctioned-|</th>
			<th>|-$impactObjectivesExpensesTotal.active-|</th>
			<th>|-$impactObjectivesExpensesTotal.restricted-|</th>
			<th>|-$impactObjectivesExpensesTotal.preventive-|</th>
			<th>|-$impactObjectivesExpensesTotal.definitive-|</th>
			<th>|-$impactObjectivesExpensesTotal.accrued-|</th>
			<th>|-$impactObjectivesExpensesTotal.available-|</th>
			<th>|-$impactObjectivesExpensesTotal.paid-|</th>*-|
			<th>100</th>
			<th>100</th>
			<th>100</th>
			<th>100</th>
			<th>100</th>
			<th>100</th>
			<th>100</th>
			<th>100</th>
		</tr>
		|-foreach $impactObjectivesExpenses as $impactObjectiveExpenses-|
		<tr>
			<td class="left">|-$impactObjectiveExpenses->getEntityname()-|</td>
			<th>|-$impactObjectiveExpenses->getsanctioned()-|</th>
			<td>|-$impactObjectiveExpenses->getactive()-|</td>
			<td>|-$impactObjectiveExpenses->getrestricted()-|</td>
			<td>|-$impactObjectiveExpenses->getpreventive()-|</td>
			<td>|-$impactObjectiveExpenses->getdefinitive()-|</td>
			<td>|-$impactObjectiveExpenses->getaccrued()-|</td>
			<th>|-$impactObjectiveExpenses->getavailable()-|</th>
			<td>|-$impactObjectiveExpenses->getpaid()-|</td>
		</tr>
		|-/foreach-|
    </table>
    <button type="button" name="" value="" class="yellowButton"onclick="tableExport('objetivoImpacto', 'gasto_por_objetivo_impacto.xls');">Exportar</button>
    <br/>
    <br/><br/><br/>
	<h6>Gasto por objetivo ministerial mensual / acumulado en millones de pesos corrientes, año 2013 al 20/03/2013</h6>
    <table class="tablaInfo small" id="gastoObjetivoMinisterial">
		<tr><th>Objetivo Ministerial  </th><th>Sanción </th><th>Vigente </th><th>Restringido </th><th>Preventivo </th><th>Definitivo </th><th>Devengado  </th><th>Disponible </th><th>Pagado </th></tr>
		<tr>
			<th>Total</th>
			|-*<th>|-$ministryObjectivesExpensesTotal.sanctioned-|</th>
			<th>|-$ministryObjectivesExpensesTotal.active-|</th>
			<th>|-$ministryObjectivesExpensesTotal.restricted-|</th>
			<th>|-$ministryObjectivesExpensesTotal.preventive-|</th>
			<th>|-$ministryObjectivesExpensesTotal.definitive-|</th>
			<th>|-$ministryObjectivesExpensesTotal.accrued-|</th>
			<th>|-$ministryObjectivesExpensesTotal.available-|</th>
			<th>|-$ministryObjectivesExpensesTotal.paid-|</th>*-|
			<th>100</th>
			<th>100</th>
			<th>100</th>
			<th>100</th>
			<th>100</th>
			<th>100</th>
			<th>100</th>
			<th>100</th>
		</tr>
		|-foreach $ministryObjectivesExpenses as $ministryObjectiveExpenses-|
		<tr>
			<td class="left">|-$ministryObjectiveExpenses->getEntityname()-|</td>
			<th>|-$ministryObjectiveExpenses->getsanctioned()-|</th>
			<td>|-$ministryObjectiveExpenses->getactive()-|</td>
			<td>|-$ministryObjectiveExpenses->getrestricted()-|</td>
			<td>|-$ministryObjectiveExpenses->getpreventive()-|</td>
			<td>|-$ministryObjectiveExpenses->getdefinitive()-|</td>
			<td>|-$ministryObjectiveExpenses->getaccrued()-|</td>
			<th>|-$ministryObjectiveExpenses->getavailable()-|</th>
			<td>|-$ministryObjectiveExpenses->getpaid()-|</td>
		</tr>
		|-/foreach-|
    </table>
    <button type="button" name="" value="" class="yellowButton"onclick="tableExport('gastoObjetivoMinisterial', 'gasto_por_objetivo_ministerial.xls');">Exportar</button>

<div id="fcexpDiv" align="center">FusionCharts Export</div>
<script type="text/javascript">
  var myExportComponent = new FusionChartsExportObject("fcExporter1", "images/FCExporter.swf");
		//Render the exporter SWF in our DIV fcexpDiv
		myExportComponent.Render("fcexpDiv");
</script>
