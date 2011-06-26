<h2>Tablero de Gestión</h2>
<h1>Administración de ##issues,1,Asuntos##</h1>
<p>A continuación se muestra la lista de ##issues,1,Asuntos## cargados en el sistema.</p>
<div id="div_issues"> 
	|-if $message eq "ok"-|
		<div class="successMessage">##issues,2,Asunto## guardado correctamente</div>
	|-elseif $message eq "deleted_ok"-|
		<div class="successMessage">##issues,2,Asunto## eliminado correctamente</div>
	|-/if-|
	<table id="tabla-issues" class='tableTdBorders' cellpadding='5' cellspacing='0' width='100%'> 
		<thead> 
		<tr>
			<td colspan="3" class="tdSearch"><a href="javascript:void(null);" onClick='switch_vis("divSearch");' class="tdTitSearch">Busqueda de ##issues,1,Asuntos## </a>
				<div id="divSearch" style="display:|-if $filters|@count gt 0-|block|-else-|none|-/if-|;"><form action='Main.php' method='get' style="display:inline;">
					<input type="hidden" name="do" value="issuesList" />
					Texto: <input name="filters[searchString]" type="text" value="|-if isset($filters.searchString)-||-$filters.searchString-||-/if-|" size="30" title="Ingrese el texto a buscar" />
					&nbsp;&nbsp;<input type='submit' value='Buscar' class='tdSearchButton' />
			</form>
					|-if $filters|@count gt 0-|<form  method="get">
				<input type="hidden" name="do" value="issuesList" />
				<input type="submit" value="Quitar Filtros" />
		</form>|-/if-|</div></td>
		</tr>
			<tr>
				 <th colspan="3" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=issuesEdit|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($pager) && ($pager->getPage() ne 1)-|&page=|-$pager->getPage()-||-/if-|" class="addLink">Agregar ##issues,2,Asunto##</a></div></th>
			</tr>
			<tr class="thFillTitle"> 
				<th width="50%">##issues,2,Asunto##</th> 
				<th width="50%">##issues,2,Asunto##</th> 
				<th width="5%">&nbsp;</th> 
			</tr> 
		</thead> 
	<tbody>|-if $issues|@count eq 0-|
		<tr>
			 <td colspan="3">|-if isset($filter)-|No hay ##issues,1,Asuntos## que concuerden con la búsqueda|-else-|No hay ##issues,1,Asuntos## disponibles|-/if-|</td>
		</tr>
	|-else-|
		|-foreach from=$issues item=issue name=for_issues-|
		<tr> 
			<td>|-$issue->getIssue()-|</td>
			<td>|-$issue->getIssue()-|</td>
			<td nowrap> <form action="Main.php" method="get" style="display:inline;"> 
					<input type="hidden" name="do" value="issuesEdit" /> 
						|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
						|-if isset($pager) && ($pager->getPage() ne 1)-| <input type="hidden" name="page" id="page" value="|-$pager->getPage()-|" />|-/if-|
					<input type="hidden" name="id" value="|-$issue->getid()-|" /> 
					<input type="submit" name="submit_go_edit_issue" value="Editar" titlke="Editar" class="icon iconEdit" /> 
				</form> 
				<form action="Main.php" method="post" style="display:inline;"> 
					<input type="hidden" name="do" value="issuesDoDelete" /> 
						|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
						|-if isset($pager) && ($pager->getPage() ne 1)-| <input type="hidden" name="page" id="page" value="|-$pager->getPage()-|" />|-/if-|
					<input type="hidden" name="id" value="|-$issue->getid()-|" /> 
					<input type="submit" name="submit_go_delete_issue" value="Borrar" title="Eliminar" onclick="return confirm('Seguro que desea eliminar el ##issues,2,Asunto##?')" class="icon iconDelete" /> 
			</form>
			|-if $loginUser->isSupervisor()-|				<form action="Main.php" method="post" style="display:inline;"> 
					<input type="hidden" name="do" value="issuesDoDelete" /> 
						|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
						|-if isset($pager) && ($pager->getPage() ne 1)-| <input type="hidden" name="page" id="page" value="|-$pager->getPage()-|" />|-/if-|
					<input type="hidden" name="id" value="|-$issue->getid()-|" /> 
					<input type="hidden" name="doHardDelete" value="true" /> 
					<input type="submit" name="submit_go_delete_issue" value="Borrar" title="Eliminar completamente" onclick="return confirm('Seguro que desea eliminar el ##issues,2,Asunto## definitivamente?')" class="icon iconHardDelete" /> 
			</form>|-/if-|</td> 
		</tr> 
		|-/foreach-|
		|-if isset($pager) && ($pager->getTotalPages() gt 1)-|
		<tr> 
			<td colspan="3" class="pages">|-include file="PaginateInclude.tpl"-|</td> 
		</tr>
		|-/if-|
			<tr>
				 <th colspan="3" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=issuesEdit|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($pager) && ($pager->getPage() ne 1)-|&page=|-$pager->getPage()-||-/if-|" class="addLink">Agregar ##issues,2,Asunto##</a></div></th>
			</tr>
		|-/if-|
		</tbody> 
		 </table> 
</div>
