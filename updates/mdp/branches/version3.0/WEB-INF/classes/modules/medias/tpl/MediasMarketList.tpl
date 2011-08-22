<h2>Medios</h2>
<h1>Administración de mercados</h1>
<p>A continuación se muestra la lista de mercado cargados en el sistema.</p>
<div id="div_types"> 
	|-if $message eq "ok"-|
		<div class="successMessage">Mercado guardado correctamente</div>
	|-elseif $message eq "deleted_ok"-|
		<div class="successMessage">Mercado eliminado correctamente</div>
	|-/if-|
	<table id="tabla-markets" class='tableTdBorders' cellpadding='5' cellspacing='0' width='100%'> 
		<thead> 
		<tr>
			<td colspan="3" class="tdSearch"><a href="javascript:void(null);" onClick='switch_vis("divSearch");' class="tdTitSearch">Busqueda de tipos </a>
				<div id="divSearch" style="display:|-if $filters|@count gt 0-|block|-else-|none|-/if-|;"><form action='Main.php' method='get' style="display:inline;">
					<input type="hidden" name="do" value="mediasMarketList" />
					Texto: <input name="filters[searchString]" type="text" value="|-if isset($filters.searchString)-||-$filters.searchString-||-/if-|" size="30" title="Ingrese el texto a buscar" />
					Resultados por página
				|-html_options name="filters[perPage]" options=',10,25,50,100'|array:"valuekey" selected=$pager->getRowsPerPage()-|	
				|-if $loginUser->isSupervisor()-|Incluir eliminados<input name="filters[includeDeleted]" type="checkbox" value="true" |-$filters.includeDeleted|checked:"true"-|>|-/if-|
					<input type="submit" value="Buscar" title="Buscar con los parámetros ingresados" />
				|-if $filters|@count gt 0-|<input name="rmoveFilters" type="button" value="Quitar filtros" onclick="location.href='Main.php?do=mediasMarketList'"/>|-/if-|
			</form>
			</div></td>
		</tr>
			|-if "mediasMarketEdit"|security_has_access-|<tr>
				 <th colspan="3" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=mediasMarketEdit|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($pager) && ($pager->getPage() ne 1)-|&page=|-$pager->getPage()-||-/if-|" class="addLink">Agregar Tipo</a></div></th>
			</tr>|-/if-|
			<tr class="thFillTitle"> 
	<!--			<th width="5%">Id</th> -->
				<th width="50%">Tipo</th> 
				<th width="5%">&nbsp;</th> 
			</tr> 
		</thead> 
	<tbody>|-if $mediaMarkets|@count eq 0-|
		<tr>
			 <td colspan="3">|-if isset($filter)-|No hay tipos que concuerden con la búsqueda|-else-|No hay mercados disponibles|-/if-|</td>
		</tr>
	|-else-|
		|-foreach from=$mediaMarkets item=mediaMarket name=for_markets-|
		<tr> 
	<!--		<td>|-$mediaMarket->getid()-|</td> -->
			<td>|-$mediaMarket->getName()-|</td>
			<td nowrap>|-if "mediasMarketEdit"|security_has_access-|<form action="Main.php" method="get" style="display:inline;"> 
					<input type="hidden" name="do" value="mediasMarketEdit" /> 
						|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
						|-if isset($pager) && ($pager->getPage() ne 1)-| <input type="hidden" name="page" id="page" value="|-$pager->getPage()-|" />|-/if-|
					<input type="hidden" name="id" value="|-$mediaMarket->getid()-|" /> 
					<input type="submit" name="submit_go_edit_type" value="Editar" title="Editar" class="icon iconEdit" /> 
				</form> |-/if-|
				|-if "mediasMarketDoDelete"|security_has_access-|<form action="Main.php" method="post" style="display:inline;"> 
					<input type="hidden" name="do" value="mediasMarketDoDelete" /> 
						|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
						|-if isset($pager) && ($pager->getPage() ne 1)-| <input type="hidden" name="page" id="page" value="|-$pager->getPage()-|" />|-/if-|
					<input type="hidden" name="id" value="|-$mediaMarket->getid()-|" /> 
					<input type="submit" name="submit_go_delete_type" value="Borrar" title="Eliminar" onclick="return confirm('Seguro que desea eliminar el mercado?')" class="icon iconDelete" /> 
			</form>
			|-if $loginUser->isSupervisor()-|
			<form action="Main.php" method="post" style="display:inline;"> 
					<input type="hidden" name="do" value="mediasMarketDoDelete" /> 
						|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
						|-if isset($pager) && ($pager->getPage() ne 1)-| <input type="hidden" name="page" id="page" value="|-$pager->getPage()-|" />|-/if-|
					<input type="hidden" name="id" value="|-$mediaMarket->getid()-|" /> 
					<input type="hidden" name="doHardDelete" value="true" /> 
					<input type="submit" name="submit_go_delete_type" value="Borrar" title="Eliminar completamente" onclick="return confirm('Seguro que desea eliminar el mercado definitivamente?')" class="icon iconHardDelete" /> 
			</form>
			|-if $mediaMarket->getDeletedAt() != NULL-|<form action="Main.php" method="post" style="display:inline;"> 
					<input type="hidden" name="do" value="mediasMarketUndeleteX" /> 
						|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
						|-if isset($pager) && ($pager->getPage() ne 1)-| <input type="hidden" name="page" id="page" value="|-$pager->getPage()-|" />|-/if-|
					<input type="hidden" name="id" value="|-$mediaMarket->getid()-|" /> 
					<input type="submit" name="submit_go_delete_type" value="Borrar" title="Recuperar registro" onclick="return confirm('Seguro que desea recuperar este mercado?')" class="icon iconUndelete" /> 
			</form>|-/if-||-/if-|
			|-/if-|</td> 
		</tr> 
		|-/foreach-|
		|-if isset($pager) && ($pager->getTotalPages() gt 1)-|
		<tr> 
			<td colspan="3" class="pages">|-include file="PaginateInclude.tpl"-|</td> 
		</tr>
		|-/if-|
			|-if "mediasMarketEdit"|security_has_access-|<tr>
				 <th colspan="3" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=mediasMarketEdit|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($pager) && ($pager->getPage() ne 1)-|&page=|-$pager->getPage()-||-/if-|" class="addLink">Agregar Tipo</a></div></th>
			</tr>|-/if-|
		|-/if-|
		</tbody> 
		 </table> 
</div>
	