<h2>Catálogo</h2>
<h1>Administración de Unidades de Medida</h1>
<div id="div_measureunits"> 
|-if $message eq "ok"-|<span class="message_ok">Measure Unit guardado correctamente</span>|-/if-| 
|-if $message eq "deleted_ok"-|<span class="message_ok">Measure Unit eliminado correctamente</span>|-/if-|
	<table class='tableTdBorders' cellpadding='4' cellspacing='0' width='400' id="tabla-measureunits"> 
		<thead> 
			<tr>
				 <th colspan="3"><div class="rightLink"><a href="Main.php?do=catalogMeasureUnitsEdit" class="agregarNueva">Agregar Unidad de Medida</a></div></th>
			</tr>
		<thead> 
			<tr> 
				<th width="20%" nowrap>Id</th> 
				<th width="70%" nowrap>Nombre</th> 
				<th width="10%" nowrap>&nbsp;</th> 
			</tr> 
		</thead> 
		<tbody>  
		|-foreach from=$measureunits item=measureunit name=for_measureunits-|
		<tr> 
			<td align="center">|-$measureunit->getid()-|</td> 
			<td>|-$measureunit->getname()-|</td> 
			<td nowrap> <form action="Main.php" method="get"> 
					<input type="hidden" name="do" value="catalogMeasureUnitsEdit" /> 
					<input type="hidden" name="id" value="|-$measureunit->getid()-|" /> 
					<input type="submit" name="submit_go_edit_measureunit" value="Editar" class="iconEdit" /> 
				</form> 
				<form action="Main.php" method="post"> 
					<input type="hidden" name="do" value="catalogMeasureUnitsDoDelete" /> 
					<input type="hidden" name="id" value="|-$measureunit->getid()-|" /> 
					<input type="submit" name="submit_go_delete_measureunit" value="Borrar" onclick="return confirm('Seguro que desea eliminar la unidad de medida?')" class="iconDelete" /> 
			</form></td> 
		</tr> 
		|-/foreach-|
		</tbody> 
  </table> 
</div>
