<h2>Administración de Carteleras</h2>
<h1>Listado de Carteleras</h1>
<p>
|-if isset($address)-|
<form action="Main.php" method="get">
	|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
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
				<label for="filters[searchThemeId]">Motivo</label>
				<select name="filters[searchThemeId]">
					<option value="">Seleccione un Motivo</option>
					|-foreach from=$themes item=theme name=for_theme-|
						<option value="|-$theme->getId()-|" |-$theme->getId()|selected:$filters.searchThemeId-|>|-$theme->getName()-|</option>
					|-/foreach-|
				</select>
			</p>	
			<p>
				<label for="filters[searchRegionId]">Barrio</label>
				<select name="filters[searchRegionId]">
					<option value="">Seleccione un Barrio</option>
					|-foreach from=$regions item=region name=for_regions-|
						<option value="|-$region->getId()-|" |-$region->getId()|selected:$filters.searchRegionId-|>|-$region->getName()-|</option>
					|-/foreach-|
				</select>
			</p>	
			<p>
				<label for="filters[searchCircuitId]">Circuito</label>
				<select name="filters[searchCircuitId]">
					<option value="">Seleccione un Circuito</option>
					|-foreach from=$circuits item=circuit name=for_circuit-|
						<option value="|-$circuit->getId()-|" |-$circuit->getId()|selected:$filters.searchCircuitId-|>|-$circuit->getName()-|</option>
					|-/foreach-|
				</select>				
			</p>
			<p>
				<label for="filters[searchType]">Tipo de Cartelera</label>
					<select name="filters[searchType]" id="filters[searchType]" >
						<option value="0" |-0|selected:$filters.searchType-|>Seleccione Tipo de Cartelera</option>
						<option value="1" |-1|selected:$filters.searchType-|>Doble</option>
						<option value="2" |-2|selected:$filters.searchType-|>Sextuple</option>
					</select>
			</p>
			<p>
				<label for="filters[searchRating]">Valoración</label>
					<select name="filters[searchRating]" id="filters[searchRating]" >
						<option value="0" |-0|selected:$filters.searchRating-|>Seleccione Valoración</option>
						<option value="1" |-1|selected:$filters.searchRating-|>Premium</option>
						<option value="2" |-2|selected:$filters.searchRating-|>Superior</option>
						<option value="3" |-3|selected:$filters.searchRating-|>Destacada</option>
						<option value="4" |-4|selected:$filters.searchRating-|>Standart</option>
					</select>
			</p>
			<p>
				<label for="filters[searchGroupByAddress]">Ver detalle por dirección</label>
				<input type="checkbox" name="filters[searchGroupByAddress]" |-$filters.searchGroupByAddress|checked:1-| value="1"/>
			</p>
			<p>
				<label for="filters[searchGroupByType]">Ver detalle por tipo</label>
				<input type="checkbox" name="filters[searchGroupByType]" |-$filters.searchGroupByType|checked:1-| value="1"/>
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
				 <th colspan="9" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=lausiBillboardsEdit|-include file='FiltersRedirectUrlInclude.tpl' filters=$filters-||-if isset($pager) && ($pager->getPage() ne 1)-|&page=|-$pager->getPage()-||-/if-|" class="addLink">Agregar Cartelera</a></div></th>
			</tr>
			|-/if-|
			<tr>
				|-if isset($address) -|
				|-else-|
				<th width="25%">Dirección</th>
				|-/if-|
			|-if not isset($filters.searchGroupByAddress) and not isset($filters.searchGroupByType)-|
				<th>Número</th>
			|-/if-|
			|-if isset($filters.searchGroupByAddress) and not isset($filters.searchGroupByType)-|
				<th width="10%">Carteleras</th>
			|-/if-|
			|-if isset($filters.searchGroupByType)-|
				<th width="5%">Carteleras</th>
			|-/if-|
			|-if not isset($filters.searchGroupByAddress) and not isset($filters.searchGroupByType)-|
				<th>Tipo</th>
				<th width="5%">En Altura</th>
				<th width="5%">Fila</th>
				<th width="5%">Columna</th>
			|-/if-|
			|-if not isset($themeId)-|
				<th width="25%">Disponible (Motivo)</th>
			|-/if-|
			|-if not isset($filters.searchGroupByAddress) and not isset($filters.searchGroupByType)-|
				<th width="5%">&nbsp;</th>
			|-/if-|
			</tr>
		</thead>
		<tbody>
		|-foreach from=$billboards item=billboard name=for_billboards-|
			<tr>
			|-if isset($address)-|
			|-else-|
				|-assign var=currentAddress value=$billboard->getAddress()-|		
				<td>
					|-$currentAddress->getName()-|
				</td>
			|-/if-|
			|-if not isset($filters.searchGroupByAddress) and not isset($filters.searchGroupByType)-|
				<td>|-$billboard->getNumber()-|</td>
			|-/if-|
			|-if isset($filters.searchGroupByAddress) and not isset($filters.searchGroupByType)-|
				<td>
					Dobles:|-$currentAddress->getBillboardCountByType(1)-|<br/>
					Sextuples:|-$currentAddress->getBillboardCountByType(2)-|
				</td>
			|-/if-|
			|-if isset($filters.searchGroupByType)-|
				<td>
					|-assign var=currentAddress value=$billboard->getAddress()-|
					|-$billboard->getTypeName()-|: |-$currentAddress->getBillboardCountByType($billboard->getType())-|
				</td>
			|-/if-|
			|-if not isset($filters.searchGroupByAddress) and not isset($filters.searchGroupByType)-|
				<td>|-$billboard->getTypeName()-|</td>
				<td>|-$billboard->getHeight()|si_no-|</td>
				<td>|-$billboard->getRow()-|</td>
				<td>|-$billboard->getColumn()-|</td>
			|-/if-|
			|-if not isset($themeId)-|
				|-if not isset($filters.searchGroupByAddress) -|
					<!--caso carteleras -->
					<td>|-if ($billboard->isAvailableToday())-|Si|-else-|No (|-assign var=theme value=$billboard->getCurrentTheme()-||-if !empty($theme)-||-$theme->getName()-||-else-|-|-/if-|)|-/if-|</td>
				|-else-|
					<!--caso agrupado por direccion -->
					<td>|-assign var=aThemes value=$currentAddress->getCurrentThemes()-|
						|-if ($aThemes|@count eq 0)-| - |-else-|(|-foreach from=$aThemes item=aTheme name=aTheme-||-$aTheme->getName()-||-if $smarty.foreach.aTheme.last-|.|-else-|, |-/if-||-/foreach-|)|-/if-|
					</td>
				|-/if-|
			|-/if-|
			
			|-if not isset($filters.searchGroupByAddress) and not isset($filters.searchGroupByType)-|
				<td nowrap>
					<form action="Main.php" method="get">
						|-include file="FiltersRedirectInclude.tpl"-|
						<input type="hidden" name="do" value="lausiBillboardsEdit" />
						<input type="hidden" name="id" value="|-$billboard->getid()-|" />
						<input type="submit" name="submit_go_edit_billboard" value="Editar" class="iconEdit" />
					</form>
					<form action="Main.php" method="post">
						|-include file="FiltersRedirectInclude.tpl"-|
						<input type="hidden" name="do" value="lausiBillboardsDoDelete" />
						<input type="hidden" name="id" value="|-$billboard->getid()-|" />
						<input type="submit" name="submit_go_delete_billboard" value="Borrar" onclick="return confirm('Seguro que desea eliminar el billboard?')" class="iconDelete" />
					</form>								
				</td>
			|-/if-|

			</tr>
		|-/foreach-|					
		|-if $all eq "1"-|	
			|-if $pager neq '' and $pager->haveToPaginate()-|
				<tr> 
					<td colspan="8" class="pages">|-include file="ModelPagerInclude.tpl"-|</td> 
				</tr>							
			|-/if-|						
			<tr>
				 <th colspan="8" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=lausiBillboardsEdit|-include file='FiltersRedirectUrlInclude.tpl' filters=$filters-||-if isset($pager) && ($pager->getPage() ne 1)-|&page=|-$pager->getPage()-||-/if-|" class="addLink">Agregar Cartelera</a></div></th>
			</tr>
		|-else-|
	<!--		<tr>
				 <th colspan="9" class="thFillTitle">
				 	<input type="button" name="selection" value="Seleccionar Todas" id="selection" onClick="javascript:setSelectionBillboards(true)">
					<input type="button" name="selection" value="Deseleccionar Todas" id="selection" onClick="javascript:setSelectionBillboards(false)">
					<form action="Main.php" method="post" id="selectedDeletionForm">
						|-include file="FiltersRedirectInclude.tpl"-|					
						<input type="hidden" name="do" value="lausiBillboardsDoDelete" />
						<input type="button" name="submit_go_delete_billboard" value="Eliminar Seleccionados" onclick="javascript:deleteSelectedBillboards()" />
					</form>
				 </th>
			</tr> -->
		|-/if-|
		</tbody>
	</table>
</div>
