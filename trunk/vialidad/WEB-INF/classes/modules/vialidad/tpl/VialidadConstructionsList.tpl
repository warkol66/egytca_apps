|-include file="CommonAutocompleterInclude.tpl" -|
<script type="text/javascript" src="scripts/lightbox.js"></script>
<div id="lightbox1" class="leightbox">
	<p align="right">				
		<a href="#" class="lbAction blackNoDecoration" rel="deactivate">Cerrar <input type="button" class="icon iconClose" /></a> 
	</p> 
	<div id="vialidadConstructionsViewWorking"></div>
	<div class="innerLighbox">
		<div id="vialidadConstructionsViewDiv"></div>
	</div>
</div> 
<h2>Obras</h2>
	<h1>Administración de Obras</h1>
	<p>A continuación podrá editar la lista de Obras del sistema.</p>
|-if $message eq "ok"-|
	<div  class="successMessage">Obra guardado correctamente</div>
|-elseif $message eq "deleted_ok"-|
	<div  class="successMessage">Obra eliminado</div>
|-elseif $message eq "not_deleted"-|
	<div  class="errorMessage">Ha ocurrido un error al intentar eliminar el proveedor.</div>
|-elseif $message eq "saved"-|
	<div  class="successMessage">Grupo de Usuarios guardado</div>
|-elseif $message eq "edited"-|
	<div  class="successMessage">Obra guardado</div>
|-elseif $message eq "blankName"-|
	<div  class="errorMessage">El Grupo de Usuarios debe tener un Nombre</div>
|-elseif $message eq "notAddedToGroup"-|
	<div  class="errorMessage">Ha ocurrido un error al intentar agregar la categoría al grupo</div>
|-elseif $message eq "notRemovedFromGroup"-|
	<div  class="errorMessage">Ha ocurrido un error al intentar eliminar la categoría del grupo</div>
|-/if-|
<table width='100%' border="0" cellpadding='5' cellspacing='0' class='tableTdBorders'>
	<tr>
		<td colspan='3' class="tdSearch"><a href="javascript:void(null);" onClick='switch_vis("divSearch");' class="tdTitSearch">Buscar obra</a><div id="divSearch" style="display:|-if $filters|@count gt 0-|block|-else-|none|-/if-|;"><form action='Main.php' method='get'>
			<input type="hidden" name="do" value="vialidadConstructionsList" />
			<p>
				<label for="filters[searchString]">Nombre</label>
				<input name="filters[searchString]" type="text" value="|-$filters.searchString-|" size="30" />
			</p>
			<p>
				<div div="div_filters[contractid]" style="position: relative;z-index:11000;">
				|-include file="CommonAutocompleterInstanceSimpleInclude.tpl" id="autocomplete_contracts" url="Main.php?do=vialidadContractsAutocompleteListX" hiddenName="filters[contractid]" disableSubmit="button_filtersSubmit" label="Contrato" defaultValue=$defaultContractValue-|
				</div>
			</p>
			<p>
				<div div="div_filters[verifierid]" style="position: relative;z-index:10000;">
				|-include file="CommonAutocompleterInstanceSimpleInclude.tpl" id="autocomplete_verifiers" url="Main.php?do=affiliatesVerifiersAutocompleteListX" hiddenName="filters[verifierid]" disableSubmit="button_filtersSubmit" label="Verificador" defaultValue=$defaultVerifierValue-|
				</div>
			</p>
			&nbsp;&nbsp;<input id="button_filtersSubmit" type='submit' value='Buscar' />
			|-if $filters|@count gt 0-|<input name="rmoveFilters" type="button" value="Quitar filtros" onclick="location.href='Main.php?do=vialidadConstructionsList'" />|-/if-|
			</form></div></td>
	</tr>
	|-if "vialidadConstructionsEdit"|security_has_access-|<tr>
		<th colspan="3"><div class="rightLink"><a href="Main.php?do=vialidadConstructionsEdit|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($pager) && ($pager->getPage() ne 1)-|&page=|-$pager->getPage()-||-/if-|" class="addLink">Agregar Obra</a></div></th>
	</tr>|-/if-|
	|-foreach from=$constructions item=construction name=for_construction-|
	<tr>
		<td width="5%">|-$construction->getId()-|</td>
		<td width="85%">|-$construction->getName()-|</td>
		<td width="10%" nowrap>|-if "vialidadConstructionsViewX"|security_has_access-|
					<form action="Main.php" method="get" style="display:inline;">
						<input type="hidden" name="do" value="vialidadConstructionsViewX" />
						<input type="hidden" name="id" value="|-$construction->getId()-|" />
						<a href="#lightbox1" rel="lightbox1" class="lbOn"><input type="button" class="icon iconView" onClick='{new Ajax.Updater("vialidadConstructionsViewDiv", "Main.php?do=vialidadConstructionsViewX&id=|-$construction->getId()-|", { method: "post", parameters: { id: "|-$construction->getId()-|"}, evalScripts: true})};$("vialidadConstructionsViewWorking").innerHTML = "<span class=\"inProgress\">buscando información...</span>";' value="Ver detalle" name="submit_go_show_project" /></a>
					</form>|-/if-|
			|-if "vialidadConstructionsEdit"|security_has_access-|<form action="Main.php" method="get" style="display:inline;"> 
			  <input type="hidden" name="do" value="vialidadConstructionsEdit" /> 
			  <input type="hidden" name="id" value="|-$construction->getId()-|" /> 
					|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
					|-if isset($pager) && ($pager->getPage() ne 1)-| <input type="hidden" name="page" id="page" value="|-$pager->getPage()-|" />|-/if-|
			  <input type="submit" name="submit_go_edit_construction" value="Editar" class="icon iconEdit" /> 
			</form>|-/if-|
			|-if "vialidadConstructionsDoDelete"|security_has_access-|<form action="Main.php" method="post" style="display:inline;"> 
			  <input type="hidden" name="do" value="vialidadConstructionsDoDelete" /> 
			  <input type="hidden" name="id" value="|-$construction->getId()-|" /> 
					|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
					|-if isset($pager) && ($pager->getPage() ne 1)-| <input type="hidden" name="page" id="page" value="|-$pager->getPage()-|" />|-/if-|
			  <input type="submit" name="submit_go_delete_construction" value="Borrar" onclick="return confirm('Seguro que desea eliminar el Obra?')" class="icon iconDelete" /> 
			</form>|-/if-|
    </td>
	</tr>
	|-/foreach-|
		|-if isset($pager) && $pager->haveToPaginate()-|
	<tr>
		<td colspan="3" class="pages">|-include file="PaginateInclude.tpl"-|</td>
	</tr>
	|-/if-|
	|-if "vialidadConstructionsEdit"|security_has_access && $vialidadConstructions|@count gt 5-|<tr>
		<th colspan="3"><div class="rightLink"><a href="Main.php?do=vialidadConstructionsEdit|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($pager) && ($pager->getPage() ne 1)-|&page=|-$pager->getPage()-||-/if-|" class="addLink">Agregar Obra</a></div></th>
	</tr>|-/if-|
</table>
