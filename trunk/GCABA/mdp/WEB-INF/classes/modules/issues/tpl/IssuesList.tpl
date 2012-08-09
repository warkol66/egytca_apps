<h2>##issues,1,Asuntos##</h2>
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
			<td colspan="|-if !$configModule->get('issues','basic')-|7|-else-|4|-/if-|" class="tdSearch"><a href="javascript:void(null);" onClick='switch_vis("divSearch");' class="tdTitSearch">Busqueda de ##issues,1,Asuntos## </a>
				<div id="divSearch" style="display:|-if $filters|@count gt 0-|block|-else-|none|-/if-|;"><form action='Main.php' method='get' style="display:inline;">
					<p>Texto: <input name="filters[searchString]" type="text" value="|-if isset($filters.searchString)-||-$filters.searchString-||-/if-|" size="30" title="Ingrese el texto a buscar" />
 |-if !$configModule->get('issues','basic')-|       Categoría <select name="filters[categoryId]" id="categoryId"> 
          <option value="">Seleccione Categoría</option> 
    	|-foreach from=$categories item=category name=for_categories-|
        <option value="|-$category->getId()-|" |-$category->getId()|selected:$filters.categoryId-|>|-section name=space loop=$category->getLevel()-| &nbsp; &nbsp;|-/section-||-$category->getName()-|</option> 
    	|-/foreach-|
        </select>

				&nbsp;
				Impacto
				<select id="filters[impact]" name="filters[impact]" >
					<option value="" >Seleccione</option>
				|-foreach from=$issueImpactTypes key=impactKey item=impact name=for_impact-|
        		<option value="|-$impactKey-|" |-$impactKey|selected:$filters.impact-|>|-$impact-|</option>
				|-/foreach-|
				</select>
			&nbsp;
			Valoración
				<select id="filters[valoration]" name="filters[valoration]" >
					<option value="" >Seleccione</option>
				|-foreach from=$issueValorationTypes key=valorationKey item=valoration name=for_valoration-|
        		<option value="|-$valorationKey-|" |-$valorationKey|selected:$filters.valoration-|>|-$valoration-|</option>
				|-/foreach-|
				</select>
			&nbsp;
				Evolución
				<select id="filters[evolution]" name="filters[evolution]" >
					<option value="" >Seleccione</option>
				|-foreach from=$issueEvolutionStages key=stageKey item=stage name=for_stage-|
        		<option value="|-$stageKey-|" |-$stageKey|selected:$filters.evolution-|>|-$stage-|</option>
				|-/foreach-|
				</select>
			Resultados por página |-html_options name="filters[perPage]" options=',10,25,50,100'|array:"valuekey" selected=$pager->getRowsPerPage()-|				</p>
				|-/if-|<p>
					<input type="submit" value="Buscar" title="Buscar con los parámetros ingresados" />
					<input type="hidden" name="do" value="issuesList" />
			&nbsp;&nbsp;|-if $filters|@count gt 0-|<input type="button" value="Quitar Filtros" onclick="location.href='Main.php?do=issuesList'"/>|-/if-|
			</p></form></div></td>
		</tr>
			|-if "issuesEdit"|security_has_access-|<tr>
				 <th colspan="|-if !$configModule->get('issues','basic')-|7|-else-|4|-/if-|" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=issuesEdit|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($pager) && ($pager->getPage() ne 1)-|&page=|-$pager->getPage()-||-/if-|" class="addLink">Agregar ##issues,2,Asunto##</a></div></th>
			</tr>|-/if-|
			<tr class="thFillTitle"> 
				<th width="20%">##issues,2,Asunto##</th> 
				<th width="35%">Descripción</th> 
				|-if !$configModule->get('issues','basic')-|<th width="10%">Valoración</th>
				<th width="10%">Impacto</th>
				<th width="10%">Evolución</th> |-/if-|
				<th width="15%">##issues,19,Sub asunto de##</th>
				<th width="1%">&nbsp;</th> 
			</tr> 
		</thead> 
	<tbody>|-if $issues|@count eq 0-|
		<tr>
			 <td colspan="|-if !$configModule->get('issues','basic')-|7|-else-|4|-/if-|">|-if isset($filter)-|No hay ##issues,1,Asuntos## que concuerden con la búsqueda|-else-|No hay ##issues,1,Asuntos## disponibles|-/if-|</td>
		</tr>
	|-else-|
		|-foreach from=$issues item=issue name=for_issues-|
		<tr> 
			<td>|-$issue->getName()|escape-|</td>
			<td>|-$issue->getDescription()|escape-|</td>
			|-if !$configModule->get('issues','basic')-|<td>|-$issue->getValorationTypeTranslated()-|</td>
			<td>|-$issue->getImpactTypeTranslated()-|</td>
			<td>|-$issue->getEvolutionStageTranslated()-|</td>|-/if-|
			<td>
				|-$issue->getParentIssue()-|
			</td>
			<td nowrap>|-if "issuesEdit"|security_has_access-|<form action="Main.php" method="get" style="display:inline;"> 
					<input type="hidden" name="do" value="issuesEdit" /> 
						|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
						|-if isset($pager) && ($pager->getPage() ne 1)-| <input type="hidden" name="page" id="page" value="|-$pager->getPage()-|" />|-/if-|
					<input type="hidden" name="id" value="|-$issue->getid()-|" /> 
					<input type="submit" name="submit_go_edit_issue" value="Editar" titlke="Editar" class="icon iconEdit" /> 
				</form>|-/if-|
				|-if "issuesDoDelete"|security_has_access-|<form action="Main.php" method="post" style="display:inline;"> 
					<input type="hidden" name="do" value="issuesDoDelete" /> 
						|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
						|-if isset($pager) && ($pager->getPage() ne 1)-| <input type="hidden" name="page" id="page" value="|-$pager->getPage()-|" />|-/if-|
					<input type="hidden" name="id" value="|-$issue->getid()-|" /> 
					<input type="submit" name="submit_go_delete_issue" value="Borrar" title="Eliminar" onclick="return confirm('Seguro que desea eliminar el ##issues,2,Asunto##?')" class="icon iconDelete" /> 
			</form>
			|-/if-|</td> 
		</tr> 
		|-/foreach-|
		|-if isset($pager) && ($pager->getTotalPages() gt 1)-|
		<tr> 
			<td colspan="|-if !$configModule->get('issues','basic')-|7|-else-|4|-/if-|" class="pages">|-include file="PaginateInclude.tpl"-|</td> 
		</tr>
		|-/if-|
			|-if "issuesEdit"|security_has_access-|<tr>
				 <th colspan="|-if !$configModule->get('issues','basic')-|7|-else-|4|-/if-|" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=issuesEdit|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($pager) && ($pager->getPage() ne 1)-|&page=|-$pager->getPage()-||-/if-|" class="addLink">Agregar ##issues,2,Asunto##</a></div></th>
			</tr>|-/if-|
		|-/if-|
		</tbody> 
		 </table> 
</div>
