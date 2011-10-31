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
<h2>Items de Constrcción</h2>
	<h1>Administración de Items de Constrcción</h1>
	<p>A continuación podrá editar la lista de Items de Constrcción del sistema.</p>
|-if $message eq "ok"-|
	<div  class="successMessage">Items de Constrcción guardado correctamente</div>
|-elseif $message eq "deleted_ok"-|
	<div  class="successMessage">Items de Constrcción eliminado</div>
|-elseif $message eq "not_deleted"-|
	<div  class="errorMessage">Ha ocurrido un error al intentar eliminar el Items de Constrcción.</div>
|-elseif $message eq "edited"-|
	<div  class="successMessage">Items de Constrcción guardado</div>
|-/if-|
<table width='100%' border="0" cellpadding='5' cellspacing='0' class='tableTdBorders'>
	<tr>
		<td colspan='2' class="tdSearch">
			<a href="javascript:void(null);" onClick='switch_vis("divSearch");' class="tdTitSearch">Busqueda por nombre</a>
			<div id="divSearch" style="display:|-if $filters|@count gt 0-|block|-else-|none|-/if-|;">
				<form action='Main.php' method='get'>
					<input type="hidden" name="do" value="vialidadConstructionItemList" />
					Nombre:
					<input name="filters[searchString]" type="text" value="|-$filters.searchString-|" size="30" />
					&nbsp;&nbsp;
					<input type='submit' value='Buscar' />
					|-if $filters|@count gt 0-|
					<input name="removeFilters" type="button" value="Quitar filtros" onclick="location.href='Main.php?do=vialidadConstructionItemList'" />
					|-/if-|
				</form>
			</div>
		</td>
	</tr>
	|-if "vialidadConstructionItemEdit"|security_has_access-|<tr>
		<th colspan="2" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=vialidadConstructionItemEdit|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($pager) && ($pager->getPage() ne 1)-|&page=|-$pager->getPage()-||-/if-|" class="addLink">Agregar Item</a></div></th>
	</tr>|-/if-|
	|-foreach from=$items item=item name=for_item-|
	<tr>
		<td width="95%">|-$item->getName()-|</td>
		<td width="5%" nowrap align="center">
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
		<td colspan="2" class="pages">|-include file="ModelPagerInclude.tpl"-|</td>
	</tr>
	|-/if-|
	|-if "vialidadConstructionItemEdit"|security_has_access && $items|@count gt 5-|<tr>
		<th colspan="2" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=vialidadConstructionItemEdit|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($pager) && ($pager->getPage() ne 1)-|&page=|-$pager->getPage()-||-/if-|" class="addLink">Agregar Item</a></div></th>
	</tr>|-/if-|
</table>
