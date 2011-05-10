<h2>Tablero de Gestión</h2>
<h1>Administración de Garantías</h1>
<p>A continuación se muestra la lista de garantías cargadas en el sistema.</p>
<div id="div_guarantees"> 
	|-if $message eq "ok"-|
		<div class="successMessage">Garantía guardada correctamente</div>
	|-elseif $message eq "deleted_ok"-|
		<div class="successMessage">Garantía eliminada correctamente</div>
	|-/if-|
	<table id="tabla-guarantees" class='tableTdBorders' cellpadding='5' cellspacing='0' width='100%'> 
		<thead> 
		<tr>
			<td colspan="8" class="tdSearch"><a href="javascript:void(null);" onClick='switch_vis("divSearch");' class="tdTitSearch">Busqueda de garantías</a>
				<div id="divSearch" style="display:|-if $filters|@count gt 0-|block|-else-|none|-/if-|;"><form action='Main.php' method='get' style="display:inline;">
					<input type="hidden" name="do" value="panelGuaranteesList" />
					Nombre: <input name="filters[searchString]" type="text" value="|-if isset($filters.searchString)-||-$filters.searchString-||-/if-|" size="30" title="Ingrese el texto a buscar" />
					&nbsp;&nbsp;Contratista
				<select id="filters[searchContractorId]" name="filters[searchContractorId]" title="Contratista"> 
				<option value="">Seleccione contratista</option>
				|-foreach from=$contractors item=contractor key=key name=for_contractors-|
        <option value="|-$contractor->getId()-|" |-$contractor->getId()|selected:$filters.searchContractorId-|>|-$contractor->getName()|truncate:75:"...":false-|</option> 
				|-/foreach-|
      </select>

					&nbsp;&nbsp;<input type='submit' value='Buscar' class='tdSearchButton' />
			</form>
					|-if $filters|@count gt 0-|<form  method="get">
				<input type="hidden" name="do" value="panelGuaranteesList" />
				<input type="submit" value="Quitar Filtros" />
		</form>|-/if-|</div></td>
		</tr>
			<tr>
				 <th colspan="8" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=panelGuaranteesEdit|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($pager) && ($pager->getPage() ne 1)-|&page=|-$pager->getPage()-||-/if-|" class="addNew">Agregar Garantía</a></div></th>
			</tr>
			<tr class="thFillTitle"> 
	<!--			<th width="5%">Id</th> -->
				<th width="5%">Fecha</th> 
				<th width="5%">Préstamo</th> 
				<th width="20%">Proyecto</th> 
				<th width="20%">Contratista</th> 
				<th width="10%">Emisor</th> 
				<th width="5%">Monto</th> 
				<th width="15%">Vencimiento</th> 
				<th width="5%">&nbsp;</th> 
			</tr> 
		</thead> 
	<tbody>|-if $guarantees|@count eq 0-|
		<tr>
			 <td colspan="8">|-if isset($filter)-|No hay garantías que concuerden con la búsqueda|-else-|No hay garantías disponibles|-/if-|</td>
		</tr>
	|-else-|
		|-foreach from=$guarantees item=guarantee name=for_guarantees-|
		<tr> 
	<!--		<td>|-$guarantee->getid()-|</td> -->
			<td>|-$guarantee->getIssueDate()|date_format:"%d-%m-%Y"-|</td> 
			<td>|-$guarantee->getPolicyGuidelineName()-|</td>
			<td>|-$guarantee->getProjectName()-|</td>
			<td>|-$guarantee->getContractorName()-|</td> 
			<td>|-$guarantee->getIssuer()-|</td> 
			<td>|-$guarantee->getCurrencyName()-| |-$guarantee->getAmmount()|number_format:2:',':'.'-|</td> 
			<td>|-$guarantee->getExpirationDate()|date_format-|</td> 
			<td nowrap> <form action="Main.php" method="get" style="display:inline;"> 
					<input type="hidden" name="do" value="panelGuaranteesEdit" /> 
						|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
						|-if isset($pager) && ($pager->getPage() ne 1)-| <input type="hidden" name="page" id="page" value="|-$pager->getPage()-|" />|-/if-|
					<input type="hidden" name="id" value="|-$guarantee->getid()-|" /> 
					<input type="submit" name="submit_go_edit_guarantee" value="Editar" class="buttonImageEdit" /> 
				</form>
				|-if $loginUser->isAdmin() || $loginUser->isSupervisor()-|
				<form action="Main.php" method="post" style="display:inline;"> 
					<input type="hidden" name="do" value="panelGuaranteesDoDelete" /> 
						|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
						|-if isset($pager) && ($pager->getPage() ne 1)-| <input type="hidden" name="page" id="page" value="|-$pager->getPage()-|" />|-/if-|
					<input type="hidden" name="id" value="|-$guarantee->getid()-|" /> 
					<input type="submit" name="submit_go_delete_guarantee" value="Borrar" onclick="return confirm('Seguro que desea eliminar la garantía?')" class="buttonImageDelete" /> 
			</form>
			|-/if-|
			|-if $loginUser->isSupervisor()-|				<form action="Main.php" method="post" style="display:inline;"> 
					<input type="hidden" name="do" value="panelGuaranteesDoDelete" /> 
						|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
						|-if isset($pager) && ($pager->getPage() ne 1)-| <input type="hidden" name="page" id="page" value="|-$pager->getPage()-|" />|-/if-|
					<input type="hidden" name="id" value="|-$guarantee->getid()-|" /> 
					<input type="hidden" name="doHardDelete" value="true" /> 
					<input type="submit" name="submit_go_delete_guarantee" value="Borrar" onclick="return confirm('Seguro que desea eliminar la garantía definitivamente?')" class="buttonImageDelete" /> 
			</form>|-/if-|</td> 
		</tr> 
		|-/foreach-|
		|-if isset($pager) && ($pager->getTotalPages() gt 1)-|
		<tr> 
			<td colspan="8" class="pages">|-include file="PaginateInclude.tpl"-|</td> 
		</tr>
		|-/if-|
			<tr>
				 <th colspan="8" class="thFillTitle">|-if $guarantees|@count gt 5-|<div class="rightLink"><a href="Main.php?do=panelGuaranteesEdit|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($pager) && ($pager->getPage() ne 1)-|&page=|-$pager->getPage()-||-/if-|" class="addNew">Agregar Garantía</a></div>|-/if-|</th>
			</tr>
		|-/if-|
		</tbody> 
		 </table> 
</div>
