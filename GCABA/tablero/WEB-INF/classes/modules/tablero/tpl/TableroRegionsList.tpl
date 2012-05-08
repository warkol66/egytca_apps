<h2>##common,18,Configuración del Sistema##</h2>
<h1>Administración de Barrios
<!-- /Link VOLVER -->
</h1>
<p>A continuación podrá editar la lista de barrios del sistema.</p>
<div id="div_regions">
	|-if $message eq "ok"-|
		<div class="successMessage">Barrio guardado correctamente</div>
	|-elseif $message eq "deleted_ok"-|
		<div class="successMessage">Barrio eliminado correctamente</div>
	|-/if-|
	<table border="0" cellpadding="5" cellspacing="0"  class='tableTdBorders' id="tabla-regions">
		<thead>
			<tr>
				 <th colspan="3" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=tableroRegionsEdit" class="addLink">Agregar Barrio</a></div></th>
			</tr>
			<tr>
				<th width="5%" class="thFillTitle">Id</th>
				<th width="85%" class="thFillTitle">Nombre</th>
				<th width="10%" class="thFillTitle">&nbsp;</th>
			</tr>
		</thead>
		<tbody>|-if $regions|@count eq 0-|
			<tr>
				 <td colspan="7">|-if isset($filter)-|No hay Barrios que concuerden con la búsqueda|-else-|No hay Barrios disponibles|-/if-|</td>
			</tr>
		|-else-|
		|-foreach from=$regions item=region name=for_regions-|
			<tr>
				<td class="line1">|-$region->getid()-|</td>
				<td class="line1">|-$region->getname()-|</td>
				<td class="line1" nowrap>
					<form action="Main.php" method="get" style="display:inline;">
						<input type="hidden" name="do" value="tableroRegionsEdit" />
						<input type="hidden" name="id" value="|-$region->getid()-|" />
						<input type="submit" name="submit_go_edit_region" value="Editar" class="icon iconEdit" />
					</form>
					<form action="Main.php" method="post" style="display:inline;">
						<input type="hidden" name="do" value="tableroRegionsDoDelete" />
						<input type="hidden" name="id" value="|-$region->getid()-|" />
						<input type="submit" name="submit_go_delete_region" value="Borrar" onclick="return confirm('Seguro que desea eliminar el barrio?')" class="icon iconDelete" />
					</form>
				</td>
			</tr>
		|-/foreach-|						
		|-if isset($pager) && ($pager->getTotalPages() gt 1)-|
			<tr> 
				<td colspan="3" class="pages">|-include file="PaginateInclude.tpl"-|</td> 
			</tr>							
		|-/if-|
			<tr>
				 <th colspan="3" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=tableroRegionsEdit" class="addLink">Agregar Barrio</a></div></th>
			</tr>
		|-/if-|
		</tbody>
	</table>
</div>
