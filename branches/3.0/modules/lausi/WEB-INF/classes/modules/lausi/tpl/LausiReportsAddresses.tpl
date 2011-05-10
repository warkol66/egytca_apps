<h2>Reportes</h2>
<h1>Reporte de Direcciones</h1>

<div id="div_billboards">
|-if $reportMode neq 'print'-|
	<p>
	<fieldset>
		<legend>Reporte de Direcciones</legend>

		<form action="Main.php" method="get">
			<p>
				<label for="type">Tipo de Cartelera</label>
					<select name="type" id="type" >
						<option value="" |-if isset($type) and $type eq 0-|selected="selected"|-/if-|>Seleccione Tipo de Cartelera</option>
						<option value="1" |-if isset($type) and $type eq 1-|selected="selected"|-/if-|>Doble</option>
						<option value="2" |-if isset($type) and $type eq 2-|selected="selected"|-/if-|>Sextuple</option>
					</select>
			</p>
			<p>
				<label>Ver cantidades por dirección</label>
				<input type="checkbox" name="viewDetail" |-if isset($viewDetail)-|checked="checked"|-/if-|/>
			</p>
			<p style="margin-top: 20px;">
				<input type="hidden" name="reportMode" value="normal" id="reportMode"/>
				<input type="hidden" name="do" value="lausiReportsAddresses" />
				<input type="button" onclick="javascript:buildReport(this.form)" value="Generar reporte" name="submitForm"/>
				<input type="button" onclick="javascript:printReport(this.form)" value="Generar reporte para impresión" name="print"/>
				<input type="button" name="export" value="Exportar reporte a Excel" onClick="javascript:exportReport(this.form)"/>
			</p>
		</form>

	</fieldset>
	<p/>
|-/if-|
|- if (not empty($addresses)) -|
	<table border="0" cellpadding="4" cellspacing="0" id="tabla-billboards" class="tableTdBorders">
		<thead>
			<tr>

				<th width="25%">Dirección</th>
				|-if isset($viewDetail)-|
					|-if $type eq 1-|
					<th width="10%">Dobles</th>
					|-elseif $type eq 2-|
					<th width="10%">Séxtuples</th>
					|-else-|
					<th width="10%">Dobles</th>
					<th width="10%">Séxtuples</th>
					|-/if-|	
				|-/if-|
			</tr>
		</thead>
		<tbody>
		|-foreach from=$addresses item=address name=for_billboards-|
			<tr>
				<td>|-$address->getName()-|</td>
				|-if isset($viewDetail)-|
					|-if $type eq 1-|
					<td>|-$address->getBillboardCountByType(1)-|</td>
					|-elseif $type eq 2-|
					<td>|-$address->getBillboardCountByType(2)-|</td>
					|-else-|
					<td>|-if $address->getBillboardCountByType(1) ne 0-||-$address->getBillboardCountByType(1)-||-/if-|</td>
					<td>|-if $address->getBillboardCountByType(2) ne 0-||-$address->getBillboardCountByType(2)-||-/if-|</td>
					|-/if-|	
				|-/if-|
			</tr>
		|-/foreach-|					
		|-if isset($pager) and $pager->haveToPaginate()-|
			<tr> 
				<td colspan="|-if isset($viewDetail)-||-if isset($type)-|2|-else-|3|-/if-||-else-|1|-/if-|" class="pages">|-include file="ModelPagerInclude.tpl"-|</td> 
			</tr>							
		|-/if-|
		</tbody>
	</table>
|-/if-|
</div>
