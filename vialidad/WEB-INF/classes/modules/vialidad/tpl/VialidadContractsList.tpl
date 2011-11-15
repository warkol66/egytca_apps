|-include file="CommonAutocompleterInclude.tpl" -|
<script type="text/javascript" src="scripts/lightbox.js"></script>
<div id="lightbox1" class="leightbox">
	<p align="right">				
		<a href="#" class="lbAction blackNoDecoration" rel="deactivate">Cerrar <input type="button" class="icon iconClose" /></a> 
	</p> 
	<div id="vialidadContractsViewWorking"></div>
	<div class="innerLighbox">
		<div id="vialidadContractsViewDiv"></div>
	</div>
</div> 
<h2>Contratos</h2>
	<h1>Administración de Contratos</h1>
	<p>A continuación podrá editar la lista de Contratos del sistema.</p>
|-if $message eq "ok"-|
	<div  class="successMessage">Contrato guardado correctamente</div>
|-elseif $message eq "deleted_ok"-|
	<div  class="successMessage">Contrato eliminado</div>
|-elseif $message eq "not_deleted"-|
	<div  class="errorMessage">Ha ocurrido un error al intentar eliminar el proveedor.</div>
|-elseif $message eq "saved"-|
	<div  class="successMessage">Grupo de Usuarios guardado</div>
|-elseif $message eq "edited"-|
	<div  class="successMessage">Contrato guardado</div>
|-elseif $message eq "blankName"-|
	<div  class="errorMessage">El Grupo de Usuarios debe tener un Nombre</div>
|-elseif $message eq "notAddedToGroup"-|
	<div  class="errorMessage">Ha ocurrido un error al intentar agregar la categoría al grupo</div>
|-elseif $message eq "notRemovedFromGroup"-|
	<div  class="errorMessage">Ha ocurrido un error al intentar eliminar la categoría del grupo</div>
|-/if-|
<table width='100%' border="0" cellpadding='5' cellspacing='0' class='tableTdBorders'>
	<tr>
		<td colspan='3' class="tdSearch"><a href="javascript:void(null);" onClick='switch_vis("divSearch");' class="tdTitSearch">Buscar contrato</a><div id="divSearch" style="display:|-if $filters|@count gt 0-|block|-else-|none|-/if-|;"><form action='Main.php' method='get'>
			<input type="hidden" name="do" value="vialidadContractsList" />
			<p>
				<label for="filters[searchString]">Nombre:</label>
				<input name="filters[searchString]" type="text" value="|-$filters.searchString-|" size="30" />
			</p>
			<p>
				<label for="filters[contractorid]">Contratista:</label>
				<div style="position: relative;z-index:10000;">
				|-include file="CommonAutocompleterInstanceSimpleInclude.tpl" url="Main.php?do=affiliatesContractorsAutocompleteListX" hiddenName="filters[contractorid]" disableSubmit="button_filtersSubmit"-|
				</div>
			</p>
			&nbsp;&nbsp;<input id="button_filtersSubmit" type='submit' value='Buscar' />
			|-if $filters|@count gt 0-|<input name="rmoveFilters" type="button" value="Quitar filtros" onclick="location.href='Main.php?do=vialidadContractsList'" />|-/if-|
			</form></div></td>
	</tr>
	|-if "vialidadContractsEdit"|security_has_access-|<tr>
		<th colspan="3"><div class="rightLink"><a href="Main.php?do=vialidadContractsEdit|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($pager) && ($pager->getPage() ne 1)-|&page=|-$pager->getPage()-||-/if-|" class="addLink">Agregar Contrato</a></div></th>
	</tr>|-/if-|
	|-foreach from=$contracts item=contract name=for_contract-|
	<tr>
		<td width="5%">|-$contract->getId()-|</td>
		<td width="85%">|-$contract->getName()-|</td>
		<td width="10%" nowrap>|-if "vialidadContractsViewX"|security_has_access-|
					<form action="Main.php" method="get" style="display:inline;">
						<input type="hidden" name="do" value="vialidadContractsViewX" />
						<input type="hidden" name="id" value="|-$contract->getId()-|" />
						<a href="#lightbox1" rel="lightbox1" class="lbOn"><input type="button" class="icon iconView" onClick='{new Ajax.Updater("vialidadContractsViewDiv", "Main.php?do=vialidadContractsViewX&id=|-$contract->getId()-|", { method: "post", parameters: { id: "|-$contract->getId()-|"}, evalScripts: true})};$("vialidadContractsViewWorking").innerHTML = "<span class=\"inProgress\">buscando información...</span>";' value="Ver detalle" name="submit_go_show_project" /></a>
					</form>|-/if-|
			|-if "vialidadContractsEdit"|security_has_access-|<form action="Main.php" method="get" style="display:inline;"> 
			  <input type="hidden" name="do" value="vialidadContractsEdit" /> 
			  <input type="hidden" name="id" value="|-$contract->getId()-|" /> 
					|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
					|-if isset($pager) && ($pager->getPage() ne 1)-| <input type="hidden" name="page" id="page" value="|-$pager->getPage()-|" />|-/if-|
			  <input type="submit" name="submit_go_edit_contract" value="Editar" class="icon iconEdit" /> 
			</form>|-/if-|
			|-if "vialidadContractsDoDelete"|security_has_access-|<form action="Main.php" method="post" style="display:inline;"> 
			  <input type="hidden" name="do" value="vialidadContractsDoDelete" /> 
			  <input type="hidden" name="id" value="|-$contract->getId()-|" /> 
					|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
					|-if isset($pager) && ($pager->getPage() ne 1)-| <input type="hidden" name="page" id="page" value="|-$pager->getPage()-|" />|-/if-|
			  <input type="submit" name="submit_go_delete_contract" value="Borrar" onclick="return confirm('Seguro que desea eliminar el Contrato?')" class="icon iconDelete" /> 
			</form>|-/if-|
    </td>
	</tr>
	|-/foreach-|
		|-if isset($pager) && $pager->haveToPaginate()-|
	<tr>
		<td colspan="3" class="pages">|-include file="PaginateInclude.tpl"-|</td>
	</tr>
	|-/if-|
	|-if "vialidadContractsEdit"|security_has_access && $vialidadContracts|@count gt 5-|<tr>
		<th colspan="3"><div class="rightLink"><a href="Main.php?do=vialidadContractsEdit|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($pager) && ($pager->getPage() ne 1)-|&page=|-$pager->getPage()-||-/if-|" class="addLink">Agregar Contrato</a></div></th>
	</tr>|-/if-|
</table>
