<h2>Administración de Carteleras</h2>
<h1>Listado de Carteleras</h1>
<p>
|-if isset($address) -|
<form action="Main.php" method="get">
	|-if isset($listRedirect)-|
		|-if isset($listRedirect.circuitId)-|
			<input type="hidden" name="listRedirect[circuitId]" value="|-$listRedirect.circuitId-|"></input>
		|-/if-|
		|-if isset($listRedirect.regionId)-|
			<input type="hidden" name="listRedirect[regionId]" value="|-$listRedirect.regionId-|"></input>
		|-/if-|
		|-if isset($listRedirect.rating)-|
			<input type="hidden" name="listRedirect[rating]" value="|-$listRedirect.rating-|"></input>
		|-/if-|
		|-if isset($listRedirect.streetName)-|
			<input type="hidden" name="listRedirect[streetName]" value="|-$listRedirect.streetName-|"></input>
		|-/if-|
		|-if isset($listRedirect.page)-|
			<input type="hidden" name="listRedirect[page]" value="|-$listRedirect.page-|"></input>
		|-/if-|
	|-/if-|
	<input type="hidden" name="id" value="|-$address->getId()-|" id="addressId">
	<input type="hidden" name="do" value="lausiAddressesEdit">
	<p><input type="submit" value="Volver a Dirección |-$address->getName()-|"></p>
</form>
|-/if-|
</p>
<div id="div_billboards">
	|-if $message eq "ok"-|
		<div class="successMessage">Cartelera guardada correctamente</div>
	|-elseif $message eq "deleted_ok"-|
		<div class="successMessage">Cartelera eliminada correctamente</div>
	|-/if-|

|-if not isset($address) -|
	<p>
	<fieldset>
		<legend>Filtros de Cartelera</legend>
		<form action="Main.php" method="get">
			<p>
				<label for="theme">Motivo</label>
				<select name="themeId">
					<option value="">Seleccione un Motivo</option>
					|-foreach from=$themes item=theme name=for_theme-|
						<option value="|-$theme->getId()-|" |-if isset($themeId) and $themeId eq $theme->getId()-|selected="selected"|-/if-|>|-$theme->getName()-|</option>
					|-/foreach-|
				</select>
			</p>	
			<p>
				<label for="region">Barrio</label>
				<select name="regionId">
					<option value="">Seleccione un Barrio</option>
					|-foreach from=$regions item=region name=for_regions-|
						<option value="|-$region->getId()-|" |-if isset($regionId) and $regionId eq $region->getId()-|selected="selected"|-/if-|>|-$region->getName()-|</option>
					|-/foreach-|
				</select>
			</p>	
			<p>
				<label for="circuit">Circuito</label>
				<select name="circuitId">
					<option value="">Seleccione un Circuito</option>
					|-foreach from=$circuits item=circuit name=for_circuit-|
						<option value="|-$circuit->getId()-|" |-if isset($circuitId) and $circuitId eq $circuit->getId()-|selected="selected"|-/if-|>|-$circuit->getName()-|</option>
					|-/foreach-|
				</select>				
			</p>
			<p>
				<label for="type">Tipo de Cartelera</label>
					<select name="type" id="type" >
						<option value="0" |-if isset($type) and $type eq 0-|selected="selected"|-/if-|>Seleccione Tipo de Cartelera</option>
						<option value="1" |-if isset($type) and $type eq 1-|selected="selected"|-/if-|>Doble</option>
						<option value="2" |-if isset($type) and $type eq 2-|selected="selected"|-/if-|>Sextuple</option>
					</select>
			</p>
			<p>
				<label for="rating">Valoración</label>
					<select name="rating" id="rating" >
						<option value="0" |-if isset($rating) and $rating lt 1-|selected="selected"|-/if-|>Seleccione Valoración</option>
						<option value="1" |-if isset($rating) and $rating eq 1-|selected="selected"|-/if-|>Premium</option>
						<option value="2" |-if isset($rating) and $rating eq 2-|selected="selected"|-/if-|>Superior</option>
						<option value="3" |-if isset($rating) and $rating eq 3-|selected="selected"|-/if-|>Destacada</option>
						<option value="4" |-if isset($rating) and $rating eq 4-|selected="selected"|-/if-|>Standart</option>
					</select>
			</p>
			<p>
				<label>Ver detalle por dirección</label>
				<input type="checkbox" name="groupByAddress" |-if not isset($groupByAddress)-|checked="checked"|-/if-|/>
			</p>
			<p style="margin-top: 20px;">
				<input type="hidden" name="do" value="lausiBillboardsList" />
				<input type="submit" value="Aplicar Filtro" />
			</p>
		</form>
	</fieldset>
	<p/>
|-/if-|

	<table border="0" cellpadding="4" cellspacing="0" id="tabla-billboards" class="tableTdBorders">
		<thead>
			|-if $all eq "1"-|			
			<tr>
				 <th colspan="9" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=lausiBillboardsEdit" class="addLink">Agregar Cartelera</a></div></th>
			</tr>
			|-/if-|
			<tr>
				|-if isset($address) -|
				<th>&nbsp;</th>
				|-/if-|
				<th width="25%">Dirección</th>
			|-if not isset($groupByAddress) and not isset($groupByType)-|
				<th>Número</th>
			|-/if-|
			|-if isset($groupByAddress) and not isset($groupByType)-|
				<th width="10%">Carteleras</th>
			|-/if-|
			|-if isset($groupByType)-|
				<th width="5%">Carteleras</th>
			|-/if-|
			|-if not isset($groupByAddress) and not isset($groupByType)-|
				<th>Tipo</th>
				<th width="5%">En Altura</th>
				<th width="5%">Fila</th>
				<th width="5%">Columna</th>
			|-/if-|
			|-if not isset($themeId)-|
				<th width="25%">Motivos en Dirección </th>
			|-/if-|
			|-if not isset($groupByAddress) and not isset($groupByType)-|
				<th width="5%">&nbsp;</th>
			|-/if-|
			</tr>
		</thead>
		<tbody>
		|-foreach from=$billboards item=billboard name=for_billboards-|
			<tr>
				|-assign var=address value=$billboard->getAddress()-|		
				<td>
					|-$address->getName()-|
				</td>
			|-if not isset($groupByAddress) and not isset($groupByType)-|
				<td>|-$billboard->getNumber()-|</td>
			|-/if-|
			|-if isset($groupByAddress) and not isset($groupByType)-|
				<td>
					Dobles:|-$address->getBillboardCountByType(1)-|<br/>
					Sextuples:|-$address->getBillboardCountByType(2)-|
				</td>
			|-/if-|
			|-if isset($groupByType)-|
				<td>
					|-assign var=address value=$billboard->getAddress()-|
					|-$billboard->getTypeName()-|: |-$address->getBillboardCountByType($billboard->getType())-|
				</td>
			|-/if-|
			|-if not isset($groupByAddress) and not isset($groupByType)-|
				<td>|-$billboard->getTypeName()-|</td>
				<td>|-$billboard->getHeight()|si_no-|</td>
				<td>|-$billboard->getRow()-|</td>
				<td>|-$billboard->getColumn()-|</td>
			|-/if-|
			|-if not isset($themeId)-|
				|-if not isset($groupByAddress) -|
					<!--caso carteleras -->
					<td>|-if ($billboard->isAvailableToday())-|No|-else-|Si (|-assign var=theme value=$billboard->getCurrentTheme()-||-$theme->getName()-|)|-/if-|</td>
				|-else-|
					<!--caso agrupado por direccion -->
					<td>|-assign var=aThemes value=$address->getCurrentThemes()-|
						|-if ($aThemes|@count eq 0)-| - |-else-|(|-foreach from=$aThemes item=aTheme name=aTheme-||-$aTheme->getName()-||-if $smarty.foreach.aTheme.last-|.|-else-|, |-/if-||-/foreach-|)|-/if-|
					</td>
				|-/if-|
			|-/if-|
			
			|-if not isset($groupByAddress) and not isset($groupByType)-|
				<td nowrap>
					<form action="Main.php" method="get">
						|-if isset($listRedirect)-|
							|-if isset($listRedirect.circuitId)-|
								<input type="hidden" name="listRedirect[circuitId]" value="|-$listRedirect.circuitId-|"></input>
							|-/if-|
							|-if isset($listRedirect.regionId)-|
								<input type="hidden" name="listRedirect[regionId]" value="|-$listRedirect.regionId-|"></input>
							|-/if-|
							|-if isset($listRedirect.rating)-|
								<input type="hidden" name="listRedirect[rating]" value="|-$listRedirect.rating-|"></input>
							|-/if-|
							|-if isset($listRedirect.streetName)-|
								<input type="hidden" name="listRedirect[streetName]" value="|-$listRedirect.streetName-|"></input>
							|-/if-|
							|-if isset($listRedirect.page)-|
								<input type="hidden" name="listRedirect[page]" value="|-$listRedirect.page-|"></input>
							|-/if-|							
						|-/if-|
						<input type="hidden" name="do" value="lausiBillboardsEdit" />
						<input type="hidden" name="id" value="|-$billboard->getid()-|" />
						<input type="submit" name="submit_go_edit_billboard" value="Editar" class="iconEdit" />
					</form>
					<form action="Main.php" method="post">
						|-if isset($listRedirect)-|
							|-if isset($listRedirect.circuitId)-|
								<input type="hidden" name="listRedirect[circuitId]" value="|-$listRedirect.circuitId-|"></input>
							|-/if-|
							|-if isset($listRedirect.regionId)-|
								<input type="hidden" name="listRedirect[regionId]" value="|-$listRedirect.regionId-|"></input>
							|-/if-|
							|-if isset($listRedirect.rating)-|
								<input type="hidden" name="listRedirect[rating]" value="|-$listRedirect.rating-|"></input>
							|-/if-|
							|-if isset($listRedirect.streetName)-|
								<input type="hidden" name="listRedirect[streetName]" value="|-$listRedirect.streetName-|"></input>
							|-/if-|
							|-if isset($listRedirect.page)-|
								<input type="hidden" name="listRedirect[page]" value="|-$listRedirect.page-|"></input>
							|-/if-|							
						|-/if-|
						<input type="hidden" name="do" value="lausiBillboardsDoDelete" />
						<input type="hidden" name="id" value="|-$billboard->getid()-|" />
						<input type="submit" name="submit_go_delete_billboard" value="Borrar" onclick="return confirm('Seguro que desea eliminar el billboard?')" class="iconDelete" />
					</form>								
				</td>
			|-/if-|

			</tr>
		|-/foreach-|					
		|-if $all eq "1"-|	
		|-if $pager->getTotalPages() gt 1-|
			<tr> 
				<td colspan="8" class="pages">|-include file="PaginateInclude.tpl"-|</td> 
			</tr>							
		|-/if-|						
			<tr>
				 <th colspan="8" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=lausiBillboardsEdit" class="addLink">Agregar Cartelera</a></div></th>
			</tr>
		|-else-|
			<tr>
				 <th colspan="9" class="thFillTitle">
				 	<input type="button" name="selection" value="Seleccionar Todas" id="selection" onClick="javascript:setSelectionBillboards(true)">
					<input type="button" name="selection" value="Deseleccionar Todas" id="selection" onClick="javascript:setSelectionBillboards(false)">
					<form action="Main.php" method="post" id="selectedDeletionForm">

						|-if isset($listRedirect)-|
							|-if isset($listRedirect.circuitId)-|
								<input type="hidden" name="listRedirect[circuitId]" value="|-$listRedirect.circuitId-|"></input>
							|-/if-|
							|-if isset($listRedirect.regionId)-|
								<input type="hidden" name="listRedirect[regionId]" value="|-$listRedirect.regionId-|"></input>
							|-/if-|
							|-if isset($listRedirect.rating)-|
								<input type="hidden" name="listRedirect[rating]" value="|-$listRedirect.rating-|"></input>
							|-/if-|
							|-if isset($listRedirect.streetName)-|
								<input type="hidden" name="listRedirect[streetName]" value="|-$listRedirect.streetName-|"></input>
							|-/if-|
							|-if isset($listRedirect.page)-|
								<input type="hidden" name="listRedirect[page]" value="|-$listRedirect.page-|"></input>
							|-/if-|							
						|-/if-|						
						
						<input type="hidden" name="do" value="lausiBillboardsDoDelete" />
						<input type="button" name="submit_go_delete_billboard" value="Eliminar Seleccionados" onclick="javascript:deleteSelectedBillboards()" />
					</form>
						
				 </th>
			</tr>
		|-/if-|
		</tbody>
	</table>
</div>
