<h2>##headlines,1,Titulares##</h2>
<h1>Administración de ##headlines,1,Titulares##</h1>
<p>A continuación se muestra la lista de ##headlines,1,Titulares## cargados en el sistema.</p>
<div id="div_headlines"> 
	|-if $message eq "ok"-|
		<div class="successMessage">##headlines,2,Titulares## guardado correctamente</div>
	|-elseif $message eq "deleted_ok"-|
		<div class="successMessage">##headlines,2,Titulares## eliminado correctamente</div>
	|-/if-|
	<table id="tabla-headlines" class='tableTdBorders' cellpadding='5' cellspacing='0' width='100%'> 
		<thead> 
		<tr>
			<td colspan="3" class="tdSearch"><a href="javascript:void(null);" onClick='switch_vis("divSearch");' class="tdTitSearch">Busqueda de ##headlines,1,Titulares## </a>
				<div id="divSearch" style="display:|-if $filters|@count gt 0-|block|-else-|none|-/if-|;"><form action='Main.php' method='get' style="display:inline;">
					<input type="hidden" name="do" value="headlinesList" />
					Texto: <input name="filters[searchString]" type="text" value="|-if isset($filters.searchString)-||-$filters.searchString-||-/if-|" size="30" title="Ingrese el texto a buscar" />
					Resultados por página |-html_options name="filters[perPage]" options=',10,25,50,100'|array:"valuekey" selected=$pager->getRowsPerPage()-|
					<input type="submit" value="Buscar" title="Buscar con los parámetros ingresados" />
				|-if $filters|@count gt 0-|<input name="rmoveFilters" type="button" value="Quitar filtros" onclick="location.href='Main.php?do=headlinesList'"/>|-/if-|
			</form>
		</div></td>
		</tr>
			|-if "headlinesEdit"|security_has_access-|<tr>
				 <th colspan="3" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=headlinesEdit|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($pager) && ($pager->getPage() ne 1)-|&page=|-$pager->getPage()-||-/if-|" class="addLink">Agregar ##headlines,2,Titular##</a></div></th>
			</tr>|-/if-|
			<tr class="thFillTitle"> 
	<!--			<th width="5%">Id</th> -->
				<th width="50%">##headlines,2,Titulares##</th> 
				<th width="40%">##headlines,3,Contenido##</th> 
				<th width="5%">&nbsp;</th> 
			</tr> 
		</thead> 
	<tbody>|-if $headlines|@count eq 0-|
		<tr>
			 <td colspan="3">|-if isset($filter)-|No hay ##headlines,1,Titulares## que concuerden con la búsqueda|-else-|No hay ##headlines,1,Titulares## disponibles|-/if-|</td>
		</tr>
	|-else-|
		|-foreach from=$headlines item=headline name=for_headlines-|
		<tr> 
	 <!-- <td>|-$headline->getid()-|</td> -->
				<td>|-$headline->getName()-|</td> 
				<td>|-$headline->getContent()-|</td>
			<td nowrap>|-if "headlinesEdit"|security_has_access-|<form action="Main.php" method="get" style="display:inline;"> 
					<input type="hidden" name="do" value="headlinesEdit" /> 
						|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
						|-if isset($pager) && ($pager->getPage() ne 1)-| <input type="hidden" name="page" id="page" value="|-$pager->getPage()-|" />|-/if-|
					<input type="hidden" name="id" value="|-$headline->getid()-|" /> 
					<input type="submit" name="submit_go_edit_headline" value="Editar" title="Editar" class="icon iconEdit" /> 
				</form>|-/if-|
				|-if "headlinesDoDelete"|security_has_access-|<form action="Main.php" method="post" style="display:inline;"> 
					<input type="hidden" name="do" value="headlinesDoDelete" /> 
						|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
						|-if isset($pager) && ($pager->getPage() ne 1)-| <input type="hidden" name="page" id="page" value="|-$pager->getPage()-|" />|-/if-|
					<input type="hidden" name="id" value="|-$headline->getid()-|" /> 
					<input type="submit" name="submit_go_delete_headline" value="Borrar" title="Eliminar" onclick="return confirm('Seguro que desea eliminar el ##headlines,2,Titular##?')" class="icon iconDelete" /> 
			</form>
			|-if $loginUser->isSupervisor()-|				<form action="Main.php" method="post" style="display:inline;"> 
					<input type="hidden" name="do" value="headlinesDoDelete" /> 
						|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
						|-if isset($pager) && ($pager->getPage() ne 1)-| <input type="hidden" name="page" id="page" value="|-$pager->getPage()-|" />|-/if-|
					<input type="hidden" name="id" value="|-$headline->getid()-|" /> 
					<input type="hidden" name="doHardDelete" value="true" /> 
					<input type="submit" name="submit_go_delete_headline" value="Borrar" title="Eliminar completamente" onclick="return confirm('Seguro que desea eliminar el ##headlines,2,Titular## definitivamente?')" class="icon iconHardDelete" /> 
			</form>|-/if-|
			|-/if-|</td> 
		</tr> 
		|-/foreach-|
		|-if isset($pager) && ($pager->getTotalPages() gt 1)-|
		<tr> 
			<td colspan="3" class="pages">|-include file="PaginateInclude.tpl"-|</td> 
		</tr>
		|-/if-|
			<tr>
				 <th colspan="3" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=headlinesEdit|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($pager) && ($pager->getPage() ne 1)-|&page=|-$pager->getPage()-||-/if-|" class="addLink">Agregar ##headlines,2,Titular##</a></div></th>
			</tr>
		|-/if-|
		</tbody> 
		 </table> 
</div>
