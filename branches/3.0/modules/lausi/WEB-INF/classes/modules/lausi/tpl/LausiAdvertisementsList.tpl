|- if $clientReport neq 1-|
<h2>Distribución de Motivos</h2>
<h1>Disposición de Avisos</h1>
|-else-|
<h2>Reportes</h2>
<h1>De Avisos para Clientes</h1>
|-/if-|
<div id="div_advertisements">
|-if $message eq "ok"-|
	<div class="successMessage">Aviso guardado correctamente</div>
|-elseif $message eq "deleted_ok"-|
	<div class="successMessage">Aviso eliminado correctamente</div>
|-elseif $message eq "failure_overlapping"-|
	<div class="errorMessage">No se han guardado las modificaciones, Hay superposicion.</div>
|-/if-|
|-if $printReport eq ''-|
	<fieldset>
		<legend>Reportes</legend>
		<form action="Main.php" method="get">
			<p>
				<label for="filters[searchThemeId]">Motivo</label>
				<select name="filters[searchThemeId]">
						<option value="">Seleccione un Motivo</option>
					|-foreach from=$themes item=theme name=for_themes-|
						<option value="|-$theme->getId()-|" |-$theme->getId()|selected:$filters.searchThemeId-|>|-$theme->getName()-| - |-$theme->getShortName()-|</option>
					|-/foreach-|
				</select>
			</p>
			<p>
				<label for="filters[searchClientId]">Cliente</label>
				<select name="filters[searchClientId]">
					<option value="">Seleccione un Cliente</option>
					|-foreach from=$clients item=client name=for_clients-|
						<option value="|-$client->getId()-|" |-$client->getId()|selected:$filters.searchClientId-|>|-$client->getName()-|</option>
					|-/foreach-|
				</select>
			</p>
|- if $clientReport neq 1-|
			<p>
				<label for="filters[searchType]">Tipo de Cartelera</label>
				<select name="filters[searchType]" id="type" >
					<option value="0" |-0|selected:$filters.searchType-|>Seleccione Tipo de Cartelera</option>
					<option value="1" |-1|selected:$filters.searchType-|>Doble</option>
					<option value="2" |-2|selected:$filters.searchType-|>Séxtuple</option>
				</select>
			</p>
			<p>
				<label for="filters[searchCircuitId]">Circuito</label>
				<select name="filters[searchCircuitId]">
					<option value="">Seleccione un Circuito</option>
					|-foreach from=$circuits item=circuit name=for_circuits-|
						<option value="|-$circuit->getId()-|" |-$circuit->getId()|selected:$filters.searchCircuitId-|>|-$circuit->getName()-|</option>
					|-/foreach-|
				</select>
			</p>
|-/if-|			
			<p>
				<label for="filters[searchFromDate]">Fecha Desde</label>
				<input name="filters[searchFromDate]" type="text" id="fromDate" title="fromDate" value="|-$filters.searchFromDate|date_format-|" size="12" /> 
				<img src="images/calendar.png" width="16" height="15" border="0" onclick="displayDatePicker('filters[searchFromDate]', false, '|-$parameters.dateFormat.value|lower|replace:'-':''-|', '-');" title="Seleccione la fecha">
			</p>
			<p>
				<label for="filters[searchToDate]">Fecha Hasta</label>
				<input name="filters[searchToDate]" type="text" id="toDate" title="toDate" value="|-$filters.searchToDate|date_format-|" size="12" /> 
				<img src="images/calendar.png" width="16" height="15" border="0" onclick="displayDatePicker('filters[searchToDate]', false, '|-$parameters.dateFormat.value|lower|replace:'-':''-|', '-');" title="Seleccione la fecha">
			</p>
|- if $clientReport neq 1-|			
			<p>
				<label>Mostrar Avisos de Motivos Activos e Inactivos</label>
				<input type="checkbox" name="allThemes" value="checked" |-if isset($allThemes)-|checked="checked"|-/if-|/>
			</p>
|-/if-|			
			<p>
				<label>No Agrupar por Dirección y Motivo</label>
				<input type="checkbox" name="noGroupByAddressAndTheme" value="1" |-$noGroupByAddressAndTheme|checked:1-|/>
			</p>
|- if $clientReport eq 1-|	
			<p>
				<label>Solo direcciones por cliente</label>
				<input type="checkbox" name="onlyAddresses" value="1" |-$onlyAddresses|checked:1-|/>
			</p>
|-/if-|				
			<p>
				<input type="hidden" name="do" value="lausiAdvertisementsList" />	
				|-if $clientReport eq 1-|
					<input type="hidden" name="clientReport" value="1"/>
				|-/if-|
				<input type="hidden" name="reportMode" value="normal" id="reportMode"/>
				<input type="button"  name="submitForm" value="Generar reporte"  onClick="javascript:buildReport(this.form)"/>
				<input type="button" name="print" value="Generar reporte para impresión" onClick="javascript:printReport(this.form)"/>
				<input type="button" name="export" value="Exportar reporte a Excel" onClick="javascript:exportReport(this.form)"/>
			</p>
		</form>
	</fieldset>
|-/if-|
	<br />

	

|-if $advertisements|@count gt 0-|
	|-if $noGroupByAddressAndTheme neq '1'-|
		<table border="0" cellpadding="4" cellspacing="0" id="tabla-advertisements" class="tableTdBorders">
			<thead>
				|-if $printReport eq ''-|
				<tr>
					 <th colspan="3" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=lausiAdvertisementsEdit|-include file='FiltersRedirectUrlInclude.tpl' filters=$filters-||-if isset($pager) && ($pager->getPage() ne 1)-|&page=|-$pager->getPage()-||-/if-|" class="addLink">Agregar Aviso</a></div></th>
				</tr>
				|-/if-|
				<tr>
					<th>Dirección</th>
					<th>Motivo</th>
					|-if $onlyAddresses eq ''-|
					<th>Avisos</th>
					|-/if-|
				</tr>
			</thead>
			<tbody>
			|-foreach from=$advertisements item=advertisement name=for_advertisements-|
				<tr>
					<td>
						|-assign var=billboard value=$advertisement->getBillboard()-|
						|-if $billboard-||-assign var=address value=$billboard->getAddress()-||-/if-|
						|-if $address-||-$address->getName()-||-/if-|						
					</td>
					<td>
						|-assign var=theme value=$advertisement->getTheme()-|
						|-if $theme-||-$theme->getShortName()-||-/if-|
					</td>
					|-if $onlyAddresses eq ''-|
					<td>
						|-$advertisement->getThemesCount()-|
					</td>
					|-/if-|
				</tr>
			|-/foreach-|						
				|-if $pager neq '' and $pager->haveToPaginate()-|
				<tr> 
					<td colspan="3" class="pages">|-include file="ModelPagerInclude.tpl"-|</td> 
				</tr>
				|-/if-|								
				|-if $printReport eq ''-|
				<tr>
					 <th colspan="3" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=lausiAdvertisementsEdit|-include file='FiltersRedirectUrlInclude.tpl' filters=$filters-||-if isset($pager) && ($pager->getPage() ne 1)-|&page=|-$pager->getPage()-||-/if-|" class="addLink">Agregar Aviso</a></div></th>
				</tr>
				|-/if-|
			</tbody>
		</table>	
	|-else-|
		<table border="0" cellpadding="4" cellspacing="0" id="tabla-advertisements" class="tableTdBorders">
			<thead>
				|-if $printReport eq ''-|
				<tr>
					 <th colspan="9" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=lausiAdvertisementsEdit|-include file='FiltersRedirectUrlInclude.tpl' filters=$filters-||-if isset($pager) && ($pager->getPage() ne 1)-|&page=|-$pager->getPage()-||-/if-|" class="addLink">Agregar Aviso</a></div></th>
				</tr>
				|-/if-|
				<tr>
					<th>Circuito</th>
					<th>Dirección</th>
					<th>Motivo</th>
				|-if $onlyAddresses eq ''-|
					<th>Tipo</th>
					<th>Cartelera</th>
					<th>Desde</th>
					<th>Hasta</th>
					|-if $printReport eq ''-|
					<th>&nbsp;</th>
					|-/if-|
				|-/if-|
				</tr>
			</thead>
			<tbody>
			|-foreach from=$advertisements item=advertisement name=for_advertisements-|
			<tr>
					|-assign var=theme value=$advertisement->getTheme()-|
					|-assign var=billboard value=$advertisement->getBillboard()-|
					|-if $billboard-||-assign var=address value=$billboard->getAddress()-||-/if-|
					|-if $address-||-assign var=circuit value=$address->getCircuit()-||-/if-|

				<td>
					|-if $circuit ne ''-||-$circuit->getName()-||-/if-|
				</td>
				<td>
					|-if $address ne ''-||-$address->getName()-||-/if-|
				</td>
				
				
				<td>|-if $theme ne ''-||-$theme->getShortName()-||-/if-|</td>
				|-if $onlyAddresses eq ''-|
				<td>|-if $theme ne ''-||-$theme->getTypeName()-||-/if-|</td>
				<td>|-$billboard->getNumber()-|</td>
				<td align="center">
					|-$advertisement->getPublishDate()|date_format:"%d-%m-%Y"-|
				</td>
				<td align="center">
					|-$advertisement->getEndDate()|date_format:"%d-%m-%Y"-|
				</td>
					|-if $printReport eq ''-|
					<td>
						<form action="Main.php" method="get">
							<input type="hidden" name="do" value="lausiAdvertisementsEdit" />
							<input type="hidden" name="id" value="|-$advertisement->getId()-|" />
							<input type="submit" name="submit_go_edit_advertisement" value="Editar" class="iconEdit" />
							|-if $clientReport eq 1-|
								<input type="hidden" name="clientReport" value="1"/>
							|-/if-|
						</form>
						<form action="Main.php" method="post">
							<input type="hidden" name="do" value="lausiAdvertisementsDoDelete" />
							<input type="hidden" name="id" value="|-$advertisement->getId()-|" />
							<input type="submit" name="submit_go_delete_advertisement" value="Borrar" onclick="return confirm('Seguro que desea eliminar el aviso?')" class="iconDelete" />
							|-if $clientReport eq 1-|
								<input type="hidden" name="clientReport" value="1"/>
							|-/if-|
						</form>
					</td>
					|-/if-|
				|-/if-|
				</tr>
			|-/foreach-|						
			|-if $pager neq '' and $pager->haveToPaginate()-|
				<tr> 
					<td colspan="9" class="pages">|-include file="ModelPagerInclude.tpl"-|</td> 
				</tr>							
			|-/if-|						
				|-if $printReport eq ''-|
				<tr>
					 <th colspan="9" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=lausiAdvertisementsEdit|-include file='FiltersRedirectUrlInclude.tpl' filters=$filters-||-if isset($pager) && ($pager->getPage() ne 1)-|&page=|-$pager->getPage()-||-/if-|" class="addLink">Agregar Aviso</a></div></th>
				</tr>
				|-/if-|
			</tbody>
		</table>
	|-/if-|
|-/if-|

</div>
