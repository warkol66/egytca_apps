<script type="text/javascript" src="scripts/lightbox.js"></script> 			
<div id="lightbox1" class="leightbox">
	<p align="right">				
		<a href="#" class="lbAction blackNoDecoration" rel="deactivate">Cerrar <input type="button" class="icon iconClose" /></a> 
	</p> 
	<div id="clientsViewWorking"></div>
	<div class="innerLighbox">
		<div id="clientsViewDiv"></div>
	</div>
</div> 
<h2>##clients,1,Clientes##</h2>
	<h1>Administración de ##clients,1,Clientes##</h1>
	<p>A continuación podrá editar la lista de ##clients,1,Clientes## del sistema.</p>
|-if $message eq "deleted"-|
	<div align='center' class='successMessage'>##clients,3,Cliente## eliminado</div>
|-elseif $message eq "errorUpdate"-|
	<div align='center' class='errorMessage'>Ha ocurrido un error al intentar guardar la información. Intente nuevamente.</div>
|-elseif $message eq "saved"-|
	<div align='center' class='successMessage'>Grupo de Usuarios guardado</div>
|-elseif $message eq "edited"-|
	<div align='center' class='successMessage'>##clients,3,Cliente## guardado</div>
|-elseif $message eq "blankName"-|
	<div align='center' class='errorMessage'>El Grupo de Usuarios debe tener un Nombre</div>
|-elseif $message eq "notAddedToGroup"-|
	<div align='center' class='errorMessage'>Ha ocurrido un error al intentar agregar la categoría al grupo</div>
|-elseif $message eq "notRemovedFromGroup"-|
	<div align='center' class='errorMessage'>Ha ocurrido un error al intentar eliminar la categoría del grupo</div>
|-/if-|
<table width='100%' border="0" cellpadding='5' cellspacing='0' class='tableTdBorders'>
	<tr>
		<td colspan='3' class="tdSearch"><a href="javascript:void(null);" onClick='switch_vis("divSearch");' class="tdTitSearch">Busqueda por nombre</a><div id="divSearch" style="display:|-if $filters|@count gt 0-|block|-else-|none|-/if-|;"><form action='Main.php' method='get'>
				<input type="hidden" name="do" value="clientsList" />
				Nombre: <input name="filters[searchString]" type="text" value="|-$filters.searchString-|" size="30" />
				&nbsp;&nbsp;<input type='submit' value='Buscar' />
				|-if $filters|@count gt 0-|<input name="rmoveFilters" type="button" value="Quitar filtros" onclick="location.href='Main.php?do=clientsList'" />|-/if-|
			</form></div></td>
	</tr>
	<tr>
		<th colspan="3"><div class="rightLink"><a href="Main.php?do=clientsEdit" class="addLink">Agregar ##clients,3,Cliente##</a></div></th>
	</tr>
	|-foreach from=$clients item=client name=for_client-|
	<tr>
		<td width="5%">|-$client->getId()-|</td>
		<td width="85%">|-$client->getName()-| |-if $client->getOwnerId() neq ""-||-assign var=owner value=$client->getOwner()-| [ Usuario Dueño: |-$owner->getUsername()-| ] |-/if-|</td>
		<td width="10%" nowrap>
					<form action="Main.php" method="get" style="display:inline;">
						
						<input type="hidden" name="do" value="clientsViewX" />
						<input type="hidden" name="id" value="|-$client->getId()-|" />
						<a href="#lightbox1" rel="lightbox1" class="lbOn"><input type="button" class="icon iconView" onClick='{new Ajax.Updater("clientsViewDiv", "Main.php?do=clientsViewX&id=|-$client->getId()-|", { method: "post", parameters: { id: "|-$client->getId()-|"}, evalScripts: true})};$("clientsViewWorking").innerHTML = "<span class=\"inProgress\">buscando información...</span>";' value="Ver detalle" name="submit_go_show_project" /></a>
					</form>
			<form action="Main.php" method="get" style="display:inline;"> 
			  <input type="hidden" name="do" value="clientsEdit" /> 
			  <input type="hidden" name="id" value="|-$client->getId()-|" /> 
					|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
					|-if isset($pager) && ($pager->getPage() ne 1)-| <input type="hidden" name="page" id="page" value="|-$pager->getPage()-|" />|-/if-|
			  <input type="submit" name="submit_go_edit_client" value="Editar" class="icon iconEdit" /> 
			</form>
			<form action="Main.php" method="post" style="display:inline;"> 
			  <input type="hidden" name="do" value="clientsDoDelete" /> 
			  <input type="hidden" name="id" value="|-$client->getId()-|" /> 
					|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
					|-if isset($pager) && ($pager->getPage() ne 1)-| <input type="hidden" name="page" id="page" value="|-$pager->getPage()-|" />|-/if-|
			  <input type="submit" name="submit_go_delete_client" value="Borrar" onclick="return confirm('Seguro que desea eliminar el ##clients,3,Cliente##?')" class="icon iconDelete" /> 
			</form>
    </td>
	</tr>
	|-/foreach-|
		|-if isset($pager) && ($pager->getTotalPages() gt 1)-|
	<tr>
		<td colspan="3" class="pages">|-include file="PaginateInclude.tpl"-|</td>
	</tr>
	|-/if-|
</table>
