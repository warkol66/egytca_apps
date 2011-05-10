<h2>Configuración del Sistema</h2>
<h1>Listado de Barrios</h1>
<div id="div_regions">
	|-if $message eq "ok"-|<div class="successMessage">Barrio guardado correctamente</div>|-/if-|
	|-if $message eq "deleted_ok"-|<div class="successMessage">Barrio eliminado correctamente</div>|-/if-|
	<table id="tabla-regions" border="0" cellpadding='5' cellspacing='0' class='tableTdBorders'>
		<thead>
			<tr>
				 <th colspan="2" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=lausiRegionsEdit" class="addLink">Agregar Barrio</a></div></th>
			</tr>
			<tr>
				<th>Nombre</th>
				<th>&nbsp;</th>
			</tr>
		</thead>
		<tbody>
		|-foreach from=$regions item=region name=for_regions-|
			<tr>
				<td>|-$region->getname()-|</td>
				<td nowrap>
					<form action="Main.php" method="get">
						<input type="hidden" name="do" value="lausiRegionsEdit" />
						<input type="hidden" name="id" value="|-$region->getid()-|" />
						<input type="submit" name="submit_go_edit_region" value="Editar" class="iconEdit" />
					</form>
					<form action="Main.php" method="post">
						<input type="hidden" name="do" value="lausiRegionsDoDelete" />
						<input type="hidden" name="id" value="|-$region->getid()-|" />
						<input type="submit" name="submit_go_delete_region" value="Borrar" onclick="return confirm('Seguro que desea eliminar el region?')" class="iconDelete" />
				</form></td>
			</tr>
		|-/foreach-|						
		|-if $pager->getTotalPages() gt 1-|
			<tr> 
				<td colspan="2" class="pages">|-include file="PaginateInclude.tpl"-|</td> 
			</tr>							
		|-/if-|						
			<tr>
				 <th colspan="2" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=lausiRegionsEdit" class="addLink">Agregar Barrio</a></div></th>
			</tr>
		</tbody>
	</table>
</div>