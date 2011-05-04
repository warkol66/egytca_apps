<form method='post' action='Main.php'>
	<input type='hidden' name='id' value='|-$actor->getId()-|' />
	<table class='tablaborde' width='100%' border='0' cellspacing='1' cellpadding='5'>
		<tr>
			<th class='celltitulo'><div class='titulo2'>##101,Nombre del Actor##</div></th>
			<th class='celltitulo'><div class='titulo2'>##102,Categoría##</div></th>
		</tr>
		<tr>
			<td width='70%' class='celldato'><input name='name' type='text' value='|-$actor->getName()-|' size='75' class='textodato' /></td>
			<td width='30%' class='celldato'><select name="category">
					<option value="0">##103,Seleccione una categoría##</option>
									|-foreach from=$categories item=category name=for_categories-|
					<option value="|-$category->getId()-|"|-if $category->getId() eq $actor->getCategoryId()-| selected="selected"|-/if-|>|-$category->getName()-|</option>
									|-/foreach-|
				</select>
			</td>
		</tr>
		<tr>
			<td colspan='2' class='cellboton'><input type="hidden" name="do" value="actorsDoEditActorCategory" />
				<input type="hidden" name="action" value="|-$include_action-|" />
				<input type='submit' value='##97,Guardar##' class='boton' />
				&nbsp;&nbsp;
				<input type='button' name='Button' value='##104,Regresar##' onClick='history.go(-1)' class='boton' />
			</td>
		</tr>
	</table>
</form>
