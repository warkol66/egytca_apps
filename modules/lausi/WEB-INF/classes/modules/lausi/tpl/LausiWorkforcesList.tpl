<h2>Configuración del Sistema</h2>
<h1>Contratistas</h1>
<div id="div_workforces">
	|-if $message eq "ok"-|<span class="message_ok">Contratista guardado correctamente</span>|-/if-|
	|-if $message eq "deleted_ok"-|<span class="message_ok">Contratista eliminado correctamente</span>|-/if-|
	<table id="tabla-workforces" border="0" cellpadding='5' cellspacing='0' class='tableTdBorders'>
		<thead>
			<tr>
				 <th colspan="6" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=lausiWorkforcesEdit" class="addLink">Agregar Contratista</a></div></th>
			</tr>
			<tr>
				<th>Id</th>
				<th>Nombre</th>
				<th>Teléfono</th>
				<th>Trabaja en Altura</th>
<!--				<th>Cantidad de Carteleras Asignadas</th>-->
				<th>&nbsp;</th>
			</tr>
		</thead>
		<tbody>
		|-foreach from=$workforces item=workforce name=for_workforces-|
			<tr>
				<td>|-$workforce->getid()-|</td>
				<td>|-$workforce->getname()-|</td>
				<td>|-$workforce->gettelephone()-|</td>
				<td align="center">|-$workforce->getworkInHeight()|si_no-|</td>
				<!-- <td>|-*$workforce->getAssignedBillboardsCount()*-|</td>-->
				<td nowrap>
					<form action="Main.php" method="get">
						<input type="hidden" name="do" value="lausiWorkforcesEdit" />
						<input type="hidden" name="id" value="|-$workforce->getid()-|" />
						<input type="submit" name="submit_go_edit_workforce" value="Editar" class="iconEdit" />
					</form>
					<form action="Main.php" method="post">
						<input type="hidden" name="do" value="lausiWorkforcesDoDelete" />
						<input type="hidden" name="id" value="|-$workforce->getid()-|" />
						<input type="submit" name="submit_go_delete_workforce" value="Borrar" onclick="return confirm('Seguro que desea eliminar el workforce?')" class="iconDelete" />
					</form>				</td>
			</tr>
		|-/foreach-|						
		|-if $pager->getTotalPages() gt 1-|
			<tr> 
				<td colspan="6" class="pages">|-include file="PaginateInclude.tpl"-|</td> 
			</tr>							
		|-/if-|						
			<tr>
				 <th colspan="6" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=lausiWorkforcesEdit" class="addLink">Agregar Contratista</a></div></th>
			</tr>
		</tbody>
	</table>
</div>