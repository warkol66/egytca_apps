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
<h2>Proveedores</h2>
	<h1>Administración de Proveedores</h1>
	<p>A continuación podrá editar la lista de Proveedores del sistema.</p>
|-if $message eq "ok"-|
	<div  class="successMessage">Proveedor guardado correctamente</div>
|-elseif $message eq "deleted_ok"-|
	<div  class="successMessage">Proveedor eliminado</div>
|-elseif $message eq "not_deleted"-|
	<div  class="errorMessage">Ha ocurrido un error al intentar eliminar el proveedor.</div>
|-elseif $message eq "saved"-|
	<div  class="successMessage">Grupo de Usuarios guardado</div>
|-elseif $message eq "edited"-|
	<div  class="successMessage">Proveedor guardado</div>
|-elseif $message eq "blankName"-|
	<div  class="errorMessage">El Grupo de Usuarios debe tener un Nombre</div>
|-elseif $message eq "notAddedToGroup"-|
	<div  class="errorMessage">Ha ocurrido un error al intentar agregar la categoría al grupo</div>
|-elseif $message eq "notRemovedFromGroup"-|
	<div  class="errorMessage">Ha ocurrido un error al intentar eliminar la categoría del grupo</div>
|-/if-|
<table width='100%' border="0" cellpadding='5' cellspacing='0' class='tableTdBorders'>
	<tr>
		<td colspan='3' class="tdSearch"><a href="javascript:void(null);" onClick='switch_vis("divSearch");' class="tdTitSearch">Busqueda por nombre</a><div id="divSearch" style="display:|-if $filters|@count gt 0-|block|-else-|none|-/if-|;"><form action='Main.php' method='get'>
				<input type="hidden" name="do" value="vialidadSuppliersList" />
				Nombre: <input name="filters[searchString]" type="text" value="|-$filters.searchString-|" size="30" />
				&nbsp;&nbsp;<input type='submit' value='Buscar' />
				|-if $filters|@count gt 0-|<input name="rmoveFilters" type="button" value="Quitar filtros" onclick="location.href='Main.php?do=vialidadSuppliersList'" />|-/if-|
			</form></div></td>
	</tr>
	|-if "vialidadSuppliersEdit"|security_has_access-|<tr>
		<th colspan="3"><div class="rightLink"><a href="Main.php?do=vialidadSuppliersEdit|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($pager) && ($pager->getPage() ne 1)-|&page=|-$pager->getPage()-||-/if-|" class="addLink">Agregar Proveedor</a></div></th>
	</tr>|-/if-|
	|-foreach from=$suppliers item=supplier name=for_supplier-|
	<tr>
		<td width="5%">|-$supplier->getId()-|</td>
		<td width="85%">|-$supplier->getName()-|</td>
		<td width="10%" nowrap>|-if "vialidadSuppliersViewX"|security_has_access-|
					<form action="Main.php" method="get" style="display:inline;">
						<input type="hidden" name="do" value="vialidadSuppliersViewX" />
						<input type="hidden" name="id" value="|-$supplier->getId()-|" />
						<a href="#lightbox1" rel="lightbox1" class="lbOn"><input type="button" class="icon iconView" onClick='{new Ajax.Updater("vialidadSuppliersViewDiv", "Main.php?do=vialidadSuppliersViewX&id=|-$supplier->getId()-|", { method: "post", parameters: { id: "|-$supplier->getId()-|"}, evalScripts: true})};$("vialidadSuppliersViewWorking").innerHTML = "<span class=\"inProgress\">buscando información...</span>";' value="Ver detalle" name="submit_go_show_project" /></a>
					</form>|-/if-|
			|-if "vialidadSuppliersEdit"|security_has_access-|<form action="Main.php" method="get" style="display:inline;"> 
			  <input type="hidden" name="do" value="vialidadSuppliersEdit" /> 
			  <input type="hidden" name="id" value="|-$supplier->getId()-|" /> 
					|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
					|-if isset($pager) && ($pager->getPage() ne 1)-| <input type="hidden" name="page" id="page" value="|-$pager->getPage()-|" />|-/if-|
			  <input type="submit" name="submit_go_edit_supplier" value="Editar" class="icon iconEdit" /> 
			</form>|-/if-|
			|-if "vialidadSuppliersDoDelete"|security_has_access-|<form action="Main.php" method="post" style="display:inline;"> 
			  <input type="hidden" name="do" value="vialidadSuppliersDoDelete" /> 
			  <input type="hidden" name="id" value="|-$supplier->getId()-|" /> 
					|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
					|-if isset($pager) && ($pager->getPage() ne 1)-| <input type="hidden" name="page" id="page" value="|-$pager->getPage()-|" />|-/if-|
			  <input type="submit" name="submit_go_delete_supplier" value="Borrar" onclick="return confirm('Seguro que desea eliminar el Proveedor?')" class="icon iconDelete" /> 
			</form>|-/if-|
    </td>
	</tr>
	|-/foreach-|
		|-if isset($pager) && $pager->haveToPaginate()-|
	<tr>
		<td colspan="3" class="pages">|-include file="ModelPagerInclude.tpl"-|</td>
	</tr>
	|-/if-|
	|-if "vialidadSuppliersEdit"|security_has_access && $vialidadSuppliers|@count gt 5-|<tr>
		<th colspan="3"><div class="rightLink"><a href="Main.php?do=vialidadSuppliersEdit|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($pager) && ($pager->getPage() ne 1)-|&page=|-$pager->getPage()-||-/if-|" class="addLink">Agregar Proveedor</a></div></th>
	</tr>|-/if-|
</table>
