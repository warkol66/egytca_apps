<h2>Reportes</h2>
<h1>Reporte por Motivos por Circuito</h1>
<div id="themesCircuitReportForm">
	<form action="Main.php" method="get" class="noPrint">
		<fieldset>
		<p>	<label for='themeId'>Motivo</label>
			<select name="themeId" >
				|-foreach from=$themes item=theme-|
						<option value="|-$theme->getId()-|" |-if not $themeSelected eq '' and $themeSelected->getId() eq $theme->getId()-|selected="selected"|-/if-|>|-$theme->getName()-|</option>
				|-/foreach-|
			</select>
		</p>
		<p>
			<input type="hidden" name="do" value="lausiReportsThemesCircuit" />
			<input type="submit" value="Generar Reporte" />
		</p>
		</fieldset>
	</form>
|-if not empty($result)-|	
|-if $themeSelected neq ''-|<h2>Motivo: |-$themeSelected->getName()-|</h2>|-/if-|
	|-foreach from=$result item=resultItem-|
	|-assign var=circuit value=$resultItem.circuit-|
	|-assign var=addresses value=$resultItem.addresses-|
	
	<table width="600" class="tableTdBorders">
		<thead>
			<tr>
				<th colspan='5'>Circuito: |-$circuit->getName()-|</th>
			</tr>
			<tr>
				<th width="60%">Direccion</th>
				<th width="25%">Motivo</th>
				<th width="5%" nowrap="nowrap">Tipo</th>				
				<th width="5%" nowrap="nowrap">Carteleras</th>
				<th width="5%" nowrap="nowrap">Afiches</th>
			</tr>					
		</thead>
		<tbody>
		|-foreach from=$addresses item=addressItem-|
			|-assign var=address value=$addressItem.address-|
		<tr>
			<td>|-$address->getName()-|</td>				
			<td>|-$themeSelected->getName()-|</td>
			<td>|-$themeSelected->getTypeName()-|</td>
			|-assign var=billboards value=$addressItem.count-|
			<td>|- $billboards-|</td>
			|-if $themeSelected->getType() eq 1-|
				|-assign var=sheets value=$billboards*2-|
			|-else-|
				|-assign var=sheets value=$billboards-|
			|-/if-|			
			<td>|-$sheets-|</td>
		</tr>
		|-/foreach-|
		<tr>
			<td colspan='5'></td>
		</tr>
		<tr>
			<td colspan='3'>Total</td>				
			|-assign var=billboards value=$circuit->getBillboardsOccupiedByThemeTodayCount($themeSelected)-|
			<td>|- $billboards-|</td>
			|-if $themeSelected->getType() eq 1-|
				|-assign var=sheets value=$billboards*2-|
			|-else-|
				|-assign var=sheets value=$billboards-|
			|-/if-|			
			<td>|-$sheets-|</td>
		</tr>
		</tbody>
	</table>
	<br />
	|-/foreach-|
	
	|-include file="LausiReportsPrintLinkInclude.tpl"-|
		
|-/if-|
</div>