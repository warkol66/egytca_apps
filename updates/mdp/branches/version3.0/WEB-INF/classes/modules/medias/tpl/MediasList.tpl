<h2>Tablero de Gestión</h2>
<h1>Administración de ##medias,1,Medios##</h1>
<p>A continuación se muestra la lista de ##medias,1,Medios## cargados en el sistema.</p>
<div id="div_medias"> 
	|-if $message eq "ok"-|
		<div class="successMessage">##medias,2,Medio## guardado correctamente</div>
	|-elseif $message eq "deleted_ok"-|
		<div class="successMessage">##medias,2,Medio## eliminado correctamente</div>
	|-/if-|
	<table id="tabla-medias" class='tableTdBorders' cellpadding='5' cellspacing='0' width='100%'> 
		<thead> 
		<tr>
			<td colspan="3" class="tdSearch"><a href="javascript:void(null);" onClick='switch_vis("divSearch");' class="tdTitSearch">Busqueda de ##medias,1,Medios## </a>
				<div id="divSearch" style="display:|-if $filters|@count gt 0-|block|-else-|none|-/if-|;"><form action='Main.php' method='get' style="display:inline;">
					<input type="hidden" name="do" value="mediasList" />
					Texto: <input name="filters[searchString]" type="text" value="|-if isset($filters.searchString)-||-$filters.searchString-||-/if-|" size="30" title="Ingrese el texto a buscar" />
					Resultados por página
				|-html_options name="filters[perPage]" options=',10,25,50,100'|array:"valuekey" selected=$pager->getRowsPerPage()-|	
				|-if $loginUser->isSupervisor()-|Incluir eliminados<input name="filters[includeDeleted]" type="checkbox" value="true" |-$filters.includeDeleted|checked:"true"-|>|-/if-|
					<input type="submit" value="Buscar" title="Buscar con los parámetros ingresados" />
				|-if $filters|@count gt 0-|<input name="rmoveFilters" type="button" value="Quitar filtros" onclick="location.href='Main.php?do=mediasList'"/>|-/if-|
			</form>
			</div></td>
		</tr>
			|-if "mediasEdit"|security_has_access-|<tr>
				 <th colspan="3" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=mediasEdit|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($pager) && ($pager->getPage() ne 1)-|&page=|-$pager->getPage()-||-/if-|" class="addLink">Agregar ##medias,2,Medio##</a></div></th>
			</tr>|-/if-|
			<tr class="thFillTitle"> 
	<!--			<th width="5%">Id</th> -->
				<th width="40%">##medias,2,Medio##</th> 
				<th width="20%">Tipo</th> 
				<th width="40%">Descripción</th> 
				<th width="5%">&nbsp;</th> 
			</tr> 
		</thead> 
	<tbody>|-if $medias|@count eq 0-|
		<tr>
			 <td colspan="3">|-if isset($filter)-|No hay ##medias,1,Medios## que concuerden con la búsqueda|-else-|No hay ##medias,1,Medios## disponibles|-/if-|</td>
		</tr>
	|-else-|
		|-foreach from=$medias item=media name=for_medias-|
		<tr> 
	<!--		<td>|-$media->getid()-|</td> -->
			<td>|-$media->getName()-|</td> 
			<td>|-$media->getTypeId()-|</td> 
			<td>|-$media->getDescription()-|</td> 
			<td nowrap>|-if "mediasEdit"|security_has_access-|<form action="Main.php" method="get" style="display:inline;"> 
					<input type="hidden" name="do" value="mediasEdit" /> 
						|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
						|-if isset($pager) && ($pager->getPage() ne 1)-| <input type="hidden" name="page" id="page" value="|-$pager->getPage()-|" />|-/if-|
					<input type="hidden" name="id" value="|-$media->getid()-|" /> 
					<input type="submit" name="submit_go_edit_media" value="Editar" title="Editar" class="icon iconEdit" /> 
				</form> |-/if-|
				|-if "mediasDoDelete"|security_has_access-|<form action="Main.php" method="post" style="display:inline;"> 
					<input type="hidden" name="do" value="mediasDoDelete" /> 
						|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
						|-if isset($pager) && ($pager->getPage() ne 1)-| <input type="hidden" name="page" id="page" value="|-$pager->getPage()-|" />|-/if-|
					<input type="hidden" name="id" value="|-$media->getid()-|" /> 
					<input type="submit" name="submit_go_delete_media" value="Borrar" title="Eliminar" onclick="return confirm('Seguro que desea eliminar el ##medias,2,Medio##?')" class="icon iconDelete" /> 
			</form>
			|-if $loginUser->isSupervisor()-|
			<form action="Main.php" method="post" style="display:inline;"> 
					<input type="hidden" name="do" value="mediasDoDelete" /> 
						|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
						|-if isset($pager) && ($pager->getPage() ne 1)-| <input type="hidden" name="page" id="page" value="|-$pager->getPage()-|" />|-/if-|
					<input type="hidden" name="id" value="|-$media->getid()-|" /> 
					<input type="hidden" name="doHardDelete" value="true" /> 
					<input type="submit" name="submit_go_delete_media" value="Borrar" title="Eliminar completamente" onclick="return confirm('Seguro que desea eliminar el ##medias,2,Medio## definitivamente?')" class="icon iconHardDelete" /> 
			</form>
			|-if $media->getDeletedAt() != NULL-|<form action="Main.php" method="post" style="display:inline;"> 
					<input type="hidden" name="do" value="mediasUndeleteX" /> 
						|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
						|-if isset($pager) && ($pager->getPage() ne 1)-| <input type="hidden" name="page" id="page" value="|-$pager->getPage()-|" />|-/if-|
					<input type="hidden" name="id" value="|-$media->getid()-|" /> 
					<input type="submit" name="submit_go_delete_media" value="Borrar" title="Recuperar registro" onclick="return confirm('Seguro que desea recuperar ##medias,2,Medio##?')" class="icon iconUndelete" /> 
			</form>|-/if-||-/if-|
			|-/if-|</td> 
		</tr> 
		|-/foreach-|
		|-if isset($pager) && ($pager->getTotalPages() gt 1)-|
		<tr> 
			<td colspan="3" class="pages">|-include file="PaginateInclude.tpl"-|</td> 
		</tr>
		|-/if-|
			|-if "mediasEdit"|security_has_access-|<tr>
				 <th colspan="3" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=mediasEdit|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($pager) && ($pager->getPage() ne 1)-|&page=|-$pager->getPage()-||-/if-|" class="addLink">Agregar ##medias,2,Medio##</a></div></th>
			</tr>|-/if-|
		|-/if-|
		</tbody> 
		 </table> 
</div>
	