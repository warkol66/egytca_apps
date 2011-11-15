|-include file="CommonAutocompleterInclude.tpl" -|
<script type="text/javascript" src="scripts/lightbox.js"></script> 
<div id="lightbox1" class="leightbox">
	<p align="right">				
		<a href="#" class="lbAction blackNoDecoration" rel="deactivate">Cerrar <input type="button" class="icon iconClose" /></a> 
	</p> 
	<div id="vialidadSuppliersViewWorking"></div>
	<div class="innerLighbox">
		<div id="vialidadSuppliersViewDiv"></div>
	</div>
</div> 
<h2>Items de Construcción</h2>
	<h1>Administración de Items de Construcción</h1>
	<p>A continuación podrá editar la lista de Items de Construcción del sistema.</p>
|-if $message eq "ok"-|
	<div  class="successMessage">Items de Construcción guardado correctamente</div>
|-elseif $message eq "deleted_ok"-|
	<div  class="successMessage">Items de Construcción eliminado</div>
|-elseif $message eq "not_deleted"-|
	<div  class="errorMessage">Ha ocurrido un error al intentar eliminar el Items de Construcción.</div>
|-elseif $message eq "edited"-|
	<div  class="successMessage">Items de Construcción guardado</div>
|-/if-|
<table width='100%' border="0" cellpadding='5' cellspacing='0' class='tableTdBorders'>
	<tr>
		<td colspan="4" class="tdSearch">
			<a href="javascript:void(null);" onClick='switch_vis("divSearch");' class="tdTitSearch">Búsqueda de items</a>
			<div id="divSearch" style="display:|-if $filters|@count gt 0-|block|-else-|none|-/if-|;">
				<form action='Main.php' method='get'>
					<input type="hidden" name="do" value="vialidadConstructionItemList" />
					<p>
						<label for="filters[searchString]">Nombre:</label>
						<input name="filters[searchString]" type="text" value="|-if isset($filters.searchString)-||-$filters.searchString-||-/if-|" size="30" title="Ingrese el nombre a buscar" />
					</p>
					<p>
						<label for="filters[constructionid]">Obra:</label>
						<div style="position: relative;z-index:11000;">
						|-include file="CommonAutocompleterInstanceSimpleInclude.tpl" id="autocomplete_constructions" url="Main.php?do=vialidadConstructionsAutocompleteListX" hiddenName="filters[constructionid]" disableSubmit="button_filtersSubmit"-|
						</div>
					</p>
					<p>
						<label for="filters[contractid]">Contrato:</label>
						<div style="position: relative;z-index:10000;">
						|-include file="CommonAutocompleterInstanceSimpleInclude.tpl" id="autocomplete_contracts" url="Main.php?do=vialidadContractsAutocompleteListX" hiddenName="filters[contractid]" disableSubmit="button_filtersSubmit"-|
						</div>
					</p>
					&nbsp;&nbsp;
					<input id="button_filtersSubmit" type='submit' value='Buscar' />
					|-if $filters|@count gt 0-|
					<input name="removeFilters" type="button" value="Quitar filtros" onclick="location.href='Main.php?do=vialidadConstructionItemList'" />
					|-/if-|
				</form>
			</div>
		</td>
	</tr>
	|-if "vialidadConstructionItemEdit"|security_has_access-|<tr>
		<th colspan="4" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=vialidadConstructionItemEdit|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($pager) && ($pager->getPage() ne 1)-|&page=|-$pager->getPage()-||-/if-|" class="addLink">Agregar Item</a></div></th>
	</tr>|-/if-|
	<tr>
		<th width="10%">Código</th>
		<th width="75%">Item</th>
		<th width="10%">Unidad</th>
		<th width="5%">&nbsp;
		</th>
	</tr>
	|-foreach from=$items item=item name=for_item-|
	<tr>
		<td nowrap="nowrap">|-$item->getCode()-|</td>
		<td>|-$item->getName()-|</td>
		<td nowrap="nowrap" align="center">|-$item->getUnit()-|</td>
		<td nowrap="nowrap">
			|-if "vialidadConstructionItemEdit"|security_has_access-|<form action="Main.php" method="get" style="display:inline;"> 
			  <input type="hidden" name="do" value="vialidadConstructionItemEdit" /> 
			  <input type="hidden" name="id" value="|-$item->getId()-|" /> 
					|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
					|-if isset($pager) && ($pager->getPage() ne 1)-| <input type="hidden" name="page" id="page" value="|-$pager->getPage()-|" />|-/if-|
			  <input type="submit" name="submit_go_edit_item" value="Editar" class="icon iconEdit" /> 
			</form>|-/if-|
			|-if "vialidadConstructionItemDoDelete"|security_has_access-|<form action="Main.php" method="post" style="display:inline;"> 
			  <input type="hidden" name="do" value="vialidadConstructionItemDoDelete" /> 
			  <input type="hidden" name="id" value="|-$item->getId()-|" /> 
					|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
					|-if isset($pager) && ($pager->getPage() ne 1)-| <input type="hidden" name="page" id="page" value="|-$pager->getPage()-|" />|-/if-|
			  <input type="submit" name="submit_go_delete_item" value="Borrar" onclick="return confirm('Seguro que desea eliminar el Item de Construcción?')" class="icon iconDelete" /> 
			</form>|-/if-|
		</td>
	</tr>
	|-/foreach-|
	|-if isset($pager) && $pager->haveToPaginate()-|
	<tr>
		<td colspan="4" class="pages">|-include file="ModelPagerInclude.tpl"-|</td>
	</tr>
	|-/if-|
	|-if "vialidadConstructionItemEdit"|security_has_access && $items|@count gt 5-|<tr>
		<th colspan="4" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=vialidadConstructionItemEdit|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($pager) && ($pager->getPage() ne 1)-|&page=|-$pager->getPage()-||-/if-|" class="addLink">Agregar Item</a></div></th>
	</tr>|-/if-|
</table>
