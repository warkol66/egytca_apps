<h2>Experiencias</h2>
<h1>Administración de Experiencias</h1>
<p>A continuación se muestra la lista de Experiencias cargados en el sistema.</p>
<div id="div_studycases"> 
	|-if $message eq "ok"-|
		<div class="successMessage">Experiencia guardada correctamente</div>
	|-elseif $message eq "deleted_ok"-|
		<div class="successMessage">Experiencia eliminada correctamente</div>
	|-/if-|
	<table id="tabla-studycases" class='tableTdBorders' cellpadding='5' cellspacing='0' width='100%'> 
		<thead> 
		<tr>
			<td colspan="4" class="tdSearch"><a href="javascript:void(null);" onClick='switch_vis("divSearch");' class="tdTitSearch">Busqueda de Experiencias</a>
				<div id="divSearch" style="display:|-if $filters|@count gt 0-|block|-else-|none|-/if-|;"><form action='Main.php' method='get' style="display:inline;">
					<input type="hidden" name="do" value="studycasesList" />
					Texto: <input name="filters[searchString]" type="text" value="|-if isset($filters.searchString)-||-$filters.searchString-||-/if-|" size="30" title="Ingrese el texto a buscar" />
					&nbsp;&nbsp;<input type='submit' value='Buscar' class='tdSearchButton' />
			</form>
					|-if $filters|@count gt 0-|<form  method="get">
				<input type="hidden" name="do" value="studycasesList" />
				<input type="submit" value="Quitar Filtros" />
		</form>|-/if-|</div></td>
		</tr>
			<tr>
				 <th colspan="4" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=studycasesEdit|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($pager) && ($pager->getPage() ne 1)-|&page=|-$pager->getPage()-||-/if-|" class="addNew">Agregar Experiencia</a></div></th>
			</tr>
			<tr class="thFillTitle"> 
	<!--			<th width="5%">Id</th> -->
				<th width="30%">Experiencia</th> 
				<th width="65%">Resumen</th> 
				<th width="10%">Publicada</th> 
				<th width="5%">&nbsp;</th> 
			</tr> 
		</thead> 
	<tbody>|-if $studycases|@count eq 0-|
		<tr>
			 <td colspan="4">|-if isset($filter)-|No hay Experiencias que concuerden con la búsqueda|-else-|No hay Experiencias disponibles|-/if-|</td>
		</tr>
	|-else-|
		|-foreach from=$studycases item=studycase name=for_studycases-|
		<tr> 
	<!--		<td>|-$studycase->getid()-|</td> -->
			<td>|-$studycase->getTitle()-|</td> 
			<td>|-$studycase->getSummary()-|</td>
			<td>|-$studycase->getPublished()|yes_no|multilang_get_translation:"common"-|</td>
			<td nowrap> <form action="Main.php" method="get" style="display:inline;"> 
					<input type="hidden" name="do" value="studycasesEdit" /> 
						|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
						|-if isset($pager) && ($pager->getPage() ne 1)-| <input type="hidden" name="page" id="page" value="|-$pager->getPage()-|" />|-/if-|
					<input type="hidden" name="id" value="|-$studycase->getid()-|" /> 
					<input type="submit" name="submit_go_edit_studycase" value="Editar" class="buttonImageEdit" /> 
				</form> 
				<form action="Main.php" method="post" style="display:inline;"> 
					<input type="hidden" name="do" value="studycasesDoDelete" /> 
						|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
						|-if isset($pager) && ($pager->getPage() ne 1)-| <input type="hidden" name="page" id="page" value="|-$pager->getPage()-|" />|-/if-|
					<input type="hidden" name="id" value="|-$studycase->getid()-|" /> 
					<input type="submit" name="submit_go_delete_studycase" value="Borrar" onclick="return confirm('Seguro que desea eliminar el Experiencia?')" class="buttonImageDelete" /> 
			</form></td> 
		</tr> 
		|-/foreach-|
		|-if isset($pager) && ($pager->getTotalPages() gt 1)-|
		<tr> 
			<td colspan="4" class="pages">|-include file="PaginateInclude.tpl"-|</td> 
		</tr>
		|-/if-|
			<tr>
				 <th colspan="4" class="thFillTitle">|-if $studycases|@count gt 5-|<div class="rightLink"><a href="Main.php?do=studycasesEdit|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($pager) && ($pager->getPage() ne 1)-|&page=|-$pager->getPage()-||-/if-|" class="addNew">Agregar Experiencia</a></div>|-/if-|</th>
			</tr>
		|-/if-|
		</tbody> 
		 </table> 
</div>
