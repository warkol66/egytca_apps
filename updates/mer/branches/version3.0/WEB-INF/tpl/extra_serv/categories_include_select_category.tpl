<form action='Main.php' method='get'>
	<table class='tableTdBorders' cellspacing='1' cellpadding='0' border='0' width='100%'>
		<tr>
			<td class='celltitulo' width='35%' nowrap><div class='titulo2'>##103,Seleccione una categoría##</div></td>
			<td><select name="cat">
					<option value="0">##103,Seleccione una categoría##</option>
					|-foreach from=$categories item=category name=for_categories-|
					<option value="|-$category->getId()-|">|-$category->getName()-|</option>
					|-/foreach-|
				</select>
				<input type="hidden" name="do" value="|-$do-|" />
			</td>
		</tr>
		<tr>
			<td class='cellboton' colspan='2'><input type='submit' value='##150,Mostrar lista de Actores##' />
			</td>
		</tr>
	</table>
</form>
