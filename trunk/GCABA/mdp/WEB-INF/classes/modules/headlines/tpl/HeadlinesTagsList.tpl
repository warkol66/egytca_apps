<h2>Tablero de Gestión</h2>
<h1>Administración de Etiquetas de Titulares</h1>
<p>A continuación se muestra la lista de Etiquetas de Titulares cargadas en el sistema.</p>
<div id="div_headlinesTags"> 
	|-if $message eq "ok"-|
		<div class="successMessage">Etiqueta guardada correctamente</div>
	|-elseif $message eq "deleted_ok"-|
		<div class="successMessage">Etiqueta eliminada correctamente</div>
	|-/if-|
	<table id="tabla-headlinesTags" class='tableTdBorders' cellpadding='5' cellspacing='0' width='100%'> 
		<thead> 
		<tr>
			<td colspan="2" class="tdSearch"><a href="javascript:void(null);" onClick='switch_vis("divSearch");' class="tdTitSearch">Busqueda de Etiquetas de Titulares </a>
				<div id="divSearch" style="display:|-if $filters|@count gt 0-|block|-else-|none|-/if-|;"><form action='Main.php' method='get' style="display:inline;">
					<input type="hidden" name="do" value="headlinesTagsList" />
					<p><label for="filters[searchString]" class="inlineLabel">Texto</label> <input name="filters[searchString]" id="filters[searchString]" type="text" value="|-if isset($filters.searchString)-||-$filters.searchString-||-/if-|" size="30" title="Ingrese el texto a buscar" />
					<label for="filters[perPage]" class="inlineLabel">Resultados por página</label>
				|-html_options id="filters[perPage]" name="filters[perPage]" options=',10,25,50,100'|array:"valuekey" selected=$pager->getMaxPerPage()-|	
				|-if $loginUser->isSupervisor()-|<!--Incluir eliminados<input name="filters[includeDeleted]" type="checkbox" value="true" |-$filters.includeDeleted|checked:"true"-|>-->|-/if-|</p>
					<p><input type="submit" value="Buscar" title="Buscar con los parámetros ingresados" />
				|-if $filters|@count gt 0-|<input name="rmoveFilters" type="button" value="Quitar filtros" onclick="location.href='Main.php?do=headlinesTagsList'"/>|-/if-|</p>
			</form>
			</div></td>
		</tr>
			|-if "headlinesTagsEdit"|security_has_access-|<tr>
				 <th colspan="2" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=headlinesTagsEdit|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($pager) && ($pager->getPage() ne 1)-|&page=|-$pager->getPage()-||-/if-|" class="addLink">Agregar Etiqueta</a></div></th>
			</tr>|-/if-|
			<tr class="thFillTitle"> 
				<th width="95%">Etiqueta</th> 
				<th width="5%">&nbsp;</th> 
			</tr> 
		</thead> 
	<tbody>|-if $headlineTagColl|@count eq 0-|
		<tr>
			 <td colspan="2" >|-if isset($filter)-|No hay Etiquetas de Titulares que concuerden con la búsqueda|-else-|No hay Etiquetas de Titulares disponibles|-/if-|</td>
		</tr>
	|-else-|
		|-foreach from=$headlineTagColl item=headlineTag name=for_headlineTags-|
		<tr> 
			<td>|-$headlineTag-|</td>
			<td nowrap>|-if "headlinesTagsEdit"|security_has_access-|<form action="Main.php" method="get" style="display:inline;"> 
					<input type="hidden" name="do" value="headlinesTagsEdit" /> 
						|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
						|-if isset($pager) && ($pager->getPage() ne 1)-| <input type="hidden" name="page" id="page" value="|-$pager->getPage()-|" />|-/if-|
					<input type="hidden" name="id" value="|-$headlineTag->getid()-|" /> 
					<input type="submit" name="submit_go_edit_headlinesTag" value="Editar" title="Editar" class="icon iconEdit" /> 
				</form> |-/if-|
				|-if "headlinesTagsDoDelete"|security_has_access-|<form action="Main.php" method="post" style="display:inline;"> 
					<input type="hidden" name="do" value="headlinesTagsDoDelete" /> 
						|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
						|-if isset($pager) && ($pager->getPage() ne 1)-| <input type="hidden" name="page" id="page" value="|-$pager->getPage()-|" />|-/if-|
					<input type="hidden" name="id" value="|-$headlineTag->getid()-|" /> 
					<input type="submit" name="submit_go_delete_headlinesTag" value="Borrar" title="Eliminar" onclick="return confirm('Seguro que desea eliminar el Etiqueta?')" class="icon iconDelete" /> 
			</form>
			|-/if-|</td> 
		</tr> 
		|-/foreach-|
		|-if isset($pager) && $pager->haveToPaginate()-|
		<tr> 
			<td colspan="2" class="pages">|-include file="ModelPagerInclude.tpl"-|</td> 
		</tr>
		|-/if-|
			|-if "headlinesTagsEdit"|security_has_access-|<tr>
				 <th colspan="2" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=headlinesTagsEdit|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($pager) && ($pager->getPage() ne 1)-|&page=|-$pager->getPage()-||-/if-|" class="addLink">Agregar Etiqueta</a></div></th>
			</tr>|-/if-|
		|-/if-|
		</tbody> 
		 </table> 
</div>
	