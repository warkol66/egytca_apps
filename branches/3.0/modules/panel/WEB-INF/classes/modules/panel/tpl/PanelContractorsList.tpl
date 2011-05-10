<h2>Tablero de Gestión</h2>
<h1>Administración de Contratistas</h1>
<p>A continuación se muestra la lista de contratistas cargados en el sistema.</p>
<div id="div_contractors"> 
	|-if $message eq "ok"-|
		<div class="successMessage">Contratista guardado correctamente</div>
	|-elseif $message eq "deleted_ok"-|
		<div class="successMessage">Contratista eliminado correctamente</div>
	|-/if-|
	<table id="tabla-contractors" class='tableTdBorders' cellpadding='5' cellspacing='0' width='100%'> 
		<thead> 
		<tr>
			<td colspan="6" class="tdSearch"><a href="javascript:void(null);" onClick='switch_vis("divSearch");' class="tdTitSearch">Busqueda contratistas</a>
				<div id="divSearch" style="display:|-if $filters|@count gt 0-|block|-else-|none|-/if-|;"><form action='Main.php' method='get' style="display:inline;">
					<input type="hidden" name="do" value="panelContractorsList" />
					Nombre: <input name="filters[searchString]" type="text" value="|-if isset($filters.searchString)-||-$filters.searchString-||-/if-|" size="30" title="Ingrese el texto a buscar" />
					CUIT: <input name="filters[searchCuit]" type="text" value="|-if isset($filters.searchCuit)-||-$filters.searchCuit-||-/if-|" size="15" title="Ingrese el CUIT sin espacios ni guiones" /><a class="tooltip" href="#"><span>Ingrese el CUIT sin espacios ni guiones</span><img src="images/icon_info.gif"></a>
					&nbsp;&nbsp;<input type='submit' value='Buscar' class='tdSearchButton' />
			</form>
					|-if $filters|@count gt 0-|<form  method="get">
				<input type="hidden" name="do" value="panelContractorsList" />
				<input type="submit" value="Quitar Filtros" />
		</form>|-/if-|</div></td>
		</tr>
			<tr>
				 <th colspan="6" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=panelContractorsEdit|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($pager) && ($pager->getPage() ne 1)-|&page=|-$pager->getPage()-||-/if-|" class="addNew">Agregar Contratista</a></div></th>
			</tr>
			<tr class="thFillTitle"> 
	<!--			<th width="5%">Id</th> -->
				<th width="30%">Razón Social</th> 
				<th width="5%">Cuit</th> 
				<th width="10%">Teléfono</th> 
				<th width="20%">Dirección</th> 
				<th width="15%">Contacto</th> 
				<th width="5%">&nbsp;</th> 
			</tr> 
		</thead> 
	<tbody>|-if $contractors|@count eq 0-|
		<tr>
			 <td colspan="6">|-if isset($filter)-|No hay Contratistas que concuerden con la búsqueda|-else-|No hay Contratistas disponibles|-/if-|</td>
		</tr>
	|-else-|
		|-foreach from=$contractors item=contractor name=for_contractors-|
		<tr> 
	<!--		<td>|-$contractor->getid()-|</td> -->
			<td>|-$contractor->getName()-|</td> 
			<td>|-$contractor->getCuit()-|</td>
			<td>|-$contractor->getPhone()-|</td> 
			<td>|-$contractor->getAddress()-|</td> 
			<td>|-$contractor->getContact()-|</td> 
			<td nowrap> <form action="Main.php" method="get" style="display:inline;"> 
					<input type="hidden" name="do" value="panelContractorsEdit" /> 
						|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
						|-if isset($pager) && ($pager->getPage() ne 1)-| <input type="hidden" name="page" id="page" value="|-$pager->getPage()-|" />|-/if-|
					<input type="hidden" name="id" value="|-$contractor->getid()-|" /> 
					<input type="submit" name="submit_go_edit_contractor" value="Editar" class="buttonImageEdit" /> 
				</form>
				|-if $loginUser->isAdmin() || $loginUser->isSupervisor()-|
				<form action="Main.php" method="post" style="display:inline;"> 
					<input type="hidden" name="do" value="panelContractorsDoDelete" /> 
						|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
						|-if isset($pager) && ($pager->getPage() ne 1)-| <input type="hidden" name="page" id="page" value="|-$pager->getPage()-|" />|-/if-|
					<input type="hidden" name="id" value="|-$contractor->getid()-|" /> 
					<input type="submit" name="submit_go_delete_contractor" value="Borrar" onclick="return confirm('Seguro que desea eliminar el contratista?')" class="buttonImageDelete" /> 
			</form>
			|-/if-|
			|-if $loginUser->isSupervisor()-|				<form action="Main.php" method="post" style="display:inline;"> 
					<input type="hidden" name="do" value="panelContractorsDoDelete" /> 
						|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
						|-if isset($pager) && ($pager->getPage() ne 1)-| <input type="hidden" name="page" id="page" value="|-$pager->getPage()-|" />|-/if-|
					<input type="hidden" name="id" value="|-$contractor->getid()-|" /> 
					<input type="hidden" name="doHardDelete" value="true" /> 
					<input type="submit" name="submit_go_delete_contractor" value="Borrar" onclick="return confirm('Seguro que desea eliminar el contratista definitivamente?')" class="buttonImageDelete" /> 
			</form>|-/if-|</td> 
		</tr> 
		|-/foreach-|
		|-if isset($pager) && ($pager->getTotalPages() gt 1)-|
		<tr> 
			<td colspan="6" class="pages">|-include file="PaginateInclude.tpl"-|</td> 
		</tr>
		|-/if-|
			<tr>
				 <th colspan="6" class="thFillTitle">|-if $contractors|@count gt 5-|<div class="rightLink"><a href="Main.php?do=panelContractorsEdit|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($pager) && ($pager->getPage() ne 1)-|&page=|-$pager->getPage()-||-/if-|" class="addNew">Agregar Contratista</a></div>|-/if-|</th>
			</tr>
		|-/if-|
		</tbody> 
		 </table> 
</div>
