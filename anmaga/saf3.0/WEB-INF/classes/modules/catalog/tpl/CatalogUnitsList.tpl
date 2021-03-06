<h2>Catálogo</h2>
<h1>Administración de Unidades</h1>
<div id="div_units"> 
|-if $message eq "ok"-|
	<span class="message_ok">Unidad guardada correctamente</span>
|-elseif $message eq "deleted_ok"-|
	<span class="message_ok">Unidad eliminada correctamente</span>
|-/if-|
<p>A continuación se muestra el listado de unidades de venta disponible en el sistema. Si desea agregar una nueva, haga click en "Agregar Unidad". Si desea modificar una o eliminarla, haga click sobre los controles de la fila correspondiente.</p>
	<table class='tableTdBorders' cellpadding='4' cellspacing='0' width='400' id="tabla-units"> 
		<thead> 
			<tr>
				 <th colspan="4"><div class="rightLink"><a href="Main.php?do=catalogUnitsEdit" class="addLink">Agregar Unidad</a></div></th>
			</tr>
			<tr> 
				<th width="20%" nowrap>Id</th> 
				<th width="50%" nowrap>Nombre</th> 
				<th width="20%" nowrap>Cantidad</th> 
				<th width="10%" nowrap>&nbsp;</th> 
			</tr> 
		</thead> 
		<tbody>  
		|-if $units|@count gt 0-|
		|-foreach from=$units item=unit name=for_units-|
		<tr> 
			<td align="center">|-$unit->getId()-|</td> 
			<td>|-$unit->getName()-|</td> 
			<td align="right">|-$unit->getUnitQuantity()-|</td> 
			<td nowrap> <form action="Main.php" method="get"> 
					<input type="hidden" name="do" value="catalogUnitsEdit" /> 
					<input type="hidden" name="id" value="|-$unit->getid()-|" /> 
					<input type="submit" name="submit_go_edit_unit" value="Editar" class="icon iconEdit" /> 
				</form> 
				<form action="Main.php" method="post"> 
					<input type="hidden" name="do" value="catalogUnitsDoDelete" /> 
					<input type="hidden" name="id" value="|-$unit->getid()-|" /> 
					<input type="submit" name="submit_go_delete_unit" value="Borrar" onclick="return confirm('Seguro que desea eliminar esta unidad?')" class="icon iconDelete" /> 
				</form></td> 
		</tr> 
		|-/foreach-|
		|-else-|
		<tr>
			<td colspan="4">No hay unidades disponibles en el sistema</td> </tr>
		|-/if-|
		</tbody> 
	</table> 
</div>
