<script type="text/javascript" src="scripts/lightbox.js"></script> 			
<div id="lightbox1" class="leightbox">
	<p align="right">				
		<a href="#" class="lbAction blackNoDecoration" rel="deactivate">Cerrar <input type="button" class="icon iconClose" /></a> 
	</p> 
	<div id="affiliatesViewWorking"></div>
	<div class="innerLighbox">
		<div id="affiliatesViewDiv"></div>
	</div>
</div> 
<h2>Clientes</h2>
	<h1>Administración de Clientes</h1>
	<p>A continuación podrá editar la lista de Clientes del sistema.</p>
|-if $message eq "deleted_ok"-|
	<div  class="successMessage">Cliente eliminado</div>
|-elseif $message eq "not_deleted"-|
	<div  class="errorMessage">No se pudo eliminar el cliente</div>
|-elseif $message eq "errorUpdate"-|
	<div  class="errorMessage">Ha ocurrido un error al intentar guardar la información. Intente nuevamente.</div>
|-elseif $message eq "saved"-|
	<div  class="successMessage">Cliente guardado</div>
|-elseif $message eq "ok"-|
	<div  class="successMessage">Cliente guardado</div>
|-/if-|
<table width='100%' border="0" cellpadding='5' cellspacing='0' class='tableTdBorders'>
	<tr>
		<td colspan="2" class="tdSearch"><a href="javascript:void(null);" onClick='switch_vis("divSearch");' class="tdTitSearch">Busqueda por nombre</a><div id="divSearch" style="display:|-if $filters|@count gt 0-|block|-else-|none|-/if-|;"><form action='Main.php' method='get'>
				<input type="hidden" name="do" value="affiliatesClientsList" />
				<p><label for="filters[searchString]">Razón Social</label> <input name="filters[searchString]" type="text" value="|-$filters.searchString-|" size="30" />
				&nbsp;&nbsp;<input type='submit' value='Buscar' />
				|-if $filters|@count gt 0-|<input name="rmoveFilters" type="button" value="Quitar filtros" onclick="location.href='Main.php?do=affiliatesClientsList'" />|-/if-|
			</p></form></div></td>
	</tr>
	|-if "affiliatesClientsEdit"|security_has_access-|<tr>
		<th colspan="2"><div class="rightLink"><a href="Main.php?do=affiliatesClientsEdit|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($pager) && ($pager->getPage() ne 1)-|&page=|-$pager->getPage()-||-/if-|" class="addLink">Agregar Cliente</a></div></th>
	</tr>|-/if-|
	|-foreach from=$affiliates item=affiliate name=for_affiliate-|
	<tr>
		<td width="90%">|-$affiliate->getName()-| |-if $affiliate->getOwnerId() neq ""-||-assign var=owner value=$affiliate->getOwner()-| [ Usuario Dueño: |-$owner->getUsername()-| ] |-/if-|</td>
		<td width="10%" nowrap>|-if "affiliatesClientsViewX"|security_has_access-|
					<form action="Main.php" method="get" style="display:inline;">
						<input type="hidden" name="do" value="affiliatesClientsViewX" />
						<input type="hidden" name="id" value="|-$affiliate->getId()-|" />
						<a href="#lightbox1" rel="lightbox1" class="lbOn"><input type="button" class="icon iconView" onClick='{new Ajax.Updater("affiliatesViewDiv", "Main.php?do=affiliatesClientsViewX&id=|-$affiliate->getId()-|", { method: "post", parameters: { id: "|-$affiliate->getId()-|"}, evalScripts: true})};$("affiliatesViewWorking").innerHTML = "<span class=\"inProgress\">buscando información...</span>";' value="Ver detalle" name="submit_go_show_project" /></a>
					</form>|-/if-|
			|-if "affiliatesClientsEdit"|security_has_access-|<form action="Main.php" method="get" style="display:inline;"> 
			  <input type="hidden" name="do" value="affiliatesClientsEdit" /> 
			  <input type="hidden" name="id" value="|-$affiliate->getId()-|" /> 
					|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
					|-if isset($pager) && ($pager->getPage() ne 1)-| <input type="hidden" name="page" id="page" value="|-$pager->getPage()-|" />|-/if-|
			  <input type="submit" name="submit_go_edit_affiliate" value="Editar" class="icon iconEdit" /> 
			</form>|-/if-|
			|-if "affiliatesClientsDoDelete"|security_has_access-|<form action="Main.php" method="post" style="display:inline;"> 
			  <input type="hidden" name="do" value="affiliatesClientsDoDelete" /> 
			  <input type="hidden" name="id" value="|-$affiliate->getId()-|" /> 
					|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
					|-if isset($pager) && ($pager->getPage() ne 1)-| <input type="hidden" name="page" id="page" value="|-$pager->getPage()-|" />|-/if-|
			  <input type="submit" name="submit_go_delete_affiliate" value="Borrar" onclick="return confirm('Seguro que desea eliminar el Cliente?')" class="icon iconDelete" /> 
			</form>|-/if-|
    </td>
	</tr>
	|-/foreach-|
		|-if isset($pager) && $pager->haveToPaginate()-|
	<tr>
		<td colspan="2" class="pages">|-include file="ModelPagerInclude.tpl"-|</td>
	</tr>
	|-/if-|
	|-if "affiliatesClientsEdit"|security_has_access && $affiliates|@count gt 5-|<tr>
		<th colspan="2"><div class="rightLink"><a href="Main.php?do=affiliatesClientsEdit|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($pager) && ($pager->getPage() ne 1)-|&page=|-$pager->getPage()-||-/if-|" class="addLink">Agregar Cliente</a></div></th>
	</tr>|-/if-|
</table>
