<h2>Tablero de Gestión</h2>
<h1>Administración de tipos de medios</h1>
<p>A continuación se muestra la lista de tipos de medio cargados en el sistema.</p>
<div id="div_types"> 
	|-if $message eq "ok"-|
		<div class="successMessage">Tipo guardado correctamente</div>
	|-elseif $message eq "deleted_ok"-|
		<div class="successMessage">Tipo eliminado correctamente</div>
	|-/if-|
	<table id="tabla-actors" class='tableTdBorders' cellpadding='5' cellspacing='0' width='100%'> 
		<thead> 
		<tr>
			<td colspan="3" class="tdSearch"><a href="javascript:void(null);" onClick='switch_vis("divSearch");' class="tdTitSearch">Busqueda de tipos </a>
				<div id="divSearch" style="display:|-if $filters|@count gt 0-|block|-else-|none|-/if-|;"><form action='Main.php' method='get' style="display:inline;">
					<input type="hidden" name="do" value="mediasTypeList" />
					Texto: <input name="filters[searchString]" type="text" value="|-if isset($filters.searchString)-||-$filters.searchString-||-/if-|" size="30" title="Ingrese el texto a buscar" />
					Resultados por página
				|-html_options name="filters[perPage]" options=',10,25,50,100'|array:"valuekey" selected=$pager->getRowsPerPage()-|	
				|-if $loginUser->isSupervisor()-|Incluir eliminados<input name="filters[includeDeleted]" type="checkbox" value="true" |-$filters.includeDeleted|checked:"true"-|>|-/if-|
					<input type="submit" value="Buscar" title="Buscar con los parámetros ingresados" />
				|-if $filters|@count gt 0-|<input name="rmoveFilters" type="button" value="Quitar filtros" onclick="location.href='Main.php?do=mediasTypeList'"/>|-/if-|
			</form>
			</div></td>
		</tr>
			|-if "actorsEdit"|security_has_access-|<tr>
				 <th colspan="3" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=mediasTypeEdit|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($pager) && ($pager->getPage() ne 1)-|&page=|-$pager->getPage()-||-/if-|" class="addLink">Agregar Tipo</a></div></th>
			</tr>|-/if-|
			<tr class="thFillTitle"> 
	<!--			<th width="5%">Id</th> -->
				<th width="50%">Tipo</th> 
				<th width="5%">&nbsp;</th> 
			</tr> 
		</thead> 
	<tbody>|-if $mediaTypes|@count eq 0-|
		<tr>
			 <td colspan="3">|-if isset($filter)-|No hay tipos que concuerden con la búsqueda|-else-|No hay tipos disponibles|-/if-|</td>
		</tr>
	|-else-|
		|-foreach from=$mediaTypes item=mediaType name=for_types-|
		<tr> 
	<!--		<td>|-$mediaType->getid()-|</td> -->
			<td>|-$mediaType->getName()-|</td>
			<td nowrap>|-if "actorsEdit"|security_has_access-|<form action="Main.php" method="get" style="display:inline;"> 
					<input type="hidden" name="do" value="mediasTypeEdit" /> 
						|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
						|-if isset($pager) && ($pager->getPage() ne 1)-| <input type="hidden" name="page" id="page" value="|-$pager->getPage()-|" />|-/if-|
					<input type="hidden" name="id" value="|-$mediaType->getid()-|" /> 
					<input type="submit" name="submit_go_edit_type" value="Editar" title="Editar" class="icon iconEdit" /> 
				</form> |-/if-|
				|-if "mediasTypeDoDelete"|security_has_access-|<form action="Main.php" method="post" style="display:inline;"> 
					<input type="hidden" name="do" value="mediasTypeDoDelete" /> 
						|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
						|-if isset($pager) && ($pager->getPage() ne 1)-| <input type="hidden" name="page" id="page" value="|-$pager->getPage()-|" />|-/if-|
					<input type="hidden" name="id" value="|-$mediaType->getid()-|" /> 
					<input type="submit" name="submit_go_delete_type" value="Borrar" title="Eliminar" onclick="return confirm('Seguro que desea eliminar el Tipo?')" class="icon iconDelete" /> 
			</form>
			|-if $loginUser->isSupervisor()-|
			<form action="Main.php" method="post" style="display:inline;"> 
					<input type="hidden" name="do" value="mediasTypeDoDelete" /> 
						|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
						|-if isset($pager) && ($pager->getPage() ne 1)-| <input type="hidden" name="page" id="page" value="|-$pager->getPage()-|" />|-/if-|
					<input type="hidden" name="id" value="|-$mediaType->getid()-|" /> 
					<input type="hidden" name="doHardDelete" value="true" /> 
					<input type="submit" name="submit_go_delete_type" value="Borrar" title="Eliminar completamente" onclick="return confirm('Seguro que desea eliminar el Tipo definitivamente?')" class="icon iconHardDelete" /> 
			</form>
			|-if $mediaType->getDeletedAt() != NULL-|<form action="Main.php" method="post" style="display:inline;"> 
					<input type="hidden" name="do" value="mediasTypeUndeleteX" /> 
						|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
						|-if isset($pager) && ($pager->getPage() ne 1)-| <input type="hidden" name="page" id="page" value="|-$pager->getPage()-|" />|-/if-|
					<input type="hidden" name="id" value="|-$mediaType->getid()-|" /> 
					<input type="submit" name="submit_go_delete_type" value="Borrar" title="Recuperar registro" onclick="return confirm('Seguro que desea recuperar Tipo?')" class="icon iconUndelete" /> 
			</form>|-/if-||-/if-|
			|-/if-|</td> 
		</tr> 
		|-/foreach-|
		|-if isset($pager) && ($pager->getTotalPages() gt 1)-|
		<tr> 
			<td colspan="3" class="pages">|-include file="PaginateInclude.tpl"-|</td> 
		</tr>
		|-/if-|
			|-if "actorsEdit"|security_has_access-|<tr>
				 <th colspan="3" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=mediasTypeEdit|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($pager) && ($pager->getPage() ne 1)-|&page=|-$pager->getPage()-||-/if-|" class="addLink">Agregar Tipo</a></div></th>
			</tr>|-/if-|
		|-/if-|
		</tbody> 
		 </table> 
</div>
	