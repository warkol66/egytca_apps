<h2>##common,18,Configuración del Sistema##</h2>
<h1>Administración de Comunas</h1>
<!-- Link VOLVER -->
<!-- /Link VOLVER -->
<p>A continuación podrá editar la lista de Dependencias del sistema.</p>
<div id="div_communes">
	|-if $message eq "ok"-|
		<div class="successMessage">Comuna guardada correctamente</div>
	|-elseif $message eq "deleted_ok"-|
		<div class="successMessage">Comuna eliminada correctamente</div>
	|-/if-|
	<table width="450" border="0" cellpadding="5" cellspacing="0" class='tableTdBorders' id="tabla-communes">
		<thead>
			<tr>
				 <th colspan="3" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=tableroCommunesEdit" class="addLink">Agregar Comuna</a></div></th>
			</tr>
			<tr>
				<th width="5%" class="thFillTitle">Id</th>
				<th width="85%" class="thFillTitle">Nombre</th>
				<th width="10%" class="thFillTitle">&nbsp;</th>
			</tr>
		</thead>
		<tbody>|-if $communes|@count eq 0-|
			<tr>
				 <td colspan="3">|-if isset($filter)-|No hay Comunas que concuerden con la búsqueda|-else-|No hay Comunas disponibles|-/if-|</td>
			</tr>
		|-else-|
		|-foreach from=$communes item=commune name=for_communes-|
			<tr>
				<td class="line1">|-$commune->getid()-|</td>
				<td class="line1">|-$commune->getname()-|</td>
				<td nowrap>
					<form action="Main.php" method="get" style="display:inline;">
						<input type="hidden" name="do" value="tableroCommunesEdit" />
						<input type="hidden" name="id" value="|-$commune->getid()-|" />
						<input type="submit" name="submit_go_edit_commune" value="Editar" class="icon iconEdit" />
					</form>
					<form action="Main.php" method="post" style="display:inline;">
						<input type="hidden" name="do" value="tableroCommunesDoDelete" />
						<input type="hidden" name="id" value="|-$commune->getid()-|" />
						<input type="submit" name="submit_go_delete_commune" value="Borrar" onclick="return confirm('Seguro que desea eliminar el commune?')" class="icon iconDelete" />
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
				 <th colspan="3" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=tableroCommunesEdit" class="addLink">Agregar Comuna</a></div></th>
			</tr>
		|-/if-|
		</tbody>
	</table>
</div>
