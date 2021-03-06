<h2>Visión Estratégica</h2>
<h1>Cuadros de Participación del Gasto 
  <script type="text/javascript" src="scripts/FusionCharts.js"></script>
<script type="text/javascript" src="scripts/FusionChartsExportComponent.js"></script>
</h1>
<link rel="stylesheet" href="css/extrastyles.css" type="text/css" />
<script type="text/javascript" src="scripts/raphael.js"></script>
<script type="text/javascript" src="scripts/mapa.js"></script>
<script type="text/javascript" src="scripts/tableExport.js"></script>
<!-- fin de los cambios -->
<form name="formTableExport" method="post" action="echo.php">
<input type="hidden" name="content" />
<input type="hidden" name="filename" />
</form>
<br />
<br />
<h6>Participación del gasto en obras por jurisdicción</h6>
	<h7>En porcentaje al |-$updatedSigaf|date_format-|</h7>
    <table class="tablaInfo small" id="gastoMinisterio">
        <tr><th width="28%">Jurisdicción </th><th width="8%">Sanción </th>
        <th width="8%">Vigente </th>
        <th width="8%">Restringido </th>
        <th width="8%">Preventivo </th>
        <th width="8%">Definitivo </th>
        <th width="8%">Devengado  </th>
        <th width="8%">Disponible </th>
        <th width="8%">Pagado  </th>
        </tr>
        <tr>
			<th>Total</th>
			|-*<th align="right">|-$ministriesExpensesTotal.sanctioned-|</th>
			<th align="right">|-$ministriesExpensesTotal.active-|</th>
			<th align="right">|-$ministriesExpensesTotal.restricted-|</th>
			<th align="right">|-$ministriesExpensesTotal.preventive-|</th>
			<th align="right">|-$ministriesExpensesTotal.definitive-|</th>
			<th align="right">|-$ministriesExpensesTotal.accrued-|</th>
			<th align="right">|-$ministriesExpensesTotal.available-|</th>
			<th align="right">|-$ministriesExpensesTotal.paid-|</th>
			*-|
			<th align="right">100</th>
			<th align="right">100</th>
			<th align="right">100</th>
			<th align="right">100</th>
			<th align="right">100</th>
			<th align="right">100</th>
			<th align="right">100</th>
			<th align="right">100</th>
		</tr>
		|-foreach $ministriesExpenses as $ministryExpenses-|
		<tr>
			<td class="left">|-$ministryExpenses->getEntityname()-|</td>
			<td align="right">|-$ministryExpenses->getsanctioned()|system_numeric_format-|</td>
			<td align="right">|-$ministryExpenses->getactive()|system_numeric_format-|</td>
			<td align="right">|-$ministryExpenses->getrestricted()|system_numeric_format-|</td>
			<td align="right">|-$ministryExpenses->getpreventive()|system_numeric_format-|</td>
			<td align="right">|-$ministryExpenses->getdefinitive()|system_numeric_format-|</td>
			<td align="right">|-$ministryExpenses->getaccrued()|system_numeric_format-|</td>
			<td align="right">|-$ministryExpenses->getavailable()|system_numeric_format-|</td>
			<td align="right">|-$ministryExpenses->getpaid()|system_numeric_format-|</td>
		</tr>
		|-/foreach-|
</table>
    <button type="button" name="" value="" class="yellowButton" onclick="tableExport('gastoMinisterio', 'gasto_por_ministerio.xls');">Exportar</button>
<br>
<br>
<br>
<br>

<h6>Participación del gasto en obras por comuna</h6>
	<h7>En porcentaje al |-$updatedSigaf|date_format-|</h7>
	<table class="tablaInfo small" id="gastoComuna">
			<tr><th width="28%">Gasto por Comuna</th><th width="8%">Sanción </th>
			<th width="8%">Vigente </th>
			<th width="8%">Restringido </th>
			<th width="8%">Preventivo </th>
			<th width="8%">Definitivo </th>
			<th width="8%">Devengado  </th>
			<th width="8%">Disponible </th>
			<th width="8%">Pagado  </th>
			</tr>
			<tr>
				<th>Total</th>
				|-*<th align="right">|-$regionsExpensesTotal.sanctioned-|</th>
				<th align="right">|-$regionsExpensesTotal.active-|</th>
				<th align="right">|-$regionsExpensesTotal.restricted-|</th>
				<th align="right">|-$regionsExpensesTotal.preventive-|</th>
				<th align="right">|-$regionsExpensesTotal.definitive-|</th>
				<th align="right">|-$regionsExpensesTotal.accrued-|</th>
				<th align="right">|-$regionsExpensesTotal.available-|</th>
				<th align="right">|-$regionsExpensesTotal.paid-|</th>
				*-|
				<th align="right">100</th>
				<th align="right">100</th>
				<th align="right">100</th>
				<th align="right">100</th>
				<th align="right">100</th>
				<th align="right">100</th>
				<th align="right">100</th>
				<th align="right">100</th>
			</tr>
			|-foreach $regionsExpenses as $regionExpenses-|
			<tr>
				<td class="left">|-$regionExpenses->getEntityname()-|</td>
				<td align="right">|-$regionExpenses->getsanctioned()|system_numeric_format-|</td>
				<td align="right">|-$regionExpenses->getactive()|system_numeric_format-|</td>
				<td align="right">|-$regionExpenses->getrestricted()|system_numeric_format-|</td>
				<td align="right">|-$regionExpenses->getpreventive()|system_numeric_format-|</td>
				<td align="right">|-$regionExpenses->getdefinitive()|system_numeric_format-|</td>
				<td align="right">|-$regionExpenses->getaccrued()|system_numeric_format-|</td>
				<td align="right">|-$regionExpenses->getavailable()|system_numeric_format-|</td>
				<td align="right">|-$regionExpenses->getpaid()|system_numeric_format-|</td>
			</tr>
			|-/foreach-|
</table>
    <button type="button" name="" value="" class="yellowButton" onclick="tableExport('gastoComuna', 'gasto_por_comuna.xls');">Exportar</button>
    <br/>
|-*
    <div class="clearfix">

        <div class="floatleft" width="400px" height="600px">
            <div id="mapaChart" width="500px" height="500px"></div>
            <script type="text/javascript">
                dibujarMapa('mapaChart','xmlMapa.php');
            </script>

        </div>

        <div class="floatleft" id="chartContainer2"></div>
        <script type="text/javascript">
            var myChart2 = new FusionCharts( "images/Pie3D.swf?ChartNoDataText=No se encontraron datos para mostrar&PBarLoadingText=Cargando datos&ChartNoDataText=No se encontraron datos para mostrar&LoadDataErrorText=Error cargando los datos&InvalidXMLText=Datos inválidos&XMLLoadingText=Obteniendo datos", "myChartId2", "600", "425", "0", "1" );
            myChart2.setDataURL(escape("Main.php?do=panelExpensesByComuneXml&relative=1"));
            myChart2.render("chartContainer2");
        </script>
    </div>


    <br/><br/><br/><br/>

<h6>Gasto por Objetivo Operativo</h6>
	<h7>En porcentaje al |-$updatedSigaf|date_format-|</h7>
    <table class="tablaInfo small" id="objetivoOperativo">
        <tr><th width="28%">Objetivo Operativo  </th>
        <th width="8%">Sanción </th>
        <th width="8%">Vigente </th>
        <th width="8%">Restringido </th>
        <th width="8%">Preventivo </th>
        <th width="8%">Definitivo </th>
        <th width="8%">Devengado  </th>
        <th width="8%">Disponible </th>
        <th width="8%">Pagado </th>
        </tr>
        <tr>
			<th>Total</th>
			<th align="right">100</th>
			<th align="right">100</th>
			<th align="right">100</th>
			<th align="right">100</th>
			<th align="right">100</th>
			<th align="right">100</th>
			<th align="right">100</th>
			<th align="right">100</th>
		</tr>
		|-foreach $operativeObjectivesExpenses as $operativeObjectiveExpenses-|
		<tr>
			<td class="left">|-$operativeObjectiveExpenses->getEntityname()-|</td>
			<td align="right">|-$operativeObjectiveExpenses->getsanctioned()|system_numeric_format-|</td>
			<td align="right">|-$operativeObjectiveExpenses->getactive()|system_numeric_format-|</td>
			<td align="right">|-$operativeObjectiveExpenses->getrestricted()|system_numeric_format-|</td>
			<td align="right">|-$operativeObjectiveExpenses->getpreventive()|system_numeric_format-|</td>
			<td align="right">|-$operativeObjectiveExpenses->getdefinitive()|system_numeric_format-|</td>
			<td align="right">|-$operativeObjectiveExpenses->getaccrued()|system_numeric_format-|</td>
			<td align="right">|-$operativeObjectiveExpenses->getavailable()|system_numeric_format-|</td>
			<td align="right">|-$operativeObjectiveExpenses->getpaid()|system_numeric_format-|</td>
		</tr>
		|-/foreach-|
</table>
    <button type="button" name="" value="" class="yellowButton" onclick="tableExport('objetivoOperativo', 'gasto_por_objetivo_operativo.xls');">Exportar</button>

    <br/><br/><br/><br/>
	<h6>Gasto por Objetivo de Impacto</h6>
	<h7>En porcentaje al |-$updatedSigaf|date_format-|</h7>
    <table  class="tablaInfo small" id="objetivoImpacto">
        <tr><th width="28%">Objetivo de Impacto</th><th width="8%">Sanción </th>
        <th width="8%">Vigente </th>
        <th width="8%">Restringido </th>
        <th width="8%">Preventivo </th>
        <th width="8%">Definitivo </th>
        <th width="8%">Devengado  </th>
        <th width="8%">Disponible </th>
        <th width="8%">Pagado </th>
        </tr>
        <tr>
			<th align="right">Total</th>
			<th align="right">100</th>
			<th align="right">100</th>
			<th align="right">100</th>
			<th align="right">100</th>
			<th align="right">100</th>
			<th align="right">100</th>
			<th align="right">100</th>
			<th align="right">100</th>
		</tr>
		|-foreach $impactObjectivesExpenses as $impactObjectiveExpenses-|
		<tr>
			<td align="right" class="left">|-$impactObjectiveExpenses->getEntityname()-|</td>
			<td align="right">|-$impactObjectiveExpenses->getsanctioned()|system_numeric_format-|</td>
			<td align="right">|-$impactObjectiveExpenses->getactive()|system_numeric_format-|</td>
			<td align="right">|-$impactObjectiveExpenses->getrestricted()|system_numeric_format-|</td>
			<td align="right">|-$impactObjectiveExpenses->getpreventive()|system_numeric_format-|</td>
			<td align="right">|-$impactObjectiveExpenses->getdefinitive()|system_numeric_format-|</td>
			<td align="right">|-$impactObjectiveExpenses->getaccrued()|system_numeric_format-|</td>
			<td align="right">|-$impactObjectiveExpenses->getavailable()|system_numeric_format-|</td>
			<td align="right">|-$impactObjectiveExpenses->getpaid()|system_numeric_format-|</td>
		</tr>
		|-/foreach-|
</table>
    <button type="button" name="" value="" class="yellowButton"onclick="tableExport('objetivoImpacto', 'gasto_por_objetivo_impacto.xls');">Exportar</button>
    <br/>
    <br/><br/><br/>
	<h6>Gasto por Objetivo Ministerial </h6>
	<h7>En porcentaje al |-$updatedSigaf|date_format-|</h7>
    <table class="tablaInfo small" id="gastoObjetivoMinisterial">
		<tr><th width="28%">Objetivo Ministerial  </th>
		<th width="8%">Sanción </th>
		<th width="8%">Vigente </th>
		<th width="8%">Restringido </th>
		<th width="8%">Preventivo </th>
		<th width="8%">Definitivo </th>
		<th width="8%">Devengado  </th>
		<th width="8%">Disponible </th>
		<th width="8%">Pagado </th>
		</tr>
		<tr>
			<th>Total</th>
			<th align="right">100</th>
			<th align="right">100</th>
			<th align="right">100</th>
			<th align="right">100</th>
			<th align="right">100</th>
			<th align="right">100</th>
			<th align="right">100</th>
			<th align="right">100</th>
		</tr>
		|-foreach $ministryObjectivesExpenses as $ministryObjectiveExpenses-|
		<tr>
			<td class="left">|-$ministryObjectiveExpenses->getEntityname()-|</td>
			<td align="right">|-$ministryObjectiveExpenses->getsanctioned()|system_numeric_format-|</td>
			<td align="right">|-$ministryObjectiveExpenses->getactive()|system_numeric_format-|</td>
			<td align="right">|-$ministryObjectiveExpenses->getrestricted()|system_numeric_format-|</td>
			<td align="right">|-$ministryObjectiveExpenses->getpreventive()|system_numeric_format-|</td>
			<td align="right">|-$ministryObjectiveExpenses->getdefinitive()|system_numeric_format-|</td>
			<td align="right">|-$ministryObjectiveExpenses->getaccrued()|system_numeric_format-|</td>
			<td align="right">|-$ministryObjectiveExpenses->getavailable()|system_numeric_format-|</td>
			<td align="right">|-$ministryObjectiveExpenses->getpaid()|system_numeric_format-|</td>
		</tr>
		|-/foreach-|
</table>
    <button type="button" name="" value="" class="yellowButton"onclick="tableExport('gastoObjetivoMinisterial', 'gasto_por_objetivo_ministerial.xls');">Exportar</button>
*-|
<div id="fcexpDiv" align="center">FusionCharts Export</div>
<script type="text/javascript">
  var myExportComponent = new FusionChartsExportObject("fcExporter1", "images/FCExporter.swf");
		//Render the exporter SWF in our DIV fcexpDiv
		myExportComponent.Render("fcexpDiv");
</script>
