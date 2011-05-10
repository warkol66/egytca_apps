<div class="noPrint">
<h2>Reportes</h2>
<h1>Hoja de Ruta para Contratista</h1>
</div>
<div id="div_advertisements">
|-if $message eq "ok"-|
	<div class="successMessage">Aviso guardado correctamente</div>
|-elseif $message eq "deleted_ok"-|
	<div class="successMessage">Aviso eliminado correctamente</div>
|-elseif $message eq "failure_overlapping"-|
	<div class="errorMessage">No se han guardado las modificaciones, Hay superposición.</div>
|-/if-|
	<form action="Main.php" method="get" class="noPrint">
		<fieldset>
			<legend>Reportes</legend>
		<p>
			<label for="date">Fecha</label>
			<input name="date" type="text" id="date" title="fromDate" value="|-if $date neq ''-||-$date|date_format:"%d-%m-%Y"-||-else-||-$smarty.now|date_format:"%d-%m-%Y"-||-/if-|" size="12" /> 
			<img src="images/calendar.png" width="16" height="15" border="0" onclick="displayDatePicker('date', false, '|-$parameters.dateFormat.value|lower|replace:'-':''-|', '-');" title="Seleccione la fecha">
		</p>
		<p>
			<label for="theme">Motivo</label>
			<select name="filter[themeId]">
				<option value="">Seleccione un Motivo</option>
				|-foreach from=$themes item=theme name=for_theme-|
					<option value="|-$theme->getId()-|" |-if $filter neq '' and $filter.themeId eq $theme->getId()-|selected="selected"|-/if-|>|-$theme->getName()-|</option>
				|-/foreach-|
			</select>
		</p>
		<p>
			<label for="theme">Contratista</label>
			<select name="filter[workforceId]">
				<option value="">Seleccione un Contratista</option>
				|-foreach from=$workforces item=workforce name=for_workforce-|
					<option value="|-$workforce->getId()-|" |-if $filter neq '' and $filter.workforceId eq $workforce->getId()-|selected="selected"|-/if-|>|-$workforce->getName()-|</option>
				|-/foreach-|
			</select>
		</p>
		<input type="hidden" name="do" value="lausiReportsRouteSheet" id="do" />
		<input type="hidden" name="reportMode" value="normal" id="reportMode"/>
		<input type="button"  name="submitForm" value="Generar reporte"  onClick="javascript:buildReport(this.form)"/>
		<input type="button" name="print" value="Generar reporte para impresión" onClick="addAddressesIdsToForm(this.form);javascript:printReport(this.form)"/>
				
		</fieldset>
	</form>

|-foreach from=$results item=result-|	
<p>
	|-assign var=advertisements value=$result.adverts-|
	|-assign var=currentTheme value=$result.theme-|
	
	|-if not empty($advertisements)-|
	
			<table border="0" cellpadding="4" cellspacing="0" id="tabla-advertisements" class="tableTdBorders">
				<thead>
					<tr>
						<th colspan="5"><h3>Motivo: |-$currentTheme->getShortName()-|</h3></th>
					</tr>
					<tr>
						<th>Circuito</th>
						<th>Dirección</th>
						<th>Cantidad</th>
						<th>Se Tapa</th>
						<th>Contratista</th>
					</tr>
				</thead>
				<tbody>
				|-foreach from=$advertisements item=advertisement name=for_advertisements-|
					|-assign var=theme value=$advertisement->getTheme()-|
					|-assign var=billboard value=$advertisement->getBillboard()-|
					|-assign var=address value=$billboard->getAddress()-|
					|-assign var=circuit value=$address->getCircuit()-|
					
					|-if count($address->getPreviousThemes($date,$theme->getId())) gt 0-|
						|-assign var=previous value=$address->getPreviousThemes($date,$theme->getId())-|
						|-assign var="toDistributeCounter" value=$address->getToBePublishedCount($date,$theme->getId())-|
						|-foreach from=$previous item=aPreviousHolder name=for_previous-|
						<tr>
							<td>
								|-$circuit->getName()-|
							</td>
							<td>
								|-$address->getName()-|
							</td>
							<td align="center">|-$aPreviousHolder.counter-|</td>
								|-assign var="toDistributeCounter" value=$toDistributeCounter-$aPreviousHolder.counter-|
							<td>
								|-assign var=aPrevious value=$aPreviousHolder.theme-|
								|-$aPrevious->getName()-||-if $aPreviousHolder.counter gt 1-| (|-$aPreviousHolder.counter-|)|-/if-|
							</td>
							<td>
								|-assign var=workforce value=$advertisement->getWorkforce()-|
								|-if $workforce neq ''-||-$workforce->getName()-||-/if-|
							</td>
						</tr>
						|-/foreach-|
						|-if $toDistributeCounter gt 0-|
						<tr>
							<td>
								|-$circuit->getName()-|
							</td>
							<td>
								|-$address->getName()-|
							</td>
							<td align="center">|-$toDistributeCounter-|</td>
							<td>
							</td>
							<td>
								|-assign var=workforce value=$advertisement->getWorkforce()-|
								|-if $workforce neq ''-||-$workforce->getName()-||-/if-|
							</td>
						</tr>						
						|-/if-|
					|-else-|
					<tr>
						<td>
							|-$circuit->getName()-|
						</td>
						<td>
							|-$address->getName()-|
						</td>
						<td align="center">|-$address->getToBePublishedCount($date,$theme->getId())-|</td>					
						<td>|-assign var=previous value=$address->getPreviousThemes($date,$theme->getId())-|
							|-foreach from=$previous item=aPreviousHolder name=for_previous-|
								|-assign var=aPrevious value=$aPreviousHolder.theme-|
								|-$aPrevious->getName()-||-if $aPreviousHolder.counter gt 1-| (|-$aPreviousHolder.counter-|)|-/if-||-if $smarty.foreach.for_previous.last-|.|-else-|, |-/if-|
							|-/foreach-|
						</td>
						<td>
							|-assign var=workforce value=$advertisement->getWorkforce()-|
							|-if $workforce neq ''-||-$workforce->getName()-||-/if-|
						</td>
					</tr>
					|-/if-|
				|-/foreach-|						
				</tbody>
			</table>
	|-/if-|
</p>
|-/foreach-|
</div>

|-if $reportMode eq 'print'-|
	<table border="0" cellpadding="4" cellspacing="0" id="tabla-advertisements" class="tableTdBorders">
		<thead>
			<tr>
				<th colspan="5"><h3>Direcciones Ordenadas</h3></th>
			</tr>
			<tr>
				<th>Circuito</th>
				<th>Dirección</th>
			</tr>
		</thead>
		<tbody>
		|-foreach from=$results item=result-|
			|-foreach from=$result.addresses item=address-|
				<tr>
					|-assign var=address value=$address.address-|
					|-assign var=circuit value=$address->getCircuit()-|
					<td>|-$circuit->getName()-|</td>
					<td>|-$address-|</td>
				</tr>
			|-/foreach-|
		|-/foreach-|
		</tbody>
	</table>
|-/if-|

<div class="noPrint">
	|-include file="LausiReportsRouteSheetMapInclude.tpl"-|
</div>
