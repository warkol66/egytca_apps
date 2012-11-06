<h2>Tablero de Gestión</h2>
<h1>Administración de ##actors,1,Actores##</h1>
<p>A continuación se muestra la lista de ##actors,1,Actores## cargados en el sistema.</p>
<div id="div_actors"> 
	|-if $message eq "ok"-|
		<div class="successMessage">##actors,2,Actor## guardado correctamente</div>
	|-elseif $message eq "deleted_ok"-|
		<div class="successMessage">##actors,2,Actor## eliminado correctamente</div>
	|-/if-|
	<table id="tabla-actors" class='tableTdBorders' cellpadding='5' cellspacing='0' width='100%'> 
		<thead> 
		<tr>
			<td colspan="3" class="tdSearch"><a href="javascript:void(null);" onClick='switch_vis("divSearch");' class="tdTitSearch">Busqueda de ##actors,1,Actores## </a>
				<div id="divSearch" style="display:|-if $filters|@count gt 0-|block|-else-|none|-/if-|;"><form action='Main.php' method='get' style="display:inline;">
					<input type="hidden" name="do" value="actorsList" />
					Texto: <input name="filters[searchString]" type="text" value="|-if isset($filters.searchString)-||-$filters.searchString-||-/if-|" size="30" title="Ingrese el texto a buscar" />
					&nbsp;&nbsp;<input type='submit' value='Buscar' class='tdSearchButton' />
			</form>
					|-if $filters|@count gt 0-|<form  method="get">
				<input type="hidden" name="do" value="actorsList" />
				<input type="submit" value="Quitar Filtros" />
		</form>|-/if-|</div></td>
		</tr>
			<tr>
				 <th colspan="3" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=actorsEdit|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($pager) && ($pager->getPage() ne 1)-|&page=|-$pager->getPage()-||-/if-|" class="addNew">Agregar ##actors,2,Actor##</a></div></th>
			</tr>
			<tr class="thFillTitle"> 
	<!--			<th width="5%">Id</th> -->
				<th width="50%">##actors,2,Actor##</th> 
				<th width="40%">##actors,3,Institución##</th> 
				<th width="5%">&nbsp;</th> 
			</tr> 
		</thead> 
	<tbody>|-if $actors|@count eq 0-|
		<tr>
			 <td colspan="3">|-if isset($filter)-|No hay ##actors,1,Actores## que concuerden con la búsqueda|-else-|No hay ##actors,1,Actores## disponibles|-/if-|</td>
		</tr>
	|-else-|
		|-foreach from=$actors item=actor name=for_actors-|
		<tr> 
	<!--		<td>|-$actor->getid()-|</td> -->
			<td>|-if $actor->getTitle() ne ''-||-$actor->getTitle()-| |-/if-||-$actor->getName()-| |-$actor->getSurname()-|</td> 
			<td>|-$actor->getInstitution()-|</td>
			<td nowrap> <form action="Main.php" method="get" style="display:inline;"> 
					<input type="hidden" name="do" value="actorsEdit" /> 
						|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
						|-if isset($pager) && ($pager->getPage() ne 1)-| <input type="hidden" name="page" id="page" value="|-$pager->getPage()-|" />|-/if-|
					<input type="hidden" name="id" value="|-$actor->getid()-|" /> 
					<input type="submit" name="submit_go_edit_actor" value="Editar" class="buttonImageEdit" /> 
				</form> 
				<form action="Main.php" method="post" style="display:inline;"> 
					<input type="hidden" name="do" value="actorsDoDelete" /> 
						|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
						|-if isset($pager) && ($pager->getPage() ne 1)-| <input type="hidden" name="page" id="page" value="|-$pager->getPage()-|" />|-/if-|
					<input type="hidden" name="id" value="|-$actor->getid()-|" /> 
					<input type="submit" name="submit_go_delete_actor" value="Borrar" onclick="return confirm('Seguro que desea eliminar el ##actors,2,Actor##?')" class="buttonImageDelete" /> 
			</form>
			|-if $loginUser->isSupervisor()-|				<form action="Main.php" method="post" style="display:inline;"> 
					<input type="hidden" name="do" value="actorsDoDelete" /> 
						|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
						|-if isset($pager) && ($pager->getPage() ne 1)-| <input type="hidden" name="page" id="page" value="|-$pager->getPage()-|" />|-/if-|
					<input type="hidden" name="id" value="|-$actor->getid()-|" /> 
					<input type="hidden" name="doHardDelete" value="true" /> 
					<input type="submit" name="submit_go_delete_actor" value="Borrar" onclick="return confirm('Seguro que desea eliminar el ##actors,2,Actor## definitivamente?')" class="buttonImageDelete" /> 
			</form>|-/if-|</td> 
		</tr> 
		|-/foreach-|
		|-if isset($pager) && ($pager->getTotalPages() gt 1)-|
		<tr> 
			<td colspan="3" class="pages">|-include file="PaginateInclude.tpl"-|</td> 
		</tr>
		|-/if-|
			<tr>
				 <th colspan="3" class="thFillTitle">|-if $actors|@count gt 5-|<div class="rightLink"><a href="Main.php?do=actorsEdit|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($pager) && ($pager->getPage() ne 1)-|&page=|-$pager->getPage()-||-/if-|" class="addNew">Agregar ##actors,2,Actor##</a></div>|-/if-|</th>
			</tr>
		|-/if-|
		</tbody> 
		 </table> 
</div>