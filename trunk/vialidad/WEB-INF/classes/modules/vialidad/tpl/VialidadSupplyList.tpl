<h2>Insumos</h2>
<h1>Administraci&oacute;n de Insumos</h1>
<p>A continuaci&oacute;n se muestra la lista de Insumos cargados en el sistema.</p>
<div id="div_supplies"> 
	|-if $message eq "ok"-|
		<div class="successMessage">Insumo guardado correctamente</div>
	|-elseif $message eq "deleted_ok"-|
		<div class="successMessage">Insumo eliminado correctamente</div>
	|-/if-|
	<table id="table_supplies" class='tableTdBorders' cellpadding='5' cellspacing='0' width='100%'> 
		<thead> 
		<tr>
			<td colspan="2" class="tdSearch"><a href="javascript:void(null);" onClick='switch_vis("divSearch");' class="tdTitSearch">B&uacute;squeda de Insumos </a>
				<div id="divSearch" style="display:|-if $filters|@count gt 0-|block|-else-|none|-/if-|;">
				<form action='Main.php' method='get' style="display:inline;">
					<p>Texto: <input name="filters[searchString]" type="text" value="|-if isset($filters.searchString)-||-$filters.searchString-||-/if-|" size="30" title="Ingrese el texto a buscar" /></p>
					<p>Resultados por página |-html_options name="filters[perPage]" options=',10,25,50,100'|array:"valuekey" selected=$pager->getRowsPerPage()-|</p>
					<p>
						<input type="submit" value="Buscar" title="Buscar con los par&aacute;metros ingresados" />
						<input type="hidden" name="do" value="vialidadSupplyList" />
						&nbsp;&nbsp;
						|-if $filters|@count gt 0-|
						<input type="button" value="Quitar Filtros" onclick="location.href='Main.php?do=vialidadSupplyList'"/>
						|-/if-|
					</p>
				</form>
				</div>
			</td>
		</tr>
		
		|-if "vialidadSupplyEdit"|security_has_access-|
		<tr>
			<th colspan="2" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=vialidadSupplyEdit" class="addLink">Agregar Insumo</a></div></th>
		</tr>
		|-/if-|
		
		<tr class="thFillTitle"> 
			<th width="95%">Nombre</th>
			<th width="5%">&nbsp;</th>
		</tr>
		</thead>
	
		<tbody>
		|-if $supplies|@count eq 0-|
		<tr>
			<td colspan="2">|-if isset($filter)-|No hay Insumos que concuerden con la b&uacute;squeda|-else-|No hay Insumos disponibles|-/if-|</td>
		</tr>
		|-else-|
		|-foreach from=$supplies item=supply name=for_supples-|
		<tr> 
			<td>|-$supply->getName()|escape-|</td>
			<td nowrap>
				|-if "vialidadSupplyEdit"|security_has_access-|
				<form action="Main.php" method="get" style="display:inline;">
					<input type="hidden" name="do" value="vialidadSupplyEdit" />
					|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
					|-if isset($pager) && ($pager->getPage() ne 1)-|
					<input type="hidden" name="page" id="page" value="|-$pager->getPage()-|" />
					|-/if-|
					<input type="hidden" name="id" value="|-$supply->getid()-|" />
					<input type="submit" name="submit_go_edit_vialidad_supply" value="Editar" title="Editar" class="icon iconEdit" />
				</form>
				|-/if-|
				|-if "vialidadSupplyDoDelete"|security_has_access-|
				<form action="Main.php" method="post" style="display:inline;">
					<input type="hidden" name="do" value="vialidadSupplyDoDelete" />
					|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
					|-if isset($pager) && ($pager->getPage() ne 1)-|
					<input type="hidden" name="page" id="page" value="|-$pager->getPage()-|" />
					|-/if-|
					<input type="hidden" name="id" value="|-$supply->getid()-|" />
					<input type="submit" name="submit_go_delete_vialidad_supply" value="Borrar" title="Eliminar" onclick="return confirm('Seguro que desea eliminar el Insumo?')" class="icon iconDelete" />
				</form>
					
				|-if isset($loginUser) && $loginUser->isSupervisor()-|
				<form action="Main.php" method="post" style="display:inline;">
					<input type="hidden" name="do" value="vialidadSupplyDoDelete" />
					|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
					|-if isset($pager) && ($pager->getPage() ne 1)-|
					<input type="hidden" name="page" id="page" value="|-$pager->getPage()-|" />
					|-/if-|
					<input type="hidden" name="id" value="|-$supply->getid()-|" />
					<input type="hidden" name="doHardDelete" value="true" /> 
					<input type="submit" name="submit_go_delete_vialidad_supply" value="Borrar" title="Eliminar completamente" onclick="return confirm('Seguro que desea eliminar el Insumo definitivamente?')" class="icon iconHardDelete" /> 
				</form>
				|-/if-|
				|-/if-|
			</td>
		</tr> 
		|-/foreach-|
		|-/if-|
		
		|-if isset($pager) && ($pager->getTotalPages() gt 1)-|
		<tr> 
			<td colspan="2" class="pages">|-include file="PaginateInclude.tpl"-|</td> 
		</tr>
		|-/if-|
		
		|-if "vialidadSupplyEdit"|security_has_access-|
		<tr>
			<th colspan="2" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=vialidadSupplyEdit" class="addLink">Agregar Insumo</a></div></th>
		</tr>
		|-/if-|
		</tbody> 
	</table> 
</div>
