<h2>Configuración del Sistema</h2>
<h1>Administración de Entidades del Sistema</h1>
<p>A continuación podrá administrar las entidades asociadas a los módulos del sistema.</p> 
<div id="systemWorking" style="display:none;"></div>
	|-if $message eq "ok"-|
		<div class="successMessage">Entidad guardada correctamente</div>
	|-elseif $message eq "deleted_ok"-|
		<div class="successMessage">Entidad eliminada correctamente</div>		
	|-/if-|
<table width="100%" cellpadding="5" cellspacing="0" class="tableTdBorders"> 
<tr>
			<td colspan="6" class="tdSearch"><a href="javascript:void(null);" onClick='switch_vis("divSearch");' class="tdTitSearch">Búsqueda de entidades</a>
				<div id="divSearch" style="display:|-if $filters|@count gt 0-|block|-else-|none|-/if-|;"><form action='Main.php' method='get' style="display:inline;">
					<input type="hidden" name="do" value="modulesEntitiesList" />
					Nombre: <input name="filters[searchString]" id="filters[searchString]" type="text" value="|-if isset($filters.searchString)-||-$filters.searchString-||-/if-|" size="30" />
					Módulo: <select name="filters[searchModule]" id="filters[searchModule]">	
	<option value="">Seleccione módulo</option>|-foreach from=$modules item=eachModule name=for_modules-|
	<option value="|-$eachModule.MODULENAME-|" |-if $filters.searchModule eq $eachModule.MODULENAME-|selected="selected"|-/if-|>|-$eachModule.MODULENAME|multilang_get_translation:"common"-|</option>
	|-/foreach-|

					</select>
					&nbsp;&nbsp;<input type='submit' value='Buscar' class='tdSearchButton' />
			</form><form  method="get">
				<input type="hidden" name="do" value="modulesEntitiesList" />
				<input type="submit" value="Quitar Filtros" />
		</form></div></td>
		</tr>
				<tr class="thFillTitle">
			<th colspan="6"><div class="rightLink"><a href="Main.php?do=modulesEntitiesCreate|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($pager) && ($pager->getPage() ne 1)-|&page=|-$pager->getPage()-||-/if-|" class="addNew">Agregar Entidad</a></div></th>
		</tr>
	<tr class="thFillTitle"> 
		<th width="10%" scope="col">Módulo</th> 
		<th width="20%" scope="col">Entidad</th> 
		<th width="55%" scope="col">Descripción</th> 
		<th width="5%" scope="col">Schema</th>
		<th width="5%" scope="col">Sql</th>
	</tr> 
	|-foreach from=$pager item=entity name=for_entities-|
	<tr> 
		<td nowrap="nowrap">
			|-$entity->getModuleName()|multilang_get_translation:"common"-| 
			<a href="javascript:void(null);" onClick='switch_vis("entity_|-$entity->getId()-|");'>Ver campos</a>
			<a href="Main.php?do=modulesEntitiesFieldsEdit&entityId=|-$entity->getId()-|">Agregar Campo</a>
		</td> 
		<td><a href="Main.php?do=modulesEntitiesEdit&id=|-$entity->getId()-||-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($page) -|&page=|-$page-||-/if-|">|-$entity->getName()-|</a></td> 
		<td>|-$entity->getDescription()-|</td> 
		<td><a href="Main.php?do=modulesEntitiesSchemaGet&id=|-$entity->getId()-|">Schema</a></td>
		<td><a href="Main.php?do=modulesEntitiesSqlGet&id=|-$entity->getId()-|">Sql</a></td>
	</tr> 
	<tr> 
		<td colspan="6" class="noPaddingCell"><div id="entity_|-$entity->getId()-|" style="display:none;margin-left:30px;">|-assign var=entityFields value=$entity->getAllEntityFields()-|<fieldset>
			<ul>|-foreach from=$entityFields item=field name=for_fields-|
			<li><a href="Main.php?do=modulesEntitiesFieldsEdit&id=|-$field->getId()-|">|-$field->getName()-|</a> |-$field->getDescription()-| </li>
			|-/foreach-|</ul></fieldset>
			</div>
</td> 
	</tr> 
	|-/foreach-|
		|-if isset($pager) && ($pager->getTotalPages() gt 1)-|
			<tr> 
				<td colspan="6" class="pages">|-include file="PaginateInclude.tpl"-|</td> 
			</tr>
		|-/if-|
		<tr class="thFillTitle">
			<th colspan="6"><div class="rightLink"><a href="Main.php?do=modulesEntitiesEdit|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($pager) && ($pager->getPage() ne 1)-|&page=|-$pager->getPage()-||-/if-|" class="addNew">Agregar Entidad</a></div></th>
		</tr>
</table> 
