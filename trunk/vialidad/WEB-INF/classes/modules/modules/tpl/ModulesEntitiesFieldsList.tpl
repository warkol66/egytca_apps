<h2>Configuración del Sistema</h2>
<h1>Administración de Campos de las Entidades del Sistema</h1>
<p>A continuación podrá administrar las entidades asociadas a los módulos del sistema.</p> 
<div id="systemWorking" style="display:none;"></div>
<table width="100%" cellpadding="5" cellspacing="0" class="tableTdBorders"> 
<tr>
			<td colspan="5" class="tdSearch"><a href="javascript:void(null);" onClick='switch_vis("divSearch");' class="tdTitSearch">Búsqueda de campos </a>
				<div id="divSearch" style="display:|-if $filters|@count gt 0-|block|-else-|none|-/if-|;"><form action='Main.php' method='get' style="display:inline;">
					<input type="hidden" name="do" value="modulesEntitiesFieldsList" />
					Nombre: <input name="filters[searchString]" id="filters[searchString]" type="text" value="|-if isset($filters.searchString)-||-$filters.searchString-||-/if-|" size="30" />
					Módulo: <select name="filters[searchModule]" id="filters[searchModule]">	
	<option value="">Seleccione módulo</option>|-foreach from=$modules item=eachModule name=for_modules-|
	<option value="|-$eachModule.MODULENAME-|" |-if $filters.searchModule eq $eachModule.MODULENAME-|selected="selected"|-/if-|>|-$eachModule.MODULENAME|multilang_get_translation:"common"-|</option>
	|-/foreach-|</select>
					Entidad: <select name="filters[searchEntity]" id="filters[searchEntity]">	
	<option value="">Seleccione Entidad</option>|-foreach from=$entities item=eachEntity name=for_entities-|
	<option value="|-$eachEntity->getId()-|" |-if $filters.searchEntity eq $eachEntity->getId()-|selected="selected"|-/if-|>|-$eachEntity->getName()-|</option>
	|-/foreach-|

					</select>
					&nbsp;&nbsp;<input type='submit' value='Buscar' class='tdSearchButton' />
			</form><form  method="get">
				<input type="hidden" name="do" value="modulesEntitiesFieldsList" />
				<input type="submit" value="Quitar Filtros" />
		</form></div></td>
		</tr>		<tr class="thFillTitle">
			<th colspan="5"><div class="rightLink"><a href="Main.php?do=modulesEntitiesFieldsEdit|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($pager) && ($pager->getPage() ne 1)-|&page=|-$pager->getPage()-||-/if-|" class="addNew">Agregar Campo</a></div></th>
		</tr>
	<tr class="thFillTitle"> 
		<th width="5%" scope="col">Id</th> 
		<th width="10%" scope="col">Módulo</th> 
		<th width="10%" scope="col">Entidad</th> 
		<th width="20%" scope="col">Campo</th> 
		<th width="65%" scope="col">Descripción</th> 
	</tr> 
	|-foreach from=$pager item=entityField name=for_entityField-|
	<tr> 
		<td>|-$entityField->getId()-|</td> 
		<td>|-$entityField->getModuleName()|multilang_get_translation:"common"-|</td> 
		<td>|-$entityField->getEntityName()-|</td> 
		<td><a href="Main.php?do=modulesEntitiesFieldsEdit&id=|-$entityField->getId()-||-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($page) -|&page=|-$page-||-/if-|">|-$entityField->getName()-|</a></td> 
		<td>|-$entityField->getDescription()-| </td> 
	</tr> 
	|-/foreach-|
		|-if isset($pager) && ($pager->getTotalPages() gt 1)-|
			<tr> 
				<td colspan="5" class="pages">|-include file="PaginateInclude.tpl"-|</td> 
			</tr>
		|-/if-|
		<tr class="thFillTitle">
			<th colspan="5"><div class="rightLink"><a href="Main.php?do=modulesEntitiesFieldsEdit|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($pager) && ($pager->getPage() ne 1)-|&page=|-$pager->getPage()-||-/if-|" class="addNew">Agregar Campo</a></div></th>
		</tr>
</table> 



