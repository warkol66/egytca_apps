<h2>Configuración del Sistema</h2>
		<h1>Categorizar Actores</h1>
	<p>A continuación podrá asignar una categoría a cada uno de los Actores ingresado en el paso previo que no tengan una asignada.</p>
|-if $actors|@count eq 0-|
<table class='tableTdBorders' width='100%' border='0' cellspacing='1' cellpadding='5'>
	<tr>
		<th>Todos los Actores ingresados están categorizadas.</th>
	</tr>
</table>
|-else-|
<form name="form1" method="post" action="Main.php">
	<table class='tableTdBorders' width='100%' border='0' cellspacing='1' cellpadding='5'>
		<tr>
			<th>##101,Nombre del Actor##</th>
			<th>##102,Categoría##</th>
			<th>&nbsp;</th>
		</tr>
		|-foreach from=$actors item=actor name=for_actors-|
		<tr valign="top">
			<td width='70%'><span class='titulo2'>|-$actor->getName()-|</span></td>
			<td width='20%'><select name="cat[|-$actor->getId()-|]">
					<option value="0">##103,Seleccione una categoría##</option>
					|-foreach from=$categories item=category name=for_categories-|
					<option value="|-$category->getId()-|">|-$category->getName()-|</option>
					|-/foreach-|
				</select>
			</td>
			<td class='cellopciones' width='10%' nowrap><a href='Main.php?do=actorsEditCategory&actor=|-$actor->getId()-|' title="Editar"><img src="images/clear.png" class="icon iconEdit" /></a>
				<a href='Main.php?do=actorsDoDelete&actor=|-$actor->getId()-|' title="Eliminar" onclick="return confirm('##116,Esta opción eliminar permanentemente a este Actor\n¿Está seguro que desea eliminarlo?##');"><img src="images/clear.png" class="icon iconDelete" /></a></td>
		</tr>
		|-/foreach-|
		<tr>
			<td class='cellboton' colspan='3'><input type="hidden" name="do" value="actorsDoAssignCategory" />
				<input type='submit' name='guardar' value='##97,Guardar##' />
				&nbsp;&nbsp;
				<input type='button' name='Button' value='##104,Regresar##' onClick='history.go(-1)' />
			</td>
		</tr>
	</table>
</form>
|-/if-| <br />
<h3><a name='recategorizar'></a>Cambiar Categorías Asignadas</h3>
|-include file="CategoriesSelectInclude.tpl" do="actorsAssignCategory"-|
|-if $actorsCategory|count gt 0-|
<table class='tableTdBorders' width='100%' border='0' cellspacing='1' cellpadding='5'>
	<tr>
			<th>##101,Nombre del Actor##</th>
			<th>##102,Categoría##</th>
		<th>&nbsp;</th>
	</tr>
	|-foreach from=$actorsCategory item=actor name=for_actors_category-|
	<tr valign="top">
		<td width='70%'><span class='titulo2'>|-$actor->getName()-|</span></td>
		<td width='20%'> |-$currentCategory->getName()-| </td>
		<td class='cellopciones' width='10%' nowrap><a href='Main.php?do=actorsEditCategory&actor=|-$actor->getId()-|' title="Editar"><img src="images/clear.png" class="icon iconEdit" /></a>
			<a href='Main.php?do=actorsDoDelete&actor=|-$actor->getId()-|' title="Eliminar" onclick="return confirm('##116,Esta opción eliminar permanentemente a este Actor\n¿Está seguro que desea eliminarlo?##');"><img src="images/clear.png" class="icon iconDelete" /></a></td>
	</tr>
	|-/foreach-|
</table>
|-/if-| 