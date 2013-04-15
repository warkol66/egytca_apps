<h2>Visión Estratégica</h2>
<h1>Cuadros de Gasto Relativo 
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

<h6>Gasto Relativo acumuldo por Jurisdicción en porcentaje al |-$updatedSigaf|date_format-|</h6>
    <table class="tablaInfo small" id="gastoMinisterio">
        <tr><th width="28%">Jurisdicción </th>
        <th width="8%">Vigente / Sanción</th>
        <th width="8%">Devengado / Vigente</th>
        <th width="8%">Devengado / (Vigente-Restringido)</th>
        <th width="8%">Disponible / Vigente</th>
        <th width="8%">Devengado / Definitivo </th>
        <th width="8%">Disponible / (Vigente-Restringido)</th>
        <th width="8%">Definitivo / Vigente</th>
        <th width="8%">Pagado / Devengado</th>
        </tr>
        <tr>
			<th>Total</th>
			<th align="right">|-if $ministriesExpensesTotal.sanctioned eq 0-|n/d|-else-||-math equation="(a / b) * 100" a=$ministriesExpensesTotal.active b=$ministriesExpensesTotal.sanctioned assign=c1-||-$c1|system_numeric_format-||-/if-|</th>
			<th align="right">|-if $ministriesExpensesTotal.active eq 0-|n/d|-else-||-math equation="(a / b) * 100" a=$ministriesExpensesTotal.accrued b=$ministriesExpensesTotal.active assign=c2-||-$c2|system_numeric_format-||-/if-|</th>
|-math equation="a - b" a=$ministriesExpensesTotal.active b=$ministriesExpensesTotal.restricted assign=substr-|
			<th align="right">|-if $substr eq 0-|n/d|-else-||-math equation="(a / b) * 100" a=$ministriesExpensesTotal.accrued b=$substr assign=c3-||-$c3|system_numeric_format-||-/if-|</th>
			<th align="right">|-if $ministriesExpensesTotal.active eq 0-|n/d|-else-||-math equation="(a / b) * 100" a=$ministriesExpensesTotal.available b=$ministriesExpensesTotal.active assign=c4-||-$c4|system_numeric_format-||-/if-|</th>
			<th align="right">|-if $ministriesExpensesTotal.definitive eq 0-|n/d|-else-||-math equation="(a / b) * 100" a=$ministriesExpensesTotal.accrued b=$ministriesExpensesTotal.definitive assign=c5-||-$c5|system_numeric_format-||-/if-|</th>
			<th align="right">|-if $substr eq 0-|n/d|-else-||-math equation="(a / b) * 100" a=$ministriesExpensesTotal.available b=$substr assign=c6-||-$c6|system_numeric_format-||-/if-|</th>
			<th align="right">|-if $ministriesExpensesTotal.active eq 0-|n/d|-else-||-math equation="(a / b) * 100" a=$ministriesExpensesTotal.definitive b=$ministriesExpensesTotal.active assign=c7-||-$c7|system_numeric_format-||-/if-|</th>
			<th align="right">|-if $ministriesExpensesTotal.accrued eq 0-|n/d|-else-||-math equation="(a / b) * 100" a=$ministriesExpensesTotal.paid b=$ministriesExpensesTotal.accrued assign=c8-||-$c8|system_numeric_format-||-/if-|</th>
		</tr>
		|-foreach $ministriesExpenses as $ministryExpenses-|
		<tr>
			<td class="left">|-$ministryExpenses->getEntityname()-|</td>
			<td align="right">|-if $ministryExpenses->getsanctioned() eq 0-|n/d|-else-||-math equation="(a / b) * 100" a=$ministryExpenses->getactive() b=$ministryExpenses->getsanctioned() assign=c1-||-$c1|system_numeric_format-||-/if-|</td>
			<td align="right">|-if $ministryExpenses->getactive() eq 0-|n/d|-else-||-math equation="(a / b) * 100" a=$ministryExpenses->getaccrued() b=$ministryExpenses->getactive() assign=c2-||-$c2|system_numeric_format-||-/if-|</td>
|-if $ministryExpenses->getactive() && $ministryExpenses->getrestricted()-||-math equation="a - b" a=$ministryExpenses->getactive() b=$ministryExpenses->getrestricted() assign=substr-||-else-||-assign var=substr value=0-||-/if-|
			<td align="right">|-if $substr eq 0-|n/d|-else-||-math equation="(a / b) * 100" a=$ministryExpenses->getaccrued() b=$substr assign=c3-||-$c3|system_numeric_format-||-/if-|</td>
			<td align="right">|-if $ministryExpenses->getactive() eq 0-|n/d|-else-||-math equation="(a / b) * 100" a=$ministryExpenses->getavailable() b=$ministryExpenses->getactive() assign=c4-||-$c4|system_numeric_format-||-/if-|</td>
			<td align="right">|-if $ministryExpenses->getdefinitive() eq 0-|n/d|-else-||-math equation="(a / b) * 100" a=$ministryExpenses->getaccrued() b=$ministryExpenses->getdefinitive() assign=c5-||-$c5|system_numeric_format-||-/if-|</td>
			<td align="right">|-if $substr eq 0-|n/d|-else-||-math equation="(a / b) * 100" a=$ministryExpenses->getavailable() b=$substr assign=c6-||-$c6|system_numeric_format-||-/if-|</td>
			<td align="right">|-if $ministryExpenses->getactive() eq 0-|n/d|-else-||-math equation="(a / b) * 100" a=$ministryExpenses->getdefinitive() b=$ministryExpenses->getactive() assign=c7-||-$c7|system_numeric_format-||-/if-|</td>
			<td align="right">|-if $ministryExpenses->getaccrued() eq 0-|n/d|-else-||-math equation="(a / b) * 100" a=$ministryExpenses->getpaid() b=$ministryExpenses->getaccrued() assign=c8-||-$c8|system_numeric_format-||-/if-|</td>
		</tr>
		|-/foreach-|
</table>
    <button type="button" name="" value="" class="yellowButton" onclick="tableExport('gastoMinisterio', 'gasto_por_ministerio.xls');">Exportar</button>
<br>
<br>
<br>
<br>

<h6>Gasto Relativo acumuldo por Comuna en porcentaje |-$updatedSigaf|date_format-|</h6>
	<table class="tablaInfo small" id="gastoComuna">
			<tr><th width="28%">Gasto por Comuna</th>
			  <th width="8%">Vigente / Sanción</th>
        <th width="8%">Devengado / Vigente</th>
        <th width="8%">Devengado / (Vigente-Restringido)</th>
        <th width="8%">Disponible / Vigente</th>
        <th width="8%">Devengado / Definitivo </th>
        <th width="8%">Disponible / (Vigente-Restringido)</th>
        <th width="8%">Definitivo / Vigente</th>
        <th width="8%">Pagado / Devengado</th>
			</tr>
			|-foreach $regionsExpenses as $regionExpenses-|
		<tr>
			<td class="left">|-$regionExpenses->getEntityname()-|</td>
			<td align="right">|-if $regionExpenses->getsanctioned() eq 0-|n/d|-else-||-math equation="(a / b) * 100" a=$regionExpenses->getactive() b=$regionExpenses->getsanctioned() assign=c1-||-$c1|system_numeric_format-||-/if-|</td>
			<td align="right">|-if $regionExpenses->getactive() eq 0-|n/d|-else-||-math equation="(a / b) * 100" a=$regionExpenses->getaccrued() b=$regionExpenses->getactive() assign=c2-||-$c2|system_numeric_format-||-/if-|</td>
|-if $regionExpenses->getactive() && $regionExpenses->getrestricted()-||-math equation="a - b" a=$regionExpenses->getactive() b=$regionExpenses->getrestricted() assign=substr-||-else-||-assign var=substr value=0-||-/if-|
			<td align="right">|-if $substr eq 0-|n/d|-else-||-math equation="(a / b) * 100" a=$regionExpenses->getaccrued() b=$substr assign=c3-||-$c3|system_numeric_format-||-/if-|</td>
			<td align="right">|-if $regionExpenses->getactive() eq 0-|n/d|-else-||-math equation="(a / b) * 100" a=$regionExpenses->getavailable() b=$regionExpenses->getactive() assign=c4-||-$c4|system_numeric_format-||-/if-|</td>
			<td align="right">|-if $regionExpenses->getdefinitive() eq 0-|n/d|-else-||-math equation="(a / b) * 100" a=$regionExpenses->getaccrued() b=$regionExpenses->getdefinitive() assign=c5-||-$c5|system_numeric_format-||-/if-|</td>
			<td align="right">|-if $substr eq 0-|n/d|-else-||-math equation="(a / b) * 100" a=$regionExpenses->getavailable() b=$substr assign=c6-||-$c6|system_numeric_format-||-/if-|</td>
			<td align="right">|-if $regionExpenses->getactive() eq 0-|n/d|-else-||-math equation="(a / b) * 100" a=$regionExpenses->getdefinitive() b=$regionExpenses->getactive() assign=c7-||-$c7|system_numeric_format-||-/if-|</td>
			<td align="right">|-if $regionExpenses->getaccrued() eq 0-|n/d|-else-||-math equation="(a / b) * 100" a=$regionExpenses->getpaid() b=$regionExpenses->getaccrued() assign=c8-||-$c8|system_numeric_format-||-/if-|</td>
		</tr>			|-/foreach-|
</table>
    <button type="button" name="" value="" class="yellowButton" onclick="tableExport('gastoComuna', 'gasto_por_comuna.xls');">Exportar</button>
    <br/>

    <br/><br/><br/><br/>
	<h6>Gasto Relativo acumuldo por Objetivo de Impacto en porcentaje |-$updatedSigaf|date_format-|</h6>
    <table  class="tablaInfo small" id="objetivoImpacto">
        <tr><th width="28%">Objetivo de Impacto</th>
			  <th width="8%">Vigente / Sanción</th>
        <th width="8%">Devengado / Vigente</th>
        <th width="8%">Devengado / (Vigente-Restringido)</th>
        <th width="8%">Disponible / Vigente</th>
        <th width="8%">Devengado / Definitivo </th>
        <th width="8%">Disponible / (Vigente-Restringido)</th>
        <th width="8%">Definitivo / Vigente</th>
        <th width="8%">Pagado / Devengado</th>
        </tr>
        <tr>
		|-foreach $impactObjectivesExpenses as $impactObjectiveExpenses-|
		<tr>
			<td align="right" class="left">|-$impactObjectiveExpenses->getEntityname()-|</td>
			<td align="right">|-if $impactObjectiveExpenses->getsanctioned() eq 0-|n/d|-else-||-math equation="(a / b) * 100" a=$impactObjectiveExpenses->getactive() b=$impactObjectiveExpenses->getsanctioned() assign=c1-||-$c1|system_numeric_format-||-/if-|</td>
			<td align="right">|-if $impactObjectiveExpenses->getactive() eq 0-|n/d|-else-||-math equation="(a / b) * 100" a=$impactObjectiveExpenses->getaccrued() b=$impactObjectiveExpenses->getactive() assign=c2-||-$c2|system_numeric_format-||-/if-|</td>
|-if $impactObjectiveExpenses->getactive() && $impactObjectiveExpenses->getrestricted()-||-math equation="a - b" a=$impactObjectiveExpenses->getactive() b=$impactObjectiveExpenses->getrestricted() assign=substr-||-else-||-assign var=substr value=0-||-/if-|
			<td align="right">|-if $substr eq 0-|n/d|-else-||-math equation="(a / b) * 100" a=$impactObjectiveExpenses->getaccrued() b=$substr assign=c3-||-$c3|system_numeric_format-||-/if-|</td>
			<td align="right">|-if $impactObjectiveExpenses->getactive() eq 0-|n/d|-else-||-math equation="(a / b) * 100" a=$impactObjectiveExpenses->getavailable() b=$impactObjectiveExpenses->getactive() assign=c4-||-$c4|system_numeric_format-||-/if-|</td>
			<td align="right">|-if $impactObjectiveExpenses->getdefinitive() eq 0-|n/d|-else-||-math equation="(a / b) * 100" a=$impactObjectiveExpenses->getaccrued() b=$impactObjectiveExpenses->getdefinitive() assign=c5-||-$c5|system_numeric_format-||-/if-|</td>
			<td align="right">|-if $substr eq 0-|n/d|-else-||-math equation="(a / b) * 100" a=$impactObjectiveExpenses->getavailable() b=$substr assign=c6-||-$c6|system_numeric_format-||-/if-|</td>
			<td align="right">|-if $impactObjectiveExpenses->getactive() eq 0-|n/d|-else-||-math equation="(a / b) * 100" a=$impactObjectiveExpenses->getdefinitive() b=$impactObjectiveExpenses->getactive() assign=c7-||-$c7|system_numeric_format-||-/if-|</td>
			<td align="right">|-if $impactObjectiveExpenses->getaccrued() eq 0-|n/d|-else-||-math equation="(a / b) * 100" a=$impactObjectiveExpenses->getpaid() b=$impactObjectiveExpenses->getaccrued() assign=c8-||-$c8|system_numeric_format-||-/if-|</td>
		</tr>
		|-/foreach-|
</table>
    <button type="button" name="" value="" class="yellowButton"onclick="tableExport('objetivoImpacto', 'gasto_por_objetivo_impacto.xls');">Exportar</button>

<div id="fcexpDiv" align="center">FusionCharts Export</div>
<script type="text/javascript">
  var myExportComponent = new FusionChartsExportObject("fcExporter1", "images/FCExporter.swf");
		//Render the exporter SWF in our DIV fcexpDiv
		myExportComponent.Render("fcexpDiv");
</script>
