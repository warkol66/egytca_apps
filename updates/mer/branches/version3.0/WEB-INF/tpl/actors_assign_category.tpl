<table border='0' cellpadding='0' cellspacing='0' width='100%'>
	<tr>
		<td class='titulo'>##40,Configuración del Sistema##</td>
	</tr>
	<tr>
		<td class='subrayatitulo'><img src="images/clear.gif" height='3' width='1'></td>
	</tr>
	<tr>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td class='fondotitulo'>##110,Categorizar Actores##</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td class='texto'>##111,A continuación podrá asignar una categoría a cada uno de los Actores ingresado en el paso previo que no tengan una asignada##.</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
	</tr>
</table>
|-if $actors|@count eq 0-|
<table class='tablaborde' width='100%' border='0' cellspacing='1' cellpadding='5'>
	<tr>
		<th>##112,Todos los Actores ingresados están categorizadas##.</th>
	</tr>
</table>
|-else-|
<form name="form1" method="post" action="Main.php">
	<table class='tablaborde' width='100%' border='0' cellspacing='1' cellpadding='5'>
		<tr>
			<th>##101,Nombre del Actor##</th>
			<th>##102,Categoría##</th>
			<th>&nbsp;</th>
		</tr>
		|-foreach from=$actors item=actor name=for_actors-|
		<tr valign="top">
			<td width='70%' class='celldato'><span class='titulo2'>|-$actor->getName()-|</span></td>
			<td width='20%' class='celldato'><select name="cat[|-$actor->getId()-|]">
					<option value="0">##103,Seleccione una categoría##</option>
					|-foreach from=$categories item=category name=for_categories-|
					<option value="|-$category->getId()-|">|-$category->getName()-|</option>
					|-/foreach-|
				</select>
			</td>
			<td class='cellopciones' width='10%' nowrap>[ <a href='Main.php?do=actorsEditActorCategory&actor=|-$actor->getId()-|' class='edit'>##114,Editar##</a> ]
				[ <a href='Main.php?do=actorsDoDeleteActor&actor=|-$actor->getId()-|' class='elim' onclick="return confirm('##116,Esta opción eliminar permanentemente a este Actor\n¿Está seguro que desea eliminarlo?##');">##115,Eliminar##</a> ]</td>
		</tr>
		|-/foreach-|
		<tr>
			<td class='cellboton' colspan='3'><input type="hidden" name="do" value="actorsDoAssignCategoryToActors" />
				<input type='submit' name='guardar' value='##97,Guardar##' class='boton' />
				&nbsp;&nbsp;
				<input type='button' name='Button' value='##104,Regresar##' onClick='history.go(-1)' class='boton' />
			</td>
		</tr>
	</table>
</form>
|-/if-| <br />
<p class='titulo'><a name='recategorizar'></a>##113,Cambiar Categorías Asignadas##</p>
|-include file="CategoriesSelectInclude.tpl" do="actorsAssignCategoryToActors"-|
|-if $actorsCategory|count gt 0-|
<table class='tablaborde' width='100%' border='0' cellspacing='1' cellpadding='5'>
	<tr>
			<th>##101,Nombre del Actor##</th>
			<th>##102,Categoría##</th>
		<th>&nbsp;</th>
	</tr>
	|-foreach from=$actorsCategory item=actor name=for_actors_category-|
	<tr valign="top">
		<td width='70%' class='celldato'><span class='titulo2'>|-$actor->getName()-|</span></td>
		<td width='20%' class='celldato'> |-$currentCategory->getName()-| </td>
		<td class='cellopciones' width='10%' nowrap>[ <a href='Main.php?do=actorsEditActorCategory&actor=|-$actor->getId()-|' class='edit'>##114,Editar##</a> ]
			[ <a href='Main.php?do=actorsDoDeleteActor&actor=|-$actor->getId()-|' class='elim' onclick="return confirm('##116,Esta opción eliminar permanentemente a este Actor\n¿Está seguro que desea eliminarlo?##');">##115,Eliminar##</a> ]</td>
	</tr>
	|-/foreach-|
</table>
|-/if-| 