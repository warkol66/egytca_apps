<h2>Boletines</h2>
<h1>Administración de Boletines</h1>
<p>A continuación se muestra la lista de Boletines cargados en el sistema.</p>
<div id="div_bulletins"> 
	|-if $message eq "ok"-|
		<div class="successMessage">Boletín guardado correctamente</div>
	|-elseif $message eq "deleted_ok"-|
		<div class="successMessage">Boletín eliminado correctamente</div>
	|-/if-|
	<table id="table_bulletins" class='tableTdBorders' cellpadding='5' cellspacing='0' width='100%'> 
		<thead> 
		<tr>
			<td colspan="3" class="tdSearch"><a href="javascript:void(null);" onClick='switch_vis("divSearch");' class="tdTitSearch">Búsqueda de Boletines</a>
				<div id="divSearch" style="display:|-if $filters|@count gt 0-|block|-else-|none|-/if-|;">
				<form action='Main.php' method='get' style="display:inline;">
					<p>Texto: <input name="filters[searchString]" type="text" value="|-if isset($filters.searchString)-||-$filters.searchString-||-/if-|" size="30" title="Ingrese el texto a buscar" /></p>
					<p>Resultados por página |-html_options name="filters[perPage]" options=',10,25,50,100'|array:"valuekey" selected=$pager->getRowsPerPage()-|</p>
					<p>
						<input type="submit" value="Buscar" title="Buscar con los par&aacute;metros ingresados" />
						<input type="hidden" name="do" value="vialidadBulletinList" />
						&nbsp;&nbsp;
						|-if $filters|@count gt 0-|
						<input type="button" value="Quitar Filtros" onclick="location.href='Main.php?do=vialidadBulletinList'"/>
						|-/if-|
					</p>
				</form>
				</div>
			</td>
		</tr>
		
		|-if "vialidadBulletinEdit"|security_has_access-|
		<tr>
			<th colspan="3" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=vialidadBulletinEdit" class="addLink">Agregar Boletín</a></div></th>
		</tr>
		|-/if-|
		<tr class="thFillTitle"> 
			<th width="50%">Número de Boletín</th> 
			<th width="45%">Fecha</th> 
			<th width="5%">&nbsp;</th> 
		</tr> 
		</thead> 
		<tbody>
		|-if $bulletins|@count eq 0-|
		<tr>
			<td colspan="3">|-if isset($filter)-|No hay Boletines que concuerden con la búsqueda|-else-|No hay Boletines disponibles|-/if-|</td>
		</tr>
		|-else-|
		|-foreach from=$bulletins item=bulletin name=for_bulletins-|
		<tr> 
			<td>|-$bulletin->getNumber()-|</td>
			<td>|-$bulletin->getBulletindate()|date_format:"%B / %Y"|@ucfirst-|</td>
			<td nowrap>
				|-if "vialidadBulletinEdit"|security_has_access-|
				<form action="Main.php" method="get">
					<input type="hidden" name="do" value="vialidadBulletinEdit" />
					|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
					|-if isset($pager) && ($pager->getPage() ne 1)-|
					<input type="hidden" name="page" id="page" value="|-$pager->getPage()-|" />
					|-/if-|
					<input type="hidden" name="id" value="|-$bulletin->getid()-|" />
					<input type="submit" name="submit_go_edit_vialidad_bulletin" value="Editar" title="Editar" class="icon iconEdit" />
				</form>
				|-/if-|
				|-if "vialidadBulletinDoDelete"|security_has_access-|
				<form action="Main.php" method="post">
					<input type="hidden" name="do" value="vialidadBulletinDoDelete" />
					|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
					|-if isset($pager) && ($pager->getPage() ne 1)-|
					<input type="hidden" name="page" id="page" value="|-$pager->getPage()-|" />
					|-/if-|
					<input type="hidden" name="id" value="|-$bulletin->getid()-|" />
					<input type="submit" name="submit_go_delete_vialidad_bulletin" value="Borrar" title="Eliminar" onclick="return confirm('Seguro que desea eliminar el Boletín?')" class="icon iconDelete" />
				</form>
				|-if isset($loginUser) && $loginUser->isSupervisor()-|
				<form action="Main.php" method="post">
					<input type="hidden" name="do" value="vialidadBulletinDoDelete" />
					|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
					|-if isset($pager) && ($pager->getPage() ne 1)-|
					<input type="hidden" name="page" id="page" value="|-$pager->getPage()-|" />
					|-/if-|
					<input type="hidden" name="id" value="|-$bulletin->getid()-|" />
					<input type="hidden" name="doHardDelete" value="true" /> 
					<input type="submit" name="submit_go_delete_vialidad_bulletin" value="Borrar" title="Eliminar completamente" onclick="return confirm('Seguro que desea eliminar el Boletín definitivamente?')" class="icon iconHardDelete" /> 
				</form>
				|-/if-|
				|-/if-|
			</td>
		</tr> 
		|-/foreach-|
		|-/if-|
		|-if isset($pager) && ($pager->getTotalPages() gt 1)-|
		<tr> 
			<td colspan="3" class="pages">|-include file="PaginateInclude.tpl"-|</td> 
		</tr>
		|-/if-|
		|-if "vialidadBulletinEdit"|security_has_access-|
		<tr>
			<th colspan="3" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=vialidadBulletinEdit" class="addLink">Agregar Boletín</a></div></th>
		</tr>
		|-/if-|
		</tbody> 
	</table> 
</div>
