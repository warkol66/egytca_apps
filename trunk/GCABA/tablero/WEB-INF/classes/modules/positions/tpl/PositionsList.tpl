<h2>##common,18,Configuración del Sistema##</h2>
<h1>Administración del Organigrama <!--(Versión |-$version-|)-->
<!-- /Link VOLVER -->
</h1>
<div id="positionsVersionEdit" style="display:none;">
|-include file="PositionsIncludeVersionEdit.tpl"-|
</div>
<p>A continuación podrá editar el organigrama. |-if ($browser->getBrowser() == 'Firefox' && $browser->getVersion() >= 3) || ($browser->getBrowser() == 'Internet Explorer' && $browser->getVersion() >= 7)-|
Puede ver la versión gráfica haciendo click <a href="Main.php?do=positionsChartView" target="_blank">aquí</a>
<a href="javascript:void(null);" class="tooltipWide"><span>(Sólo disponible para IExplorer 7 o mas reciente y Firefox 3.0 o mas reciente)</span><img src="images/clear.png" class="icon iconInfo"></a>
|-else-|
<a href="javascript:void(null);" class="tooltipWide"><span>(Una versión gráfica del organigrama está disponible utilizando un navegador IExplorer 7 o mas reciente y Firefox 3.0 o mas reciente)</span><img src="images/clear.png" class="icon iconInfo"></a>
|-/if-|</p>
<div id="div_positions">
	|-if $message eq "ok"-|
		<div class="successMessage">Posición guardada correctamente</div>
	|-elseif $message eq "deleted_ok"-|
		<div class="successMessage">Posición eliminada correctamente</div>
	|-/if-|
	<table border="0" cellpadding="5" cellspacing="0"  class='tableTdBorders' id="tabla-positions">
		<thead>
		<tr>
			<td colspan="5" class="tdSearch"><div><a href="javascript:void(null);" onClick='$("divSearch").toggle();' class="tdTitSearch">Buscar</a></div>
				<div id="divSearch" style="display:|-if $filters|@count gt 0-|block|-else-|none|-/if-|;"><form action='Main.php' method='get' style="display:inline;">
					<input type="hidden" name="do" value="positionsList" />
					Por tipo<select id="filters_type" name="filters[type]" title="type">
				<option value="0">Seleccione el tipo</option>
			|-foreach from=$positionTypes key=typeKey item=type name=for_type-|
				|-if $typeKey gt $configModule->get("positions","treeRootType")-|
        <option value="|-$typeKey-|" |-if $typeKey eq $filters.type-|selected="selected" |-/if-|>|-$type-|</option> 
				|-/if-|
			|-/foreach-|
      </select>
					Nombre: <input name="filters[searchString]" type="text" value="|-if isset($filters.searchString)-||-$filters.searchString-||-/if-|" size="30" />
					&nbsp;&nbsp;<input type='submit' value='Buscar' class='tdSearchButton' />
			</form>|-if $filters|@count gt 0-|<form  method="get">
				<input type="hidden" name="do" value="positionsList" />
				<input type="submit" value="Quitar Filtros" />
		</form>|-/if-|</div></td>
		</tr>
			<tr>
				 <th colspan="5" class="thFillTitle">
				 	<div class="rightLink"><a href="Main.php?do=positionsEdit" class="addLink">Agregar Posición</a></div>
<!--					<div class="rightLink"><a href="#" onclick="$('positionsVersionEdit').show();return false;" class="addLink">Agregar Versión</a></div>
				 	<div class="rightLink"><a href="Main.php?do=positionsVersionsList">Ver Historial de Versiones</a></div>-->
				</th>
			</tr>
			<tr class="thFillTitle">
				<th width="5%">Código</th>
				<th width="40%">Dependencia</th>
				<th width="50%">Cargo &#8212; Funcionario</th>
				<th width="5%">&nbsp;</th>
			</tr>
		</thead>
		<tbody>
		|-if $positions|@count eq 0-|
			<tr>
				 <td colspan="5">|-if isset($filters)-|No hay posiciones que concuerden con la búsqueda|-else-|No hay posiciones disponibles|-/if-|</td>
			</tr>
		|-else-|
			|-foreach from=$positions item=position name=for_positions-|
			<tr>
				<td>|-$position->getInternalCode()-|</td>
				<td>|-$position->getName()-|</td>
				<td>|-assign var=tenure value=$position->getActiveTenure()-||-if $tenure->getObject() != NULL-||-$tenure->getOwnerName()-| &#8212;  |-assign var=tenureObject value=$tenure->getObject()-||-$tenureObject->getName()-| |-$tenureObject->getSurname()-||-assign var=tenureId value=$tenure->getId()-||-/if-|</td>
        <!--				|-if ($configModule->get("positions","useFemale") eq true) -|<td>|-$position->getOwnerNameFemale()-|</td>|-/if-|	-->
				<td nowrap="nowrap">|-if "positionsEdit"|security_user_has_access-|
					<form action="Main.php" method="get" style="display:inline;">
						|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
						|-if isset($pager) && ($pager->getPage() ne 1)-|<input type="hidden" name="page" id="page" value="|-$pager->getPage()-|" />|-/if-|
						<input type="hidden" name="do" value="positionsEdit" />
						<input type="hidden" name="id" value="|-$position->getid()-|" />
						<input type="submit" name="submit_go_edit_position" value="Editar" class="icon iconEdit" />
					</form>
					<form action="Main.php#tenureForm" method="get" style="display:inline;">
						|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
						|-if isset($pager) && ($pager->getPage() ne 1)-| <input type="hidden" name="page" id="page" value="|-$pager->getPage()-|" />|-/if-|
						<input type="hidden" name="do" value="positionsEdit" />
						<input type="hidden" name="id" value="|-$position->getid()-|" />
						<input type="hidden" name="addTenure" value="1" />
						<input type="submit" name="submit_go_edit_position" value="Agregar persona al cargo" title="Agregar persona al cargo" class="icon iconAddUser" />
					</form>
					|-if $tenureId ne ""-|
					<form action="Main.php#tenureForm" method="get" style="display:inline;">
						|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
						|-if isset($pager) && ($pager->getPage() ne 1)-| <input type="hidden" name="page" id="page" value="|-$pager->getPage()-|" />|-/if-|
						<input type="hidden" name="do" value="positionsEdit" />
						<input type="hidden" name="id" value="|-$position->getid()-|" />
						<input type="hidden" name="tenureId" value="|-$tenureId-|" />
						<input type="submit" name="submit_go_edit_position" value="Modificar persona a cargo" title="Modificar persona a cargo" class="icon iconEditUser" />
						|-assign var=tenureId value=""-|
					</form>|-/if-|
					|-if $position->getTreeLevel() neq 0-|<form action="Main.php" method="post" style="display:inline;">
						|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
						|-if isset($pager) && ($pager->getPage() ne 1)-| <input type="hidden" name="page" id="page" value="|-$pager->getPage()-|" />|-/if-|
						<input type="hidden" name="do" value="positionsDoDelete" />
						<input type="hidden" name="id" value="|-$position->getid()-|" />
						<input type="submit" name="submit_go_delete_position" value="Borrar" onclick="return confirm('Seguro que desea eliminar la posición?')" class="icon iconDelete" />
					</form>|-else-|
					<input type="button" name="submit_go_delete_position" value="Borrar" class="icon iconDelete disabled" title="Esta dependencia no se puede eliminar, si desea hacerlo solicitelo al administrador del sistema" />
					|-/if-|
					|-/if-|
				</td>
			</tr>
			|-/foreach-|						
		|-if isset($pager) && ($pager->getTotalPages() gt 1)-|
			<tr> 
				<td colspan="|-if $moduleConfig.useDependencies.value =="YES"-|7|-else-|6|-/if-|" class="pages">|-include file="PaginateInclude.tpl"-|</td> 
			</tr>
		|-/if-|
			<tr>
				 <th colspan="5" class="thFillTitle">|-if $positions|@count gt 5-|<div class="rightLink"><a href="Main.php?do=positionsEdit" class="addLink">Agregar Posición</a></div>|-/if-|</th>
			</tr>
		|-/if-|
		</tbody>
	</table>
</div>
