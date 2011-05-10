|-if $smarty.get.print neq 1-|
<h2>Reportes</h2>
<h1>Reporte por Motivos |-if $circuit neq ''-|del Circuito |-$circuit->getName()-||-/if-|</h1>
|-else-|
<h2>LAUSI - Vía Pública</h2>
<h1>Reporte por Motivos al |-$smarty.now|date_format:"%d-%m-%Y"-| |-if $circuit neq ''-| del Circuito |-$circuit->getName()-||-/if-|</h1>
|-/if-|
<div id="div_advertisements">
	|-if not empty($resultsDouble)-|
	<h3>Dobles</h3>
		|-include file="LausiReportsThemesInclude.tpl" results=$resultsDouble-|
	|-/if-|
	|-if not empty($resultsSix)-|
	<h3>Séxtuples</h3>
		|-include file="LausiReportsThemesInclude.tpl" results=$resultsSix-|
	|-/if-|
</div>

|-if (not empty($resultsDouble) or not empty($resultsSix)) and $smarty.get.print neq 1-|
	|-include file="LausiReportsPrintLinkInclude.tpl"-|
|-/if-|
