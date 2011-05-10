<div class="noPrint"><h2>Reportes</h2>
<h1>Disposición de Afiches</h1>
</div>
<p class="noPrint">El siguiente reporte le permite obtener un listado de direcciones y motivos en cada dirección por cada circuito. Para generar el reporte debe selecionar un circuito.</p>
<div id="div_advertisements">
|-if $message eq "noCircuitSeleted"-|
	<div class="errorMessage">Este reporte se genera por circuito, por favor, seleccione un circuito y solicite el reporte nuevamente</div>
|-/if-|

			<form action="Main.php" method="get" class="noPrint">
				<fieldset>
					<legend>Reportes</legend>
				<p>
					<label for="date">Fecha Desde</label>
					<input name="date" type="text" id="date" title="fromDate" value="|-$date|date_format:"%d-%m-%Y"-|" size="12" /> 
					<img src="images/calendar.png" width="16" height="15" border="0" onclick="displayDatePicker('date', false, '|-$parameters.dateFormat.value|lower|replace:'-':''-|', '-');" title="Seleccione la fecha">
				</p>
				<p>
					<label for="circuitId">Circuito</label>
					<select name="circuitId">
						<option value="">Seleccione un Circuito</option>
						|-foreach from=$circuits item=circuit name=for_circuits-|
							<option value="|-$circuit->getId()-|" |-if isset($circuitId) and $circuitId eq $circuit->getId()-|selected="selected"|-/if-|>|-$circuit->getName()-|</option>
						|-/foreach-|
					</select>
				</p>				
				<p>
					<label for="type">Tipo</label>
					<select name="type">
						<option value="1" |-if isset($type) and $type eq 1 -|selected="selected"|-/if-|>Doble</option>
						<option value="2" |-if isset($type) and $type eq 2 -|selected="selected"|-/if-|>Sextuple</option>
					</select>
				</p>
				<p><input type="hidden" name="do" value="lausiReportsSheetsLocation" id="do" />
				<input type="hidden" name="reportMode" value="normal" id="reportMode"/>
				<input type="button"  name="submitForm" value="Generar reporte"  onClick="javascript:buildReport(this.form)"/>
				<input type="button" name="print" value="Generar reporte para impresión" onClick="addAddressesIdsToForm(this.form);javascript:printReport(this.form)"/>
				<input type="button" name="export" value="Exportar reporte a Excel" onClick="javascript:exportReport(this.form)"/>
				</p></fieldset>
			</form>
|-if not empty($results)-|
		|-foreach from=$results item=item-|
			|-assign var=currentCircuit value=$item.circuit-|
			
			<table border="0" cellpadding="4" cellspacing="0" id="tabla-advertisements" class="tableTdBorders">
				<thead>
					<tr>|-math equation="x+1" x=$themes|@count assign=themesCount-|
						<th colspan="|-$themesCount-|"><h3>Circuito |-$currentCircuit->getName()-|</h3></th>
					</tr>
					<tr>
						<th>Dirección</th>
					|-foreach from=$themes item=theme-|
						<th>|-$theme->getShortName()-|</th>
					|-/foreach-|
					</tr>
				</thead>
				<tbody>
				
				|-foreach from=$item.addresses item=addressHolder name=for_advertisements-|
					<tr>
							|-assign var=address value=$addressHolder.address -|
							|-assign var=adverts value=$addressHolder.adverts-|
						<td>
							|-$address->getName()-|
						</td>
					|-foreach from=$themes item=theme-|
						|-assign var=themeId value=$theme->getId()-|
						<td align="center">|-if isset($adverts.$themeId)-||-$adverts.$themeId-||-else-||-/if-|</td>
					|-/foreach-|
					</tr>
				|-/foreach-|					
					<tr>
						<th>Totales</th>
					|-assign var=generalTotal value=0-|
					|-assign var=counter value=0-|
					|-foreach from=$themes item=theme-|
						|-assign var=themeId value=$theme->getId()-|
						<th>|-if isset($item.totals.$themeId)-||-$item.totals.$themeId-||-else-|---|-/if-|</th>			
					|-/foreach-|
					</tr>
					<tr>
						<th colspan="|-$themesCount-|">Total del circuito: |-$item.total-|</th>
					</tr>
				</tbody>
			</table>
			<p></p>
		|-/foreach-|
|-/if-|
</div>

<div class="noPrint">
	|-include file="LausiReportsSheetMapInclude.tpl"-|
</div>